@extends('layouts.app')

@section('title','Tambah Jabatan')

@section('contents')

  <!-- Main -->
  <main id="main" class="main">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Tambah Jabatan</h5>
        @if ($errors->any())
        <div class="alert alert-danger">
          <div class="alert-title">
            <h4>Whoops!</h4>
          </div>
          There are some problems with your input.
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-success">{{ session('error') }}</div>
        @endif

        <!-- Vertical Form -->
        <form class="row g-3" action="{{ route('jabatans.store') }}" method="post">
          @csrf

          <div class="col-12">
              <label for="organisasi" class="form-label">Organisasi <span style="color: red;">*</span></label>
              <select name="organisasi_id" class="form-control" id="organisasi_id">
                  <option value="">-- Organisasi --</option>
                  @foreach ($Organisasi as $item)
                      <option value="{{ $item['organisasi_id'] }}" @if ($item['organisasi_id'] == $organisasi_id) selected @endif>{{ $item['organisasi_nama'] }}</option>
                  @endforeach
              </select>
          </div>

          <div class="col-12">
    <label for="divisi" class="form-label">Divisi <span style="color: red;">*</span></label>
    @foreach ($divisiOrganisasi as $item)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $item['divisi_id'] }}" name="divisi_ids[]" id="divisi_{{ $item['divisi_id'] }}">
            <label class="form-check-label" for="divisi_{{ $item['divisi_id'] }}">
                {{ $item['divisi_nama'] }}
            </label>
        </div>
    @endforeach
</div>
          
          <div class="col-12">
            <label for="nama_jabatan" class="form-label">Nama Jabatan<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan">
          </div>

          <div class="col-12">
            <input type="hidden" class="form-control" id="Status" value="1" name="Status">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form><!-- Vertical Form -->
      </div>
  </main>
  <!-- End - Main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




      <script>
  $(document).ready(function () {
    // Ketika nilai dropdown Organisasi berubah
    $('#organisasi_id').on('change', function () {
      var organisasiId = $(this).val();
      var url = "{{ route('jabatans.create', ['organisasi_id' => ':organisasiId']) }}";
        url = url.replace(':organisasiId', organisasiId);
        location.href = url;
    });
  });
</script>
     
  @endsection