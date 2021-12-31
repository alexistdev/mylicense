<x-adminlte.template-layout :tagSubMenu="$tagSubMenu" :title="$judul">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master Data Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <x:notify-messages />
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Kategori</h3>

                    <div class="card-tools">
                        <a href="{{route('admin.addkategori')}}"><button class="btn btn-sm btn-primary">Tambah</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabelKategori" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <x-adminlte.footer-layout/>
    <x-adminlte.js-layout/>
    <script>
        $(function () {
            $('#tabelKategori').DataTable({
                responsive : true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.kategori') }}",
                columns: [
                    {
                        data: 'index',
                        class: 'text-center',
                        defaultContent: '',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                        }
                    },
                    {data: 'name', class: 'text-left'},
                    {data: 'created_at', class: 'text-left'},
                    {data: 'action', width: '15%',class: 'text-center'},

                ],

            });
        });
    </script>
</x-adminlte.template-layout>
