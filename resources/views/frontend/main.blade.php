<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.elements.head')
</head>

<body>
    <div class="super_container">
        @include('frontend.elements.header')
        @yield('content')
        @include('frontend.elements.footer')

        <!-- Back to top button -->
        @include('frontend.elements.tap-to-top')
    </div>

    @include('frontend.elements.script')
</body>

</html>
