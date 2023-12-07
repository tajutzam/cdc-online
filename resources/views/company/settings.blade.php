@extends('layouts-company.app')

@section('content')
    <style>
        #logo-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 50%;
            margin: 10px auto;
            display: none;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pengaturan Akun</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group logo-container">
                                <h5 for="" style="font-weight: bold; font-size: 25px; text-align: center">Nama
                                    Perusahaan</h5>
                                <img id="logo-preview">
                                <label style="text-align: start;" for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" onchange="previewLogo()">
                            </div>
                            <div class="form-group">
                                <label for="nib">Nomor Induk Berusaha</label>
                                <input type="text" class="form-control" id="nib">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Perusahaan</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Perusahaan</label>
                                <textarea class="form-control" id="alamat" rows="3"></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="surat" class="col-sm-2 col-form-label">Surat Izin Usaha</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="surat">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-secondary" onclick="downloadSurat()">Download
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success" style="width: 200px;">Simpan</button>
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

        }
    </script>
@endsection
