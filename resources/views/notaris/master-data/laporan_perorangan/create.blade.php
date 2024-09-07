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
  <form action="{{ route('notaris.laporan_perorangan.store', $laporan->id) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <h5 class="mb-3">{{ $subtitle }} Form</h5>
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <label class="control-label mb-1">Nomor akta</label>
            <input type="text" name="laporan_no_akta"
              class="form-control @error('laporan_no_akta') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_no_akta') }}" />
            @error('laporan_no_akta')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal</label>
            <input type="date" name="laporan_tanggal"
              class="form-control @error('laporan_tanggal') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_tanggal') }}" />
            @error('laporan_tanggal')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Bentuk perbuatan hukum</label>
            <input type="text" name="laporan_bentuk" class="form-control @error('laporan_bentuk') is-invalid @enderror"
              placeholder="..." value="{{ old('laporan_bentuk') }}" />
            @error('laporan_bentuk')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Pihak yang mengalihkan/memberikan</label>
            <input type="text" name="laporan_nama_pihak_memberikan"
              class="form-control @error('laporan_nama_pihak_memberikan') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_nama_pihak_memberikan') }}" />
            @error('laporan_nama_pihak_memberikan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Pihak yang menerima</label>
            <input type="text" name="laporan_nama_pihak_menerima"
              class="form-control @error('laporan_nama_pihak_menerima') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_nama_pihak_menerima') }}" />
            @error('laporan_nama_pihak_menerima')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
      
          <div class="mb-3">
            <label class="control-label mb-1">Jenis dan nomor hak</label>
            <input type="text" name="laporan_jenis_hak"
              class="form-control @error('laporan_jenis_hak') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_jenis_hak') }}" />
            @error('laporan_jenis_hak')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Letak tanah dan bangunan</label>
            <input type="text" name="laporan_letak_tanah"
              class="form-control @error('laporan_letak_tanah') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_letak_tanah') }}" />
            @error('laporan_letak_tanah')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Luas tanah M²</label>
            <input type="text" name="laporan_tanah" class="form-control @error('laporan_tanah') is-invalid @enderror"
              placeholder="..." value="{{ old('laporan_tanah') }}" />
            @error('laporan_tanah')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Luas bangunan M²</label>
            <input type="text" name="laporan_bangunan"
              class="form-control @error('laporan_bangunan') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_bangunan') }}" />
            @error('laporan_bangunan')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Harga transaksi perolehan</label>
            <input type="text" name="laporan_harga" class="form-control @error('laporan_harga') is-invalid @enderror"
              placeholder="..." value="{{ old('laporan_harga') }}" />
            @error('laporan_harga')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">NOP tahun</label>
            <input type="text" name="laporan_nop" class="form-control @error('laporan_nop') is-invalid @enderror"
              placeholder="..." value="{{ old('laporan_nop') }}" />
            @error('laporan_nop')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">NJOP</label>
            <input type="text" name="laporan_njop" class="form-control @error('laporan_njop') is-invalid @enderror"
              placeholder="..." value="{{ old('laporan_njop') }}" />
            @error('laporan_njop')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal SSP</label>
            <input type="date" name="laporan_tanggal_ssp"
              class="form-control @error('laporan_tanggal_ssp') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_tanggal_ssp') }}" />
            @error('laporan_tanggal_ssp')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Harga SSP</label>
            <input type="text" name="laporan_harga_ssp"
              class="form-control @error('laporan_harga_ssp') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_harga_ssp') }}" />
            @error('laporan_harga_ssp')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Tanggal SSB</label>
            <input type="date" name="laporan_tanggal_ssb"
              class="form-control @error('laporan_tanggal_ssb') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_tanggal_ssb') }}" />
            @error('laporan_tanggal_ssb')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Harga SSB</label>
            <input type="text" name="laporan_harga_ssb"
              class="form-control @error('laporan_harga_ssb') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_harga_ssb') }}" />
            @error('laporan_harga_ssb')
            <small class="invalid-feedback">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="mb-3">
            <label class="control-label mb-1">Keterangan</label>
            <input type="text" name="laporan_keterangan"
              class="form-control @error('laporan_keterangan') is-invalid @enderror" placeholder="..."
              value="{{ old('laporan_keterangan') }}" />
            @error('laporan_keterangan')
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