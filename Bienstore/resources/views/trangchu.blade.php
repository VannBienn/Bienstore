@extends('layouts.app')

@section('tieude', 'Trang chủ')

@section('noidung')
<!-- Phần banner -->
<div class="banner">
    <div class="container">
        <div class="noidung-banner">
            <h1 class="tieude-banner">Sản phẩm làm đẹp</h1>
            <p class="mota-banner">Đa dạng sản phẩm chất lượng cao cấp với khuyến mãi hấp dẫn đang đón chờ bạn.</p>
            <div class="nut-banner">
                <a href="{{ route('sanpham.fe') }}">Mua ngay</a>
            </div>
        </div>
        <div class="hinh-banner">
            <img src="{{ asset('images/banner-img.png') }}" alt="Banner">
        </div>
    </div>
</div>

<!-- Phần giới thiệu -->
<div class="gioithieu">
    <div class="container">
        <div class="cot-gioithieu">
            <div class="hinhanh-gioithieu">
                <img src="{{ asset('images/about-img.png') }}" alt="Tin tức">
            </div>
            <div class="noidung-gioithieu">
                <h2>Tin tức</h2>
                <p>Cập nhật các xu hướng làm đẹp, mẹo chăm sóc da và thông tin hữu ích từ BIENstore.</p>
                <div class="nut-gioithieu">
                    <a href="/tin-tuc">Xem tin tức</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sản phẩm nổi bật -->
<div class="container mt-5">
    <h2 class="tieude-chinh">Sản phẩm nổi bật</h2>
    <p class="mota">Những sản phẩm được nhiều người yêu thích</p>
    <div class="row">
        @forelse($sanPhamNoiBat as $sanPham)
        @include('components.sanpham_card', ['sanPham' => $sanPham])
        @empty
        <p>Chưa có sản phẩm nổi bật nào.</p>
        @endforelse
    </div>
</div>

<!-- Sản phẩm khuyến mãi -->
<div class="container mt-5">
    <h2 class="tieude-chinh">Sản phẩm khuyến mãi</h2>
    <p class="mota">Săn sale giá tốt nhất hôm nay!</p>
    <div class="row">
        @forelse($sanPhamKhuyenMai as $sanPham)
        @include('components.sanpham_card', ['sanPham' => $sanPham])
        @empty
        <p>Chưa có sản phẩm khuyến mãi nào.</p>
        @endforelse
    </div>
</div>

<!-- Quick View Modal -->
<div id="quickview-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="quickview-content">
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-quickview').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/sanpham/quickview/' + id,
                method: 'GET',
                success: function(res) {
                    $('#quickview-content').html(res);
                    $('#quickview-modal').fadeIn();
                },
                error: function() {
                    alert('Không thể tải dữ liệu sản phẩm.');
                }
            });
        });

        $(document).on('click', '.close', function() {
            $('#quickview-modal').fadeOut();
        });

        $(window).on('click', function(e) {
            if ($(e.target).is('#quickview-modal')) {
                $('#quickview-modal').fadeOut();
            }
        });
    });
</script>
@endsection

<style>
    .modal {
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        padding: 20px;
        width: 80%;
        max-width: 900px;
        position: relative;
        border-radius: 10px;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 25px;
        cursor: pointer;
    }
</style>