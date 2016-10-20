<?php

namespace App;

use App\Models\UsersContact;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Authenticatable implements HasRoleAndPermissionContract {
    use Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token' ,
    ];
    
	// Getter methods
    public function getID()                 { return $this->id; }
    public function getName()               { return $this->name; }
    public function getEmail()              { return $this->email; }
    public function getPassword()           { return $this->password; }
    public function getDateCreated()        { return $this->created_at; }
    public function getDateUpdated()        { return $this->updated_at; }
    public function getBackgroundImage() 	{ return $this->image_background; }
	
	/**
	 * @return UsersContact
	 */
	public function Contact() 			{
		$uc = UsersContact::where('user_id', '=', $this->getID())->get()->first();
		return $uc;
	}
	
	/**
	 * Check if a user id exists
	 * @param $id
	 * @return bool
	 */
    public static function ExistsID($id) {
        return User::find($id) != null;
    }
	
	/**
	 * Check if a email exists
	 * @param $email
	 * @return mixed
	 */
    public static function ExistsEmail($email) {
        return User::where('email', '=', $email)->exists();
    }
	
	/**
	 * Find a user by their email
	 * @param $email
	 * @return bool
	 */
    public static function findEmail($email) {
        $usr = User::where('email', '=', $email);

        if ($usr === null)   return false;
        if (!$usr->exists()) return false;

        return $usr->first();
    }
	
	/**
	 * Get the gravatar image for the current user
	 * @param int $size Total Pixels that are ^2
	 * @return string
	 */
    public function getGravatar($size = 128) {
        $grava_email    = $this->email;
        $grava_default  = "https://s.gravatar.com/avatar/23463b99b62a72f26ed677cc556c44e8?s=128";
        $grava_size     = 128;
        $grava_url      = "https://www.gravatar.com/avatar/" . 
                            md5( strtolower( trim( $grava_email ) ) ) . 
                            "?d=" . urlencode( $grava_default ) . 
                            "&s=" . $grava_size;
        return $grava_url;
    }
	
	/**
	 * The default gravatar image 
	 * @return string
	 */
    public static function getGravatarDefault() {
        return 'https://s.gravatar.com/avatar/23463b99b62a72f26ed677cc556c44e8?s=128';
    }
	
	/**
	 * Count how many pending notifications the current user has.
	 * @return int
	 */
    public function getNotificationCount() {
        return 0;
    }
	
	/**
	 * Gets the highest assigned role to the user
	 * @return Role
	 */
    public function getHighestRole() {
		return $this->getRoles()->sortByDesc('level')->first();
	}
    
    /**
	 * Checks if the user has any roles
     * @return boolean
     */
    public function hasRoles() {
		return $this->getRoles()->count() >= 1;
    }
}
