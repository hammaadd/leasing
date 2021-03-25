<!DOCTYPE html>
<html lang="en">
    @include('inc.header')
<body>
    <div id="app">
        @include('inc.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>@yield('heading')</h3>
            </div>
            <div class="page-content">
                @yield('content')
            </div>
            @include('inc.footer')
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>

        @include('inc.scripts')
        @yield('scriptCode')
        @include('inc.toastify')
</body>
</html>
