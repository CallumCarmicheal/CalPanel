<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RolePermissions;
use App\Libraries\Colors;
use App\Libraries\PID;
use App\Libraries\PTYPE;
use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RolesController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware(['admin', 'permission:admin.roles.access']);
    }

    /**
     * Show the roles dashboard
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() { return $this->home(); }

    /**
     * Show the roles dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
		$Roles = Role::all();
	
		$Page = [
			'PID'	  	  => PID::$ADMIN_Roles,
			'Title'       => "Roles",
			'Header'	  => [
				'Text'	  => 'Roles',
				'Sub'	  => 'Listing user roles!',
				'Color'   => Colors::$ADMIN_Roles
			],
		
			'Type'		  => PTYPE::$Dashboard,
			'IsBCHome' 	  => false,
			'Breadcrumbs' => [[
				'Text' 	  => 'Admin',
				'Url' 	  => '/admin/home',
				'Active'  => false
			],[
				'Text' 	  => 'Roles',
				'Url' 	  => '#',
				'Active'  => true
			]]
		];
		
        return view('areas.admin.roles.home', ['PAGE' => $Page, 'roles' => $Roles]);
    }
    
    public function query($query) 	{
		if (is_numeric($query)) {
			$Roles = Role::where('slug', 'like', '%'. $query. '%')
				->orWhere('name', 'like', '%'. $query. '%')
				->orWhere('level', '=', $query)
				->get();
		} else {
			$Roles = Role::where('slug', 'like', '%'. $query. '%')
				->orWhere('name', 'like', '%'. $query. '%')
				->get();
		}
	
		$Page = [
			'PID'	  	  => PID::$ADMIN_Roles,
			'Title'       => "Roles",
			'Header'	  => [
				'Text'	  => 'Roles',
				'Sub'	  => 'Listing user roles!',
				'Color'   => Colors::$ADMIN_Roles
			],
		
			'Type'		  => PTYPE::$Dashboard,
			'IsBCHome' 	  => false,
			'Breadcrumbs' => [[
				'Text' 	  => 'Admin',
				'Url' 	  => '/admin/home',
				'Active'  => false
			],[
				'Text' 	  => 'Roles',
				'Url' 	  => '#',
				'Active'  => true
			]]
		];
	
	
		return view('areas.admin.roles.home', ['PAGE' => $Page, 'roles' => $Roles]);
	}
	
	public function queryp($query) 	{
		if ($query == "*") {
			$Roles = Role::all();
		} else if (is_numeric($query)) {
			$Roles = Role::where('slug', 'like', '%'. $query. '%')
				->orWhere('name', 'like', '%'. $query. '%')
				->orWhere('level', '=', $query)
				->get();
		} else {
			$Roles = Role::where('slug', 'like', '%'. $query. '%')
				->orWhere('name', 'like', '%'. $query. '%')
				->get();
		} 
		
		return view('areas.admin.roles.list', ['roles' => $Roles]);
	}

	public function queryu($slug, $query) {
		/** @var User[] $AllUsers */
		if ($query == "*") {
			$AllUsers = User::all();
		} else {
			$AllUsers = User::where('email', 'like', '%'. $query. '%')
				 		  ->orWhere('name',  'like', '%'. $query. '%')
						  ->get();
		}
		
		$AllRUsers = Role::getRoleFromSLug($slug);
		$AllRUsers = $AllRUsers->usersInRole();
		$AllEmails = array();
		
		foreach($AllRUsers as $user) 
			array_push($AllEmails, $user->getEmail());
		
		$usr = [];
		foreach($AllUsers as $user) {
			if(in_array($user->getEmail(), $AllEmails)) 
				continue;
			array_push($usr, $user);
		}
		

        // List users
        return view('areas.admin.roles.res.users', 
            ['users' => $usr]);
    } 
	
	public function view($slug) 	{
		/** @var Role $r */
		$r = Role::getRoleFromSLug($slug);
		
		$Page = [
			'PID'	  	  => PID::$ADMIN_Roles,
			'Title'       => "Roles",
			'Header'	  => [
				'Text'	  => 'INVALID',
				'Sub'	  => 'Cannot find (slug:'.$slug.').',
				'Color'   => Colors::$ADMIN_Roles
			],
			
			'Type'		  => PTYPE::$Dashboard,
			'IsBCHome' 	  => false,
			'Breadcrumbs' => [[
				'Text' 	  => 'Admin',
				'Url' 	  => '/admin/home',
				'Active'  => false
			],[
				'Text' 	  => 'Roles',
				'Url' 	  => '/admin/roles',
				'Active'  => false
			],[
				'Text' 	  => 'Invalid Role',
				'Url' 	  => '#',
				'Active'  => true
			]]
		];
		
		if(!$r) 
			return view (
				'areas.admin.roles.notfound', 
				['PAGE' => $Page, 'slug' => $slug]
			);
		
		$Page['Header']['Text'] 		= "Role";
		$Page['Header']['Sub'] 			= $r->name;
		$Page['Breadcrumbs'][2]['Text'] = $r->name;
		
		$rps = RolePermissions::GetAllPermissions($r, true, true);
		
		return view (
			'areas.admin.roles.view',
			['PAGE' => $Page, 'role' => $r, 'rps' => $rps]
		);
	}
	
	public function update($slug)	{
		$result = [
			'success'	 => false,
			'error' 	 => "",
			'message' 	 => ""
		];
		
		if ($slug == "admin") {
			$response["message"] = "You cannot edit the admin role's permissions!";
			return $response;
		}
		
		try {
			$Role = Role::getRoleFromSLug($slug);
		} catch (\Exception $ex) {
			$result["error"] = "Failed to get the role, maybe it was deleted.";
			return $result;
		}
		
		$perms = Input::get('perms');
		foreach ($perms as $p) {
			try { $perm = Permission::find ($p["id"]); } 
			catch (\Exception $ex) {
				$result["message"] .= "Cannot find permission with ID: ". $p["id"]. "\n";
				continue;
			}
			
			try {
				if ($p["en"] == 1) {
					$result['message'] .= 
						'Attached permission '. $perm->name. " [slug:". $perm->slug. "]";
					$Role->attachPermission ($perm);
				} else {
					$result['message'] .=
						'Removed permission '. $perm->name. " [slug:". $perm->slug. "]";
					$Role->detachPermission($perm);
				}
			} catch (\Exception $ex) { /*Already detached or attached*/ }
		}
		
		$result['success'] = true;
		$result['message'] = 'Finished\n';
		
		return $result;
	}
	
	public function delete($slug) {
		$response = [
			'success' => false,
			'message' => ''
		];
		
		if ($slug == "admin" || $slug == "everyone") {
			$response["message"] = "You cannot delete the default role's (slug:admin, slug:everyone)!";
			return $response;
		}
		
		try {
			$Role = Role::getRoleFromSLug($slug);
		} catch (\Exception $ex) {
			$response["message"] = "Failed to find role, maybe it was deleted or eaten?";
			return $response;
		}
		
		try {
			$Role->delete();
		} catch (\Exception $ex) {
			$response["message"] = "Failed to delete the role!";
			return $response;
		}
		
		$response["success"] = true;
		return $response;
	}
	
	public function AddUser($slug, $id) {
		$response = [
			'success' => false,
			'message' => ''
		];
		
		if ($slug == "everyone") {
			$response["message"] = "You cannot remove/add users from the default everyone role (slug:everyone)!";
			return $response;
		}
		
		try {
			$Role = Role::getRoleFromSLug($slug);
		} catch (\Exception $ex) {
			$response["message"] = "Failed to find role, maybe it was deleted or eaten?";
			return $response;
		}
		
		try {
			/** @var User $User */
			$User = User::find($id);
		} catch (\Exception $ex) {
			$response["message"] = "Failed to find user with id:". $id;
			return $response;
		}
		
		try {
			$User->attachRole($Role);
		} catch (\Exception $ex) {
			$response["message"] = "Failed to add user to the current role, ". 
				"maybe the user is already in the role or ". 
				"1) The user has been deleted ". 
				"2) The role was deleted". 
				"3) The user is already in the role. Try refreshing!";
			return $response;
		}
		
		$response["success"] = true;
		return $response;
	}

	public function RemUser($slug, $id) {
		$response = [
			'success' => false,
			'message' => ''
		];
		
		if ($slug == "everyone") {
			$response["message"] = "You cannot remove/add users from the default everyone role (slug:everyone)!";
			return $response;
		}
		
		try {
			$Role = Role::getRoleFromSLug($slug);
		} catch (\Exception $ex) {
			$response["message"] = "Failed to find role, maybe it was deleted or eaten?";
			return $response;
		}
		
		try {
			/** @var User $User */
			$User = User::find($id);
		} catch (\Exception $ex) {
			$response["message"] = "Failed to find user with id:". $id;
			return $response;
		}
		
		try {
			$User->detachRole($Role);
		} catch (\Exception $ex) {
			$response["message"] = "Failed to remove user to the current role, ".
				"maybe the user is already in the role or ".
				"1) The user has been deleted ".
				"2) The role was deleted".
				"3) The user is not in the role. Try refreshing!";
			return $response;
		}
		
		$response["success"] = true;
		return $response;
	}
	
	public function MakeRole($slug, $name, $description) {
		$response = [
			"success" => false,
			"message" => "",
			"id"	  => ""
		];
		
		if (Role::getRoleFromSLug($slug) != false) {
			$response['message'] = 
				"The role $name [slug:$slug] already exists, please ".
				"<a href=\"". url('/admin/role'). "/$slug\">edit that</a> or change the slug of the role you are ".
				"trying to make!";
			return $response;
		}
		
		try {
			Role::create ([
				'name' => $name,
				'slug' => $slug,
				'description' => $description,
				'level' => 1
			]);
		} catch (\Exception $ex) {
			$response['message'] = "Failed to make role. Maybe the role's slug is ".
			"already taken, please refresh and check. If this error persists ".
			"please check if you have any invalid characters or contact a member of staff! ".
			"Wait you are staff... Well sucks to be you i guess.";
			return $response;
		}
		
		// Test the newly created role
		$Role = Role::getRoleFromSLug($slug);
		if ($Role == false) {
			$response['message'] = "Failed to check role, please refresh!";
			return $response;
		}
		
		$response['id'] = $Role->slug;
		$response["success"] = true;
		
		return $response;
	}
}
