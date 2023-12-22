@extends('layouts.app')

@section('title','Detail Laporan Organisasi')

@section('contents')
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

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <!-- <a href="{{ route('pengurus.create') }}" class="btn btn-primary">Tambah</a> -->
                            Rata Rata
                        </h5>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if($penguruses->count() > 0)


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Integritas</th>
                                    <th scope="col">Handal</th>
                                    <th scope="col">Tangguh</th>
                                    <th scope="col">Kolaborasi</th>
                                    <th scope="col">Inovasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $rataRata['Nama'] }}</td>
                                    <td>{{ number_format($rataRata['integritas'], 1) }}</td>
                                    <td>{{ number_format($rataRata['handal'], 1) }}</td>
                                    <td>{{ number_format($rataRata['tangguh'], 1) }}</td>
                                    <td>{{ number_format($rataRata['kolaborasi'], 1) }}</td>
                                    <td>{{ number_format($rataRata['inovasi'], 1) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @else
                        <p>Record not found!</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->



<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection