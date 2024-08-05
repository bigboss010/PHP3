<?php

namespace App\Http\Controllers\clients;

use App\Models\Pet;
use App\Models\DanhMuc;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\BinhLuan;
use App\Models\DonHang;
use App\Models\HinhAnhPet;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PetControllerView extends Controller
{
    protected $pet;
    protected $pet_hinhanh;

    public function __construct()
    {
        $this->pet = new Pet();
        //    $this->pet_hinhanh = new HinhAnhPet(); 
    }

    protected function getUniquePetsCount()
    {
        $userId = auth()->id();
        if (!$userId) {
            return 0;
        }
        $cartItems = DB::table('gio_hangs')->where('user_id', $userId)->get();
        $uniquePetIds = [];
        foreach ($cartItems as $item) {
            $pet = Pet::find($item->id);
            if ($pet && !in_array($pet->id, $uniquePetIds)) {
                $uniquePetIds[] = $pet->id;
            }
        }
        return count($uniquePetIds);
    }

    public function index(Request $request, DanhMuc $danhMuc)
    {
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet();
        $sliders = Slider::query()->get();
        $list = $query->where('trang_thai', 1)->get();
        return view('layouts.clients.index', compact('list', 'danhMucs', 'uniquePetsCount', 'sliders'));
    
    }

    public function shop(Request $request, DanhMuc $danhMuc)
    {
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet();
        $sliders = Slider::query()->get();
        $list = $query->where('trang_thai', 1)->get();
        return view('layouts.clients.shop', compact('list', 'danhMucs', 'uniquePetsCount', 'sliders'));
    
    }
    public function shopSearch(Request $request, DanhMuc $danhMuc)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet();
        $sliders = Slider::query()->get();
       
        if ($search) {
            $list =  $query->where('danh_mucs.ten_danh_muc', 'like', '%'.$search.'%')
            ->orwhere('pets.ten_pet', 'like', '%'.$search.'%')->get();
            return view('layouts.clients.shop', compact('danhMucs', 'uniquePetsCount', 'list', 'sliders'));
        } else {
            $list = $query->where('trang_thai', 1)->get();
            return view('layouts.clients.shop', compact('list', 'danhMucs', 'uniquePetsCount', 'sliders'));
        }
    }

    public function shopDanhMuc(Request $request, DanhMuc $danhMuc, $id)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet()->where('trang_thai', 1)->where('danh_muc_id', $id);
        if ($search) {
            $query->where('ten_pet', 'like', "%{$search}%");
        }
        $list = $query->get();

        return view('layouts.clients.shop', compact('list', 'danhMucs', 'uniquePetsCount', 'search'));
    }
    

    public function shopSingle(string $id)
    {
        $list = $this->pet->find($id);
        $listImage = HinhAnhPet::where('pet_id', $id)->get();
        $featuredProducts = $this->pet->take(6)->get(); // Truy xuất danh sách sản phẩm nổi bật
        $uniquePetsCount = $this->getUniquePetsCount();
        return view('layouts.clients.shop-single', compact('list', 'featuredProducts', 'uniquePetsCount', 'listImage'));
    }

    public function addPetToCart(string $id, int $so_luong = 1)
    {
    $userId = auth()->id();
    if (!$userId) {
        return redirect()->back()->with('error', 'bạn phải đăng nhập trước khi add');
    }
    $pet = Pet::findOrFail($id);
    $cartKey = 'cart_' . $userId;
    $cart = session()->get($cartKey, []);
    // dd($cart);

    if (isset($cart[$id])) {
        $cart[$id]['so_luong'] += $so_luong;
    } else {
        $cart[$id] = [
            'ten_pet' => $pet->ten_pet,
            'gia_pet' => $pet->gia_pet,
            'so_luong' => $so_luong,
            'image' => $pet->image
        ];
    }

    $existingCartItem = DB::table('gio_hangs')->where('user_id', $userId)->where('id', $id)->first();
    if ($existingCartItem) {
        DB::table('gio_hangs')->where('user_id', $userId)->where('id', $id)
            ->update(['so_luong' => $existingCartItem->so_luong + $so_luong]);
    } else {
        DB::table('gio_hangs')->insert([
            'user_id' => $userId,
            'so_luong' => $so_luong
        ]);
    }

    session()->put($cartKey, $cart);
    // dd(session()->get($cartKey)); // Kiểm tra giỏ hàng trong session
    return redirect()->back()->with('success', 'Thêm pet vào giỏ hàng thành công');
    }

    // Update khi thêm các sản phẩm ngoài trang cart
    public function update(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $userId = auth()->id();
    
        // Cập nhật số lượng sản phẩm trong giỏ hàng trong session
        $cartKey = 'cart_' . $userId;
        $cart = session()->get($cartKey);
    
        if (isset($cart[$id])) {
            $cart[$id]['so_luong'] = $quantity;
            session()->put($cartKey, $cart);
        }
    
        // Cập nhật số lượng sản phẩm trong giỏ hàng trong cơ sở dữ liệu
        $existingCartItem = DB::table('gio_hangs')->where('user_id', $userId)->where('id', $id)->first();
        if ($existingCartItem) {
            DB::table('gio_hangs')->where('user_id', $userId)->where('id', $id)
                ->update(['so_luong' => $quantity]);
        }
    
        // Tính toán lại tổng tiền
        $total = 0;
        foreach ($cart as $details) {
            $total += $details['gia_pet'] * $details['so_luong'];
        }
    
        return response()->json(['total' => $total]);
    }

    // Update tại trang cart
    public function updateCart(Request $request)
    {
    // Get the cart items from the request
    $cartItems = $request->input('cartItems', []);

    // Get the current user's cart key
    $cartKey = 'cart_' . Auth::id();

    // Get the existing cart from the session
    $cart = session()->get($cartKey, []);

    // Update the cart with the new quantities
    foreach ($cartItems as $id => $item) {
        if (isset($cart[$id])) {
            $cart[$id]['so_luong'] = $item['so_luong'];
        }
    }

    // Save the updated cart back to the session
    session()->put($cartKey, $cart);

    return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    public function deletePetCart(Request $request)
    {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['error' => 'Bạn cần đăng nhập trước!'], 403);
        }
        if ($request->id) {
            $cartKey = 'cart_' . $userId;
            $cart = session()->get($cartKey, []);
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put($cartKey, $cart);

                DB::table('gio_hangs')->where('user_id', $userId)->where('id', $request->id)->delete();
            }
        }

        return response()->json(['success' => 'Xóa pet khỏi giỏ hàng thành công.']);
    }

    public function showCart()
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng');
        }

        $cartKey = 'cart_' . $userId;
        $cartItems = session()->get($cartKey, []);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['gia_pet'] * $item['so_luong'];
        }

        return view('layouts.clients.cart', compact('cartItems', 'total'));
    }


    // public function checkout()
    // {
    //     $userId = auth()->id();
    //     if (!$userId) {
    //         return redirect()->route('login')->with('error', 'Bạn cần đăng nhập rồi mới được thanh toán');
    //     }

    //     $cartKey = 'cart_' . $userId;
    //     $cartItems = session()->get($cartKey, []);
     
    //     $subtotal = 0;
    //     $total = 0;

    //     if (!empty($cartItems)) {
    //         foreach ($cartItems as $item) {
    //             $subtotal += $item['gia_pet'] * $item['so_luong'];
    //         }
    //         $total = $subtotal;
    //     }

    //     return view('layouts.clients.checkout', compact('cartItems', 'subtotal', 'total'));
    // }


    public function showProfile()
    {
        return view('layouts.clients.profile');
    }
    public function profileEdit(Request $request)
    {
        return view('layouts.clients.profileEdit');
    }
   
    public function showDonHang()
    {
        $donHangs = Auth::user()->donHang;
        $trangThaiDH = DonHang::TRANG_THAI_DON_HANG;
        return view('layouts.clients.donhang', compact('donHangs', 'trangThaiDH'));
    }

    public function showDetailDonHang($id){
        $donHangDetail = DonHang::query()->findOrFail($id);
        $trangThaiDH = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiTT = DonHang::TRANG_THAI_THANH_TOAN;
        return view('layouts.clients.donhang_detail', compact('donHangDetail', 'trangThaiDH', 'trangThaiTT'));
    }

    public function updateDonHang(Request $request, $id){
        $donHang = DonHang::query()->findOrFail($id);

        try{
            if($request->has('huy_don_hang')){
                $donHang->update(['trang_thai_id' => DonHang::HUY_DON_HANG]);
            }elseif($request->has('da_giao_hang')){
                $donHang->update(['trang_thai_id' => DonHang::DA_GIAO_HANG]);
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return redirect()->back();
       }

    public function shopDog(Request $request, DanhMuc $danhMuc)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet()->where('ten_danh_muc', 'like', "%Chó%");
        if ($search) {
            $query->where('ten_pet', 'like', "%{$search}%");
        }
        $list = $query->get();

        return view('layouts.clients.shop-dog', compact('list', 'danhMucs', 'uniquePetsCount', 'search'));
    }
    public function shopCat(Request $request, DanhMuc $danhMuc)
    {
        $search = $request->input('search');
        $danhMucs = $danhMuc->getDanhMuc();
        $uniquePetsCount = $this->getUniquePetsCount();
        $query = $this->pet->getPet()->where('ten_danh_muc', 'like', "%Mèo%");
        if ($search) {
            $query->where('ten_pet', 'like', "%{$search}%");
        }
        $list = $query->get();

        return view('layouts.clients.shop-dog', compact('list', 'danhMucs', 'uniquePetsCount', 'search'));
    }

    public function thank()  {
        return view('layouts.clients.thank');
        
    }

    public function send_comment(Request $request)
    {  
        $user_id = $request->user_id;
        $pet_id = $request->pet_id;
        $noi_dung = $request->noi_dung;
        $thoi_gian = Carbon::now();
        $comment = New BinhLuan();  
        $comment->noi_dung = $noi_dung;
        $comment->user_id = $user_id;
        $comment->pet_id = $pet_id;
        $comment->thoi_gian = $thoi_gian;
        $comment->save();
    }
}
