<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class NewJobAddedNotification extends Notification
{
    use Queueable;

    protected $employerName;

    public function __construct($employerName)
    {
        $this->employerName = $employerName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new job has been added by ' . $this->employerName)
                    ->action('View Pending Job Postings', url('/admin/job-postings'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
