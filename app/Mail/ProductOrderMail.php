<?php

namespace App\Mail;

use App\Models\Payment;
use App\Models\Setting;
use App\Models\OrderDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $id, $order, $setting, $pdf, $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        //$this->pdf = $data['pdf'];
        $this->setting = Setting::first();
        $this->order = Payment::where('id',$this->id)->first();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.product_order_mail')->subject('C-Section Subscription Plan Purchase Email');
    }
}
