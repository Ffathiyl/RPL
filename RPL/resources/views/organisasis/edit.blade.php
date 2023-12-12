@extends('layouts.app')

@section('title','Edit Organisasi')

@section('contents')

    <!-- Main -->
    <main id="main" class="main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Organisasi</h5>
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
                <form class="row g-3" action="{{ route('organisasis.update', $organisasi->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="col-12">
                        <label for="ID" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $organisasi->id) }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                        <input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi"
                            value="{{ old('nama_organisasi', $organisasi->nama_organisasi) }}">
                    </div>

                    <div class="col-12">
                        <input type="hidden" class="form-control" id="Status" value="1" name="Status">
                    </div>

                    <div class="col-12">
                        <div class="text-end d-flex justify-content-between">
                            <a href="{{ route('organisasis.index') }}" class="btn btn-secondary ms-2">Kembali</a>
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