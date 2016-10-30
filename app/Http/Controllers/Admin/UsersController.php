<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserPermissions;
use App\Libraries\Colors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Libraries\PID;
use App\Libraries\PTYPE;

class UsersController extends Controller {
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['admin', 'permission:admin.users.access']);
    }

    /**
     * Show the admin dashboard
     *  RETURN HOME BY DEFAULT
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() {  return $this->home(); }

    /**
     * Show the admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
        $usr = User::all();
		
        $Page = [
            'PID'	  	  => PID::$ADMIN_Users,
            'Title'      => "Manage Users",
			'Header'	  => [
				'Text'	  => 'Users',
				'Sub'	  => 'Managing all users',
				'Color'   => Colors::$ADMIN_Users
			],
	
			'Type'		  => PTYPE::$Dashboard,
            'IsBCHome' 	  => false,
            'Breadcrumbs' => [[
                'Text' 	  => 'Admin',
                'Url' 	  => '/admin/home',
                'Active'  => false
            ],[
                'Text' 	  => 'Users',
                'Url' 	  => '#',
                'Active'  => true
            ]]
        ];
        
        
        /*
        echo "<pre>";
        foreach($usr as $user) {
            echo "ID: ". $user->getID(). "\n";

            echo "\n\n\n";
            die("");
        } //*/

        // List users
        return view('areas.admin.users.home', ['PAGE' => $Page, 'users' => $usr]);
    }

    public function query($query) {
		if ($query == "*") {
			$usr = User::all();
		} else if (is_numeric($query)) {
			$usr = User::where('name', 'like', '%'. $query. '%')
				     ->orWhere('email', 'like', '%'. $query. '%')
				     ->orWhere('id', '=', $query)
				     ->get();
		} else {
			$usr = User::where('name', 'like', '%'. $query. '%')
				     ->orWhere('email', 'like', '%'. $query. '%')
				     ->get();
		}
        
        $Page = [
            'PID'	  	  => PID::$ADMIN_Users,
			'Title'       => "Manage Users",
			'Header'	  => [
				'Text'	  => 'Users',
				'Sub'	  => 'Managing all users',
				'Color'   => Colors::$ADMIN_Users
			],
			
			'Type'		  => PTYPE::$Dashboard,
            'IsBCHome' 	  => false,
            'Breadcrumbs' => [[
                'Text' 	  => 'Admin',
                'Url' 	  => '/admin/home',
                'Active'  => false
            ],[
                'Text' 	  => 'Users',
                'Url' 	  => '#',
                'Active'  => true
            ]]
        ];
    
    
        // List users
        return view('areas.admin.users.home', 
            ['PAGE' => $Page, 'query' => $query, 'users' => $usr]);
    } 

    public function queryp($query) {
		if ($query == "*") {
			$usr = User::all();
		} else if (is_numeric($query)) {
			$usr = User::where('name', 'like', '%'. $query. '%')
				     ->orWhere('email', 'like', '%'. $query. '%')
				     ->orWhere('id', '=', $query)
				     ->get();
		} else {
			$usr = User::where('name', 'like', '%'. $query. '%')
				     ->orWhere('email', 'like', '%'. $query. '%')
				     ->get();
		}

        // List users
        return view('areas.admin.users.userlist', 
            ['users' => $usr]);
    }
	
    public function view($id) {
		if(!Auth::user()->can('admin.users.view'))
			return redirect('/admin/users');
		
        if(!User::ExistsID($id)) {
            return view('areas.admin.users.notfound', [
                'id' => $id]);
        }

        $user = User::find($id);
		/* @var User $user*/
	
		
		$Page = [
			'PID'	  	  => PID::$ADMIN_Users,
			'Title'       => "Manage Users",
			'Header'	  => [
				'Text'	  => 'View User',
				'Sub'	  => 'Viewing '. $user->getName(),
				'Color'   => Colors::$ADMIN_Users,
				'NoHead'  => true
			],
			
			'Type'		  => PTYPE::$Dashboard,
			'IsBCHome' 	  => false,
			'Breadcrumbs' => [[
				'Text' 	  => 'Admin',
				'Url' 	  => '/admin/home',
				'Active'  => false
			],[
				'Text' 	  => 'Users',
				'Url' 	  => '/admin/users',
				'Active'  => true
			],[
				'Text' 	  => $user->getName(),
				'Url' 	  => '#',
				'Active'  => true
			]]
		];
		
        return view('areas.admin.users.view', ['PAGE' => $Page, 'user' => $user]);
    }
	
    public function update($id) {
		if(!Auth::user()->can('admin.users.update'))
			return redirect('/admin/users');
		
        // Should i check if the user is myself
        // im 50/50 on it.
		
        // Check if the user is myself
    }
	
    public function delete($id) {
		if(!Auth::user()->can('admin.users.delete'))
			return redirect('/admin/users');
		
        $me = Auth::user();

        $model = array(
            'deleted' => false,
            'error' => 'Could not process request (Fallthrough)'
        );

        // Check if the user is me, if so cancel request
        if($id == $me->getID()) {
            $model["deleted"] = false;
            $model["error"] = "You cant delete your self silly!";
            goto ReturnResult;
        }
		
        // Check if the user exists
        if(!User::ExistsID($id)) {
            $model["deleted"] = false;
            $model["error"] = "User does not exist!!!";
            goto ReturnResult;
        }
		
        // Delete the user
        try {
            $user = User::find($id);
            $user->delete();

            $model['deleted'] = true;
            $model['error'] = null;
        } catch (\Exception $ex) {
            // No need for debugging since this
            // is the site admin, im sure they will
            // be-able to read some simple error message
            $model['error'] = $ex->getMessage();
            goto ReturnResult;
        }
	
    ReturnResult:
        return $model;
    }
}
