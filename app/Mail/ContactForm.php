<?php

namespace App\Mail;

use App\Enums\Contact\ContactService;
use App\Enums\Contact\UserType;
use App\Models\District;
use App\Models\Province;
use App\Models\School;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Ward;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Thông tin liên hệ',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $school = School::all();
        $province = Province::whereIn('code', [1, 79])->get();
        $district = District::all();
        return new Content(
            view: 'mails.contact-form',
            with: [
                'school' => $school,
                'province' => $province,
                'district' => $district,
                'type' => UserType::asSelectArray(),
                'service' => ContactService::asSelectArray(),
                'data' => $this->data
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
