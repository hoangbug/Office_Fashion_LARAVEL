@extends('index')
@section('content')
    <!--================Login Box Area =================-->
    <section class="login_box_area section-margin section-register">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Bạn có sẵn sàng để tạo một tài khoản mới?</h4>
                            <p>Bằng việc đăng kí, bạn đã đồng ý với Shop về Điều khoản dịch vụ & Chính sách bảo mật</p>
                            <a class="button button-account" href="{{ route('login-view') }}">Đăng nhập ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Đăng ký</h3>
                        <form class="row login_form" method="POST" action="{{ route('register')}}" enctype="multipart/form-data" id="register_form">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar" accept="image/*">
                                    <label class="custom-file-label text-left" for="avatar" style="color: #999">Avatar</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Email Address'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Địa chỉ" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Address'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Số điện thoại" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Phone'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Mật khẩu" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                    placeholder="Xác nhận mật khẩu" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Confirm Password'">
                            </div>
                            {{-- <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">Keep me logged in</label>
                                </div>
                            </div> --}}
                            <div class="col-md-12 form-group">
                                <button type="submit" class="button button-register w-100">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->
   
@endsection
@section('ajax')
<script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
@endsection
