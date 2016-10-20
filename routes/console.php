<?php

use Illuminate\Foundation\Inspiring;
use Bican\Roles\Models\Role;
use App\User;
use Bican\Roles\Models\Permission;

/**
 * @param $role Role
 * @param $slug string 
 * @param $name string 
 * @param $desc string
 * @return bool
 */
function mkatperm($role, $slug, $desc) {
	$name = $slug;
	
	try {
		Permission::create([
			'name' => $slug,
			'slug' => $name,
			'description' => $desc, // optional
		]); echo "Created\t\t '$name' [$slug] permission\n";
	} catch (\Exception $ex) {
		echo "Exists\t\t '$name' [$slug] already exists\n";
	}
	
	$r_name = $role->name;
	$r_slug = $role->slug;
	
	$result = false;
	
	//if(rand(0,1) == 1) {
		$result = $role->attachPermissionFromSLug ($slug);
		
		if ($result)
			 echo "Attached\t '$name' [$slug] permission to the role '$r_name' [$r_slug]\n";
		else echo "Failed to attach '$name' [$slug] permission to the role '$r_name' [$r_slug]\n";
	//} else {
	//	echo "Skipped\t\t '$name' [$slug] permission to the role '$r_name' [$r_slug]\n";
	//}
	
	return $result;
}

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('cp:roles/add {slug} {name} {description} {level=1}', function ($name, $slug, $description, $level=1) {
	// Allow artisan to throw the errors so they look pretty!
	$newRole = Role::create ([
		'name' => $name,
		'slug' => $slug,
		'description' => $description,
		'level' => $level
	]);
	
	$newRole = Role::getRoleFromSLug ($slug);
	
	echo ("Added '$name' role with Level:" .$newRole->slug. "\n");

	echo("\n");
})->describe('Create a role');

Artisan::command('cp:roles/delete {slug}', function ($slug) {
	echo "CalPanel/User/Roles::Delete('$slug')\n";
	
	$role = Role::where('slug', '=', $slug)
		->first();
	
	/** @var Role $role */
	
	if($role == null) {
		echo "Role does not exist\n";
		return;
	}
	
	$role->delete();
	
	echo("Deleted role with slug:".$slug."\n");
})->describe('Delete a role');

