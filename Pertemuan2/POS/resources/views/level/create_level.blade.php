@extends('layout.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Level')    
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')
{{-- Content body::main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Buat level baru</h3>
            </div>  

            <form method="post" action="/level">
              @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeLevel">Kode level</label>
                        <input type="text" class="form-control" id="kodeLevel" name="kodeLevel" placeholder="Kode Level">
                    </div>
                    <div class="form-group">    
                        <label for="namaLevel">Nama Level</label>
                        <input type="text" class="form-control" id="namaLevel" name="namaLevel" placeholder="Nama">       
                    </div>
                </div>

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>   
                </div>
            </form>

            {{--MENAMBAHKAN ERROR YANG TERJADI --}}
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
            @endif
            </div>
    </div>
@endsection