<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        @php
         $company = DB::table('companies')->where('id', auth()->user()->company_id)->first()->name;
        @endphp
        @yield('title') | {{ ucwords($company) }}
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{-- favicon --}}
 <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('backend/assets/favicon/apple-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('backend/assets/favicon/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('backend/assets/favicon/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/favicon/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('backend/assets/favicon/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('backend/assets/favicon/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('backend/assets/favicon/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('backend/assets/favicon/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/favicon/apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('backend/assets/favicon/android-icon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('backend/assets/favicon/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/favicon/favicon-16x16.png') }}">


<link rel="manifest" href="{{ asset('backend/assets/favicon/manifest.json') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('backend/assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet"   type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/iziToast.min.css') }}">
    <link href="{{ asset('backend/assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />



    <!-- Template CSS -->

    {{-- <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('backend/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/web/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/web/css/bootstrap-datetimepicker.min.css') }}">
    <link href="{{ asset('backend/assets/css/bootstrap-toggle.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dropzone.min.css') }}">

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <style>
        input.form-control,
        textarea.form-control,
        select.form-control {
            border-radius: 0em;
        }

        .ck-editor__editable,
        textarea {
            min-height: auto;
        }

        [class^='select2'] {
            border-radius: 0px !important;
        }

        .bg-transparent-to-overlay {
            background-color: transparent;
            background-image: url("{{ asset('img/luhoi.min.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

      
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  border: 1px solid rgb(109, 24, 24);
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


        /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/

    </style>
    @stack('third_party_stylesheets')

    @stack('page_css')

    @yield('css')
</head>

<body>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('backend.layouts.header')

            </nav>
            <div class="main-sidebar main-sidebar-postion">
                @include('backend.layouts.sidebar')
            </div>
            <!-- Main Content -->
            <div class="main-content">
                               {{-- @include('backend.layouts.flashMessage')                     --}}
                @yield('content')
            </div>
            <footer class="main-footer">
                @include('backend.layouts.footer')
            </footer>
        </div>
    </div>

    @include('backend.profile.change_password')
    @include('backend.profile.edit_profile')

</body>
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/iziToast.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/dataTables.select.min.js') }}"></script>
{{-- <script src="{{ asset('backend/assets/js/select2.min.js') }}"></script> --}}
<script src="{{ asset('backend/assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('backend/assets/js/buttons.flash.min.js') }}"></script>


<!-- Template JS File -->

<script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>

<script script src="{{ asset('backend/web/js/stisla.js') }}"></script>
<script src="{{ asset('backend/web/js/scripts.js') }}"></script>
<script src="{{ mix('/backend/assets/js/profile.js') }}"></script>
<script src="{{ asset('/backend/assets/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/dropzone.min.js') }}"></script>

<script src="{{ asset('/backend/assets/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/backend/assets/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/date-range-picker-demo.js') }}"></script>
{{-- --}}
<script src="{{ asset('/backend/assets/js/date-range-picker-demo-single.js') }}"></script>
<script src="{{ asset('/backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/easy-number-separator.js') }}"></script>


{{-- <script src="{{ mix('/backend/assets/js/custom/custom.js') }}"></script> --}}
@stack('third_party_scripts')

@stack('page_scripts')

@yield('scripts')
<script>
    let loggedInUser = @json(Auth::user());
    let loginUrl = '{{ route('admin.login') }}';
    const userUrl = '{{ url('users') }}';
    // Loading button plugin (removed from BS4)
    (function($) {
        $.fn.button = function(action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));

        $('#started_at').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            showButtonPanel: true,
            autoclose: true
        });

        $('#ended_at').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            showButtonPanel: true,
            autoclose: true
        });

         $('#dob').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            showButtonPanel: true,
            autoclose: true
        });

        $('#employment_date').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            showButtonPanel: true,
            autoclose: true
        });
    
    easyNumberSeparator({
      selector: '.number-separator',
      separator: ',',
      decimalSeparator: '.',
      resultInput: '#result_input',
    })

</script>

</html>
