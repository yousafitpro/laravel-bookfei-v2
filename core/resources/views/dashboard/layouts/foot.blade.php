<script type="text/javascript">
    var public_lang = "{{ @Helper::currentLanguage()->code }}";
    var public_folder_path = "{{ asset('') }}";
    var first_day_of_week = "{{ env("FIRST_DAY_OF_WEEK",0) }}";

</script>
@stack('before-scripts')
<!-- jQuery -->
<script src="{{ asset('assets/dashboard/js/jquery/dist/jquery.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/dashboard/js/tether/dist/js/tether.min.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/bootstrap/dist/js/bootstrap.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/moment/moment.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/moment/locale/'.@Helper::currentLanguage()->code.'.js') }}" defer></script>
<!-- core -->
<script src="{{ asset('assets/dashboard/js/underscore/underscore-min.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/jQuery-Storage-API/jquery.storageapi.min.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/pace/pace.min.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/config.lazyload.js') }}" defer></script>

<script src="{{ asset('assets/dashboard/js/scripts/palette.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-load.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-jp.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-include.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-device.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-form.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-nav.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-screenfull.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-scroll-to.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/js/scripts/ui-toggle-class.js') }}" defer></script>


<script src="{{ asset('assets/dashboard/js/scripts/app.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<!-- Responsive extension -->
<script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
<!-- Buttons extension -->
<script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}" ></script>
<script src="{{ asset('assets/js/myfile-uploader.js') }}" ></script>
<script>

//    $(".mytoggle").on("click",function (e)
//    {
//        // $('#'+e.target.id).prop("checked", true);
//        // alert($('#'+e.target.id).attr("checked"))
//
//    })
    $(document).ready(function() {

            $('#myTable').DataTable();

        $('.js-select-basic-single').select2();
    });
</script>
{!! Helper::SaveVisitorInfo("Dashboard &raquo; ".trim($__env->yieldContent('title'))) !!}
@stack('after-scripts')
