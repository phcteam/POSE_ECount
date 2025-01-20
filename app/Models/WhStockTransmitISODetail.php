<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhStockTransmitISODetail extends Model
{
    use HasFactory;
    protected $table = 'wh_stock_transmit_iso_detail';

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
        'IsComplete',
        'Status',
        'Manufacturing_Qty',
        'Theory_Qty',
        'Percent',
        'Hour',
        'Description',
        'Qty_Applie_Before',
        'Qty_Total',
        'StartDateTime',
        'EndDateTime',
        'Human_M',
        'Human_F',
        'RateTP',
        'QA_All_Human',
        'QA_Wage',
        'QC_StartDateTime',
        'QC_EndDateTime',
        'QC_Hour',
        'QC_Human_M',
        'QC_Human_F',
        'QC_All_Human',
        'QC_Wage',
        'Packing_StartDateTime',
        'Packing_EndDateTime',
        'Packing_Hour',
        'Packing_Human_M',
        'Packing_Human_F',
        'Packing_All_Human',
        'Prepare_Working_StartDateTime',
        'Prepare_Working_EndDateTime',
        'Prepare_Working_Hour',
        'Prepare_Working_Human_M',
        'Prepare_Working_Human_F',
        'Prepare_Working_All_Human',
        'Mix_Working_StartDateTime',
        'Mix_Working_EndDateTime',
        'Mix_Working_Hour',
        'Mix_Working_Human_M',
        'Mix_Working_Human_F',
        'Mix_Working_All_Human',
        'Working_Wage',
        'CostOfUtilities',
        'CostOfOwner',
        'CostOfAllowance',
        'Value',
        'Sumary_P',
        'Sumary_R',
        'Memo',
    ];
}
