@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'User')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Manage User</div>
            <div class="card-header">
                <a href="/user/create_user/">
                <button class="btn btn-primary" href="">Add +
                </button>
                </a>
                </div>
        </div>
        <div class="card-body">
            <h1>Data Pengguna</h1>
    <table border='1' cellpadding='2' cellspacing='0'>
        <tr>
            <th>ID</th>
            <th>Usernama</th>
            <th>Nama Level</th>
            <th>Action</th>
        </tr>
        @foreach ($data as $d)
         <tr>
            <td>{{$d->user_id}}</td>    
            <td>{{$d->username}}</td>  
            <td>{{$d->level->level_nama}}</td>
            <td><a href="/user/edit/{{$d->user_id}}">Edit</a>
                <a href="/user/delete/{{$d->user_id}}">Delete</a></td>  
        </tr>   
        @endforeach
    </table>     
        </div>
    </div>
</div>
@endsection
