<?php

namespace Modules\Notifications\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Recruitments\Entities\JobApplication;
use Illuminate\Notifications\Messages\MailMessage;

class JobApplicationCreated extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private JobApplication $jobapplication;

    public function __construct(JobApplication $jobapplication)
    {
        $this->jobapplication = $jobapplication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return view('notifications::jobapplications.create');
    // }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->greeting('Hellow New Applicant')
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }
}
