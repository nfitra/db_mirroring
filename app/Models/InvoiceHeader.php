<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'docId',
        'customerNo',
        'debtorAcct',
        'virtualAccountName',
        'lotNo',
        'virtualAccountEmail',
        'docDate',
        'dueDate',
        'totalAmount',
        'prevBill',
        'payFine',
    ];

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'billDocId', 'docId');
    }
}
