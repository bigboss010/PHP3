<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách slider';
        $sliders = Slider::where('deleted', 0)->paginate(5);
        return view('admins.sliders.index', compact('title', 'sliders'));
        
    }

    public function trash()
    {
        $list = Slider::onlyTrashed()->paginate(5);
        $title ="Thùng rác";
        return view('admins.sliders.trash',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm ảnh slider';
        return view('admins.sliders.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the request has files
        if ($request->hasFile('list_hinh_anh')) {
            $altCount = $request->alt; 
            $index = 0;
    
            foreach ($request->file('list_hinh_anh') as $image) {
                if ($image) {
                    $path = $image->store('uploads/sliders/list_slider', 'public');           
                    Slider::create([
                        'alt' => $altCount[$index], 
                        'hinh_anh' => $path
                    ]);
    
                    $index++; 
                }
            }
        }
    
        return redirect()->route('admin.slider.index')->with('success', 'Thêm thành công!');
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
        $slider = Slider::query()->findOrFail($id);

        if($slider->hinh_anh && Storage::disk('public')->exists($slider->hinh_anh)){
            Storage::disk('public')->delete($slider->hinh_anh);
        }

        $slider->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Xóa thành công!');
    }

    public function delete(SliderRequest $request)
    {
        $list = Slider::findOrFail($request->id);
        $list->deleted = 1;
        $list->save();
        $list->delete();
        return redirect()->route('admin.slider.index')->with('success','Xóa thành công!');

    }
    public function restore(SliderRequest $request)
    {
        $list = Slider::withTrashed()->findOrFail($request->id);
        $list->deleted = 0;
        $list->save();
        $list->restore();
        return redirect()->route('admin.slider.index')->with('success', 'Khôi phục thành công!');
    }
}
