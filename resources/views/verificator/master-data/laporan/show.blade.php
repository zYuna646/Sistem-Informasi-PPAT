@extends('notaris.layouts.app')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('notaris.dashboard') }}" class="text-muted">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('notaris.' . $active) }}" class="text-muted">{{ $title ?? '' }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="card">
  <form action="{{ route('verificator.laporan.verifikasi', $data->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
      <h5 class="mb-3">{{ $subtitle }} Form</h5>
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <label class="control-label mb-1">Nomor akta</label>
            <input disabled type="text" name="akta_no" class="form-control @error('akta_no') is-invalid @enderror"
              placeholder="..."
              value="{{ old('akta_no', isset(json_decode($data->akta)->no) ? json_decode($data->akta)->no : '') }}" />
            @error('akta_no')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal Akta</label>
            <input disabled type="date" name="akta_tanggal"
              class="form-control @error('akta_tanggal') is-invalid @enderror" placeholder="..."
              value="{{ old('akta_tanggal', isset(json_decode($data->akta)->tanggal_akta) ? json_decode($data->akta)->tanggal_akta : '') }}" />
            @error('akta_tanggal')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Bentuk Perbuatan Hukum</label>
            <input disabled type="text" name="bentuk_perbuatan_hukum"
              class="form-control @error('bentuk_perbuatan_hukum') is-invalid @enderror" placeholder="..."
              value="{{ old('bentuk_perbuatan_hukum', $data->bentuk_perbuatan_hukum) }}" />
            @error('bentuk_perbuatan_hukum')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Pihak yang menerima</label>
            <input disabled type="text" name="npwp_pihak_menerima"
              class="form-control @error('npwp_pihak_menerima') is-invalid @enderror" placeholder="..."
              value="{{ old('npwp_pihak_menerima', isset(json_decode($data->npwp)->pihak_menerima) ? json_decode($data->npwp)->pihak_menerima : '') }}" />
            @error('npwp_pihak_menerima')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Pihak yang memberikan</label>
            <input disabled type="text" name="npwp_pihak_memberikan"
              class="form-control @error('npwp_pihak_memberikan') is-invalid @enderror" placeholder="..."
              value="{{ old('npwp_pihak_memberikan', isset(json_decode($data->npwp)->pihak_memberikan) ? json_decode($data->npwp)->pihak_memberikan : '') }}" />
            @error('npwp_pihak_memberikan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Jenis dan Nomor Hak</label>
            <input disabled type="text" name="jenis_nomor"
              class="form-control @error('jenis_nomor') is-invalid @enderror" placeholder="..."
              value="{{ old('jenis_nomor', $data->jenis_nomor) }}" />
            @error('jenis_nomor')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Letak Tanah dan Bangunan</label>
            <input disabled type="text" name="letak_tanah"
              class="form-control @error('letak_tanah') is-invalid @enderror" placeholder="..."
              value="{{ old('letak_tanah', $data->letak_tanah) }}" />
            @error('letak_tanah')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Luas Tanah</label>
            <input disabled type="text" name="luas_tanah" class="form-control @error('luas_tanah') is-invalid @enderror"
              placeholder="..."
              value="{{ old('luas_tanah', isset(json_decode($data->luas)->luas_tanah) ? json_decode($data->luas)->luas_tanah : '') }}" />
            @error('luas_tanah')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Luas Bangunan</label>
            <input disabled type="text" name="luas_bangunan"
              class="form-control @error('luas_bangunan') is-invalid @enderror" placeholder="..."
              value="{{ old('luas_bangunan', isset(json_decode($data->luas)->luas_bangunan) ? json_decode($data->luas)->luas_bangunan : '') }}" />
            @error('luas_bangunan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="control-label mb-1">Harga Transaksi</label>
            <input disabled type="text" name="harga_transaksi"
              class="form-control @error('harga_transaksi') is-invalid @enderror" placeholder="..."
              value="{{ old('harga_transaksi', $data->harga_transaksi) }}" />
            @error('harga_transaksi')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">NJOP</label>
            <input disabled type="text" name="sppt_njop" class="form-control @error('sppt_njop') is-invalid @enderror"
              placeholder="..."
              value="{{ old('sppt_njop', isset(json_decode($data->sppt)->njop) ? json_decode($data->sppt)->njop : '') }}" />
            @error('sppt_njop')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">NOP Tahun</label>
            <input disabled type="text" name="sppt_nop_tahun"
              class="form-control @error('sppt_nop_tahun') is-invalid @enderror" placeholder="..."
              value="{{ old('sppt_nop_tahun', isset(json_decode($data->sppt)->nop_tahun) ? json_decode($data->sppt)->nop_tahun : '') }}" />
            @error('sppt_nop_tahun')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Harga SSP</label>
            <input disabled type="text" name="ssp_harga_ssp"
              class="form-control @error('ssp_harga_ssp') is-invalid @enderror" placeholder="..."
              value="{{ old('ssp_harga_ssp', isset(json_decode($data->ssp)->harga_ssp) ? json_decode($data->ssp)->harga_ssp : '') }}" />
            @error('ssp_harga_ssp')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal SSP</label>
            <input disabled type="date" name="ssp_tanggal_ssp"
              class="form-control @error('ssp_tanggal_ssp') is-invalid @enderror" placeholder="..."
              value="{{ old('ssp_tanggal_ssp', isset(json_decode($data->ssp)->tanggal_ssp) ? json_decode($data->ssp)->tanggal_ssp : '') }}" />
            @error('ssp_tanggal_ssp')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Harga SSB</label>
            <input disabled type="text" name="ssb_harga_ssb"
              class="form-control @error('ssb_harga_ssb') is-invalid @enderror" placeholder="..."
              value="{{ old('ssb_harga_ssb', isset(json_decode($data->ssb)->harga_ssb) ? json_decode($data->ssb)->harga_ssb : '') }}" />
            @error('ssb_harga_ssb')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal SSB</label>
            <input disabled type="date" name="ssb_tanggal_ssb"
              class="form-control @error('ssb_tanggal_ssb') is-invalid @enderror" placeholder="..."
              value="{{ old('ssb_tanggal_ssb', isset(json_decode($data->ssb)->tanggal_ssb) ? json_decode($data->ssb)->tanggal_ssb : '') }}" />
            @error('ssb_tanggal_ssb')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Keterangan</label>
            <input disabled type="text" name="ket" class="form-control @error('ket') is-invalid @enderror"
              placeholder="..." value="{{ old('ket', $data->ket) }}" />
            @error('ket')
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
            Verifikasi
          </div>
        </button>
      </div>
    </div>
  </form>
  <form action="{{ route('verificator.laporan.tolak', $data->id) }}" method="post" style="display: inline;" class="px-4 pb-4">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
      Tolak
    </button>
  </form>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#priceInput').on('input', function() {
        // Get the input value and remove non-numeric characters
        let inputValue = $(this).val().replace(/\D/g, '');

        // Add commas to format the number
        inputValue = addCommas(inputValue);

        // Update the input field with the formatted value
        $(this).val(inputValue);
    });

    // Function to add commas to format the number
    function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
  });
</script>
@endpush