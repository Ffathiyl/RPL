@extends('layouts.apps')

@section('title','Isi Kuesioner')

@section('contents')

<!-- Main -->
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Kuesioner</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Kuesioner</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form Penilaian</h5>
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

      <!-- Table Form -->
      <form class="table-form" action="{{ route('penguruses.store', $penguruses->Nim) }}" method="post">
        @csrf

        <table class="table">
          <thead>
            <tr>
              <th></th>
              <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<th>' . $i . '</th>';
                }
                ?>
            </tr>
          </thead>
          <tbody>
            <tr>
              @php
              $logged_in = session('logged_in');
              @endphp
              <input type="hidden" name="penilai_id" value="{{ $logged_in->Nim }}">
            </tr>
            <tr>
              <td><label for="Integritas">Integritas<span style="color: red;">*</span></label></td>
              <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Integritas" value="' . $i . '"></td>';
                }
                ?>
            </tr>
            <tr>
              <td><label for="Handal">Handal<span style="color: red;">*</span></label></td>
              <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Handal" value="' . $i . '"></td>';
                }
                ?>
            </tr>
            <tr>
              <td><label for="Tangguh">Tangguh<span style="color: red;">*</span></label></td>
              <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Tangguh" value="' . $i . '"></td>';
                }
                ?>
            </tr>
            <tr>
              <td><label for="Kolaborasi">Kolaborasi<span style="color: red;">*</span></label></td>
              <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Kolaborasi" value="' . $i . '"></td>';
                }
                ?>
            </tr>
            <tr>
              <td><label for="Inovasi">Inovasi<span style="color: red;">*</span></label></td>
              <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Inovasi" value="' . $i . '"></td>';
                }
                ?>
            </tr>
            <tr>
              <td><label for="kritikSaran">Kritik & Saran<span style="color: red;">*</span></label></td>
              <td colspan="10"><textarea id="kritikSaran" name="kritikSaran" rows="4" cols="69"></textarea></td>
            </tr>
            <tr>
              <input type="text" class="form-control" id="pengurus_id" name="pengurus_id"
                value="{{ old('pengurus_id', $penguruses->Nim) }}" hidden>
            </tr>
          </tbody>
        </table>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- Table Form -->
    </div>
  </div>
</main>

<!-- End - Main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

@endsection