@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Level')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Level')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Manage Level</div>
            <div class="card-header">
                <a href="/level/create_level/">
                <button class="btn btn-primary" href="">Add +
                </button>
                </a>
                </div>
        </div>
        <div class="card-body">
            <h1>Data Level Pengguna</h1>
    <table border='1' cellpadding='2' cellspacing='0'>
        <tr>
            <th>ID</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
            <th>Action</th>
        </tr>
        @foreach ($data as $d)
         <tr>
            <td>{{$d->level_id}}</td>    
            <td>{{$d->level_kode}}</td>  
            <td>{{$d->level_nama}}</td>
            <td><a href="/level/edit/{{$d->level_id}}">Edit</a>
                <a href="/level/delete/{{$d->level_id}}">Delete</a></td>  
        </tr>   
        @endforeach
    </table>     
        </div>
    </div>
</div>
@endsection
