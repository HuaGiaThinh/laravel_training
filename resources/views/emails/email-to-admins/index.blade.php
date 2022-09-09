<h3>Danh sách bài đăng chưa có lượt xem trong ngày</h3>

@foreach ($posts as $key => $value)
    <hr>
    <p><strong>ID:</strong> {{ $key }}</p>
    <p><strong>Name:</strong> {{ $value }}</p>
@endforeach