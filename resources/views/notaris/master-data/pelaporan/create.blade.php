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
  <form action="{{ route('notaris.' . $active . '.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <h5 class="mb-3">{{ $subtitle }} Form</h5>
      <div class="row">
        <div class="col-12">
          <div class="mb-3">
            <label class="control-label mb-1">Nomor ijin</label>
            <input type="text" name="pelaporan_nomor_ijin"
              class="form-control @error('pelaporan_nomor_ijin') is-invalid @enderror" placeholder="..."
              value="{{ old('pelaporan_nomor_ijin') }}" />
            @error('pelaporan_nomor_ijin')
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