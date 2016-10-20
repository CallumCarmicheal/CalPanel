<?php
/**
 * User: Callum Carmicheal
 * Date: 16/10/2016
 * Time: 20:02
 */


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordChanged extends Notification implements ShouldQueue  {
	use Queueable;
	
	private $email;
	private $ip;
	
	public function __construct ($email, $ip) {
		$this->email = $email;
	}
	
	
	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		$url = url('/support');
		$ip  = $this->ip;
		
		/*return (new MailMessage)
			->greeting('Hello!')
			->line('One of your invoices has been paid!')
			->action('View Invoice', $url)
			->line('Thank you for using our application!'); //*/
		
		return (new MailMessage)
			->greeting('Hello!')
			->line('You are receiving this email because the password')
			->line('for your account has been reset')
			->line('')
			->line('The password was reset by IP ('. $ip. ')')
			->line('')
			->line('If this action was not committed by you please contact a member of staff below:')
			->action('Contact staff', $url);
	}
}