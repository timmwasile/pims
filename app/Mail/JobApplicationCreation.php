<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Recruitments\Entities\JobApplication;

class JobApplicationCreation extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public $jobapplication;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobApplication $jobapplication)
    {
        $this->jobapplication = $jobapplication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        // return $this->view('notifications::emails.jobapplications.create');

        return $this
            ->from('timoth.mwasile@tanesco.co.tz', 'TANREP')
            ->subject('TANESCO JOB APPLICATION NOTIFICATION')
            ->view('notifications::emails.jobapplications.create');
    }
}
