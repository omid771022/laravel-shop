<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\ResatPasswordRequestMaill;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResatPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $code =random_int(100000, 999999);
        $id=$notifiable['id'];
        
        $user=User::where('id', $id)->update([
        'verify_code'=>$code,
        ]);
        
        cache()->set('verify_code_' .$notifiable, $code, now()->addDay());
                return (new ResatPasswordRequestMaill($code))->to($notifiable->email)->subject('بازیابی رمز عبور ');
            }
        
    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
