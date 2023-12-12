@extends('layouts.app')

@section('title','Tambah Program Studi')

@section('contents')

  <!-- Main -->
  <main id="main" class="main">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Tambah Program Studi</h5>
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
        <form class="row g-3" action="{{ route('programStudis.store') }}" method="post">
          @csrf

          <div class="col-12">
            <label for="nama_program_studi" class="form-label">Nama Program Studi<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="nama_program_studi" name="nama_program_studi">
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