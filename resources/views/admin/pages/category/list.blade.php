<div class="table-responsive">
    <div class="dd" id="nestable3" style="max-width: 100%;" data-url="{{ route("$routeName.updateTree") }}">
        <ol class="dd-list">
            @foreach ($items as $item)
                @include('admin.pages.category.item', ['item' => $item])
            @endforeach
        </ol>
    </div>
</div>

@push('script-nestable')
    <script>
        $('.dd').nestable({
            callback: function() {
                let url = $('.dd').data('url');
                let data = $('.dd').nestable('serialize');

                $.ajax({
                    type: "get",
                    url: url,
                    data: {
                        'dataClient': data
                    },
                    dataType: "json",
                    success: function(nodes) {
                        if (nodes > 0) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Rebuild categories successfully'
                            })
                        }
                    }
                });
            }
        });
    </script>
@endpush
