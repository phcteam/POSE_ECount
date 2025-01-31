<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';

    protected $fillable = [
        'RowId',
        'DocNo',
        'DocDate',
        'RefDocNo',
        'TaxNo',
        'TaxDate',
        'Cus_Code',
        'TT_Code',
        'Bill_Type',
        'Transportcost',
        'Productcost',
        'DiscountPercent',
        'DiscountBath',
        'Deposit',
        'Productcosttotal',
        'TaxCost',
        'TaxCostTotal',
        'Total',
        'Detail',
        'Branch_Code',
        'Modify_Code',
        'Modify_Date',
        'Table_Code',
        'Employee_Code',
        'PayMoney',
        'Change',
        'Detail1',
        'Detail2',
        'Detail3',
        'CmsCode',
        'DueDate',
        'DetailN1',
        'DetailN2',
        'DetailN3',
        'DetailN4',
        'DetailEmail',
        'IsEms',
        'IsClrBill',
        'xAddress',
        'isArea',
        'AreaCode',
        'CT_Code',
        'CT_FullName',
        'ORDocNo',
        'SendDate',
        'SendStatus',
        'Sale_Status',
        'IsCancel',
        'SaleOrder_DocNo',
        'InvDocNo',
        'Document_Status',
        'DocNoAcc',
        'Acc_Modify_Date',
        'PrintCnt',
        'Acc_Status',
        'Acc_Type',
        'StringBath',
        'IsCheckIn',
        'IsPrint',
        'DocNoAccNew',
        'IsCopy',
        'xAddressAcc',
        'DocDateAcc',
        'Detail3Acc',
        'Detail2Acc',
        'Detail1Acc',
        'DetailAcc',
        'xAddressAccBill2',
        'CusNameAccBill2',
        'Cn',
        'DeductCN_Price',
        'Bank_Code',
        'CheckNo',
        'CheckDate',
        'rAmount',
        'dAmount',
        'ExpressCode',
        'Check_CreateDate',
        'Bring1',
        'Bring2',
        'Bring3',
        'Bring1_Datetime',
        'Bring2_Datetime',
        'Bring3_Datetime',
        'BringTotal',
        'BringTotal_Max',
        'Status_Finish_Bring',
        'Status_Finish_Bring_Datetime',
        'Status_Bring',
        'bFinish1',
        'bFinish2',
        'bFinish3',
        'Status_ClearLoan',
        'Ref_DocNoLoan',
        'Add_Money',
        'Status_ShowVat',
        'Percent_Id',
        'BringBalance',
        'PayCheck',
        'TaxCheck',
        'OrtherCheck',
        'CheckNo2',
        'CheckDate2',
        'rAmount2',
        'dAmount2',
        'ExpressCode2',
        'Check_CreateDate2',
        'PayCheck2',
        'TaxCheck2',
        'OrtherCheck2',
        'TotalCheck',
        'VatCode',
        'IsCopy_Date',
        'AddTaxCheck',
        'TsCheck',
        'IsCopy_CreateCode',
        'CheckNo_Delegate',
        'CheckDate_Delegate',
        'rAmount_Delegate',
        'dAmount_Delegate',
        'ExpressCode_Delegate',
        'Check_CreateDate_Delegate',
        'PayCheck_Delegate',
        'PayOff',
        'PayOver',
        'Pay_Discount',
        'PayOff2',
        'PayOver2',
        'Pay_Discount2',
        'PayOff_Delegate',
        'PayOver_Delegate',
        'Pay_Discount_Delegate',
        'Status_Delegate',
        'UseCheckIn',
        'DocDateAccPrint',
        'IsOverdue',
        'Fines',
        'Fines2',
        'Status_Cms1',
        'Status_Cms2',
        'Status_Day',
        'PrintWelfare',
        'RemarkWelfare',
        'IsPayAcc_delegate',
        'Print_Status',
        'StockCard_Date',
        'DocNo_Online',
        'IsFrom_Online',
        'IsPay_DateTime',
        'Bringwelfare_Remark',
        'Detail_Edit',
        'IsCheck_Code',
        'IsCheck_Date',
        'IsCheck',
        'IsBillPo_Order',
        'Welfare_Bkk',
        'Discount_Cms',
        'Discount_Cms_Remark',
        'IsBillingNote_Status',
        'TrackingStatus',
        'Tracking_FinishDateTime',
        'IsDelivery',
    ];
    public function Area()
    {
        return $this->hasOne(Area::class, 'Code', 'AreaCode');
    }

    public function TrackingOrder()
    {
        return $this->hasOne(TrackingOrder::class, 'DocNo', 'DocNo');
    }
    public function TrackingOrderDetail()
    {
        return $this->hasOne(TrackingOrderDetail::class, 'RefDocNo ', 'DocNo');
    }
}
