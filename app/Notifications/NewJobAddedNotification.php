<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewJobAddedNotification extends Notification
{
    protected $employerName;

    public function __construct($employerName)
    {
        $this->employerName = $employerName;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Add 'database' channel to store notification in the database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new job has been added by ' . $this->employerName)
                    ->action('View Pending Job Postings', url('/admin/job-postings'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'employer_name' => $this->employerName,
            'message' => 'A new job has been added by ' . $this->employerName,
            'action_url' => '/admin/job-postings',
            'action_text' => 'View Pending Job Postings',
        ];
    }
}
