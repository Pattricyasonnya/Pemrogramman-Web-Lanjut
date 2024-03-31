@extends('adminlte::page') 
 
@section('title', 'Dashboard') 
 
@section('content_header') 
    <h1>Dashboard</h1> 
@stop 
 
@section('content') 
 
    <div class="card-body"> 
        <form>
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Level Id</label>
                <input type="text" class="form-control" placeholder="Id">
                <label>Kode Level</label>
                <input type="text" class="form-control" placeholder="Kode level">
                <label>Nama Level</label>
                <input type="text" class="form-control" placeholder="Nama level">
                <div>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <form>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <h2>Form User</h2>
                <label>User ID</label>
                <input type="text" class="form-control" placeholder="Masukkan ID">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Masukkan username">
                <div>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        </div>
@stop 
 
@section('css') 
    {{-- Add here extra stylesheets --}} 
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}} 
@stop 
 
@section('js') 
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script> 
@stop 