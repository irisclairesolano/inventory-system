<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Inventory;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        $inventory = Inventory::where('product_id', $transaction->product_id)->first();

        if ($inventory) {
            if ($transaction->type === 'in') {
                // Stock incoming: add to quantity
                $inventory->increment('quantity', $transaction->quantity);
            } elseif ($transaction->type === 'out') {
                // Stock outgoing: subtract from quantity
                $inventory->decrement('quantity', $transaction->quantity);
            }
        }
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        // If a transaction is edited, we need to revert the old change and apply the new one
        $inventory = Inventory::where('product_id', $transaction->product_id)->first();

        if ($inventory && $transaction->wasChanged('quantity') || $transaction->wasChanged('type')) {
            // Revert old transaction
            $originalType = $transaction->getOriginal('type');
            $originalQuantity = $transaction->getOriginal('quantity');

            if ($originalType === 'in') {
                $inventory->decrement('quantity', $originalQuantity);
            } elseif ($originalType === 'out') {
                $inventory->increment('quantity', $originalQuantity);
            }

            // Apply new transaction
            if ($transaction->type === 'in') {
                $inventory->increment('quantity', $transaction->quantity);
            } elseif ($transaction->type === 'out') {
                $inventory->decrement('quantity', $transaction->quantity);
            }
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        $inventory = Inventory::where('product_id', $transaction->product_id)->first();

        if ($inventory) {
            if ($transaction->type === 'in') {
                // Revert: remove the added quantity
                $inventory->decrement('quantity', $transaction->quantity);
            } elseif ($transaction->type === 'out') {
                // Revert: add back the subtracted quantity
                $inventory->increment('quantity', $transaction->quantity);
            }
        }
    }
}
