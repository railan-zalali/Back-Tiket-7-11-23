<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedBarcode extends Model
{
    use HasFactory;
    protected $fillable = ['barcode'];
    protected $table = 'used_barcodes';
}
