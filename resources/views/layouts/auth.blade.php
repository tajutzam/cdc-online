<!DOCTYPE html>
<html lang="en">
@include('layouts.header')

<body>
    @yield('content')
    @include('layouts.footer')
    @include('sweetalert::alert')

</body>

</html>
