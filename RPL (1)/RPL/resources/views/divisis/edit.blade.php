@extends('layouts.app')

@section('title','Edit Divisi')

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
            <form class="row g-3" action="{{ route('divisis.update', $divisi->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="col-12">
                    <label for="ID" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $divisi->id) }}"
                        readonly>
                </div>

                <div class="col-12">
                    <label for="nama_divisi" class="form-label">Nama Divisi</label>
                    <input type="text" class="form-control" id="nama_divisi" name="nama_divisi"
                        value="{{ old('nama_divisi', $divisi->nama_divisi) }}">
                </div>

                <div class="col-12">
                    <label for="pendidikan" class="form-label">Pendidikan <span style="color: red;">*</span></label>
                    <select name="organisasi_id" class="form-control" id="organisasi_id">
                        <option value="">-- Organisasi --</option>
                        @foreach ($organisasis as $organisasiID => $nama)
                        @php
                        $selected = '';
                        if ($divisi->organisasi_id === $organisasiID) {
                        $selected = 'selected';
                        }
                        @endphp
                        <option value="{{ $organisasiID }}" {{ $selected }}>
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
                        <a href="{{ route('divisis.index') }}" class="btn btn-secondary ms-2">Kembali</a>
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