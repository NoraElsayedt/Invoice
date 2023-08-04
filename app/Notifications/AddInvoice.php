<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\invoices;

class AddInvoice extends Notification
{
    use Queueable;

    private $invoices_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoices_id)
    {
        $this->id_invoices=$invoices_id;
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

        $url = 'http://127.0.0.1:8000/invoicesdatails/'.$this->id_invoices;

        return (new MailMessage)
        ->subject('add of invoices')
                    ->line('add of invoices .')
                    ->action('invoces details', $url)
                    ->line('Thank you for using our application!');
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
