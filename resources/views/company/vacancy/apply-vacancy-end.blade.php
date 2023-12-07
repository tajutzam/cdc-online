@extends('layouts-company.app')

@section('content')
    <style>
        /* Import Google Font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        .img-area {
            position: relative;
            width: 100%;
            height: 400px;
            max-height: 1000px;
            background: var(--grey);
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .img-area .icon {
            font-size: 100px;
        }

        .img-area h3 {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .img-area p {
            color: #999;
        }

        .img-area p span {
            font-weight: 600;
        }

        .img-area img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 100;
        }

        .img-area::before {
            content: attr(data-img);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
            color: #fff;
            font-weight: 500;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
            opacity: 0;
            transition: all .3s ease;
            z-index: 200;
        }

        .img-area.active:hover::before {
            opacity: 1;
        }

        .select-image {
            display: block;
            width: 100%;
            padding: 16px 0;
            border-radius: 15px;
            background: var(--blue);
            color: #fff;
            font-weight: 500;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all .3s ease;
        }

        .select-image:hover {
            background: var(--dark-blue);
        }


        .img-area {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        #file {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 1;
        }

        img {
            width: 200px;
            /* Adjust the size as needed */
            height: auto;
        }

        /* Add styles to indicate hover effect and make the hidden input cover the image */
        .img-area:hover {
            /* Add your hover styles here */
            border: 2px solid #007bff;
        }

        /* Add styles to indicate hover effect and make the hidden input cover the image */
        .img-area:hover #file {
            display: block;
        }
    </style>
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                <div class="text-white">{{ $errors->first() }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mt-4">
            <div class="col p-0">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href=""> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-folder2-open"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z" />
                                    </svg></i></a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Pengajuan Lowongan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">

                <div class="row" style="justify-items: end; text-align: end;">
                    <div class="col">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            {{-- <button type="button" class="btn btn-primary">Left</button> --}}
                            <a href="{{ route('vacancy-next') }}"> <button type="button" class="btn btn-secondary">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <form action="{{ route('vacancy-end-post') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Rincian</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" style="border-radius: 7px">

                                <tbody>
                                    <tr>
                                        <th style=" width: 70px">Posisi</th>
                                        <td>:</td>

                                        <td>Sekretaris</td>
                                        <input type="text" value="{{ $data['position'] }}" hidden name="position">
                                    </tr>
                                    <tr>

                                        <th style=" width: 70px">Diunggah</th>
                                        <td>:</td>
                                        <td>{{ $data['upload_at'] }}</td>
                                        <input type="date" value="{{ $data['upload_at'] }}" hidden name="upload_at">
                                    </tr>
                                    <tr>

                                        <th style=" width: 70px">Kadaluwarsa</th>
                                        <td>:</td>
                                        <td>{{ $data['expired_at'] }}</td>
                                        <input type="date" value="{{ $data['expired_at'] }}" hidden name="expired">

                                    </tr>
                                    <tr>
                                        <th style=" width: 70px">Tautan</th>
                                        <td>:</td>
                                        <td><a href="{{ $data['link'] }}">{{ $data['link'] }}</a></td>
                                        <input type="text" value="{{ $data['link'] }}" name="link_apply" hidden>

                                    </tr>

                                    <tr>
                                        <th style=" width: 70px">Tipe Pekerjaan</th>
                                        <td>:</td>
                                        <td>{{ $data['type_jobs'] }}</td>
                                        <input type="text" value="{{ $data['link'] }}" name="type_jobs" hidden>

                                    </tr>

                                    <tr>
                                        <th style=" width: 70px">Deskripsi</th>
                                        <td>:</td>
                                        <td>
                                            {{ $data['description'] }}
                                            <input type="text" value="{{ $data['description'] }}" name="description"
                                                hidden>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Poster</h5>
                        </div>
                        <div class="card-body">

                            {{-- @dd($data) --}}
                            <div class="container">

                                <div class="img-area" data-img="">
                                    <img src="{{ url('/') . '/mitra/vacancy-temp/' . $data['poster'] }}" alt="Poster"
                                        onclick="openFileInput()" id="previewImage">
                                    <input type="file" id="file" accept="image/*" onchange="updateImage()"
                                        name="poster" hidden>
                                    <input type="file" id="bukti" name="bukti" hidden>
                                    <img src="{{ url('/') . '/mitra/bukti/temp/' . $data['bukti_path'] }}" alt="sas"
                                        id="buktiPreview" hidden>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


                {{-- @dd($data) --}}
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row" style="justify-items: end; text-align: end;">
                                <div class="col">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {{-- <button type="button" class="btn btn-primary">Left</button> --}}
                                        <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i>
                                            Konfirmasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script>
        // document.getElementById('file').value = 
        var src = document.getElementById('previewImage').src;
        var srcBukti = document.getElementById('buktiPreview').src;



        function toDataUrl(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                if (xhr.status === 200) {
                    callback(xhr.response);
                } else {
                    console.error('Failed to load image. Status code: ' + xhr.status);
                }
            };
            xhr.onerror = function() {
                console.error('Network error while loading image.');
            };
            xhr.open('GET', url);
            xhr.responseType = 'blob';
            xhr.send();
        }

        let image;
        toDataUrl(src, function(blob) {
            console.log("blob ", blob);

            const imageType = blob.type; // Get the image type (e.g., "image/jpeg" or "image/png")
            const fileExtension = imageType.split('/')[1]; // Extract the file extension

            const dT = new ClipboardEvent('').clipboardData ||
                // Firefox < 62 workaround exploiting https://bugzilla.mozilla.org/show_bug.cgi?id=1422655
                new DataTransfer(); // specs compliant (as of March 2018 only Chrome)

            const fileName = 'myNewFile.' + fileExtension; // Construct the file name with the correct extension
            dT.items.add(new File([blob], fileName, {
                type: imageType
            }));

            document.querySelector('#file').files = dT.files;
        });


        toDataUrl(srcBukti,
            function(blob) {
                console.log("blob ", blob);

                const imageType = blob.type; // Get the image type (e.g., "image/jpeg" or "image/png")
                const fileExtension = imageType.split('/')[1]; // Extract the file extension

                const dT = new ClipboardEvent('').clipboardData ||
                    // Firefox < 62 workaround exploiting https://bugzilla.mozilla.org/show_bug.cgi?id=1422655
                    new DataTransfer(); // specs compliant (as of March 2018 only Chrome)

                const fileName = 'bukti.' + fileExtension; // Construct the file name with the correct extension
                dT.items.add(new File([blob], fileName, {
                    type: imageType
                }));

                document.querySelector('#bukti').files = dT.files;
            });

        // Get the image source
        function openFileInput() {
            // Trigger click on the hidden file input when the image is clicked
            document.getElementById('file').click();
        }

        function updateImage() {
            var input = document.getElementById('file');
            var reader = new FileReader();

            // Read the selected file as a data URL and set it as the image source
            reader.onload = function(e) {
                document.querySelector('.img-area img').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
