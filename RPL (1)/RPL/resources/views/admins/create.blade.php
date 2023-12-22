@extends('layouts.app')

@section('title','Tambah Admin')

@section('contents')

  <!-- Main -->
  <main id="main" class="main">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Tambah Admin</h5>
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
        <form class="row g-3" action="{{ route('admins.store') }}" method="post">
          @csrf

          <div class="col-12">
            <label for="Nama" class="form-label">Nama <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="Nama" name="Nama">
          </div>

          <div class="col-12">
            <label for="Jabatan" class="form-label">Jabatan <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="Jabatan" name="Jabatan">
          </div>

          <div class="col-12">
            <label for="Nohp" class="form-label">No Hp <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="Nohp" name="Nohp" oninput="validatePhoneNumber(this)">
          </div>

          <div class="col-12">
            <label for="Kelamin" class="form-label">Kelamin <span style="color: red;">*</span></label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="Kelamin" id="laki" value="1">
              <label class="form-check-label" for="laki">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="Kelamin" id="perempuan" value="0">
              <label class="form-check-label" for="perempuan">Perempuan</label>
            </div>
          </div>

          <div class="col-12">
            <label for="Username" class="form-label">Username <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="Username" name="Username">
          </div>

          <div class="col-12">
            <label for="Password" class="form-label">Password <span style="color: red;">*</span></label>
            <div class="input-group">
              <input type="password" class="form-control" id="Password" name="Password">
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
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

  <script>
    // Lihat password
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordField = document.getElementById('Password');
      const fieldType = passwordField.getAttribute('type');

      if (fieldType === 'password') {
        passwordField.setAttribute('type', 'text');
      } else {
        passwordField.setAttribute('type', 'password');
      }
    });

    function validatePhoneNumber(input) {
      input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
        if (input.value.length > 13) {
        input.value = input.value.slice(0, 13);
      }
    }

    
  </script>


  @endsection