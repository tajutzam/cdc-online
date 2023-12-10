@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                <div class="text-white">{{ $errors->first() }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Admin Program Studi</p>
                                <h4 class="my-1">{{ sizeof($data) }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-primary text-primary ms-auto"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-person-video3" viewBox="0 0 16 16">
                                    <path
                                        d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z" />
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                        <path
                                            d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Admin Program Studi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="row justify-content-start">
                        <div class="col">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#add-admin-prodi" type=""> <i class="fas fa-plus"></i>Tambah Admin
                                Program Studi</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Program Studi</th>
                                        <th>Email</th>
                                        <th>Dibuat</th>
                                        <th>Diperbarui</th>
                                        <th>Akses Export</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($data as $item) --}}
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['prodi']['nama_prodi'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <td>{{ date('Y-m-d H:i', strtotime($item['created_at'])) }}</td>
                                            <td>{{ date('Y-m-d H:i', strtotime($item['updated_at'])) }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheck_{{ $item['id'] }}"
                                                        onchange="updateStatus('{{ $item['id'] }}')"
                                                        {{ $item['can_download'] ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheck_{{ $item['id'] }}"
                                                        id="statusLabel_{{ $item['id'] }}">
                                                        {{ $item['can_download'] ? 'Aktif' : 'Tidak Aktif' }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row text-center">
                                                    <div class="col-12">
                                                        <a href="" class="btn-prodi-admin-delete"
                                                            data-bs-target="#delete-admin" data-id="{{ $item['id'] }}"
                                                            data-bs-toggle="modal"><i class="fa-solid fa-trash"
                                                                style="color: #ff0f27;"></i></a>
                                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @endforeach --}}
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal-small id="add-admin-prodi" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Admin Program Studi</x-slot>
        <x-slot name="id">add-admin-prodi</x-slot>
        <x-slot name="body">
            <form action="{{ route('manage-admin-prodi-add') }}" method="post">
                <div class="form-floating mb-3">
                    <select class="form-select" name="prodi_id" id="prodi">
                        @foreach ($prodis as $item)
                            <option value="{{ $item['id'] }}">{{ $item['nama_prodi'] }}</option>
                        @endforeach
                    </select>
                    <label for="prodi">Pilih Program Studi</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control form-control-sm" required id="floatingTextarea"
                        name="email"></input>
                    <label for="floatingTextarea">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="name"></input>
                    <label for="floatingTextarea">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm" required id="floatingTextarea"
                        name="nik"></input>
                    <label for="floatingTextarea">Nik</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="address"></input>
                    <label for="floatingTextarea">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="password"></input>
                    <label for="floatingTextarea">Password</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>
    <x-modal-small id="delete-admin" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Admin</x-slot>
        <x-slot name="id">delete-admin</x-slot>
        <x-slot name="body">
            <div class="mb-3" style="text-align: start;  font-size: 16px; ">Apakah anda yakin ingin menghapus Data ini
                ? </div>
            <form action="{{ route('manage-admin-prodi-delete') }}" method="post">
                <input type="text" hidden id="admin-delete-id" name="id">
                @method('delete')
                @csrf
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tidak</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Ya</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>


    <script>
        $(document).ready(function() {
            $(".btn-prodi-admin-delete").click(function() {
                var id = $(this).attr('data-id');
                console.log(id); // Ini akan mencetak nilai id ke konsol
                var id = $(this).attr('data-id'); // Mengambil ID dari tombol
                var modal = $("#delete-admin"); // Ganti "delete-admin" dengan ID modal yang sesuai
                modal.find('#admin-delete-id').val(id); // Menetapkan ID ke input dalam modal
            });
        });
    </script>
    <script>
        function updateStatus(id) {
            const checkbox = document.getElementById(`flexSwitchCheck_${id}`);
            const statusLabel = document.getElementById(`statusLabel_${id}`);

            var raw = JSON.stringify({
                "id": id
            });
            // Send a PUT request to your API endpoint
            fetch(`/api/admin-prodi`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        // Add any other headers you may need, such as authorization headers
                    },
                    body: raw,
                })
                .then(response => response.json())
                .then(data => {
                    // Update the label text based on the response
                    if (data.status) {
                        statusLabel.textContent = data.data.can_download ? 'Aktif' : 'Tidak Aktif';
                        alert('Sukses Memperbarui Akses Export')
                    } else {
                        alert('Gagal Memperbarui Akses Export')
                    }
                })
                .catch(error => {
                    alert("Error : ", error);
                    console.error('Error:', error);
                    // Handle errors if needed
                });
        }
    </script>
@endsection
