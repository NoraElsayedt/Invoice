<?php

namespace App\Models;
use App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'description',
        'createadd',
       
    ];

  
}