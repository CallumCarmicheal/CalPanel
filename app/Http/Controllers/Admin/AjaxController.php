<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

class AjaxController extends Controller {
    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware(['permission:admin.ajax.access']);
    }

    public function __todo() {
		return array();
	}
	
	public function QueryUserList($slug, $query) {
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
		
		foreach($AllRUsers as $user) {
			array_push($AllEmails, $user->getEmail());
		}
		
		$suggestions = [];
		
		foreach($AllUsers as $user) {
			if(in_array($user->getEmail(), $AllEmails)) 
				continue;
			
			$tmp = [
				'value' => $user->getName(). ' | '. $user->getEmail(),
				'data'  => $user->getID()
			];
			
			array_push($suggestions, $tmp);
		}
		
		$result = [ 'suggestions' => $suggestions ];
		return $result;
	}
    
}
