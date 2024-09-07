@extends('admin.layouts.app')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('admin.' . $active) }}" class="text-muted">{{ $title ?? '' }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="card">
  <form action="{{ route('admin.laporan_perorangan.update', ['id' => $laporan->id, 'idPerorangan' => $data->id]) }}"
    method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
      <h5 class="mb-3">{{ $subtitle }} Form</h5>
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <label class="control-label mb-1">Nomor akta</label>
            <input type="text" name="akta_no" class="form-control @error('akta_no') is-invalid @enderror"
              placeholder="..." readonly
              value="{{ old('akta_no', isset(json_decode($data->akta)->no) ? json_decode($data->akta)->no : '') }}" />
            @error('akta_no')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal Akta</label>
            <input type="date" name="akta_tanggal" class="form-control @error('akta_tanggal') is-invalid @enderror"
              placeholder="..." readonly
              value="{{ old('akta_tanggal', isset(json_decode($data->akta)->tanggal_akta) ? json_decode($data->akta)->tanggal_akta : '') }}" />
            @error('akta_tanggal')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Bentuk Perbuatan Hukum</label>
            <input type="text" name="bentuk_perbuatan_hukum"
              class="form-control @error('bentuk_perbuatan_hukum') is-invalid @enderror" placeholder="..." readonly
              value="{{ old('bentuk_perbuatan_hukum', $data->bentuk_perbuatan_hukum) }}" />
            @error('bentuk_perbuatan_hukum')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Pihak yang menerima</label>
            <input type="text" name="nama_pihak_menerima"
              class="form-control @error('nama_pihak_menerima') is-invalid @enderror" placeholder="..." readonly
              value="{{ old('nama_pihak_menerima', isset(json_decode($data->npwp)->nama_pihak_menerima) ? json_decode($data->npwp)->nama_pihak_menerima : '') }}" />
            @error('nama_pihak_menerima')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">NIK pihak yang menerima</label>
            <input type="text" name="nik_pihak_menerima"
              class="form-control @error('nik_pihak_menerima') is-invalid @enderror" placeholder="..." readonly
              value="{{ old('nik_pihak_menerima', isset(json_decode($data->npwp)->nik_pihak_menerima) ? json_decode($data->npwp)->nik_pihak_menerima : '') }}" />
            @error('nik_pihak_menerima')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Alamat pihak yang menerima</label>
            <input name="alamat_pihak_menerima"
              class="form-control @error('alamat_pihak_menerima') is-invalid @enderror" placeholder="..." readonly
              value="{{ old('alamat_pihak_menerima', isset(json_decode($data->npwp)->alamat_pihak_menerima) ? json_decode($data->npwp)->alamat_pihak_menerima : '') }}" />
            @error('alamat_pihak_menerima')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Pihak yang memberikan</label>
            <input type="text" name="nama_pihak_memberikan"
              class="form-control @error('nama_pihak_memberikan') is-invalid @enderror" placeholder="..." readonly
              value="{{ old('nama_pihak_memberikan', isset(json_decode($data->npwp)->nama_pihak_memberikan) ? json_decode($data->npwp)->nama_pihak_memberikan : '') }}" />
            @error('nama_pihak_memberikan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">NIK pihak yang memberikan</label>
            <input type="text" name="nik_pihak_memberikan"
              class="form-control @error('nik_pihak_memberikan') is-invalid @enderror" placeholder="..." readonly
              value="{{ old('nik_pihak_memberikan', isset(json_decode($data->npwp)->nik_pihak_memberikan) ? json_decode($data->npwp)->nik_pihak_memberikan : '') }}" />
            @error('nik_pihak_memberikan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Alamat pihak yang memberikan</label>
            <input name="alamat_pihak_memberikan"
              class="form-control @error('alamat_pihak_memberikan') is-invalid @enderror" placeholder="..." readonly
              value="{{ old('alamat_pihak_memberikan', isset(json_decode($data->npwp)->alamat_pihak_memberikan) ? json_decode($data->npwp)->alamat_pihak_memberikan : '') }}" />
            @error('alamat_pihak_memberikan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>


          <div class="mb-3">
            <label class="control-label mb-1">Jenis dan Nomor Hak</label>
            <input type="text" name="jenis_nomor" class="form-control @error('jenis_nomor') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('jenis_nomor', $data->jenis_nomor) }}" />
            @error('jenis_nomor')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Letak Tanah dan Bangunan</label>
            <input type="text" name="letak_tanah" class="form-control @error('letak_tanah') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('letak_tanah', $data->letak_tanah) }}" />
            @error('letak_tanah')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Luas Tanah</label>
            <input type="text" name="luas_tanah" class="form-control @error('luas_tanah') is-invalid @enderror"
              placeholder="..." readonly
              value="{{ old('luas_tanah', isset(json_decode($data->luas)->luas_tanah) ? json_decode($data->luas)->luas_tanah : '') }}" />
            @error('luas_tanah')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Luas Bangunan</label>
            <input type="text" name="luas_bangunan" class="form-control @error('luas_bangunan') is-invalid @enderror"
              placeholder="..." readonly
              value="{{ old('luas_bangunan', isset(json_decode($data->luas)->luas_bangunan) ? json_decode($data->luas)->luas_bangunan : '') }}" />
            @error('luas_bangunan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Harga Jual / Sewa / Nilai</label>
            <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="..."
              readonly value="{{ old('harga', $data->harga) }}" />
            @error('harga')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Jenis Hak</label>
            <input type="text" name="jenis_hak" class="form-control @error('jenis_hak') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('jenis_hak', $data->jenis_hak) }}" />
            @error('jenis_hak')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Nomor Surat</label>
            <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('nomor_surat', $data->nomor_surat) }}" />
            @error('nomor_surat')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('tanggal_surat', $data->tanggal_surat) }}" />
            @error('tanggal_surat')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Nomor SK</label>
            <input type="text" name="nomor_sk" class="form-control @error('nomor_sk') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('nomor_sk', $data->nomor_sk) }}" />
            @error('nomor_sk')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Tanggal SK</label>
            <input type="date" name="tanggal_sk" class="form-control @error('tanggal_sk') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('tanggal_sk', $data->tanggal_sk) }}" />
            @error('tanggal_sk')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Keterangan</label>
            <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
              placeholder="..." readonly value="{{ old('keterangan', $data->keterangan) }}" />
            @error('keterangan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="text-end">
            <a href="{{ route('notaris.laporan_perorangan', $laporan->id) }}" class="btn btn-secondary">
              Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection