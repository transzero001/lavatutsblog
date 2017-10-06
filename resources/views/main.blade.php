<!DOCTYPE html>
<html lang="en">
@include('partial._head')
<body>

@include('partial._nav')


<div class="container">


    @yield('content');


    @include('partial._footer')
</div>

@include('partial._javascript')


@yield('scripts');
</body>
</html>