@extends('layouts.app')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $errors->first() }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lowongan</li>
                </ol>
            </nav>
        </div>

    </div>
    {{-- {{ dd($data) }} --}}
    <button class="btn btn-outline-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#my-modal">Tambah
        Lowongan</button>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Link Apply</th>
                    <th>Nama Perusahaan</th>
                    <th>Deskripsi</th>
                    <th>Poster</th>
                    <th>Posisi</th>
                    <th>Pengunggah</th>
                    <th>Status</th>
                    <th>Kadaluwarsa</th>
                    <th>Diunggah</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ $item['link_apply'] }}" class="text-decoration-none  font-italic">link_apply</a>
                        </td>
                        <td>{{ $item['company'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td><img src="{{ $item['image'] }}" alt="foto poster"></td>
                        <td>{{ $item['position'] }}</td>
                        <td class="text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#detail-user" id="{{ $item['id'] }}"
                                class="mx-auto" data-user="{{ json_encode($item['user']) }}"
                                data-admin="{{ json_encode($item['admin']) }}" onclick="detailUploader(id)"><i
                                    class="fa-solid fa-circle-info"></i></a>
                        </td>
                        <td>
                            <form action="" method="post" action="" id="">
                                <div class="form-check-primary form-check form-switch">
                                    <input name="can_comment" class="form-check-input" type="checkbox"
                                        onclick="updateStatusPost(id)" @if ($item['verified']) checked @endif
                                        id="{{ $item['id'] }}">
                                </div>
                            </form>
                        </td>
                        <td>{{ date('Y-F-d H:i', strtotime($item['expired'])) }}</td>
                        <td>{{ date('Y-F-d H:i', strtotime($item['post_at'])) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Link Apply</th>
                    <th>Nama Perusahaan</th>
                    <th>Deskripsi</th>
                    <th>Poster</th>
                    <th>Posisi</th>
                    <th>Pengunggah</th>
                    <th>Status</th>
                    <th>Kadaluwarsa</th>
                    <th>Diunggah</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        function updateStatusPost(id) {
            var checked = document.getElementById(id);
            var dataToSend = {
                id: id,
                verified: checked.checked // true atau false sesuai dengan kebutuhan Anda
            };
            // URL tujuan
            var url = "{{ url('/api/admin/lowongan/verified') }}";
            // Kirim permintaan AJAX
            $.ajax({
                type: "PUT",
                url: url,
                contentType: "application/json",
                data: JSON.stringify(dataToSend),
                success: function(response) {
                    // Tangani respons dari server jika diperlukan
                    console.log("Permintaan berhasil dikirim");
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan jika terjadi
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }

        // function detailUploader(id) {
        //     $(document).ready(function() {
        //         let user = null;
        //         let admin = null;
        //         var selector = '#' + id;
        //         console.log(selector);
        //         $(selector).on('click', function(e) {
        //             e.preventDefault(); // Untuk mencegah navigasi ke URL "#" yang tidak diperlukan
        //             // Ambil data ID dari atribut "data-id"
        //             user = $(this).data('user');
        //             admin = $(this).data('admin');
        //             console.log(true);

        //         });
        //         // $('#detail-user').on('show.bs.modal', function() {
        //         //     var modal = $(this);
        //         //     if (user != null) {
        //         //         modal.find('#email-user').val(user.email);
        //         //         modal.find('#fullname-user').val(user.fullname);
        //         //         modal.find('#gender-user').val(user.gender);
        //         //         modal.find('#address-user').val(user.address);
        //         //         modal.find('#nim-user').val(user.nim);
        //         //     } else {
        //         //         modal.find('#email-user').val(admin.email);
        //         //         modal.find('#fullname-user').val(admin.fullname);
        //         //         modal.find('#gender-user').val(admin.gender);
        //         //         modal.find('#address-user').val(admin.address);
        //         //         modal.find('#nim-user').val(admin.nim);
        //         //     }
        //         // });
        //     });
        // }
        function detailUploader(id) {
            // This function doesn't need to be wrapped in $(document).ready since it doesn't perform DOM manipulation on page load.
            let user = null;
            let admin = null;

            // Define the click event binding for the specified 'id'
            var selector = '#' + id;
            console.log(selector);

            $(document).on('click', selector, function(e) {
                e.preventDefault(); // To prevent navigation to an unnecessary URL

                // Retrieve data from 'data-user' and 'data-admin' attributes of the clicked element
                user = $(this).data('user');
                admin = $(this).data('admin');
                console.log(true);

                // Now you can access 'user' and 'admin' data as needed here.
                // If you want to update the modal content, you can do that here as well.
            });
        }
    </script>
    <x-modal id="my-modal" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Lowongan</x-slot>
        <x-slot name="id">my-modal</x-slot>
        <x-slot name="body">
            <form method="POST" action="{{ route('post-store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Company</label>
                    <input type="text" class="form-control" name="company" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Position</label>
                    <input type="text" class="form-control" name="position" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Link Apply</label>
                    <input type="text" class="form-control" name="link_apply" id="link">
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Expired</label>
                    <input type="datetime-local" name="expired" class="form-control" id="link">
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Poster</label>
                    <input name="image" class="form-control  form-control-sm" type="file" id="formFile" required>
                </div>
                <div class="form-check-danger form-check form-switch">
                    <input name="can_comment" class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDanger">
                    <label class="form-check-label" for="flexSwitchCheckCheckedDanger">Comment</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea required name="description" class="form-control" placeholder="Leave a description" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Description</label>
                </div>
                <label class="form-label"></label>
                <select name="type_jobs" class="form-select mb-3" aria-label="Multiple select example">
                    <option selected>Pilih</option>
                    <option value="Purnawaktu">Purnawaktu</option>
                    <option value="Paruh Waktu">Paruh Waktu</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Pekerja Lepas">Pekerja Lepas</option>
                    <option value="Kontrak">Kontrak</option>
                    <option value="Musiman">Musiman</option>
                </select>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </x-slot>
    </x-modal>


    <x-modal id="detail-user" footer="footer" title="title" body="body">
        <x-slot name="title">Detail Pengunggah</x-slot>
        <x-slot name="id">detail-user</x-slot>
        <x-slot name="body">
            <div class="row mb-3">
                <label for="input35" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="email-user" placeholder="Enter Your Name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input36" class="col-sm-3 col-form-label">Fullname</label>
                <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="fullname-user" placeholder="Phone No">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input37" class="col-sm-3 col-form-label">NIM / NPWP</label>
                <div class="col-sm-9">
                    <input readonly type="email" class="form-control" id="nim-user" placeholder="Email Address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input37" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <input readonly type="email" class="form-control" id="address-user" placeholder="Email Address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input37" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <input readonly type="email" class="form-control" id="gender-user" placeholder="Email Address">
                </div>
            </div>
        </x-slot>
    </x-modal>
@endsection
