<x-adminlte.template-layout :tagSubMenu="$tagSubMenu" :title="$judul">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{($tag != 'add')?'Edit':'Tambah'}} Data Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.kategori')}}">Kategori</a></li>
                            <li class="breadcrumb-item active">{{($tag != 'add')?'Edit':'Add'}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Default box -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">{{($tag != 'add')?'Form Edit':'Form Tambah'}} Kategori</h3>
                        </div>
                        <div class="card-body">
                            @if($tag == 'add')
                                <form action="{{route('admin.savekategori')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kategori">Nama Kategori</label>
                                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan Nama Kategori">
                                        @error('kategori')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{route('admin.kategori')}}"><button type="button" class="btn btn-sm btn-danger">Batal</button></a>
                                </form>
                            @else

                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <x-adminlte.footer-layout/>
    <x-adminlte.js-layout/>

</x-adminlte.template-layout>
