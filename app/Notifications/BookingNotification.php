<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingNotification extends Notification
{
    use Queueable;

    public $booking;
    public $type; // 'admin' or 'user'

    public function __construct($booking, $type)
    {
        $this->booking = $booking;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if ($this->type == 'admin') {
            return (new MailMessage)
                ->subject('🔔 تنبيه: حجز جديد في النظام')
                ->greeting('مرحباً أيها المدير')
                ->line('هناك حجز جديد تم إضافته للنظام بالتفاصيل التالية:')
                ->line('اسم العميل: ' . $this->booking->customer_name)
                ->line('المبلغ: ' . $this->booking->amount . '$')
                ->action('عرض كافة الحجوزات', url('/bookings'))
                ->line('يرجى مراجعة لوحة التحكم للتأكد من حالة الدفع.');
        }

        return (new MailMessage)
            ->subject('✅ تأكيد عملية الحجز')
            ->greeting('أهلاً ' . $this->booking->customer_name)
            ->line('تم تسجيل حجزك بنجاح في نظامنا.')
            ->line('رقم الحجز: #' . $this->booking->id)
            ->line('المبلغ المطلوب: ' . $this->booking->amount . '$')
            ->action('عرض حجوزاتي', url('/bookings'))
            ->line('شكراً لاستخدامك نظامنا الذكي!');
    }
}