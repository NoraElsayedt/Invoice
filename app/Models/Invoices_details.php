<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_details extends Model
{
    use HasFactory;
    protected $fillable = [
         
        'invoices_number',
        'id_invoices',
        'product',
        'section',
        'note',
        'status',
        'value_status',
        'user',
       
    ];
   
    
   
}