Artisan::command('cp:roles:setup/default', function () {
	try {
		DB::connection()->getPdo();
		echo "Connected successfully to database ".DB::connection()->getDatabaseName(). "\n";
	} catch (\Exception $ex) {
		echo "Could not connect to database\n";
		return;
	}
	
	echo "Creating default roles!\n";
	
	$_admin  = null;
	/** @var Role $_admin */
	
	$r_slug  = "admin";
	$r_name  = "Admin";
	$r_desc  = "Website Administrator/Developer";
	$r_level = 100; // 0 = Lowest, 100 = Highest
	
	try {
		Role::create([
			'name' => $r_name,
			'slug' => $r_slug,
			'description' => $r_desc,
			'level' => $r_level
		]); echo "Created\t\t '$r_name' [$r_slug] role with the Level:$r_level\n";
	} catch (\Exception $ex) {
		echo "Role\t\t '$r_name' [slug:$r_slug] already exists\n";
	}
	
	try {
		Role::create([
			'name' 			=> "Everyone",
			'slug' 			=> "everyone",
			'description'	=> "This role is applied to every user!",
			'level' 		=> 0
		]); echo "Created\t\t 'Everyone/Default' [slug:everyone] role with the Level:$r_level\n";
	} catch (\Exception $ex) {
		echo "Role\t\t 'Everyone' [slug:everyone] already exists\n";
	}
	
	// Attach the role "everyone" to every user
	$everyone = null;
	try {
		$everyone = Role::getRoleFromSLug("everyone");
	} catch (\Exception $ex) {
		echo "ERROR\t\t failed to get the everyone role by slug:'everyone' please try again\n";
		return;
	}
	
	foreach (User::all() as $user) {
		/** @var $user User */
		
		try {
			$user->attachRole($everyone);
			echo "Attached\t 'Everyone' role to the user email:". $user->getEmail(). "\n";
		} catch (\Exception $ex) {
			/* User is already in the role! */
		}
	}
	
	
	// Attach all the permissions to 
	
	$_admin = Role::getRoleFromSLug($r_slug);
	if(!$_admin) {
		echo "Could not retrieve role 'slug:$r_slug' from the database\n";
		return;
	}
	
	
	/*
	 mkatperm ($_admin, '', '');
	*/
	
	mkatperm ($_admin, 'admin.access', 					'Display the admin tab on the side of the screen');
	
	mkatperm ($_admin, 'admin.ajax.access', 			'Allow access to the ajax misc api');
	
	mkatperm ($_admin, 'admin.home.access', 			'Access the home dashboard');
	
	mkatperm ($_admin, 'admin.users.access', 			'Access the users dashboard');
	mkatperm ($_admin, 'admin.users.list', 				'List of all the users');
	mkatperm ($_admin, 'admin.users.view', 				'View a users profile'); // Requires the admin.users.access perm
	mkatperm ($_admin, 'admin.users.update', 			'Edit/Update a user account');
	mkatperm ($_admin, 'admin.users.padd', 				'Add a per user permission');
	mkatperm ($_admin, 'admin.users.pdel', 				'Delete a per user permission');
	mkatperm ($_admin, 'admin.users.delete', 			'Delete a user');
	mkatperm ($_admin, 'admin.users.edit', 				'Edit a user');
	
	mkatperm ($_admin, 'admin.roles.access', 			'Access the roles dashboard');
	mkatperm ($_admin, 'admin.roles.list', 				'List of all the roles');
	mkatperm ($_admin, 'admin.roles.add', 				'Add a role');
	mkatperm ($_admin, 'admin.roles.delete', 			'Delete a role');
	mkatperm ($_admin, 'admin.roles.edit', 				'Edit a role');
	
	mkatperm ($_admin, 'community.access',	 			'Access the community tab');
	
	mkatperm ($_admin, 'community.chat.access', 		'Access the community chat');
	mkatperm ($_admin, 'community.chat.message', 		'Send messages in the staff chat');
	
	mkatperm ($_admin, 'community.todo.access', 		'Access the TODO list');
	mkatperm ($_admin, 'community.todo.create', 		'Create a task');
	mkatperm ($_admin, 'community.todo.mark', 			'Mark a task for completion');
	mkatperm ($_admin, 'community.todo.edit', 			'Edit a task');
	mkatperm ($_admin, 'community.todo.delete', 		'Delete a task');
	
	mkatperm ($_admin, 'stealth.access', 				'Access the stealth tab');
	
	mkatperm ($_admin, 'stealth.log.access', 			'Access the server log(s)');
	mkatperm ($_admin, 'stealth.log.clear', 			'Clear the log(s)');
	
	mkatperm ($_admin, 'stealth.planner.access', 		'Access the update planner');
	mkatperm ($_admin, 'stealth.planner.push', 			'Add an a update');
	mkatperm ($_admin, 'stealth.planner.edit', 			'Edit an update’s comments');
	mkatperm ($_admin, 'stealth.planner.delete', 		'Delete an update');
	
	mkatperm ($_admin, 'stealth.clients.access',		'Access the clients');
	mkatperm ($_admin, 'stealth.clients.add', 			'Adds a stealth client/console');
	mkatperm ($_admin, 'stealth.clients.edit', 			'Edit a client');
	mkatperm ($_admin, 'stealth.clients.view', 			'See detailed information on the client');
	mkatperm ($_admin, 'stealth.clients.delete', 		'Delete a client');
	
	mkatperm ($_admin, 'stealth.tokens.access', 		'Access the token manager');
	mkatperm ($_admin, 'stealth.tokens.view', 			'View all tokens by current user');
	mkatperm ($_admin, 'stealth.tokens.all', 			'View all tokens by all users');
	mkatperm ($_admin, 'stealth.tokens.add', 			'Add a token');
	mkatperm ($_admin, 'stealth.tokens.delete', 		'Delete a token');
	
	mkatperm ($_admin, 'user.access', 					'Access the user tab');
	mkatperm ($_admin, 'user.manage', 					'Manage the current user\'s private data');
	
/*	mkatperm ($_admin, 'user.community.access', 		'Access the community');
	mkatperm ($_admin, 'user.community.list.public', 	'Show all the users whom are set to public');
	mkatperm ($_admin, 'user.community.list.private', 	'Show all the users who are public and private');
	mkatperm ($_admin, 'user.community.post', 			'');
	mkatperm ($_admin, 'user.community.friend.access',	'');
	mkatperm ($_admin, '') */
	
	echo("\n");
})->describe('Setup the default roles');

Artisan::command('cp:user:roles/add {id} {role} {type=0}', function ($id, $role, $type=0) {
	echo "CalPanel/User/Roles::Add('$id', '$role', '$type')\n";

	echo "Query: ". $id. "\n";
	echo "\n\n";

	$role = Role::where('slug', '=', $role)
            ->first();

	/** @var Role $role */
	
	$isEmail = ($type == 0);
    $isID 	 = ($type == 1);

    if($isID) {
		if (!User::ExistsID($id)) {
			die("User does not exist\n\n");
		}
    }

	if($isEmail) {
	    if (!User::ExistsEmail($id)) {
	    	die("User does not exist\n\n");
	    }
	}
	
	if ($isID) {
		     $user = User::find($id);
	} else { $user = User::findEmail($id); }
	

	if ($user === null || !$user) {
		die("Failed to retrieve user\n\n");
	}

	// Add the role
	$user->attachRole($role);

	echo("Attached role (". $role->name. ") to user ($id)\n\n");
})->describe('Add a user to a group');

Artisan::command('cp:user:roles/remove {id} {role} {type=0}', function ($id, $role, $type=0) {
	echo "CalPanel/User/Roles::Remove('$id', '$role', '$type')\n";

	echo "Query: ". $id. "\n";
	echo "\n\n";

	$role = Role::where('slug', '=', $role)
            ->first();

	$isEmail = ($type == 0);
    $isID 	 = ($type == 1);

    if($isID) {
		if (!User::ExistsID($id)) {
			die("User does not exist\n\n");
		}
    }

	if($isEmail) {
	    if (!User::ExistsEmail($id)) {
	    	die("User does not exist\n\n");
	    }
	}
	
	if ($isID) {
		     $user = User::find($id);
	} else { $user = User::findEmail($id); }
	

	if ($user === null || !$user) {
		die("Failed to retrieve user\n\n");
	}

	// Add the role
	$user->detachRole($role);

	echo("Removed user ($id) from role ($role->slug) \n\n");
})->describe('Remove a user from a group');