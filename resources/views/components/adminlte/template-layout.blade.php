<div>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <x-adminlte.header-layout :title="$title"/>
            @notifyCss
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
        @notifyJs
        </body>
    </html>
</div>
