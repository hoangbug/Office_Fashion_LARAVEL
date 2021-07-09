<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{ asset('assets/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/skrollr.min.js') }}"></script>
<script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
@if(!Request::is('women', 'men', 'index-affiliate/*'))
<script src="{{ asset('assets/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
@endif

{{-- Date Range Picker --}}
{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('admin-assets/js/plugin/datatables/datatables.min.js') }}"></script>

<script src="{{ asset('assets/vendors/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('assets/vendors/mail-script.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
    $(document).ready(function(){

        $(document).on('keyup', '.search_input', function(){
            var search = $(this).val();
            if(search != ""){
                $('#load-data-live').css({'opacity': '1'});
                fetch_customer_data(search);
            }else{
                $('#load-data-live').css({'opacity': '0'});
                $('#data-live-search').html("");
            }
        });

        function fetch_customer_data(search){
            var arrData = [];
            $.ajax({
                method: 'GET',
                url: "{{ route('live_search.action') }}",
                data: { search: search },
                dataType: 'json',
                success: function(data){
                    var arr = Object.keys(data).map(key => data[key]);
                    arrData.push(arr[0]);
                    var option = '';
                    var total = 0;
                    for(let i = 0; i < arrData.length; i++){
                        $.each(arrData[i], function(key, val){
                            if((val['gender_product']) == 1){
                                if((val['sale']) != 0){
                                    total = (val['price']) * ((100 - (val['sale'])) / 100);
                                    option += '<a href="/men/'+ val['id'] +'" class="list-group-item list-group-item-action">\
                                                <div class="card flex-md-row mb-4 box-shadow" style="height: 100px">\
                                                    <img class="card-img-right flex-auto d-none d-md-block" src="{{ asset('storage/images/product') }}/'+ val['main_image'] +'" alt="Card image cap" style="width: 200px">\
                                                    <div class="card-body d-flex flex-column align-items-start">\
                                                        <h5 class="mb-0">'+ val['name'] +'</h5>\
                                                        <div class="mb-1 text-muted"><del>'+ val['price'].toLocaleString()+' VND</del></div>\
                                                        <p class="card-text mb-auto">'+ total.toLocaleString() +' VND</p>\
                                                    </div>\
                                                </div>\
                                            </a>';
                                }else{
                                    option += '<a href="/men/'+ val['id'] +'" class="list-group-item list-group-item-action">\
                                            <div class="card flex-md-row mb-4 box-shadow" style="height: 100px">\
                                                <img class="card-img-right flex-auto d-none d-md-block" src="{{ asset('storage/images/product') }}/'+ val['main_image'] +'" alt="Card image cap" style="width: 200px">\
                                                <div class="card-body d-flex flex-column align-items-start">\
                                                    <h5 class="mb-0">'+ val['name'] +'</h5>\
                                                    <div class="mb-1 text-muted"></div>\
                                                    <p class="card-text mb-auto">'+ val['price'].toLocaleString() +' VND</p>\
                                                </div>\
                                            </div>\
                                            </a>';
                                }
                            }else if((val['gender_product']) == 2){
                                if((val['sale']) != 0){
                                    total = (val['price']) * ((100 - (val['sale'])) / 100);
                                    option += '<a href="/women/'+ val['id'] +'" class="list-group-item list-group-item-action">\
                                                <div class="card flex-md-row mb-4 box-shadow" style="height: 100px">\
                                                    <img class="card-img-right flex-auto d-none d-md-block" src="{{ asset('storage/images/product') }}/'+ val['main_image'] +'" alt="Card image cap" style="width: 200px">\
                                                    <div class="card-body d-flex flex-column align-items-start">\
                                                        <h5 class="mb-0">'+ val['name'] +'</h5>\
                                                        <div class="mb-1 text-muted"><del>'+ val['price'].toLocaleString() +' VND</del></div>\
                                                        <p class="card-text mb-auto">'+ total.toLocaleString() +' VND</p>\
                                                    </div>\
                                                </div>\
                                            </a>';
                                }else{
                                    option += '<a href="/women/'+ val['id'] +'" class="list-group-item list-group-item-action">\
                                            <div class="card flex-md-row mb-4 box-shadow" style="height: 100px">\
                                                <img class="card-img-right flex-auto d-none d-md-block" src="{{ asset('storage/images/product') }}/'+ val['main_image'] +'" alt="Card image cap" style="width: 200px">\
                                                <div class="card-body d-flex flex-column align-items-start">\
                                                    <h5 class="mb-0">'+ val['name'] +'</h5>\
                                                    <div class="mb-1 text-muted"></div>\
                                                    <p class="card-text mb-auto">'+ val['price'].toLocaleString() +' VND</p>\
                                                </div>\
                                            </div>\
                                            </a>';
                                }
                            }
                            $('#data-live-search').html(option);
                        });
                    }
                }
            });
        }
    });
    
</script>
@yield('ajax')
