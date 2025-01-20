<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleOrder;
use App\Models\WhStockTransmitISO;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function row1col1_data($year, $month)
    {
        // $whStockTransmitISO_query = WhStockTransmitISO::get(10);
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

        return $data;
    }

    private function row1col2_data($year, $month)
    {
        // หาจำนวนวันในเดือนนั้น
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

        return $data;
    }



    public function index()
    {

        $year = date('Y');
        $month = date('m');
        $day = date('d');

        // $year = '2024';
        // $month = '10';
        // $day = '10';

        return view('overviewDashboard.index', compact('month', 'year','day'));
    }
}
