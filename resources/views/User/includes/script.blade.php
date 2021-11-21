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

@yield('ajax')
