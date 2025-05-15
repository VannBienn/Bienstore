<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;

class TrangChuController extends Controller
{
    public function index()
    {
        $sanPhamNoiBat = SanPham::where('noi_bat', true)->take(6)->get();
        $sanPhamKhuyenMai = SanPham::where('khuyen_mai', '>', 0)->take(6)->get();
        return view('trangchu', compact('sanPhamNoiBat', 'sanPhamKhuyenMai'));
    }
}
