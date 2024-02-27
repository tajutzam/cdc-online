@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <!-- Breadcrumb Navigation -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                        <!-- SVG Path for Database Icon -->
                                        <path
                                            d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kuesioner</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Card for Creating Questionnaire Package -->
        <div class="card bg-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 style="color: white">Edit Paket Kuesioner</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('paket_kuesioner.update', $paketKuesioner->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Form Inputs with Bootstrap Styling -->
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Paket:</label>
                                <input type="text" class="form-control" name="judul"
                                    value="{{ $paketKuesioner->judul }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tipe" class="form-label">Tipe Paket:</label>
                                <select class="form-select" name="tipe" id="tipe" required>
                                    <option value="Tracer Study"
                                        {{ $paketKuesioner->tipe == 'Tracer Study' ? 'selected' : '' }}>Tracer
                                        Study</option>
                                    <option value="Survey Khusus"
                                        {{ $paketKuesioner->tipe == 'Survey Khusus' ? 'selected' : '' }}>Survey
                                        Khusus</option>
                                </select>
                            </div>

                            <!-- Program Studi Field -->
                            <div id="programStudiField"
                                style="{{ $paketKuesioner->tipe == 'Survey Khusus' ? 'display:block;' : 'display:none;' }}">
                                <div class="mb-3">
                                    <label for="program_studi" class="form-label">Program Studi:</label>
                                    <select class="form-select" name="id_quis_identitas_prodi" id="program_studi">
                                        @foreach ($prodi as $p)
                                            @if (isset($paketKuesioner->prodi->nama_prodi))
                                                <option value="{{ $p->id }}"
                                                    {{ $p->nama_prodi == $paketKuesioner->prodi->nama_prodi ? 'selected' : '' }}>
                                                    {{ $p->nama_prodi }}</option>
                                            @else
                                                <option selected disabled>Pilih Program Studi</option>
                                                <option value="{{ $p->id }}">
                                                    {{ $p->nama_prodi }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="tanggal_dibuat" class="form-label">Tanggal Paket Dibuat:</label>
                                <input type="date" class="form-control" name="tanggal_dibuat"
                                    value="{{ $paketKuesioner->tanggal_dibuat }}" required>
                            </div> --}}

                            <!-- Submit and Cancel Buttons with Bootstrap Styling -->
                            <button type="submit" class="btn btn-primary">Perbarui Paket Kuesioner</button>
                            <a href="{{ route('paket_kuesioner.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>

                        <!-- Script for Dynamic Display of Program Studi Field -->
                        <script>
                            document.getElementById('tipe').addEventListener('change', function() {
                                var programStudiField = document.getElementById('programStudiField');
                                programStudiField.style.display = this.value === 'Survey Khusus' ? 'block' : 'none';
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
