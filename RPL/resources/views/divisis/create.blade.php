@extends('layouts.app')

@section('title','Tambah Divisi')

@section('contents')

<!-- Main -->
<main id="main" class="main">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form Tambah Divisi</h5>
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
      <form class="row g-3" action="{{ route('divisis.store') }}" method="post">
        @csrf

        <div class="col-12">
          <label for="nama_divisi" class="form-label">Nama Divisi<span style="color: red;">*</span></label>
          <input type="text" class="form-control" id="nama_divisi" name="nama_divisi">
        </div>

        <div class="col-12">
          <label for="organisasi" class="form-label">Organisasi <span style="color: red;">*</span></label>
          <select name="organisasi_id" class="form-control" id="organisasi_id">
            <option value="">-- Organisasi --</option>
            @foreach ($organisasis as $organisasiID => $nama)
            <option value="{{ $organisasiID }}" @selected(old('organisasi_id')==$organisasiID)>
              {{ $nama }}
            </option>
            @endforeach
          </select>
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

@endsection