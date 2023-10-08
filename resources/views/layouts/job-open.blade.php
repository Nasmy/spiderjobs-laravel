<!DOCTYPE html>

<html
    lang="en"
    class="semi-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr"
    data-theme="theme-semi-dark"
    data-assets-path="../../assets/"
    data-template="vertical-menu-template"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    @include('layouts/sections/style');

</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Content wrapper -->
            <div class="content-wrapper">
                @yield('content')


                @include('layouts/sections/footer/footer')
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
            <!-- Footer -->

            <!-- / Footer -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

@include('layouts/sections/script');
</body>
</html>
