<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingOrder extends Model
{
    use HasFactory;
    protected $table = 'tracking_order';

    protected $fillable = [
        'DocNo',
        'DocDate',
        'Modify_Code',
        'Modify_Date',
        'Create_Code',
        'Create_Date',
        'Send_Date',
        'Send_Time',
        'IsDelivery',
        'RegionID',
        'Delivery_DriverID',
    ];
}
