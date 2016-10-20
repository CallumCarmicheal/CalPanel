<?php
/**
 * User: Callum Carmicheal
 * Date: 20/10/2016
 * Time: 17:18
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UsersContact extends Model {
	protected $table = 'users_contact';
	public $timestamps = true;
	
	public function getSkype() 		{ return $this->skype; }
	public function getAim() 		{ return $this->aim; }
	public function getDiscord() 	{ return $this->discord; }
	public function getFacebook() 	{ return $this->facebook; }
}