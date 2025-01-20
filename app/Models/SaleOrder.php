<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;
    protected $table = 'saleorder';

    protected $fillable = [
        'DocNo',
        'DocDate',
        'RefDocNo',
        'Cus_Code',
        'DueDate',
        'Total',
        'IsFinish',
        'IsCancel',
        'Area_Code',
        'Detail',
        'IsSave',
        'IsPO',
        'IsQT',
        'IsBV',
        'tDate',
        'IsST',
        'IsSend',
        'SendDate',
        'Modify_Date',
        'Pose_Status_Id',
        'IsSaleFinish',
        'IslogisticFinish',
    ];
}
