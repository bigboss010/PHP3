<?php

namespace App\Http\Controllers\Admins;

use Carbon\Carbon;
use App\Models\ThongKe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThongKeController extends Controller
{
    public function thongke()
    {
        $title = "thong ke";
        return view('admins.thong_ke.index', compact('title'));
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = ThongKe::whereBetween('ngay_dat', [$from_date, $to_date])->orderBy('ngay_dat', 'ASC')->get();

        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'order' => $value->don_hang_id,
                'previod' => $value->ngay_dat,
                'thanh_tien' => $value->thanh_tien,
                'so_luong' => $value->so_luong,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        // Xác định khoảng thời gian cho từng quý
        $startOfQuarter1 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->toDateString();
        $endOfQuarter1 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->addMonths(2)->endOfMonth()->toDateString();

        $startOfQuarter2 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->addMonths(3)->firstOfMonth()->toDateString();
        $endOfQuarter2 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->addMonths(5)->endOfMonth()->toDateString();

        $startOfQuarter3 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->addMonths(6)->firstOfMonth()->toDateString();
        $endOfQuarter3 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->addMonths(8)->endOfMonth()->toDateString();

        $startOfQuarter4 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->addMonths(9)->firstOfMonth()->toDateString();
        $endOfQuarter4 = Carbon::now('Asia/Ho_Chi_Minh')->firstOfYear()->addMonths(11)->endOfMonth()->toDateString();

        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        if ($data['dashboard_value'] == 'quy1') {
            $get = ThongKe::whereBetween('ngay_dat', [$startOfQuarter1, $endOfQuarter1])->orderBy('ngay_dat', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'quy2') {
            $get = ThongKe::whereBetween('ngay_dat', [$startOfQuarter2, $endOfQuarter2])->orderBy('ngay_dat', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'quy3') {
            $get = ThongKe::whereBetween('ngay_dat', [$startOfQuarter3, $endOfQuarter3])->orderBy('ngay_dat', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'quy4') {
            $get = ThongKe::whereBetween('ngay_dat', [$startOfQuarter4, $endOfQuarter4])->orderBy('ngay_dat', 'ASC')->get();
        } else {
            $get = ThongKe::whereBetween('ngay_dat', [$sub365days, $now])->orderBy('ngay_dat', 'ASC')->get();
        }

        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'order' => $value->don_hang_id,
                'previod' => $value->ngay_dat,
                'thanh_tien' => $value->thanh_tien,
                'so_luong' => $value->so_luong,
            );
        }

        echo $data = json_encode($chart_data);
    }
}
