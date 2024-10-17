@extends('master.home')

@section('main')

<h2>Chi tiết sản phẩm</h2>
<div class="row products">
    <div class="col-md-5">
        <img src="https://image.kacana.vn/images/product/gio-xach-dep-hang-hieu-tui-nu-fsm-2303-4013216754.jpg" alt=""
            style="width:100%">
    </div>
    <div class="col-md-7">
        <h3>{{ $product->name }}</h3>
        <p style="font-size: 18px">
            <s>Giá gốc: {{ $product->price }}</s>
            <b>Giá mới: {{ $product->sale_price }}</b>
        </p>
        <p>
            <form action="{{ route('cart.add') }}" method="POST" class="form-inline" role="form">
                @csrf
                <div class="form-group">
                    <input class="form-control" name="quantity" placeholder="Số lượng" type="number" min="1" value="1">
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
            </form>
        </p>
    </div>
</div>
<hr>
<div class="comments">
    @foreach($product->comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img width="60" class="media-object" src="https://haycafe.vn/wp-content/uploads/2022/03/Avatar-TikTok-anh-dai-dien-TikTok.jpg" alt="Image">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->user->name}}</h4>
            <p>{{$comment->content}}</p>
            @if (auth('cus')->check() && auth('cus')->user()->can('change-comment', $comment))
            <a href="" class="label label-danger">Xóa</a> 
            <a href="" class="label label-default">Sửa</a> 
            @endif

        </div>
    </div>
    @endforeach
</div>


<!-- Kiểm tra xem người dùng đã đăng nhập chưa -->
@if (auth()->guard('cus')->check())
    <form action="{{ route('home.product_comment', $product->id) }}" method="POST" role="form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <legend>Bình luận sản phẩm</legend>

        @if (Session::has('ok'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ Session::get('ok') }}!</strong>
            </div>
        @endif

        <div class="form-group">
            <label for="content">Nội dung bình luận</label>
            <textarea id="content" name="content" class="form-control" placeholder="Nội dung bình luận"></textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Gửi bình luận</button>
    </form>
@else
    <!-- Nếu chưa đăng nhập thì thông báo -->
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Chưa đăng nhập</strong> bạn hãy <a href="{{ route('customer.login') }}">click vào đây</a> để đăng nhập
    </div>
@endif

@endsection
