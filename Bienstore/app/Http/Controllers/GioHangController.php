<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

class GioHangController extends Controller
{
    public function index()
    {
        $giohang = session()->get('giohang', []);
        return view('frontend.giohang.index', compact('giohang'));
    }

    public function them(Request $request)
    {
        $id = $request->input('sanpham_id');
        $soLuong = (int) $request->input('so_luong', 1);

        $sanPham = SanPham::findOrFail($id);

        $giaGoc = $sanPham->gia;
        $giaSauKM = $giaGoc - ($giaGoc * $sanPham->khuyen_mai / 100);

        $gioHang = session()->get('giohang', []);

        if (isset($gioHang[$id])) {
            $gioHang[$id]['so_luong'] += $soLuong;
        } else {
            $gioHang[$id] = [
                'ten_san_pham' => $sanPham->ten_san_pham,
                'gia' => $giaGoc,
                'gia_khuyen_mai' => $giaSauKM,
                'hinh_anh' => $sanPham->hinh_anh,
                'so_luong' => $soLuong
            ];
        }

        session()->put('giohang', $gioHang);
        return redirect()->route('giohang.index')->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function themBangAjax(Request $request)
    {
        $id = $request->input('sanpham_id');
        $soLuong = (int) $request->input('so_luong', 1);

        $sanPham = SanPham::find($id);
        if (!$sanPham) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm.']);
        }

        $giaGoc = $sanPham->gia;
        $giaSauKM = $giaGoc - ($giaGoc * $sanPham->khuyen_mai / 100);

        $gioHang = session()->get('giohang', []);

        if (isset($gioHang[$id])) {
            $gioHang[$id]['so_luong'] += $soLuong;
        } else {
            $gioHang[$id] = [
                'ten_san_pham' => $sanPham->ten_san_pham,
                'gia' => $giaGoc,
                'gia_khuyen_mai' => $giaSauKM,
                'hinh_anh' => $sanPham->hinh_anh,
                'so_luong' => $soLuong
            ];
        }

        session()->put('giohang', $gioHang);

        return response()->json(['success' => true, 'message' => 'Đã thêm vào giỏ hàng']);
    }

    public function xoa($id)
    {
        $gioHang = session()->get('giohang', []);
        if (isset($gioHang[$id])) {
            unset($gioHang[$id]);
            session()->put('giohang', $gioHang);
        }

        return redirect()->route('giohang.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}
