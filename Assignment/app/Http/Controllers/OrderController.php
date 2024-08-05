<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(OrderRequest $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            dd($request);
            DB::beginTransaction();
            try {
                // \Log::info('Start addDonHang');
    
                $params = $request->except('_token');
                dd($params);
                $params['ma_don_hang'] = $this->generateUniqueOrderCode();
                // \Log::info('Params: ' . json_encode($params));
                dd($params);
                $donHang = DonHang::create($params);
                $donHangId = $donHang->id;
                // \Log::info('Order created with ID: ' . $donHangId);
                dd($params);
                $carts = session()->get('cart', []);
                // \Log::info('Cart: ' . json_encode($carts));
    
                foreach ($carts as $key => $item) {
                    $thanhTien = $item['gia'] * $item['so_luong'];
                    // \Log::info('Processing item: ' . $key);
    
                    $donHang->chiTietDonHang()->create([
                        'don_hang_id' => $donHangId,
                        'pet_id' => $key,
                        'thanh_tien' => $thanhTien,
                        'gia' => $item['gia'],
                        'so_luong' => $item['so_luong'],
                    ]);
                    // \Log::info('Order item created for pet_id: ' . $key);
                }
              
                DB::commit();
                session()->put('cart', []);
                return redirect()->route('/.donhang')->with('success', 'Đơn hàng đã được tạo thành công');
    
            } catch (\Exception $e) {
                DB::rollBack();
                // \Log::error('Error in addDonHang: ' . $e->getMessage());
                return redirect()->route('/.cart')->with('error', 'Có lỗi khi tạo đơn hàng, vui lòng thử lại sau');
            }
           
        }
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function generateUniqueOrderCode()  {
        do {
            $orderCode = 'ORD-'.Auth::id(). '-'. now()->timestamp;
        } while (DonHang::where('ma_don_hang', $orderCode)->exists());
        return $orderCode;
    }
}
