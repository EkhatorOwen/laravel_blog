<!doctype html>
<html lang="en">

@include('partials._head')

<body>
@include('partials._nav')

<div class="container my-3">

    @include('partials._messages')

@yield('content')

  @include('partials._footer')

</div> <!-- end of container -->

@include('partials._javascript')
@yield('scripts')

</body>

</html>