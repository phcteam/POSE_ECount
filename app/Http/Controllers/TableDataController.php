<?php

namespace App\Http\Controllers;

use App\Models\WhStockReceiveSub;
use App\Models\WhStockTransmitISO;
use Illuminate\Http\Request;

class TableDataController extends Controller
{
    public function row2col1Data($year, $month, $day)
    {

        $WhStockTransmitISOs_dones = WhStockTransmitISO::where('Display_Status', '4')
            ->where('Status', '!=', '4')
            ->whereMonth('DocDate', $month)
            ->whereYear('DocDate', $year)
            ->whereDay('DocDate', $day)
            ->get();

        $WhStockTransmitISOs_NotDones = WhStockTransmitISO::where('Display_Status', '!=', '4')
            ->where('Status', '!=', '4')
            ->whereMonth('DocDate', $month)
            ->whereYear('DocDate', $year)
            ->whereDay('DocDate', $day)
            ->get();

        $data = [];
        foreach ($WhStockTransmitISOs_dones as $WhStockTransmitISOs_done) {

            $tmp = [];

            $tmp['status'] = 'ผลิตเสร็จแล้ว';
            $tmp['Manufacturing_Name'] = $WhStockTransmitISOs_done->Manufacturing_Name;
            $tmp['Manufacturing_Value'] = $WhStockTransmitISOs_done->Manufacturing_Value;
            $tmp['Manufacturing_Unit'] = $WhStockTransmitISOs_done->ItemUnit->Unit_Name;
            $tmp['Manufacturing_LotNo'] = $WhStockTransmitISOs_done->Manufacturing_LotNo;


            $data[] = $tmp;
        }



        foreach ($WhStockTransmitISOs_NotDones as $WhStockTransmitISOs_NotDone) {
            $tmp = [];
            $tmp['status'] = 'ผลิตยังไม่เสร็จ';
            $tmp['Manufacturing_Name'] = $WhStockTransmitISOs_NotDone->Manufacturing_Name;
            $tmp['Manufacturing_Value'] = $WhStockTransmitISOs_NotDone->Manufacturing_Value;
            $tmp['Manufacturing_Unit'] = $WhStockTransmitISOs_NotDone->ItemUnit->Unit_Name;
            $tmp['Manufacturing_LotNo'] = $WhStockTransmitISOs_NotDone->Manufacturing_LotNo;

            $data[] = $tmp;
        }

        return response()->json($data);
    }

    public function row2col2Data($year, $month, $day)
    {
        $WhStockTransmitISOs_tasks = WhStockTransmitISO::where('Display_Status', '!=', '4')
            ->where('Status', '!=', '4')
            ->whereMonth('DocDate', '!=', $month)
            ->whereYear('DocDate', '!=', $year)
            ->whereDay('DocDate', '!=', $day)
            ->get();

        $data = [];
        foreach ($WhStockTransmitISOs_tasks as $WhStockTransmitISOs_task) {
            $tmp = [];
            $tmp['DocDate'] = $WhStockTransmitISOs_task->DocDate;
            $tmp['Manufacturing_Name'] = $WhStockTransmitISOs_task->Manufacturing_Name;
            $tmp['Manufacturing_Value'] = $WhStockTransmitISOs_task->Manufacturing_Value;
            $tmp['Manufacturing_Unit'] = $WhStockTransmitISOs_task->ItemUnit->Unit_Name;
            $tmp['Manufacturing_LotNo'] = $WhStockTransmitISOs_task->Manufacturing_LotNo;

            $data[] = $tmp;
        }


        return response()->json($data);
    }


    public function row2col3Data($year, $month, $day)
    {

        $WhStockReceiveSubs = WhStockReceiveSub::whereMonth('Create_Date',  $month)
            ->whereYear('Create_Date',  $year)
            ->whereDay('Create_Date',  $day)
            ->get();
        $data = [];

        foreach ($WhStockReceiveSubs as  $WhStockReceiveSub) {
            $tmp = [];
            $tmp['NameTH'] = $WhStockReceiveSub->Item->NameTH;
            $tmp['Qty'] = $WhStockReceiveSub->Qty;
            $tmp['Unit_Name'] = $WhStockReceiveSub->ItemUnit->Unit_Name;
            $tmp['LotNo'] = $WhStockReceiveSub->LotNo;
            $tmp['IsApplieBefore'] = $WhStockReceiveSub->IsApplieBefore;
            $data[] = $tmp;
        }

        return response()->json($data);
    }
}
