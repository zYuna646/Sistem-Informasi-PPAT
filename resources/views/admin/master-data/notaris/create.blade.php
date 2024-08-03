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
          <a href="{{ route('admin.category') }}" class="text-muted">{{ $title ?? '' }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="card">
  <form action="{{ route('admin.notaris.store') }}" method="post">
    @csrf
    <div class="card-body">
      <h5 class="mb-3">{{ $subtitle }} Form</h5>
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <label class="control-label mb-1">Nama lengkap</label>
            <input type="text" name="notaris_name" class="form-control @error('notaris_name') is-invalid @enderror"
              placeholder="..." value="{{ old('notaris_name') }}" />
            @error('notaris_name')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Nomor ijin</label>
            <input type="text" name="notaris_no_ijin"
              class="form-control @error('notaris_no_ijin') is-invalid @enderror" placeholder="..."
              value="{{ old('notaris_no_ijin') }}" />
            @error('notaris_no_ijin')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Alamat</label>
            <textarea type="text" name="notaris_alamat"
              class="form-control @error('notaris_alamat') is-invalid @enderror" placeholder="..."
              value="{{ old('notaris_alamat') }}"></textarea>
            @error('notaris_alamat')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">No Telp</label>
            <input type="text" name="notaris_no_telp"
              class="form-control @error('notaris_no_telp') is-invalid @enderror" placeholder="..."
              value="{{ old('notaris_no_telp') }}" />
            @error('notaris_no_telp')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Email</label>
            <input type="email" name="notaris_email" class="form-control @error('notaris_email') is-invalid @enderror"
              placeholder="..." value="{{ old('notaris_email') }}" />
            @error('notaris_email')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Password</label>
            <input type="password" name="notaris_password"
              class="form-control @error('notaris_password') is-invalid @enderror" placeholder="..."
              value="{{ old('notaris_password') }}" />
            @error('notaris_password')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Jabatan</label>
            <select type="text" name="notaris_jabatan"
              class="form-control @error('notaris_jabatan') is-invalid @enderror" placeholder="..."
              value="{{ old('notaris_jabatan') }}"></select>
            @error('notaris_jabatan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Wilayah Kerja</label>
            <input type="text" name="notaris_wilayah"
              class="form-control @error('notaris_wilayah') is-invalid @enderror" placeholder="..."
              value="{{ old('notaris_wilayah') }}" />
            @error('notaris_wilayah')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal Izin Diterbitkan</label>
            <input type="date" name="notaris_ijin_terbit"
              class="form-control @error('notaris_ijin_terbit') is-invalid @enderror" placeholder="..."
              value="{{ old('notaris_ijin_terbit') }}" />
            @error('notaris_ijin_terbit')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="form-actions">
      <div class="card-body border-top">
        <button type="submit" class="btn btn-success rounded-pill px-4">
          <div class="d-flex align-items-center">
            <i class="ti ti-device-floppy me-1 fs-4"></i>
            Save
          </div>
        </button>
        <button type="reset" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
          Cancel
        </button>
      </div>
    </div>
  </form>
</div>
@endsection