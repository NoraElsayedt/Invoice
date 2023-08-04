<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invoices;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Addinvoices extends Notification
{
    use Queueable;
    private $Invoices;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoices $Invoices)
    {
        $this->Invoices=$Invoices;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
  
     public function toDatabase($notifiable)
     {
         return [
           
            'id'=>$this->Invoices->id,
            'title'=>'add invoices from :: ',
            'user'=>Auth::User()->name,
         ];
     }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    
}
