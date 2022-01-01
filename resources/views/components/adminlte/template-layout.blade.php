<div>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <x-adminlte.header-layout :title="$title"/>
            <style> .notify{ z-index: 1000000; margin-top: 5%; } </style>
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
