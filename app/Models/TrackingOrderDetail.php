<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'tracking_order_detail';

    protected $fillable = [
        'DocNo',
        'DocNoAcc',
        'Cus_Code',
        'RefDocNo',
        'IsType',
        'ShipRound',
        'AreaCode'
    ];
}
