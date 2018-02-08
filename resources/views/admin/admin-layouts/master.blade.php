<!doctype html>
<html lang="en">

<head>
    @include('admin.includes.header')
</head>

<body>
    <div class="wrapper">
        @include('admin.includes.sidebar')

        <div class="main-panel">
            @include('admin.includes.nav')

            <div class="content">
                <div class="container-fluid">
                      @yield('content')
                </div>
            </div>

            
            @include('admin.includes.footer')
        </div>
    </div>

</body>
         @include('admin.includes.javascript')


</html>