<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhStockTransmitDetail extends Model
{
    use HasFactory;

    protected $table = 'wh_stock_transmit_detail';

    protected $fillable = [
        'Row_Id',
        'Branch_Code',
        'Create_Code',
        'Create_Date',
        'Modify_Code',
        'Modify_Date',
        'DocNo',
        'Item_Code',
        'Qty',
        'Unit_Code',
        'LotNo',
        'MFGDate',
        'EXPDate',
        'Ref_Code',
        'Status',
        'IsComplete',
    ];
}
