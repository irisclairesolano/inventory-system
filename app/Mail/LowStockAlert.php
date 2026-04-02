<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LowStockAlert extends Mailable
{
    use Queueable, SerializesModels;

    public Product $product;
    public int $currentStock;
    public int $reorderLevel;

    public function __construct(Product $product, int $currentStock, int $reorderLevel)
    {
        $this->product = $product;
        $this->currentStock = $currentStock;
        $this->reorderLevel = $reorderLevel;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Low Stock Alert: ' . $this->product->name);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.low-stock-alert');
    }
}
