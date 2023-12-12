@extends('layouts.app')

@section('title','Menu Pengurus')

@section('contents')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pengurus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Dashboard.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Pengurus</li>
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
                        </h5>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Organisasi</th>
                                    <th scope="col">Divisi</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $i=1;
                                @endphp

                                @forelse($penguruses as $pengurus)
                                <tr>
                                    <td>{{ $pengurus->Nim }}</td>
                                    <td>{{ $pengurus->Nama }}</td>
                                    <td>{{ ($pengurus->organisasi != null) ? $pengurus->organisasi->nama_organisasi :
                                        ''}}</td>
                                        <td>{{ ($pengurus->divisi != null) ? $pengurus->divisi->nama_divisi : '' }}
                                    </td>
                                    <td>{{ ($pengurus->jabatan != null) ? $pengurus->jabatan->nama_jabatan : ''}}</td>
                                    <td>{{ ($pengurus->prodi != null) ? $pengurus->prodi->nama_program_studi : ''}}</td>
                                    <td>
                                        <a href="{{ route('pengurus.edit', ['nim' => $pengurus->Nim]) }}"
                                            class="btn btn-warning ">Edit</a>
                                        <a class="btn btm-sm btn-danger delete-btn"
                                            data-id="{{ $pengurus->Nim }}">Delete</a>
                                        <form id="delete-row-{{ $pengurus->Nim }}"
                                            action="{{ route('pengurus.destroy', ['nim' => $pengurus->Nim]) }}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        No Record Found!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->



<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteLinks = document.querySelectorAll('a.delete-btn');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const pengurusId = this.getAttribute('data-id');
                console.log(pengurusId)
                Swal.fire({
                    title: 'Yakin Hapus Data?',
                    text: 'Data tidak akan bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(delete-row-${pengurusId});
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection