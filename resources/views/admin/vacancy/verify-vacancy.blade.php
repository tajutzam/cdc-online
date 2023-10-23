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


    <div class="row gap-4">
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Lowongan</p>
                        <h4 class="my-1">{{ $total['total'] }}</h4>

                    </div>
                    <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-badge'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Aktif</p>
                        <h4 class="my-1">{{ $total['active'] }}</h4>

                    </div>
                    <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-badge'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Tidak Aktif</p>
                        <h4 class="my-1">{{ $total['nonactive'] }}</h4>
                    </div>
                    <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-badge'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- {{ dd($data) }} --}}
    <div class="card row align-items-start" style="margin-left:2px; margin-right:2px; margin-bottom: 10px">
        <button class="btn btn-outline-primary btn-sm mb-3 w-auto m-3" data-bs-toggle="modal"
            data-bs-target="#my-modal">Tambah
            Lowongan</button>
    </div>

    <div class="table-responsive card p-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengunggah</th>
                    <th>Perusahaan</th>
                    <th>Posisi</th>
                    <th>Deskripsi</th>
                    <th>Poster</th>
                    <th>Tautan</th>

                    <th>Kadaluwarsa</th>
                    <th>Diunggah</th>
                    <th>Perizinan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start" style="text-align: start">
                            {{ $item['user']['fullname'] }}
                            <a href="#" class="user-info" data-bs-toggle="modal" data-bs-target="#detail-user"
                                data-id="{{ $item['id'] }}" class="mx-auto" data-user="{{ json_encode($item['user']) }}"
                                data-admin="{{ json_encode($item['admin']) }}" onclick="detailUploader(id)"><i
                                    class="fa-solid fa-circle-info"></i></a>
                        </td>
                        <td>{{ $item['company'] }}</td>
                        <td>{{ $item['position'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td><img style="height: 100px; width: 100px" src="{{ $item['image'] }}" alt="foto poster"></td>
                        <td><a href="{{ $item['link_apply'] }}" class="text-decoration-none  font-italic">link_apply</a>
                        </td>
                        {{-- <td>
                            <form action="" method="post" action="" id="">
                                <div class="form-check-primary form-check form-switch">
                                    <input name="can_comment" class="form-check-input" type="checkbox"
                                        onclick="updateStatusPost(id)" @if ($item['verified']) checked @endif
                                        id="{{ $item['id'] }}">
                                </div>
                            </form>
                        </td> --}}
                        <td>{{ date('Y-F-d H:i', strtotime($item['expired'])) }}</td>
                        <td>{{ date('Y-F-d H:i', strtotime($item['post_at'])) }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-success">Setuju</button>
                                <button type="button" class="btn btn-danger">Tolak</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

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

        $(document).ready(function() {
            var emailInput = $('#email-user');
            var gender = $('#gender-user');
            var address = $('#address-user');
            var fullname = $('#fullname-user');
            var nim = $('#nim-user');
            var img = $('#img-uploader');
            var lvl = $('#level-uploader');

            // when click the info user run this function
            $('.user-info').on('click', function() {
                var newHeight = 100; // Replace with your desired height

                let user = $(this).data('user');
                let admin = $(this).data('admin');

                img.css({
                    width: newHeight + 'px',
                    height: newHeight + 'px'
                });

                if (user != null) {
                    var urlUser = "{{ url('/user/images/') }}" + user.foto;
                    img.attr('src', urlUser);

                    lvl.text("-USER");
                    emailInput.val(user.email);
                    gender.val(user.gender);
                    address.val(user.alamat);
                    nim.val(user.nim);
                    fullname.val(user.fullname);
                } else {
                    img.attr('src', "{{ asset('/') }}" + "assets/images/admin.png");
                    lvl.text("-ADMIN");
                    emailInput.val(admin.email);
                    fullname.val(admin.name);
                    nim.val(admin.npwp);
                    address.val(admin.alamat);
                }
            });

            // run when the modal is closed
            $('#detail-user').on('hidden.bs.modal', function() {
                // This event is triggered when the modal is hidden or closed
                // Clear the input values before the modal is closed
                emailInput.val('');
                gender.val('');
                address.val('');
                nim.val('');
                fullname.val('');
            });
        });
    </script>
    <x-modal id="my-modal" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Lowongan</x-slot>
        <x-slot name="id">my-modal</x-slot>
        <x-slot name="body">
            <form method="POST" action="{{ route('vacancy-store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Perusahaan</label>
                    <input type="text" class="form-control" name="company" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Posisi</label>
                    <input type="text" class="form-control" name="position" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Tautan Lamaran</label>
                    <input type="text" class="form-control" name="link_apply" id="link">
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Masa Berlaku</label>
                    <input type="datetime-local" name="expired" class="form-control" id="link">
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Poster</label>
                    <input name="image" class="form-control  form-control-sm" type="file" id="formFile" required>
                </div>
                <div class="form-check-danger form-check form-switch">
                    <input name="can_comment" class="form-check-input" type="checkbox"
                        id="flexSwitchCheckCheckedDanger">
                    <label class="form-check-label" for="flexSwitchCheckCheckedDanger">Komentar</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea required name="description" class="form-control" placeholder="Leave a description" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Deskripsi</label>
                </div>
                <label class="form-label">Jenis Pekerjaan</label>
                <select name="type_jobs" class="form-select mb-3" aria-label="Multiple select example">
                    <option selected>Pilih</option>
                    <option value="Purnawaktu">Purnawaktu</option>
                    <option value="Paruh Waktu">Paruh Waktu</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Pekerja Lepas">Pekerja Lepas</option>
                    <option value="Kontrak">Kontrak</option>
                    <option value="Musiman">Musiman</option>
                </select>
                <div class="row justify-content-between">
                    <button class="col-3 btn btn-outline-danger btn-sm mx-4" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <x-modal id="detail-user" footer="footer" title="title" body="body">
        <x-slot name="title">Detail Pengunggah <span id="level-uploader"></span></x-slot>



        <x-slot name="body">
            <div></div>
            <img id="img-uploader" class="rounded-circle mb-3  shadow-4-strong" alt="image-uploader" />

            <div class="row mb-3">
                <label for="input35" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="email-user" placeholder="Enter Your Name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input36" class="col-sm-3 col-form-label">Nama Lengkap</label>
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
