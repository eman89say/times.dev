<!DOCTYPE html>
<html lang="en">

<head>
    @include('website.includes.header')
  
</head>

<body class="landing-page sidebar-collapse">
   @include('website.includes.nav')
    <!-- End Navbar -->
    <div class="wrapper">
               @include('website.includes.subpage-header')

        <div class="section section-team text-center">
            <div class="container">
               <div class="row">
                   <div class="col-md-8">
                       @yield('content')

                   </div>
                   <div class="col-md-4">
                            @include('website.includes.sidebar')
                   </div>
               </div>
                
            </div>
        </div>
        
        @include('website.includes.footer')
    </div>
</body>
     
     @include('website.includes.javascript')

</html>

