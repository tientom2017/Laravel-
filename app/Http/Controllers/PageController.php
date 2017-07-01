<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\Slide;
use App\TinTuc;
use App\Commnet;
class PageController extends Controller
{
    //
	function __construct()
	{
		$theloai = TheLoai::all();
        $slide = Slide::all();
		view::share('theloai', $theloai);
        view::share('slide', $slide);
	}

    public function trangchu()
    {
    	$theloai = TheLoai::all();
    	return view('pages.trangchu', compact('theloai'));
    }

    public function lienhe()
    {
    	return view('pages.lienhe');
    }

    public function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaitin'=> $loaitin, 'tintuc'=> $tintuc] );
    }

    public function tintuc($id)
    {
         $tintuc = tintuc::find($id);
         $tinnoibat = tintuc::where('NoiBat', 1)->take(5)->get();
         $tinlienquan = tintuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(5)->get();
        
         return view('pages.tintuc',compact("tintuc"), compact('tinnoibat'), compact('tinlienquan'), compact('commnet'));
    }
}
