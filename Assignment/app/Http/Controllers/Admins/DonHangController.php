<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonHangRequest;
use App\Models\DonHang;
use App\Models\KhachHang;
use App\Models\PhuongThucThanhToan;
use App\Models\TrangThaiDonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    protected $users;
    protected $don_hang;
    protected $phuong_thuc_thanh_toan;
    protected $trang_thai;

    public function __construct()
    {
        $this->don_hang = new DonHang();
        $this->users = new KhachHang();
        $this->phuong_thuc_thanh_toan = new PhuongThucThanhToan();
        $this->trang_thai = new TrangThaiDonHang();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách đơn hàng";
        $list=$this->don_hang->getDH()->where('don_hangs.deleted', 0)->paginate(5);
        $trangThaiDH = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiTT = DonHang::TRANG_THAI_THANH_TOAN;
        return view('admins.donhang.index',[
            'title'       => $title,
            'list'        => $list,
            'trangThaiDH' => $trangThaiDH,
            'trangThaiTT' => $trangThaiTT
        ]);
    }
    public function trash()
    {
        $list=$this->don_hang->getDH()->where('don_hangs.deleted', 1)->paginate(5);;
        $title ="Thùng rác";
        return view('admins.donhang.trash',[
            'title' => $title,
            'list' => $list
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(KhachHang $khachHang)
    {
        $title = "Thêm mới đơn hàng";
        $khachHangs = $khachHang->getListHD();
        $listPTDH = $this->phuong_thuc_thanh_toan->getList();
        $listTT = $this->trang_thai->getList();
        return view('admins.donhang.create',[
            'title' => $title,
            'khachHangs' => $khachHangs,
            'listPTDH' => $listPTDH,
            'listTT' => $listTT
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $params = $request->post();
            unset($params['_token']);
            $this->don_hang->createDonHang($params);
            return redirect()->route('admin.don_hangs.index')->with('success','Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $title = "Thông tin đơn hàng";
    $order = $this->don_hang->with(['khachHang', 'phuongThucThanhToan', 'trangThai'])->find($id);

    if (!$order) {
        return redirect()->route('admin.don_hangs.index')->with('error', 'Đơn hàng không tồn tại.');
    }

    return view('admins.donhang.show', [
        'title' => $title,
        'order' => $order
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, KhachHang $khachHang, PhuongThucThanhToan $PhuongThucThanhToan, TrangThaiDonHang $trangThaiDonHang) 
    {
        $title="Sửa đơn hàng";
        $list = $this->don_hang->find($id);
        $khachHangs = $khachHang->getListHD();
        $PhuongThucThanhToans = $PhuongThucThanhToan->getList();
        $TrangThaiDonHangs = $trangThaiDonHang->getList();

        if(!$list){
            return redirect()->route('admin.don_hangs.index')->with('errors','Không có đơn hàng này!');
        }
        return view('admins.donhang.update',[
            'list'=>$list,
            'title'=>$title,
            'khachHangs'=>$khachHangs,
            'PhuongThucThanhToans'=>$PhuongThucThanhToans,
            'TrangThaiDonHangs'=>$TrangThaiDonHangs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $donHang = DonHang::query()->findOrFail($id);
       $currentTT = $donHang->trang_thai_id;
       $newTT = $request->input('trang_thai_id'); 
       $trangThais = array_keys(DonHang::TRANG_THAI_DON_HANG);

       // Kiểm tra nếu đơn hàng đã hủy thì không được thay đổi nữa
       if($currentTT === DonHang::HUY_DON_HANG){
        return redirect()->route('admin.don_hangs.index')->with('errors', 'Đơn hàng đã bị hủy. Không thể thay đổi trạng thái!');
       }

       // Kiểm tra nếu trạng thái mới không nằm sau trang thái hiện tại
       if(array_search($newTT, $trangThais) < array_search($currentTT, $trangThais)){
        return redirect()->route('admin.don_hangs.index')->with('errors', 'Không thể cập nhật ngược lại trạng thái!');
       }
       $donHang->trang_thai_id = $newTT;
       $donHang->save();
       return redirect()->route('admin.don_hangs.index')->with('success', 'Cập nhật trạng thái thành công!');

    }

    public function delete(DonHangRequest $request)
    {
        $list = DonHang::findOrFail($request->id);
        $list->deleted = 1;
        $list->save();
        $list->delete();
        return redirect()->route('admin.don_hangs.index')->with('success','Xóa thành công!');

    }
    public function restore(DonHangRequest $request)
    {
        $list = DonHang::withTrashed()->findOrFail($request->id);
        $list->deleted = 0;
        $list->save();
        $list->restore();
        return redirect()->route('admin.don_hangs.index')->with('success', 'Khôi phục thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = $this->don_hang->find($id);
        $list->delete();
        return redirect()->route('admin.don_hangs.index')->with('success','Xóa thành công!');

    }
    //comment
}
