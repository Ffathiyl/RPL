@extends('layouts.app')

@section('title','Edit Pengurus')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Pengurus</h5>
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
            <form class="row g-3" action="{{ route('pengurus.update', $penguruses->Nim) }}" method="POST">
            @method('PUT')
                @csrf
                <div class="col-12">
                    <label for="Nim" class="form-label">Nim <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="Nim" name="Nim" value="{{ old('Nim', $penguruses->Nim) }}" readonly>
                </div>
                <div class="col-12">
                    <label for="Nama" class="form-label">Nama <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="Nama" name="Nama" value="{{ old('Nama', $penguruses->Nama) }}">
                </div>
                <div class="col-12">
                    <label for="Organisasi" class="form-label">Organisasi <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="Organisasi" name="Organisasi" value="{{ old('Id_Organisasi', $penguruses->Id_Organisasi) }}">
                </div>
                <div class="col-12">
                    <label for="Divisi" class="form-label">Divisi <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="Divisi" name="Divisi" value="{{ old('Id_Divisi', $penguruses->Id_Divisi) }}">
                </div>
                <div class="col-12">
                    <label for="Jabatan" class="form-label">Jabatan <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="Jabatan" name="Jabatan" value="{{ old('Id_Jabatan', $penguruses->Id_Jabatan) }}">
                </div>
                <div class="col-12">
                    <label for="Prodi" class="form-label">Prodi <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="Prodi" name="Prodi" value="{{ old('Id_Prodi', $penguruses->Id_Prodi) }}">
                </div>
                <div class="col-12">
                    <label for="Password" class="form-label">Password <span style="color:red">*</span></label>
                    <div class="input-group">
                    <input type="password" class="form-control" id="Password" name="Password"
                        value="{{ old('Password', $penguruses->Password) }}">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </button>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
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
</script>
@endsection