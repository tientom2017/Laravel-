<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach()
    {
    	$slide = Slide::all();
    	return view('admin/slide/danhsach', compact("slide"));
    }

    public function getThem()
    {
    	return view('admin/slide/them');
    }

    public function postThem(Request $request)
    {
    	$slide = new Slide;
        $this->validate($request,
            [
                'ten'   => 'required|min:3|max:50|unique|Slide,Ten',
                'noidung'=>'required|min:3|max:100|unique|Slide,Ten',
                'hinh'  =>'required',
                'link'  =>'required|min:3|max:50'
            ],
            [
                'ten.required' =>  'Không được phép bỏ trống!',
                'ten.min'     =>  'Tối thiểu 3 ký tự',
                'ten.max'     =>  'Tối đa 50 ký tự',
                'ten.unique'     =>  'Tên đã tồn tại',
                'noidung.required'=>'Không được phép bỏ trống!',
                'hinh.required'=>'Không được phép bỏ trống!',
                'link.required'=>'Không được phép bỏ trống!'
            ]);
    	$slide->Ten = $request->ten;
    	$slide->NoiDung = $request->noidung;
    	$slide->link = $request->link;
    	if($request->hasFile('hinh'))
    	{
    		$file = $request->file('hinh');
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."_".$name;
    		while(file_exists("upload/slide/".$Hinh))
    		{
    			$Hinh = str_random(4)."_".$name;
    		}
    		$file->move("upload/slide/", $Hinh);
    		$slide->Hinh = $Hinh;
    	}else{
    		$slide->Hinh = "";
    	}

    	$slide->save();
    	return redirect('admin/slide/danhsach')->with('thongbao', 'Slide đã được thêm thành công!');
    }

    public function getXoa($id)
    {
    	$slide = Slide::find($id);
    	$slide->delete();
    	return redirect('admin/slide/danhsach')->with('thongbao', 'Xóa thành công!');
    }

    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.sua', ['slide' => $slide]);
    }

    public function postSua(Request $request, $id)
    {
        $slide = Slide::find($id);
        $this->validate($request,
            [
                'ten'   => 'required|min:3|max:50|unique|Slide,Ten',
                'noidung'=>'required|min:3|max:100|unique|Slide,Ten',
                'hinh'  =>'required',
                'link'  =>'required|min:3|max:50'
            ],
            [
                'ten.required' =>  'Không được phép bỏ trống!',
                'ten.min'     =>  'Tối thiểu 3 ký tự',
                'ten.max'     =>  'Tối đa 50 ký tự',
                'ten.unique'     =>  'Tên đã tồn tại',
                'noidung.required'=>'Không được phép bỏ trống!',
                'hinh.required'=>'Không được phép bỏ trống!',
                'link.required'=>'Không được phép bỏ trống!'
            ]);
        $slide->Ten = $request->ten;
        if($request->hasFile('hinh'))
        {
            $file = $request->file('hinh');
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide/", $Hinh);
            $slide->Hinh = $Hinh;
        }
        $slide->noidung = $request->noidung;
        $slide->link = $request->link;
        $slide->save();
        return redirect('admin/slide/danhsach')->with('thongbao', 'Sửa thành công!');
    }
}
