@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline card-primary"> 
      <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
        <div class="card-tools"> 
          <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a> 
        </div> 
      </div> 
      <div class="card-body"> 
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        @if(auth()->user()->level->level_nama != 'Member')

        <div class="row">
          <label class="col-1 control-label col-form-label">Filter:</label>
          <div class="col-3">
            <select class="form-control" id="penjualan_id" name="penjualan_id" required>
              <option value="">- Semua -</option>
              @foreach ($penjualan as $item)
              <option value="{{$item->penjualan_id}}">{{$item->penjualan_kode}}</option>
              @endforeach
            </select>
            <small class="form-text text-muted">Penjualan Kode</small>
          </div>
        </div>
        @endif
        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan"> 
          <thead> 
            <tr>
              <th>ID</th>
              <th>Penjualan Kode</th>
              <th>User</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr> 
          </thead> 
      </table> 
    </div> 
  </div> 
@endsection 
 
@push('css') 
@endpush 
@push('js') 
  <script> 
    $(document).ready(function() { 
      var dataPenjualan = $('#table_penjualan').DataTable({ 
          serverSide: true,     // serverSide: true, jika ingin menggunakan server side processing 
          ajax: { 
              "url": "{{ url('penjualan/list') }}", 
              "dataType": "json", 
              "type": "POST",
              "data":function(d){
                d.penjualan_id = $('#penjualan_id').val();
              }
          }, 
          columns: [ 
            { 
             data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()            
              className: "text-center", 
              orderable: false, 
              searchable: false     
            },{ 
              data: "penjualan_kode",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "user.nama",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "penjualan_tanggal",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },
            { 
              data: "aksi",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari 
            } 
          ] 
      }); 
      $('#penjualan_id').on('change', function(){
        dataPenjualan.ajax.reload();
      });
    }); 
  </script> 
@endpush 