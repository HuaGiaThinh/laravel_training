<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/js/notify.min.js') }}"></script>

<script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

{{-- nestable2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
@stack('script-nestable')

{{-- ckeditor --}}
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>

{{-- my custom js --}}
<script src="{{ asset('admin/js/my-custom.js') }}"></script>
@stack('script-sidebar')
@stack('script')