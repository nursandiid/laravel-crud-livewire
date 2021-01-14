<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <livewire:styles />
    <style>
        .datepicker {
            border-radius: 0.25rem;
            padding: 0;
            overflow: hidden;
        }
        .datepicker-days table thead, .datepicker-days table tbody, .datepicker-days table tfoot {
            padding: 5px;
            display: list-item;
        }
        .datepicker-days table thead, .datepicker-months table thead, .datepicker-years table thead, .datepicker-decades table thead, .datepicker-centuries table thead {
            background: #3546b3;
            color: #ffffff;
            border-radius: 0;
        }
        .datepicker-days table thead tr:nth-child(2n+0) td, .datepicker-days table thead tr:nth-child(2n+0) th {
            border-radius: 3px;
        }
        .datepicker-days table thead tr:nth-child(3n+0) {
            text-transform: uppercase;
            font-weight: 300 !important;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }
        .table-condensed > tbody > tr > td, 
        .table-condensed > tbody > tr > th,
        /* .table-condensed > tfoot > tr > td,  */
        /* .table-condensed > tfoot > tr > th,  */
        .table-condensed > thead > tr > td, 
        .table-condensed > thead > tr > th 
        {
            /* padding: 0 6px; */
            padding: 4px 6px;
            border-radius: 25px;
            font-size: 14px;
        }
        .table-condensed > thead > tr > th.dow {
            font-size: 12px;
        }
        .table-condensed > tfoot > tr > td, 
        .table-condensed > tfoot > tr > th {
            padding: 0px 122px;
            font-weight: normal;
            text-transform: uppercase;
            font-size: 11px;
        }
        .datepicker-months table thead td, .datepicker-months table thead th, .datepicker-years table thead td, .datepicker-years table thead th, .datepicker-decades table thead td, .datepicker-decades table thead th, .datepicker-centuries table thead td, .datepicker-centuries table thead th {
            border-radius: 0;
        }
        .datepicker td, .datepicker th  {
            border-radius: 25px;
            width: 40px;
            height: 40px;
        }
        .datepicker-days table thead, .datepicker-months table thead, .datepicker-years table thead, .datepicker-decades table thead, .datepicker-centuries table thead {
            background: #3546b3;
            color: #ffffff;
            border-radius: 0;
        }
        .datepicker table tr td.active, .datepicker table tr td.active:hover, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover {
            background-image: none;
        }
        .datepicker .prev, .datepicker .next {
            color: rgba(255, 255, 255, 0.5);
            transition: 0.3s;
            width: 37px;
            height: 37px;
        }
        .datepicker .prev:hover, .datepicker .next:hover {
            background: transparent;
            color: rgba(255, 255, 255, 0.99);
        }
        .datepicker .datepicker-switch {
            font-size: 1rem;
            font-weight: bold;
            transition: 0.3s;
        }
        .datepicker .datepicker-switch:hover {
            color: rgba(255, 255, 255, 0.7);
            background: transparent;
        }
        .datepicker table tr td span {
            border-radius: 0.25rem;
            margin: 3%;
            width: 27%;
        }
        .datepicker table tr td span.active, .datepicker table tr td span.active:hover, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover {
            background-color: #3546b3;
            background-image: none;
        }
        .dropdown-menu {
            border: 1px solid rgba(0,0,0,.1);
            box-shadow: 0 6px 12px rgba(0,0,0,.175);
        }
        .datepicker-dropdown.datepicker-orient-top:before {
            border-top: 7px solid rgba(0,0,0,.1);
        }
    </style>
    @stack('css')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer data-turbolinks-track="reload"></script>
    <livewire:scripts />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Livewire App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contacts*') ? 'active' : '' }}" href="/contacts">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}" href="/posts">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="/categories">Categories</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    @if (auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"
                                onclick="document.querySelector('#form-logout').submit()">Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <form action="{{ route('logout') }}" method="post" class="display-none" id="form-logout">
        @csrf
    </form>
    
    @yield('content')
    
    <script>
        $(window).on('hide-flash-session', () => {
            setTimeout(() => {
                if ($('.alert') != null) {
                    if ($('.alert').hasClass('flash-message')) {
                        $('.alert').removeClass('show');

                        setTimeout(() => {
                            $('.alert').remove();
                        }, 300);
                    }
                }
            }, 2000);
        });
    </script>

    @stack('js')
</body>
</html>
