<div>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <x-adminlte.header-layout :title="$title"/>
        </head>

        <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
            <div class="wrapper">
                <!-- Navbar -->
                <x-adminlte.navbar-layout/>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <x-adminlte.sidebar-layout :tagSubMenu="$tagSubMenu"/>

                {{$slot}}

            </div>
        <!-- / Site wrapper -->
        </body>
    </html>
</div>
