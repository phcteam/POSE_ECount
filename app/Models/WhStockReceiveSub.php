<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhStockReceiveSub extends Model
{
    use HasFactory;
    protected $table = 'wh_stock_receive_sub';

    protected $fillable = [
        'Branch_Code',
        'Create_Code',
        'Create_Date',
        'Modify_Code',
        'Modify_Date',
        'DocNo',
        'Row_No',
        'Item_Code',
        'Unit_code',
        'Qty_Adjust',
        'Qty',
        'Price',
        'IsVat',
        'TaxCost',
        'Productcost',
        'Total',
        'Qty_tmp',
        'Price_tmp',
        'Total_tmp',
        'Shelf_Code',
        'LotNo',
        'MFGDate',
        'EXPDate',
        'IO_Status',
        'Status',
        'Transmit_ISO_Detail_Id',
        'Ref_Code',
        'IsApplieBefore',
        'Transmit_Detail_Id',
        'Manufacturing_No',
        'FNo',
        'ProductionPackage',
        'Remark',
        'Detail',
        'IsNoExpire',
        'Dispenser_Status',
    ];
    public function WhStockTransmitISODetail()
    {
        return $this->hasOne(WhStockTransmitISODetail::class,  'Row_Id','Transmit_ISO_Detail_Id');
    }

    public function Item()
    {
        return $this->belongsTo(Item::class, 'Item_Code', 'Item_Code');
    }

    public function ItemUnit()
    {
        return $this->hasOne(ItemUnit::class, 'Unit_Code', 'Unit_code');
    }
}
