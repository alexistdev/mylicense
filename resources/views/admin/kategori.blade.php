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
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Nama Kategori</th>
                            <th scope="col" class="text-center">Dibuat</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

        <!-- START: MODAL HAPUS -->
        <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    </div>
                    <form action="{{route('admin.deletekategori')}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="">
                            Apakah anda ingin menghapus data ini ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END: MODAL HAPUS -->
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
                    {data: 'created_at', class: 'text-center',width: '15%'},
                    {data: 'action', width: '15%',class: 'text-center'},

                ],

            });
        });
        $(document).on("click", ".open-hapus", function () {
            let fid = $(this).data('id');
            $('#id').val(fid);
        });
    </script>
</x-adminlte.template-layout>
