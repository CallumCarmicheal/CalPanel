<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Mail\Message;
use Illuminate\Notifications\Messages\MailMessage;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('guest');
    }
    
    /**
     * @param string $response
	 * @param string $email
     * @return bool
     */
    protected function onPasswordReset(string $response, string $email) {
		// TODO: Add notification...
		
        return false;
    }
}
