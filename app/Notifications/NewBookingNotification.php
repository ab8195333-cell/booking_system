<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail']; // نحدد هنا أننا نريد الإرسال عبر البريد
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('تأكيد حجز جديد 📅')
            ->greeting('أهلاً ' . $notifiable->name)
            ->line('لقد تم تسجيل حجز جديد بنجاح في النظام.')
            ->line('تفاصيل الحجز: ' . $this->booking->name)
            ->line('تاريخ الحجز: ' . $this->booking->booking_date)
            ->action('مشاهدة حجوزاتي', url('/bookings'))
            ->line('شكراً لاستخدامك تطبيقنا!');
    }
}