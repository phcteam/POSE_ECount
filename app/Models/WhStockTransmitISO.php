<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhStockTransmitISO extends Model
{
    use HasFactory;
    protected $table = 'wh_stock_transmit_iso';

    protected $fillable = [
        'DocNo',
        'Branch_Code',
        'Create_Code',
        'Create_Date',
        'Modify_Code',
        'Modify_Date',
        'DocDate',
        'Reason_Code',
        'Detail',
        'Item_Code',
        'Total',
        'Stock_Mode',
        'Status',
        'Manufacturing_Name',
        'Manufacturing_Value',
        'Manufacturing_Unit',
        'Manufacturing_LotNo',
        'MFG_Date',
        'EXP_Date',
        'Display_Status',
        'Print_Date',
        'Receive_Date',
        'Human_M',
        'Human_F',
        'Value',
        'Hour',
        'Manufacturing_No',
        'IsOutSide',
        'ItemM_Code',
        'Is_Iso',
    ];

    public function ItemUnit()
    {
        return $this->hasOne(ItemUnit::class, 'Unit_Code', 'Manufacturing_Unit');
    }
  
}
