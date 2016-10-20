<?php

namespace App\Http\Controllers;

use App\Helpers\RolePermissions;
use App\Libraries\Colors;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Libraries\PID;
use App\Libraries\PTYPE;

class HomeController extends Controller{
	/**
	 * Create a new controller instance.
	 *
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$Page = [
			'PID'	  	  => PID::$HOME_Index,
			'Title'       => "Home",
			'Header'	  => [
				'Text'	  => 'Dashboard',
				'Sub'	  => 'Personalized Homepage!',
				'Color'   => Colors::$HOME_Index
			],
			
			'Type'		  => PTYPE::$Dashboard,
			'IsBCHome' 	  => true,
			'Breadcrumbs' => []
		];

		return view('areas.home.index', ['PAGE' => $Page]);
	}

	
	
	public function test() {
		return view('/');
		
		// Get the role "admin" via the slug
		$role = Role::getRoleFromSLug("admin");
		
		// List off all the current perm slugs in the
		// current role
		echo "Slugs in the current role: ";
		$perm = $role->getPermissionsSLugs();
		
		foreach($perm as $p) 
			echo "$p <br>";
		echo "<br><br>";
		
		// Get all the permissions for the 
		// current role
		$rp = RolePermissions::GetAllPermissions($role);
		
		// Loop through each of the perms
		foreach($rp as $p) {
			echo $p->slug;
			echo "<br>";
			
			if ($p->isEnabled()) 
				 echo "Enabled";
			else echo "Disabled";
			
			// Now we want to flip the
			// enabled to disabled
			// and 
			// disabled to enabled
			// Set to !(ENABLED) | Opposite of Enabled
			$p->setState(!$p->isEnabled());
			
			echo "<br><br>";
		}
	}
}
