<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class SanPhamController extends Controller
{
    // Sử dụng cho 2 cách Raw Query và Query Builer
    protected $sanPhams;

    public function __construct()
    {
        $this->sanPhams = new SanPham();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Sử dụng cho 2 cách Raw Query và Query Builer
        // $listSanPhams = $this->sanPhams->getList();

        $title = 'Danh sách sản phẩm';
        // Lấy dữ liệu từ form tìm kiếm
        $search = $request->input('search');
        $searchTrangThai = $request->input('searchTrangThai');
        // Sử dụng Eloquent
        $listSanPhams = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where('ma_san_pham', 'like', "%{$search}%")
                    ->orWhere('ten_san_pham', 'like', "%{$search}%");
            })
            ->when($searchTrangThai, function ($query, $searchTrangThai) {
                return $query->where('trang_thai', 'like', "%{$searchTrangThai}%");
            })
            ->orderByDesc('id')
            ->paginate(3);

        return view('admins.index', compact('title', 'listSanPhams'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới sản phẩm';
        return view('admins.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        // Kiểm tra xem có dữ liệu từ form không
        if ($request->isMethod('POST')) {
            // Lấy ra dữ liệu từ form
            // Cách 1:
            // $data = [
            //   "ma_san_pham" => $request->ma_san_pham,
            //   "ten_san_pham" => $request->ten_san_pham,
            //   "gia" => $request->gia,
            //   "so_luong" => $request->so_luong,
            //   "ngay_nhap" => $request->ngay_nhap,
            //   "mota" => $request->mota,
            //   "trang_thai" => $request->trang_thai,
            // ];

            // Cách 2:
            $data = $request->post();

            // Vì có trường '_token' do csrf sinh ra
            // nên trước khi gửi dữ liệu ta cần loại bỏ _token
            // Cách 1:
            // unset($data['_token']);

            // Cách 2: 
            $data = $request->except('_token', 'add');
            // Bình thường thì chỉ cần loại bỏ _token nhưng do bên form dùng
            // input để submit có name là add nên sẽ bị chèn vào câu lệnh insert nên phải bỏ cả add :V
            // Dùng button hoặc bỏ name = add trong input đi

            // Xử lí ảnh
            if ($request->hasFile('img_san_pham')) {
                $fileName = $request->file('img_san_pham')->store('uploads/sanPham', 'public');
            } else {
                $fileName = null;
            }
            $data['hinh_anh'] = $fileName;
            // Thêm dữ liệu 
            // Sử dụng Query Builer
            // $this->sanPhams->addSanPham($data);

            // Sử dụng Eloquent
            SanPham::create($data);
            return redirect()->route('san-pham.index')->with('success', 'Thêm mới thành công!');
        }

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
        $title = 'Sửa sản phẩm';
        // Query Builer
        $listSanPham = $this->sanPhams->find($id);
        if (!$listSanPham) {
            return redirect()->route('san-pham.index')->with('errors', 'Sản phẩm này không tồn tại!');
        }
        // Eloquent
        // $listSanPham = SanPham::findOrFail($id);
        return view('admins.update', compact('title', 'listSanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SanPhamRequest $request, string $id)
    {
        $listSanPham = $this->sanPhams->find($id);
        if (!$listSanPham) {
            return redirect()->route('san-pham.index')->with('errors', 'Sản phẩm này không tồn tại!');
        }
        if ($request->isMethod('PUT')) {
            if ($request->hasFile('img_san_pham')) {
                if ($listSanPham->hinh_anh) {
                    Storage::disk('public')->delete($listSanPham->hinh_anh);
                }
                $fileName = $request->file('img_san_pham')->store('uploads/sanPham', 'public');
            } else {
                $fileName = $listSanPham->hinh_anh;
            }

            $data = [
                'hinh_anh' => $fileName,
                'ma_san_pham' => $request->ma_san_pham,
                'ten_san_pham' => $request->ten_san_pham,
                'gia' => $request->gia,
                'ngay_nhap' => $request->ngay_nhap,
                'mota' => $request->mota,
                'trang_thai' => $request->trang_thai
            ];
            $this->sanPhams->updateSanPham($data, $id); // Query Builer
            return redirect()->route('san-pham.index')->with('success', 'Sửa thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eloquent
        $listSanPhams = SanPham::findOrFail($id);

        // Query Builer
        // $listSanPhams = $this->sanPhams->find($id);
        if ($listSanPhams) {
            // Eloquent
            $listSanPhams->delete();

            // Query Builer
            // Nếu xóa mềm thì không xóa ảnh
            if ($listSanPhams->hinh_anh && Storage::disk('public')->exists($listSanPhams->hinh_anh)) { // Kiểm tra ảnh trên db và trong thư mục public
                Storage::disk('public')->delete($listSanPhams->hinh_anh);
            }
            // $this->sanPhams->deleteSanPham($id);
            return redirect()->route('san-pham.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('san-pham.index')->with('errors', 'Sản phẩm này không tồn tại!');

        // Khi xóa mềm sẽ sử dụng eloquent và khi xóa thì không xóa ảnh
        // Một số hàm cần nhớ khi làm việc với xóa mềm
        // Hàm hiển thị toàn bộ các sản phẩm đã xóa mềm
        // $listSanPhams = SanPham::query()->onlyTrashed()->get();

        // Hàm restore sản phẩm đã xóa
        // $listSanPhams->restore();

        // Hàm xóa vĩnh viễn sản phẩm đã xóa mềm (Khi làm chức năng này mới được xóa ảnh)
        // $listSanPhams->forceDelete();
    }

    // Viết một phương thức mới
    public function test()
    {
        dd("Đây là một hàm mới");
    }
}
