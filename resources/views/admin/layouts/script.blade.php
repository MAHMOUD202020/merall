<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/admin/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/admin/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        App.init();

        let arrayUrl = location.pathname.split('/');
        let linkNow = arrayUrl[2];

        if (arrayUrl[2] !== 'trash'){

            $('#toggle-'+linkNow).attr('data-active' , 'true').click()
            $('#'+linkNow + ' #li-'+arrayUrl[arrayUrl.length-1]).addClass('active')

        }else {

            let linkNow = arrayUrl[3];

            $('#toggle-'+linkNow).attr('data-active' , 'true').click()
            $('#'+linkNow + ' #li-trash').addClass('active')

        }
    });

</script>
<script src="{{asset('assets/admin/js/pusher.min.js')}}"></script>
<script>

</script>
<script src="{{asset('assets/admin/js/custom.js')}}"></script>
<script src="{{asset('assets/admin/js/notify.js')}}"></script>
@yield('js')
