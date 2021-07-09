@extends('index')
@section('content')
<div class="container-fluid">
    <div class="row" style="display: flex; justify-content: center; align-items: center; height: 180px; background-color: rgb(1, 127, 255);">
        <div class="col-md-4" style="display: flex; justify-content: flex-end;">
            <div class="clock">
                <div class="hour">
                    <div class="hr" id="hr"></div>
                </div>
                <div class="min">
                    <div class="mn" id="mn"></div>
                </div>
                <div class="sec">
                    <div class="sc" id="sc"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4" style="display: flex; justify-content: flex-start; align-items: center;">
            <div class="dropdown-partner">
                <button class="dropbtn-partner"><i class="far fa-user" aria-hidden="true"></i></button>
                <div class="droppartner-content">
                    <a href="{{ route('affiliate.program') }}">Home</a>
                    <a href="#">Thông tin tài khoản</a>
                    <a href="{{ route('affiliate.manage') }}">Quản lý chương trình</a>
                    <a href="#">Quản lý doanh thu</a>
                    <a href="#">Đổi mã</a>
                    <a href="#">Thoát tài khoản</a>
                </div>
                <div style="color: #fff;">16.000.000VND</div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin: 50px auto;">
    <div class="row">
        <div class="col-md-12" style="height: 500px; display: flex; align-items: center;">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://www.semtek.com.vn/wp-content/uploads/2020/12/tiep-thi-lien-ket-affiliate-marketing-1.jpg" alt="..." style="width: 100%; height: 500px">
                    </div>
                    <div class="carousel-item">
                        <img src="https://news.nganluong.vn/wp-content/uploads/Ne%CC%82n-kinh-doanh-online-ba%CC%86%CC%80ng-hi%CC%80nh-thu%CC%9B%CC%81c-Dropshipping-hay-Affiliate-Marketing2.png" alt="..." style="width: 100%; height: 500px">
                    </div>
                    <div class="carousel-item">
                        <img src="https://nguyenthanhmmo.com/wp-content/uploads/2020/11/what-is-affiliate-marketing.png" alt="..." style="width: 100%; height: 500px">
                    </div> 
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div id="load-content">
        <div class="content">
            @if(!empty($data))
                @foreach ($data as $value)
                    <div class="row card-affiliate">
                        <div class="col-md-4 col-sm-4 left-cotent-img">
                            <a href="#">
                                <img src="{{ asset('storage/images/affiliate/'. $value->image) }}" class="img-card" alt="">
                            </a>
                        </div>
                        <div class="col-md-8 col-sm-8 right-content-text" style="width: 65%; height: 330px;">
                            <div class="card-text-content" style="width: 75%; color: rgb(117, 117, 117); height: 75%; display: flex; flex-direction: column; justify-content: center; padding-left: 20px">
                                <input type="hidden" class="program_id" value="">
                                <input type="hidden" class="affiliate_id" value="">
                                <h5 style="font-size: 1.75rem; letter-spacing: 1.5px; line-height: 1.25;">{{ $value->title }}</h5>
                                <h6 style="color: red;">Hoa hồng {{ $value->rose_old }} % - {{ $value->rose_new }} %</h6>
                                @if(($value->gender_product) == 1)
                                    <h6 style="font-size: 1.5em;"><a href="{{ route('men.show', $value->product_id) }}" target="_blank">Sản phẩm: {{ $value->name }}</a></h6>
                                @elseif (($value->gender_product) == 2)
                                    <h6 style="font-size: 1.5em;"><a href="{{ route('women.show', $value->product_id) }}" target="_blank">Sản phẩm: {{ $value->name }}</a></h6>
                                @endif
                                <span style="font-size: 1em;">Có hiệu lực từ: {{ $value->created_at }}</span>
                            </div>
                            <div style="width: 25%; text-align: center">
                                <button type="button" class="btn btn-outline-success detail-program" data-toggle="modal" data-target="#programModalCenter" style="width: 100px; height: 50px;" data-url="{{ $value->id }}">Chi tiết</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="programModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px">
        <div class="modal-content" id="load-detail">
            
        </div>
    </div>
</div>

@endsection
@section('ajax')
<script>
    const deg = 6;
    const hr = document.querySelector('#hr');
    const mn = document.querySelector('#mn');
    const sc = document.querySelector('#sc');

    setInterval(() => {
        let day = new Date();
        let hh = day.getHours() * 30;
        let mm = day.getMinutes() * deg;
        let ss = day.getSeconds() * deg;

        hr.style.transform = `rotateZ(${(hh)+(mm/12)}deg)`;
        mn.style.transform = `rotateZ(${(mm)}deg)`;
        sc.style.transform = `rotateZ(${(ss)}deg)`;
    })
    $(document).ready(function(){
        $(document).on('click', '.detail-program', function(e){
            e.preventDefault();
            var id = $(this).attr('data-url');
            if(id != ''){
                $.ajax({
                    type: "GET",
                    url: "{{ route('program.detail') }}",
                    data: { id: id },
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        $('#load-detail').html(data);
                    }
                });
            }
        });
    });
</script>
@endsection