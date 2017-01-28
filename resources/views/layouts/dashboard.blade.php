<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    {{--<meta content="Webflow" name="generator">--}}
    <link href="/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="/css/webflow.css" rel="stylesheet" type="text/css">
    <link href="/css/support.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic","Varela Round:400","Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]
            }
        });
    </script>
    <script src="/js/modernizr.js" type="text/javascript"></script>
    {{--<link href="https://daks2k3a4ib2z.cloudfront.net/img/favicon.ico" rel="shortcut icon" type="image/x-icon">--}}
    {{--<link href="https://daks2k3a4ib2z.cloudfront.net/img/webclip.png" rel="apple-touch-icon">--}}
</head>
<body class="background">
    <div class="main-row w-row">
        <div class="main-column w-col w-col-2 w-col-stack">
            <div class="nav-row">
                <div class="nav-row-section">
                    <div class="profile-pic">
                        <div class="profile-pic-default"></div>
                    </div>

                    {{--Here should have been a dropdown menu where admin accounts could be easily switched from one to another.
                     But it's not functional yet. I'm still working on it.--}}
                    <div class="w-dropdown" data-delay="0">
                        <div class="select-admin w-dropdown-toggle">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="w-icon-dropdown-toggle"></div>
                        </div>
                        {{--<nav class="w-dropdown-list">--}}
                            {{--@php--}}
                                {{--$usernames = App\User::pluck('name');--}}
                                {{--$filtered = $usernames->filter(function ($value, $key) {--}}
                                    {{--return $value != 'admin';--}}
                                {{--});--}}
                                {{--$usernamesExceptAuthorized = $filtered->all();--}}
                            {{--@endphp--}}
                            {{--@foreach($usernamesExceptAuthorized as $username)--}}
                                {{--<a class="select-admin-link w-dropdown-link" href="#">{{ $username }}</a>--}}
                            {{--@endforeach--}}
                        {{--</nav>--}}
                    </div>
                </div>
                <div>
                    <div class="nav-row-section-title">Main</div>
                    <a class="nav-row-link w-inline-block" href="{{ route('dashboard-home') }}">
                        <div class="icon icon-nav"></div>
                        <div class="nav-row-link-label">Home</div>
                    </a>
                    <a class="nav-row-link w-inline-block" href="{{ route('show-categories') }}">
                        <div class="icon icon-nav"></div>
                        <div class="nav-row-link-label">Questions</div>
                    </a>
                    <a class="nav-row-link w-inline-block" href="{{ route('show-accounts') }}">
                        <div class="icon icon-nav"></div>
                        <div class="nav-row-link-label">Accounts</div>
                    </a>
                    <a class="nav-row-link w-inline-block" href="#">
                        <div class="icon icon-nav"></div>
                        <div class="nav-row-link-label">Logs</div>
                    </a>
                    <a class="nav-row-link w-inline-block" href="{{ route('logout') }}">
                        <div class="icon icon-nav"></div>
                        <div class="nav-row-link-label">Logout</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-column w-col w-col-10 w-col-stack">
            <div class="navbar w-clearfix">
                <div class="nav-text">@yield('title')</div>
            </div>
            {{--Custom Alert--}}
            @if (session('alert'))
                <div class="alert {{ session('status') }}">
                    <div class="icon status">{{ session('icon') }}</div>
                    <div class="alert-message">{{ session('alert') }}</div>
                </div>
            @endif
            {{--Errors--}}
            @if (count($errors))
                @foreach ($errors->all() as $error)
                <div class="alert failure">
                    <div class="icon status"></div>
                    <div class="alert-message">{{ $error }}</div>
                </div>
                @endforeach
            @endif

        @yield('content')

        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
<script src="/js/webflow.js" type="text/javascript"></script>
<!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
