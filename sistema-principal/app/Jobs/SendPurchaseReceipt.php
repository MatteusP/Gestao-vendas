<?php

namespace App\Jobs;

use App\Mail\PurchaseReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPurchaseReceipt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $purchaseData;

    /**
     * Create a new job instance.
     *
     * @param array $purchaseData
     * @return void
     */
    public function __construct(array $purchaseData)
    {
        $this->purchaseData = $purchaseData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->purchaseData['email'])->send(new PurchaseReceipt($this->purchaseData));
    }
}

