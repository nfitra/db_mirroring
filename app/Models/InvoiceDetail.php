<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'billId',
        'billDocId',
        'billCode',
        'billNo',
        'billName',
        'billShortName',
        'billDescription',
        'billAmount',
    ];

    public function header() {
        return $this->belongsTo(InvoiceHeader::class, 'billDocId', 'docId');
    }
}
