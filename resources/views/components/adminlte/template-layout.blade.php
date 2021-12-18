<div>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <x-adminlte.header-layout/>
        </head>

        <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
            <div class="wrapper">
                <!-- Navbar -->
                <x-adminlte.navbar-layout/>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <x-adminlte.sidebar-layout/>

                {{$slot}}

            </div>
        <!-- / Site wrapper -->
        </body>
    </html>
</div>
