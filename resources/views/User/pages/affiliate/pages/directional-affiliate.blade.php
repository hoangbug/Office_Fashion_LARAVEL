@extends('index')
@section('content')
<section style="background: #ececec url('{{ asset('images/affiliate/bg-bot.92224b5f.png') }}') no-repeat 100% 100%/90% auto; width: 100%; height: 100vh;">
    <div class="container col-affiliate">
        <div class="row">
            <div class="col-md-5 ctent-affiliate">
                <h2 class="txt-title">Login</h2>
                <a href="{{ route('affiliate.login') }}" class="btn btn-success">Login</a>
                <span class="ghichu-txt">(Nếu bạn đã có tài khoản!)</span>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5 ctent-affiliate">
                <h2 class="txt-title">Sign up</h2>
                <a href="{{ route('affiliate.register') }}" class="btn btn-info">Sign up</a>
                <span class="ghichu-txt">(Nếu bạn chưa có tài khoản!)</span>
            </div>
        </div>
    </div>
</section>
@endsection