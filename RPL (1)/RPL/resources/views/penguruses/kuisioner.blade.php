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
          <table class="table" border="1">
            <td style="font-size : 16px">Terima kasih telah berpartisipasi dalam kuesioner penilaian ini. Tujuan dari penilaian ini adalah untuk mengukur keterlibatan, kinerja, dan kontribusi Anda sebagai mahasiswa dalam organisasi. Harap berikan penilaian berdasarkan pengalaman dan pandangan pribadi Anda. Gunakan skala penilaian dari 1 hingga 10.
           <br>
           <br>
          Keterangan :
        <br>
        1 menunjukkan kinerja atau kontribusi yang rendah dan 10 menunjukkan kinerja atau kontribusi yang sangat baik.</td>
        </table>

          <table class="table">
            <thead>
              <tr>
                <th></th>
                <?php
                for ($i = 0; $i <= 10; $i++) {
                    echo '<th>' . $i . '</th>';
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><label for="Integritas"><strong>Integritas</strong><span style="color: red;">*</span>
                <br>
                <p style="font-size: 12px;">Integritas merujuk pada kualitas kejujuran, ketulusan, dan konsistensi dalam tindakan dan perilaku seseorang atau suatu organisasi.</p></label></td>
                <?php
                for ($i = 0; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Integritas" value="' . $i . '"></td>';
                }
                ?>

              </tr>
              <tr>
                <td><label for="Handal"><strong>Handal</strong><span style="color: red;">*</span>
                <br>
                <p style="font-size: 12px;">Handal mengacu pada kemampuan atau kualitas seseorang atau suatu sistem untuk memberikan hasil atau kinerja yang konsisten, dapat diandalkan, dan efektif.</p></label></td>
                <?php
                for ($i = 0; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Handal" value="' . $i . '"></td>';
                }
                ?>
              </tr>
              <tr>
                <td><label for="Tangguh"><strong>Tangguh</strong><span style="color: red;">*</span>
              <br>
            <p style="font-size : 12px ">Tangguh merujuk pada kemampuan untuk bertahan atau menghadapi tekanan, tantangan, atau situasi sulit dengan keberanian dan ketahanan.</p></label></td>
                <?php
                for ($i = 0; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Tangguh" value="' . $i . '"></td>';
                }
                ?>
              </tr>
              <tr>
                <td><label for="Kolaborasi"><strong>Kolaborasi</strong><span style="color: red;">*</span>
              <br>
            <p style="font-size : 12px">Kolaborasi mengacu pada kerja sama antara individu, kelompok, atau organisasi untuk mencapai tujuan bersama dengan saling berbagi sumber daya, ide, dan tanggung jawab.</p></label></td>
                <?php
                for ($i = 0; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Kolaborasi" value="' . $i . '"></td>';
                }
                ?>
              </tr>
              <tr>
                <td><label for="Inovasi"><strong>Inovasi</strong><span style="color: red;">*</span>
              <br>
            <p style="font-size : 12px">Inovasi mencakup pengembangan ide, konsep, atau produk baru yang dapat membawa perubahan positif, meningkatkan efisiensi, atau memberikan nilai tambah.</p></label></td>
                <?php
                for ($i = 0; $i <= 10; $i++) {
                    echo '<td><input type="radio" name="Inovasi" value="' . $i . '"></td>';
                }
                ?>
              </tr>
              <tr>
                <td><label for="apresiasi">Apresiasi <span style="color: red;">*</span></label></td>
                <td colspan="10"><textarea id="apresiasi" name="apresiasi" rows="4" cols="69"></textarea></td>
              </tr>
              <tr>
                <td><label for="evaluasi">Evaluasi <span style="color: red;">*</span></label></td>
                <td colspan="10"><textarea id="evaluasi" name="evaluasi" rows="4" cols="69"></textarea></td>
              </tr>
              <tr>
              <input type="text" class="form-control" id="pengurus_id" name="pengurus_id"
                            value="{{ old('pengurus_id', $penguruses->Nim) }}" hidden>
              </tr>
              <tr>
              @php
              $logged_in = session('logged_in');
              @endphp
              <input type="hidden" name="penilai_id" value="{{ $logged_in->Nim }}">
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
