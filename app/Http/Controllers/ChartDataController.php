<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleOrder;
use App\Models\Sale;



class ChartDataController extends Controller
{
    public function row1col1Data(Request $request, $year, $month)
    {

        $saleOrder_wainting = SaleOrder::where('IsSave', 1)
            ->where('IsFinish', 0)
            ->whereMonth('DocDate', $month)
            ->whereYear('DocDate', $year)
            ->count();

        $sale_approve_count = Sale::where('Acc_Status', 0)
            ->whereMonth('DocDate', $month)
            ->whereYear('DocDate', $year)
            ->count();

        $allBill_count = $saleOrder_wainting + $sale_approve_count;
        $monthNameThai = config('myconfig.thai_months')[intval($month)];

        $data = [
            'month' => $month,
            'month_th' => $monthNameThai,
            'year' => $year,
            'waiting' => $saleOrder_wainting,
            'approving' => $sale_approve_count,
            'allBill' => $allBill_count
        ];


        return response()->json($data);
    }

    public function row1col2Data(Request $request, $year, $month)
    {
        $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year)); // 't' คืนจำนวนวันในเดือน
        $currentDay = date('j'); // วันที่ปัจจุบัน (1-31)
        $currentMonth = date('n'); // เดือนปัจจุบัน (1-12)
        $currentYear = date('Y'); // ปีปัจจุบัน

        $days = [];
        $saleOrders = [];

        // วนลูปสร้างวันที่
        for ($day = 1; $day <= $daysInMonth; $day++) {
            // หยุดที่วันที่ปัจจุบันถ้าเป็นเดือนปัจจุบัน
            if ($year == $currentYear && $month == $currentMonth && $day > $currentDay) {
                break;
            }

            $saleOrderApproving = Sale::where('Acc_Status', 0)
                ->whereMonth('DocDate', $month)
                ->whereYear('DocDate', $year)
                ->whereDay('DocDate', $day) // กำหนดวันในเดือน
                ->count();

            $saleOrderWaiting = SaleOrder::where('IsSave', 1)
                ->where('IsFinish', 0)
                ->whereMonth('DocDate', $month)
                ->whereYear('DocDate', $year)
                ->whereDay('DocDate', $day) // กำหนดวันในเดือน
                ->count();

            $days[] = $day;
            $saleOrders[] = $saleOrderWaiting + $saleOrderApproving;
        }

        $data = [
            'days' => $days,
            'saleOrders' => $saleOrders,
        ];

        return response()->json($data);
    }


    public function row3col1Data($year, $month, $day)
    {

        $saleDatas = Sale::join('area', 'sale.AreaCode', '=', 'area.Code')
            ->where('sale.Acc_Status', 1)
            ->whereMonth('sale.DocDate', $month)
            ->whereYear('sale.DocDate', $year)
            ->whereDay('DocDate', $day)
            ->whereIn('area.IsStatus', [0, 1, 2, 3])
            ->select('sale.IsDelivery', 'area.IsStatus')
            ->get();


        $areaTypes = [
            1 => 'กรุงเทพ ฯ',   // เขต กทม
            2 => 'ตจว',          // เขต ต่างจังหวัด
            0 => 'อื่น ๆ',      // เขตปกติ
            3 => 'อื่น ๆ'        // เขต พิเศษ
        ];

        $deliveryStatus = [
            0 => 'not_delivery',
            1 => 'delivered'
        ];

        $groupedData = [];
        foreach (array_unique($areaTypes) as $areaName) {
            $groupedData[$areaName] = [];
            foreach ($deliveryStatus as $deliveryName) {
                $groupedData[$areaName][$deliveryName] = 0;
            }
        }

        foreach ($saleDatas as $saleData) {
            $areaStatus = $saleData->IsStatus ?? null;
            $deliveryState = $saleData->IsDelivery ?? null;

            $areaName = $areaTypes[$areaStatus] ?? 'ไม่ทราบเขต';
            $deliveryName = $deliveryStatus[$deliveryState] ?? 'ไม่ทราบสถานะ';

            if (isset($groupedData[$areaName][$deliveryName])) {
                $groupedData[$areaName][$deliveryName]++;
            }
        }

        return response()->json($groupedData);
    }

    public function row3col2Data($year, $month)
    {
        $saleDatas = Sale::join('area', 'sale.AreaCode', '=', 'area.Code')
            ->where('sale.Acc_Status', 1)
            ->whereMonth('sale.DocDate', $month)
            ->whereYear('sale.DocDate', $year)
            ->whereIn('area.IsStatus', [0, 1, 2, 3])
            ->select('sale.IsDelivery', 'area.IsStatus')
            ->get();

        $areaTypes = [
            1 => 'กรุงเทพ ฯ',   // เขต กทม
            2 => 'ตจว',          // เขต ต่างจังหวัด
            0 => 'อื่น ๆ',      // เขตปกติ
            3 => 'อื่น ๆ'        // เขต พิเศษ
        ];

        $deliveryStatus = [
            0 => 'not_delivery',
            1 => 'delivered'
        ];

        $groupedData = [];
        foreach (array_unique($areaTypes) as $areaName) {
            $groupedData[$areaName] = [];
            foreach ($deliveryStatus as $deliveryName) {
                $groupedData[$areaName][$deliveryName] = 0;
            }
        }

        foreach ($saleDatas as $saleData) {
            $areaStatus = $saleData->IsStatus ?? null;
            $deliveryState = $saleData->IsDelivery ?? null;


            $areaName = $areaTypes[$areaStatus] ?? 'ไม่ทราบเขต';
            $deliveryName = $deliveryStatus[$deliveryState] ?? 'ไม่ทราบสถานะ';

            if (isset($groupedData[$areaName][$deliveryName])) {
                $groupedData[$areaName][$deliveryName]++;
            }
        }

        return response()->json($groupedData);
    }


    //     SELECT
    // DATEDIFF( sale.DocDate, tracking_order.Send_Date ),
    // sale.DocNo,
    // sale.DocDate AS saledate,
    // tracking_order.Send_Date,
    // tracking_order.DocNo AS tracking_orderdocno,
    // sale.Acc_Status,
    // sale.AreaCode,
    // area.IsStatus

    // FROM
    //   sale
    //   INNER JOIN tracking_order_detail ON tracking_order_detail.RefDocNo  = sale.DocNo
    //   INNER JOIN tracking_order ON tracking_order.DocNo = tracking_order_detail.DocNo/
    //   INNER JOIN area ON area.`Code` = sale.AreaCode//

    // area.IsStatus  = 0(เขต ปกติ)
    // area.IsStatus  = 1(เขต กทม)
    // area.IsStatus  = 2(เขต ต่างจังหวัด)
    // area.IsStatus  = 3(เขต พิเศษ)

    public function row4col1($year, $month, $day)
    {

        $salesDatas = Sale::
             


            join('tracking_order_detail', 'tracking_order_detail.RefDocNo', '=', 'sale.DocNo')
            ->join('tracking_order', 'tracking_order.DocNo', '=', 'tracking_order_detail.DocNo')
            ->join('area', 'area.Code', '=', 'sale.AreaCode')
            
            ->selectRaw('DATEDIFF(sale.DocDate, tracking_order.Send_Date) as days_difference')
            ->selectRaw('sale.DocNo as sale_docno')
            ->selectRaw('sale.DocDate as saledate')
            ->selectRaw('tracking_order.Send_Date as send_date')
            ->selectRaw('tracking_order.DocNo as tracking_orderdocno')
            ->selectRaw('sale.Acc_Status as acc_status')
            ->selectRaw('sale.AreaCode as area_code')
            ->selectRaw('area.IsStatus as is_status')
            ->get();

        dd($salesDatas);
    }
}
