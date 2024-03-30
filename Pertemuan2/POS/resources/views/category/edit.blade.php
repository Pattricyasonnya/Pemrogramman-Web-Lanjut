@extends('layout.app')
{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')    
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')

{{-- Content body::main page content --}}

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Edit kategori</h3>
            </div>  

            <form method="post" action="/kategori/update/{{$data->kategori_id}}">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Kategori</label>
                        <input type="text" class="form-control" id="kodeKategori" name="kategori_kode" placeholder="untuk makanan, contoh: MKN">
                    </div>
                    <div class="form-group">    
                        <label for="namaKategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="namaKategori" name="kategori_nama" placeholder="Nama">       
                    </div>
                </div>

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>   
                </div>
            </form>
            </div>
    </div>
@endsection
