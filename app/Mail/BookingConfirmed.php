<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingData;

    public function __construct($data)
    {
        $this->bookingData = $data;
    }

    public function build()
    {
        return $this->subject('تأكيد الحجز - تم استلام طلبك بنجاح ✅')
                    ->html("<h1>مرحباً " . $this->bookingData['name'] . "</h1>
                            <p>نود إعلامك بأننا استلمنا طلب حجزك بنجاح بتاريخ: " . $this->bookingData['date'] . "</p>
                            <p>شكراً لثقتك بنا!</p>");
    }
}