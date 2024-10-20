<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $purchaseData;

    /**
     * Create a new message instance.
     *
     * @param array $purchaseData
     * @return void
     */
    public function __construct(array $purchaseData)
    {
        $this->purchaseData = $purchaseData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('emails.purchases.receipt')
                    ->subject('Confirmação de Compra')
                    ->with('data', $this->purchaseData);
    }
    
}