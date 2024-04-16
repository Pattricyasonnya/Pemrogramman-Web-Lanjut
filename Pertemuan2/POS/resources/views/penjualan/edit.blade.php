@extends('layout.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools"></div>
  </div>
  <div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Ops!</strong> Error <br><br>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    @empty($penjualan)
    <div class="alert alert-danger alert-dismissible">
      <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
      Data yang Anda cari tidak ditemukan.
    </div>
    <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    @else
    <form method="POST" action="{{ url('/penjualan/'.$penjualan->penjualan_id) }}" class="form-horizontal">
      @csrf
      @method('PUT')
      <div class="form-group row">
        <label class="col-1 control-label col-form-label">Barang</label>
        <div class="col-11">
          <select class="form-control" id="barang_id" name="barang_id" required>
            <option value="">- Pilih Barang -</option>
            @foreach($barang as $item)
            <option value="{{ $item->barang_id }}" @if($item->barang_id == $penjualan->barang_id) selected 
              @endif>{{ $item->barang_nama }}</option>
            @endforeach
          </select>
          @error('barang_id')
          <small class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <label class="col-1 control-label col-form-label">Kode Penjualan</label>
        <div class="col-11">
          <select class="form-control" id="penjualan_id" name="penjualan_id" required>
            <option value="">- Pilih Kode -</option>
            @foreach($penjualan as $item)
              <option value="{{ $item->penjualan_id }}" 
            @if($item->penjualan_id == $penjualan->penjualan_id) 
                selected 
            @endif
              >{{ $item->penjualan_kode }}</option>
            @endforeach
          </select>
          @error('penjualan_id')
          <small class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <label class="col-1 control-label col-form-label">Tanggal</label>
        <div class="col-11">
          <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
            value="{{ old('penjualan_tanggal', date('Y-m-d', strtotime($penjualan->penjualan_tanggal))) }}">
          @error('penjualan_tanggal')
          <small class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <label class="col-1 control-label col-form-label">Pembeli</label>
        <div class="col-11">
          <input type="number" min="0" class="form-control" id="pembeli" name="pembeli"
            value="{{ old('pembeli', $penjualan->pembeli) }}" required>
          @error('pembeli')
          <small class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <label class="col-1 control-label col-form-label">Jumlah</label>
        <div class="col-11">
          <input type="number" min="0" class="form-control" id="jumlah" name="jumlah"
            value="{{ old('jumlah', $penjualan->jumlah) }}" required>
          @error('jumlah')
          <small class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label class="col-1 control-label col-form-label"></label>
        <div class="col-11">
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
          <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') 
      }}">Kembali</a>
        </div>
      </div>
    </form>
    @endempty
  </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush