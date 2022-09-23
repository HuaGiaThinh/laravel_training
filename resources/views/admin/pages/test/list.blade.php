@php
use App\Helpers\Template as Template;
@endphp
<div class="table-responsive">
    <table class="table align-middle text-center table-bordered">
        {{-- title --}}
        @if (count($items) > 0)
            <thead>
                <tr>
                    <th><input type="checkbox" name="checkall-toggle"></th>
                    <th width="3%">ID</th>
                    <th width="30%" class="text-left">Event</th>
                    <th>Editable</th>
                    <th>Action API</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><input type="checkbox" name="cid[]" value="{{ $item->id }}"></td>
                        <td class="item-id">{{ $item->id }}</td>
                        <td class="text-left">
                            <p class="mb-0">
                                <b>{{ Template::showContent($item->name, 50) }}</b>
                            </p>
                        </td>
                        <td>{{ $item->editable == 0 ? 'No' : 'Yes' }}</td>
                        <td>
                            <a href="{{ route($routeName . '.form', ['id' => $item->id]) }}"
                                data-api="http://laravel_base.test/api/events/{{ $item->id }}/editable?api_token={{ Auth::user()->api_token }}"
                                class="btn btn-info rounded-circle btn-sm api-edit">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="{{ route($routeName . '.delete', ['id' => $item->id]) }}"
                                class="btn btn-danger btn-delete rounded-circle btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                            <input type="hidden" name="api-maintain-{{ $item->id }}"
                                value="http://laravel_base.test/api/events/{{ $item->id }}/editable/maintain">
                        </td>
                    </tr>
                @endforeach

            </tbody>
        @else
            <h5 class="text-center">Dữ liệu đang được cập nhật...</h5>
        @endif
    </table>
</div>
@push('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".api-edit", function(e) {
                e.preventDefault();
                var url = $(this).attr("href");
                let api = $(this).data("api");
                let id = $(this).parent().siblings('td.item-id').html();

                $.ajax({
                    type: "GET",
                    contentType: "application/json",
                    url: api,
                    data: "data",
                    dataType: "json",
                    statusCode: {
                        200: function(response) {
                            window.location.href = url;
                        },
                        409: function(response) {                 
                            maintain(url, id);
                        },
                    },
                });
            });
        });

        function maintain(url, id) {
            $.ajax({
                type: "GET",
                url: $('input[name=api-maintain-' + id + ']').val(),
                dataType: "json",
                success: function() {
                    window.location.href = url;
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Sự kiện này chưa thể chỉnh sửa! Vui lòng thử lại sau",
                    });
                },
            });
        }
    </script>
@endpush
