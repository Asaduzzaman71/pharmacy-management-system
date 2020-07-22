<!DOCTYPE html>
<html lang="en">

<head>

    @include('include._head')

</head>

<body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href=""><span>[</span>Feits <i>PMS</i><span>]</span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
        @include('include._leftsidebar')
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->



    <!-- ########## START: HEAD PANEL ########## -->
    @include('include._headpannel')

    <!-- ########## END: HEAD PANEL ########## -->





    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        @yield('content')

        <footer class="br-footer">

            @include('include._footer')

        </footer>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


    <!-- ########## javascript ########## -->
    @include('include._javascript')

    @include('sweetalert::alert')

</body>

</html>
