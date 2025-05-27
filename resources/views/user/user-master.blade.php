<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('/assets') }}"
  data-template="vertical-menu-template-no-customizer"
  data-style="light">
  <head>
    @include('template.header')
</head>
<body>
    @include('template.sidebar')
    @include('template.navbar')

    <div class="main-content">
        @yield('content')
    </div>

    @include('template.footer')
    @yield('scripts')
</body>
</html>
