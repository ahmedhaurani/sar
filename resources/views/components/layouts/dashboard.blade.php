<!doctype html>
<html
dir="rtl"
class="light-style layout-navbar-fixed layout-menu-fixed"
defaultTheme="1"
data-theme="theme-default"
data-assets-path="../../assets/"
data-template="vertical-menu-template-no-customizer-starter">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ $settings->title}} </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?IBM+Plex+Sans+Arabic,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Google Font Tajawal -->
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/quill/typography.css')}}" />

    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/rtl/core.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/rtl/theme-semi-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('style/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/fontawesome.css') }}">
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/wysiwyg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/highlight.min.css') }}"> --}}

    <!-- Scripts -->
    <script src="{{ asset('style/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('style/assets/js/config.js') }}"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
            @livewireStyles()

            <style>
                body {
                    font-family: 'Tajawal', sans-serif;
                }

                /* Optional: Customize specific elements */
                h1, h2, h3, h4, h5, h6 {
                    font-family: 'Tajawal', sans-serif;
                }

                .btn {
                    font-family: 'Tajawal', sans-serif;
                }
            </style>

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('livewire.partials.admin.sidebar')
            <div class="layout-page">
                 @include('livewire.partials.admin.navbar')
                <div class="content-wrapper">
                    <main>
                        {{ $slot }}
                    </main>
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

                            <div></div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('style/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('style/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('style/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('style/js/off-canvas.js') }}"></script>
    <script src="{{ asset('style/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('style/js/template.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('style/assets/js/main.js') }}"></script>
    <script src="{{ asset('style/assets/js/forms-editors.js') }}"></script>

  <!-- Vendors JS -->
  <script src="{{asset('style/assets/vendor/libs/quill/katex.js')}}"></script>
  <script src="{{asset('style/assets/vendor/libs/quill/quill.js')}}"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    @livewireStyles
    @livewireScripts

    <!-- Custom Scripts -->
    @stack('scripts')
</body>

</html>
