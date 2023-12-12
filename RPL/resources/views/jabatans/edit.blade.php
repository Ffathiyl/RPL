@extends('layouts.app')

@section('title','Edit Jabatan')

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
            <form class="row g-3" action="{{ route('jabatans.update', $jabatan->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="col-12">
                    <label for="ID" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $jabatan->id) }}"
                        readonly>
                </div>

                <div class="col-12">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                        value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}">
                </div>

                <div class="col-12">
                    <label for="divisi" class="form-label">Divisi <span style="color: red;">*</span></label>
                    <select name="divisi_id" class="form-control" id="divisi_id">
                        <option value="">-- Divisi --</option>
                        @foreach ($divisis as $divisiID => $nama)
                        @php
                        $selected = '';
                        if ($jabatan->divisi_id === $divisiID) {
                        $selected = 'selected';
                        }
                        @endphp
                        <option value="{{ $divisiID }}" {{ $selected }}>
                            {{ $nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <input type="hidden" class="form-control" id="Status" value="1" name="Status">
                </div>

                <div class="col-12">
                    <div class="text-end d-flex justify-content-between">
                        <a href="{{ route('jabatans.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>


            </form><!-- Vertical Form -->
        </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection