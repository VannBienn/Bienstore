@php
$giaMoi = $sanPham->gia - ($sanPham->gia * $sanPham->khuyen_mai / 100);
@endphp

<div class="col-md-4 mb-4 d-flex">
    <div class="card w-100 h-100 product-card">
        <a href="{{ route('sanpham.show', $sanPham->id) }}">
            <div class="position-relative">
                @if($sanPham->khuyen_mai > 0)
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                        -{{ $sanPham->khuyen_mai }}%
                    </span>
                @endif
                <img src="{{ $sanPham->hinh_anh ? asset('uploads/' . $sanPham->hinh_anh) : 'https://via.placeholder.com/300x300?text=No+Image' }}"
                    class="card-img-top" alt="{{ $sanPham->ten_san_pham }}">
            </div>
        </a>
        <div class="card-body text-center">
            <h5 class="card-title">{{ $sanPham->ten_san_pham }}</h5>
            <div class="card-text">
                @if($sanPham->khuyen_mai > 0)
                    <span class="gia-cu">{{ number_format($sanPham->gia, 0, ',', '.') }} đ</span>
                    <span class="gia-moi">{{ number_format($giaMoi, 0, ',', '.') }} đ</span>
                @else
                    <span class="gia-moi">{{ number_format($sanPham->gia, 0, ',', '.') }} đ</span>
                @endif
            </div>
        </div>
        <div class="hover-links">
            <a href="{{ route('sanpham.show', $sanPham->id) }}" class="btn-detail">Xem chi tiết</a>
            <a href="javascript:void(0);" class="btn-quickview" data-id="{{ $sanPham->id }}">Xem nhanh</a>
        </div>
    </div>
</div>
