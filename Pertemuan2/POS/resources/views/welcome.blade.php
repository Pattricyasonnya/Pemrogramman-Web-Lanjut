@extends('layout.template')

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Halo, apakabar!!!</h3>
    <div class="card-tools"></div>
  </div>
  <div class="card-body">
    Selamat datang semua, ini adalah halaman utama dari aplikasi ini.
  </div>
</div>

{{-- menampilkan data siapa yg login di halamandashboard --}}
@if (auth()->user()->level->level_nama!='Member')
<div class="chartWrapper">
  {!! $chart->container() !!}
</div>
<div class="btnWrapper mb-2">
  <a href="{{route('PDF')}}" class="btn btn-danger mr-2">
    Export-PDF
  </a>
  <a href="{{route('EXCEL')}}" class="btn btn-success">
    Export-Excel
  </a>
</div>
<div>
<table class="table table-bordered table-striped table-hover table-sm" id="table_user"> 
  <thead> 
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Nama</th>
      <th>Level Pengguna</th>
      <th>Aksi</th>
    </tr> 
  </thead> 
</table> 
</div>
    
@else
<table class="table table-bordered table-striped table-hover table-sm"> 
  <tr> 
      <th>ID</th> 
      <td>{{ auth()->user()->user_id }}</td> 
  </tr> 
  <tr> 
      <th>Level</th> 
      <td>{{ auth()->user()->level->level_nama }}</td> 
  </tr> 
  <tr> 
      <th>Username</th> 
      <td>{{ auth()->user()->username }}</td> 
  </tr> 
  <tr> 
      <th>Nama</th> 
      <td>{{ auth()->user()->nama }}</td> 
  </tr> 
  <tr> 
      <th>Profil</th>
      <td><img src="{{asset('storage/profil/'.auth()->user()->profil_img)}}" style="max-width: 500px;" alt="Foto"></td>
  </tr> 
</table> 
@endif

</div> 
</div> 
@endsection
 
@push('css') 
@endpush 
@push('js') 
  <script> 
    $(document).ready(function() { 
      var dataUser = $('#table_user').DataTable({ 
          serverSide: true,     // serverSide: true, jika ingin menggunakan server side processing 
          ajax: { 
              "url": "{{ Route('list_member') }}", 
              "dataType": "json", 
              "type": "POST",
              "data":function(d){
                d.level_id = $('#level_id').val();
              }
          }, 
          columns: [ 
            { 
             data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()            
              className: "text-center", 
              orderable: false, 
              searchable: false     
            },{ 
              data: "username",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "nama",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "level.level_nama",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari
            },{ 
              data: "aksi",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari 
            } 
          ] 
      }); 
      $('#level_id').on('change', function(){
        dataUser.ajax.reload();
      });
    }); 
  </script> 
  <script src="{{ $chart->cdn() }}"></script>

  {{ $chart->script() }}
@endpush 