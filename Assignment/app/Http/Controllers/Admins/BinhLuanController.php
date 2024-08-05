<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\BinhLuanRequest;
use App\Models\BinhLuan;
use App\Models\KhachHang;
use App\Models\Pet;
use Carbon\Carbon;
use DateTime;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BinhLuanController extends Controller
{
    public $binhLuans;

    public function __construct()
    {
        $this->binhLuans = new BinhLuan();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách bình luận';
        $binhLuans = $this->binhLuans->getBL()->where('bl.deleted', 0)->paginate(5);
        return view('admins.binh_luans.index', compact('title', 'binhLuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(KhachHang $users, Pet $pets)
    {
        $title = 'Thêm mới bình luận';
        $users = $users->getListHD();
        $pets = $pets->getPet();
        return view('admins.binh_luans.add', compact('title', 'users', 'pets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if ($request->isMethod('POST')) {
        //     $data = [
        //         'user_id' => $request->user_id,
        //         'pet_id' => $request->pet_id,
        //         'noi_dung' => $request->noi_dung,
        //         'thoi_gian' => Carbon::now(),
        //     ];

        //     $comment = BinhLuan::create($data);

        //     return response()->json(['success' => 'Comment added successfully!', 'comment' => $comment]);
        // }
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
    public function edit(string $id, KhachHang $users, Pet $pets)
    {
        $title = 'Sửa bình luận';
        $binhLuan = $this->binhLuans->find($id);
        if (!$binhLuan) {
            return redirect()->route('binh-luan.index')->with('errors', 'Bình luận này không tồn tại!');
        }
        $users = $users->getListHD();
        $pets = $pets->getPet();
        return view('admins.binh_luans.update', compact('title', 'binhLuan', 'users', 'pets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $data = [
                'user_id' => $request->user_id,
                'pet_id' => $request->pet_id,
                'noi_dung' => $request->noi_dung,
                'thoi_gian' => $request->thoi_gian,
                'trang_thai' => $request->trang_thai,
                'updated_at' => Carbon::now()
            ];
            $this->binhLuans->updateBL($data, $id);
            return redirect()->route('admin.binh-luan.index')->with('success', 'Sửa thành công!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $binhLuan = $this->binhLuans->find($id);
        if (!$binhLuan) {
            return redirect()->route('admin.binh-luan.index')->with('errors', 'Bình luận này không tồn tại!');
        }
        $binhLuan->delete();
        return redirect()->route('admin.binh-luan.index')->with('success', 'Xóa thành công!');
    }

    public function load_comment(Request $request)
    {
        $pet_id = $request->pet_id;
        $comments = BinhLuan::query()
            ->join('users', 'binh_luans.user_id', '=', 'users.id')
            ->join('pets', 'binh_luans.pet_id', '=', 'pets.id')
            ->select(
                'binh_luans.id',
                'binh_luans.noi_dung',
                'binh_luans.thoi_gian',
                'binh_luans.trang_thai',
                'binh_luans.created_at',
                'binh_luans.updated_at',
                'users.name',
                'pets.id'
            )
            ->where('pets.id', $pet_id)
            ->where('binh_luans.trang_thai', 1)
            ->orderByDesc('binh_luans.id')
            ->paginate(5);

        $output = '';
        foreach ($comments as $comment) {
            $output .= '
            <ul class="list-unstyled">
                <li class="media mb-4">
                    <img class="mr-3 rounded-circle" src="' . url('/assets/admin/img/undraw_profile.svg') . '" width="50px" alt="User Avatar">
                    <div class="media-body">
                         <div class="d-flex justify-content-between">
                                <div class="mr-10">
                                    <h5 class="mt-0 mb-1">' . htmlspecialchars($comment->name) . '</h5>
                                </div>
                                <div class="mr-10">
                                    <p class="mt-0 mb-1">' . htmlspecialchars((New DateTime($comment->thoi_gian))->format('d/m/Y H:i:s')) . '</p>
                                </div>
                        </div>
                        <p>' . htmlspecialchars($comment->noi_dung) . '</p>
                    </div>
                </li>
            </ul>';
        }
        return response()->json($output);
    }

    public function trash()
    {
        $list = $this->binhLuans->getBL()->where('bl.deleted', 1)->paginate(5);
        $title ="Thùng rác";
        return view('admins.binh_luans.trash',compact('list','title'));
    }
 public function delete(BinhLuanRequest $request)
    {
        $list = BinhLuan::findOrFail($request->id);
        $list->deleted = 1;
        $list->save();
        $list->delete();
        return redirect()->route('admin.binh-luan.index')->with('success','Xóa thành công!');
    }
    public function restore(BinhLuanRequest $request)
    {
        $list = BinhLuan::withTrashed()->findOrFail($request->id);
        $list->deleted = 0;
        $list->save();
        $list->restore();
        return redirect()->route('admin.binh-luan.index')->with('success', 'Khôi phục thành công!');
    }
}
