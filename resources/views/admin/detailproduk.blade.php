<x-adminlte.template-layout :tagSubMenu="$tagSubMenu" :title="$judul">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fitur Produk <span class="text-danger font-weight-bold">{{$produkName}}</span></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.produk')}}">Produk</a></li>
                            <li class="breadcrumb-item active">Fitur Produk</li>
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
                    <h3 class="card-title">Daftar Fitur Produk</h3>

                    <div class="card-tools">
                        <a href="#"><button class="open-tambah btn btn-sm btn-primary" data-id="{{$id}}" data-toggle="modal" data-target="#modalTambah">Tambah</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabelDetail" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Fitur Produk</th>
                            <th scope="col" class="text-center">Dibuat</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <a href="{{route('admin.produk')}}"><button class="btn btn-sm btn-danger mt-5">Kembali</button></a>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

        <!-- START: MODAL Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    </div>
                    <form action="{{route('admin.savedetailproduk')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group">
                                <label for="fitur">Nama Fitur</label>
                                <input type="text" class="form-control @if($errors->tambah->has('fitur')) is-invalid @endif" id="fitur" name="fitur" placeholder="Masukkan Nama Fitur">
                                @if($errors->tambah->has('fitur'))
                                <div class="text-sm text-danger">{{$errors->tambah->first('fitur')}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END: MODAL Tambah -->

        <!-- START: MODAL Edit -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    </div>
                    <form action="{{route('admin.updatedetailproduk')}}" method="post">
                        @csrf
                        @method('patch')
                        <div class="modal-body">
                            <input type="hidden" name="rid" id="rid" value="">
                            <input type="hidden" name="prid" id="prid" value="">
                            <div class="form-group">
                                <label for="fitur">Nama Fitur</label>
                                <input type="text" class="form-control @if($errors->edit->has('fitur')) is-invalid @endif"  name="fitur" placeholder="Masukkan Nama Fitur">
                                @if($errors->edit->has('fitur'))
                                    <div class="text-sm text-danger">{{$errors->edit->first('fitur')}}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END: MODAL Edit -->

        <!-- START: MODAL Hapus -->
        <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    </div>
                    <form action="{{route('admin.deletedetailproduk')}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input type="hidden" id="dlid" name="dlid"/>
                            <input type="hidden" id="prodid" name="prodid"/>
                            Apakah anda ingin menghapus data ini ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" >Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END: MODAL Hapus -->
    </div>
    <x-adminlte.footer-layout/>
    <x-adminlte.js-layout/>
    @if($errors->hasbag('tambah'))
        <script>
            $('#modalTambah').modal({
                show: true
            });
        </script>
    @endif
    @if($errors->hasbag('edit'))
        <script>
            $('#modalEdit').modal({
                show: true
            });
        </script>
    @endif
    <script>
        $(function () {

            $('#tabelDetail').DataTable({
                responsive : true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.detailproduk',$id) }}",
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
        $(document).on("click", ".open-tambah", function () {
            let fid = $(this).data('id');
            $('#id').val(fid);
        });
        $(document).on("click", ".open-hapus", function () {
            let fid = $(this).data('id');
            let fprid = $(this).data('prid');
            $('#dlid').val(fid);
            $('#prodid').val(fprid);
        });
        $(document).on("click", ".open-edit", function () {
            let fid = $(this).data('id');
            let fname = $(this).data('name');
            let fprid = $(this).data('prid');
            $('#rid').val(fid);
            $('#prid').val(fprid);
            $("input[name=fitur]").val(fname);
        });
    </script>
</x-adminlte.template-layout>
