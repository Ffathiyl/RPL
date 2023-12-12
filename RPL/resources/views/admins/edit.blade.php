@extends('layouts.app')

@section('title','Edit Admin')

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
            <form class="row g-3" action="{{ route('admins.update', $admin->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="col-12">
                    <label for="ID" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $admin->id) }}"
                        readonly>
                </div>

                <div class="col-12">
                    <label for="Nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="Nama" name="Nama"
                        value="{{ old('Nama', $admin->Nama) }}">
                </div>

                <div class="col-12">
                    <label for="Jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="Jabatan" name="Jabatan"
                        value="{{ old('Jabatan', $admin->Jabatan) }}">
                </div>

                <div class="col-12">
                    <label for="Nohp" class="form-label">No Hp</label>
                    <input type="text" class="form-control" id="Nohp" name="Nohp"
                        value="{{ old('Nohp', $admin->Nohp) }}">
                </div>

                <div class="col-12">
                    <label for="Kelamin" class="form-label">Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Kelamin" id="laki" value="Laki - Laki" {{
                            old('Kelamin', $admin->Kelamin) === 'Laki - Laki' ? 'checked' : '' }}>
                        <label class="form-check-label" for="laki">Laki - Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Kelamin" id="perempuan" value="Perempuan" {{
                            old('Kelamin', $admin->Kelamin) === 'Perempuan' ? 'checked' : '' }}>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>

                <div class="col-12">
                    <label for="Username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="Username" name="Username"
                        value="{{ old('Username', $admin->Username) }}">
                </div>

                <div class="col-12">
                    <label for="Password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="Password" name="Password"
                            value="{{ old('Password', $admin->Password) }}">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="col-12">
                    <input type="hidden" class="form-control" id="Status" value="1" name="Status">
                </div>

                <div class="col-12">
                    <div class="text-end d-flex justify-content-between">
                        <a href="{{ route('admins.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
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