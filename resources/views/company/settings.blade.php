@extends('layouts-company.app')

@section('content')
    <style>
        #logo-preview {
            height: 100px;
            width: 100px;
            /* Tambahkan lebar yang sama dengan tinggi */
            border-radius: 50%;
            margin: 10px auto;
            display: block;
            object-fit: cover;
            /* Tambahkan properti object-fit */
            border: 1px solid grey
        }
    </style>
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                <div class="text-white">{{ $errors->first() }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pengaturan Akun</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mitra-put') }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            <div class="form-group logo-container">
                                <h5 for="" style="font-weight: bold; font-size: 25px; text-align: center">
                                    {{ auth('mitra')->user()->name }}</h5>
                                <img id="logo-preview" src="{{ url('/') . '/mitra/logo/' . auth('mitra')->user()->logo }}">
                                <label style="text-align: start;" for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" onchange="previewLogo()"
                                    accept=".png , .jpeg , .jpg" name="logo">
                            </div>
                            <div class="form-group">
                                <label for="nib">Nomor Induk Berusaha</label>
                                <input type="text" class="form-control" value="{{ auth('mitra')->user()->nib }}"
                                    name="nib" id="nib">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama" name="name"
                                    value="{{ auth('mitra')->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Perusahaan</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ auth('mitra')->user()->email }}" name="email">
                            </div>
                            <div class="form-group">
                                <label for="email">No Hp</label>
                                <input type="number" class="form-control" id="email"
                                    value="{{ auth('mitra')->user()->phone }}" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Perusahaan</label>
                                <textarea class="form-control" id="alamat" name="address" rows="3">{{ auth('mitra')->user()->address }}</textarea>

                            </div>
                            <div class="form-group row">
                                <label for="surat" class="col-sm-2 col-form-label">Surat Izin Usaha</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="surat" name="business_license" accept=".pdf">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-secondary" onclick="downloadSurat()">Download
                                        Surat</button>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-success" style="width: 200px;">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewLogo() {
            var input = document.getElementById('logo');
            var preview = document.getElementById('logo-preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }


        function downloadSurat() {
            // Implement your download logic here
            // You may need to fetch the file or generate it on the server side
            var fileUrl = '{{ url('/') . '/mitra/bussince_licence/' . auth('mitra')->user()->business_license }}';
            // Create a hidden anchor element
            var a = document.createElement('a');
            a.href = fileUrl;

            // Set the download attribute to specify the file name
            a.download = 'Surat-Izin-Usaha-{{ auth('mitra')->user()->name }}.pdf'; // Change the file name as needed

            // Append the anchor to the body
            document.body.appendChild(a);

            // Programmatically click the anchor to trigger the download
            a.click();

            // Remove the anchor from the body
            document.body.removeChild(a);
        }
    </script>
@endsection
