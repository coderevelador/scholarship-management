@include('layouts.partials.header')

<!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->

@include('layouts.partials.nav')
<!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
<div class="content">
    @yield('content')

<!-- Footer -->
@include('layouts.partials.footer')
