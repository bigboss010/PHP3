<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\ChucVu;
use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $users;
    protected $chuc_vu;

    public function __construct()
    {
        $this->chuc_vu = new ChucVu();
        $this->users = new KhachHang();
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listUsers = $this->users->getList()->where('users.deleted', 0)->where('ten_chuc_vu','like',"%User%")->paginate(5);
        $title ="Quản lý tài khoản";
        return view('admins.khachhang.index',compact('listUsers','title'));
    }
    public function trash()
    {
        $listUsers = $this->users->getList()->where('users.deleted', 1)->where('ten_chuc_vu','like',"%User%")->paginate(5);
        $title ="Thùng rác";
        return view('admins.khachhang.trash',compact('listUsers','title'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ="Thêm mới tài khoản";
        $list = $this->chuc_vu->getList();

        return view('admins.khachhang.create',compact('title','list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->except('_token');
            $this->users ->createUser($data);
            return redirect()->route('admin.users.index')->with('success','Thêm người dùng thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Thông tin Khách hàng";
        $list = $this->users->find($id);
        $listChucvu = $this->chuc_vu->getList();

        return view('admins.khachhang.show', compact('list','listChucvu','title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Khách hàng";
        $listCV = $this->chuc_vu->getList();
        $list= DB::table('users')->find($id);
        if(!$list){
            return redirect()->route('admin.users.index');
        }
        return view('admins.khachhang.update',[
            'title'=>$title,
            'list'=>$list,
            'listCV'=>$listCV,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $data = $request->except('_token', '_method');
            User::where('id', Auth::user()->id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phoneNumber' => $data['phoneNumber'],
                'address' => $data['address']
            ]);
            return redirect()->back()->with('success','Sửa thành công!');
        }
    }
    public function delete(UserRequest $request)
    {
        $list = KhachHang::findOrFail($request->id);
        $list->deleted = 1;
        $list->save();
        $list->delete();
        return redirect()->route('admin.users.index')->with('success','Xóa thành công!');

    }
    public function restore(UserRequest $request)
    {
        $list = KhachHang::withTrashed()->findOrFail($request->id);
        $list->deleted = 0;
        $list->save();
        $list->restore();
        return redirect()->route('admin.users.index')->with('success', 'Khôi phục thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = DB::table('users')->find($id);
        if (!$list) {
            return redirect()->route('users.index');
        }
        $this->users->deleteUser($id);
        return redirect()->route('admin.users.index')->with('success','Xóa thành công!');
        
    }
}