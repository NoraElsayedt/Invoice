<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
         
        'invoices_number',
        'invoices_Date',
        'due_date',
        'product',
        'section_id',
        'section',
        'Amount_collection',
        'Amount_commision',
        'discount',
        'rate_vat',
        'value_vat',
        'total',
        'note',
        'status',
        'value_status',
        'user',
       
    ];

    public function sections()
    {
        return $this->belongsTo(Sections::class,'section_id');
    }


}
