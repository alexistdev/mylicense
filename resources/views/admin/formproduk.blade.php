<x-adminlte.template-layout :tagSubMenu="$tagSubMenu" :title="$judul">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{($tag != 'add')?'Edit':'Tambah'}} Data Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.produk')}}">Produk</a></li>
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
                    <x:notify-messages />
                    <!-- Default box -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">{{($tag != 'add')?'Form Edit':'Form Tambah'}} Produk</h3>

                        </div>
                        <div class="card-body">
                            @if($tag == 'add')
                                <form action="{{route('admin.saveproduk')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kategori_id">Nama Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id')is-invalid @enderror">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategori as $row)
                                                <option value="{{$row->id}}" {{($row->id == old('kategori_id'))? "SELECTED":""}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="produk">Nama Produk</label>
                                        <input type="text" class="form-control @error('produk') is-invalid @enderror" id="produk" name="produk" placeholder="Masukkan Nama Produk">
                                        @error('produk')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Produk</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="0">
                                        @error('harga')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{route('admin.produk')}}"><button type="button" class="btn btn-sm btn-danger">Batal</button></a>
                                </form>
                            @else
                                <form action="{{route('admin.updateproduk')}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="form-group">
                                        <label for="kategori_id">Nama Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id')is-invalid @enderror">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategori as $row)
                                                <option value="{{$row->id}}" {{($row->id == $kategori_id)? "SELECTED":""}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="produk">Nama Produk</label>
                                        <input type="text" class="form-control @error('produk') is-invalid @enderror" id="produk" name="produk" value="{{$produkname}}" placeholder="Masukkan Nama Produk">
                                        @error('produk')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Produk</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{$price}}" placeholder="0">
                                        @error('harga')
                                        <div class="text-sm text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="{{route('admin.produk')}}"><button type="button" class="btn btn-sm btn-danger">Batal</button></a>
                                </form>
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
