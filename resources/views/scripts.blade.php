<!-- jQuery -->
<script src="{{URL::asset('plugins/components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{URL::asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{URL::asset('js/sidebarmenu.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{URL::asset('js/jquery.slimscroll.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{URL::asset('js/custom.js')}}"></script>
<script src="{{URL::asset('plugins/components/switchery/dist/switchery.min.js')}}"></script>
<script src="{{URL::asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('plugins/components/icheck/icheck.js')}}"></script>
<script src="{{URL::asset('plugins/components/icheck/icheck.init.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="{{URL::asset('plugins/components/datatables/buttons.html5.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<!-- Moment -->
<script src="{{URL::asset('plugins/components/moment/min/moment.min.js')}}"></script>

<!-- Toastr -->
<script src="{{URL::asset('js/toastr.min.js')}}" type="text/javascript"></script>
<script>
    toastr.options.closeButton = true;
    toastr.options.preventDuplicates = false;
    toastr.options.progressBar = true;
    toastr.options.positionClass = 'toast-bottom-right';
</script>
{!! Toastr::render() !!}

<!-- Start of b2flyhelp Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=2e2e981d-d4db-4603-87ca-61debe54494f"> </script>
<!-- End of b2flyhelp Zendesk Widget script -->
