<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCustomerNotification extends Notification
{
    use Queueable;

    protected $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function via($notifiable)
    {
        return ['database']; // database дээр хадгална
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Шинэ хэрэглэгч нэмэгдлээ: '
                . $this->customer->firstname . ' ' . $this->customer->lastname,
            'url' => route('admin.custom.page'), // Customers list рүү холбоно
        ];
    }
}
