@extends('layouts-company.app')
@section('content')
    <style>
        /* Import Google Font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        .select-btn {
            display: flex;
            align-items: center;
            width: 100%;
            height: 40px;
            padding: 0 20px;
            font-size: 15px;
            background: #fff;
            border-radius: 7px;
            justify-content: space-between;
            border: 1px solid #B3B3B3;
            cursor: pointer;
        }

        .select-btn i {
            font-size: 24px;
            transition: transform 0.3s ease;
        }

        .banksearch.active .select-btn i {
            transform: rotate(-180deg);
        }

        .content {
            display: none;
            padding: 20px;
            margin-top: 15px;
            background: #fff;
            border-radius: 7px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .banksearch.active .content {
            display: block;
        }

        .content .search {
            position: relative;
            margin-bottom: 20px;
        }

        .search i {
            position: absolute;
            width: 100%;
            top: 50%;
            left: 15px;
            color: #999;
            font-size: 20px;
            transform: translateY(-50%);
        }

        .search input {
            height: 40px;
            width: 100%;
            outline: none;
            font-size: 15px;
            border-radius: 5px;
            padding: 0 20px 0 43px;
            border: 1px solid #B3B3B3;
            transition: padding-left 0.3s ease, border 0.3s ease;
        }

        .search input:focus {
            padding-left: 42px;
            border: 2px solid #4285f4;
        }

        .search input::placeholder {
            color: #bfbfbf;
        }

        .content .options {
            max-height: 250px;
            overflow-y: auto;
            padding-right: 7px;
        }

        .options::-webkit-scrollbar {
            width: 7px;
        }

        .options::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 25px;
        }

        .options::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 25px;
        }

        .options::-webkit-scrollbar-thumb:hover {
            background: #b3b3b3;
        }

        .options li {
            height: 50px;
            padding: 0 13px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: border-radius 0.3s ease;
        }

        .options li:hover,
        li.selected {
            border-radius: 5px;
        }


        .img-area {
            position: relative;
            width: 100%;
            height: 500px;
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







        .deskripsi textarea {
            width: 100%;
            resize: none;
            height: 59px;
            outline: none;

            padding: 15px;
            font-size: 16px;

            border-radius: 5px;
            max-height: 330px;
            caret-color: #4671EA;
            border: 1px solid #bfbfbf;
        }

        textarea::placeholder {
            color: #b3b3b3;
        }

        textarea:is(:focus, :valid) {
            padding: 14px;
            border: 2px solid #b3b3b3;
        }

        textarea::-webkit-scrollbar {
            width: 0px;
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
        <form action="{{ route('apply-post') }}" method="post" onsubmit="return validateForm()"
            enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">

                    <div class="row" style="justify-items: end; text-align: end;">
                        <div class="col">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <button type="button" class="btn btn-primary">Left</button> --}}

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-chevron-right"></i> Selanjutnya
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-body">


                            <div class="form mb-3">
                                <div class="form">
                                    <label for="" style="font-weight: bold;">Paket Layanan</label>
                                    <div class="select-paket">
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="Paket 1">
                                                Pilih Paket
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form mb-3">
                                        <div class="form">
                                            <div class="">
                                                <label for="" style="font-weight: bold;">Harga</label>
                                                <input style="background-color: #E7E7E7;" type="text"
                                                    class="form-control" placeholder="Harga Layanan" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="" style="font-weight: bold;">Tipe Bank</label>
                                    <div class="banksearch">

                                        {{-- <div class="select-btn">
                                                <span>Pilih Bank</span>
                                                <i class="uil uil-angle-down"></i>
                                            </div> --}}
                                        <select class="form-select" aria-label="Default select example" id="bankSelect"
                                            onchange="updateNoRekening()" name="bank">
                                            <option value="Pilih Bank" selected>Pilih Bank</option>
                                            @foreach ($banks as $item)
                                                <option value="{{ $item->id }}">{{ $item->bank }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form mb-3">
                                <div class="form">
                                    <div class="">
                                        <label for="" style="font-weight: bold;">No Rekening</label>
                                        <input style="background-color: #E7E7E7;" type="text" class="form-control"
                                            placeholder="Rekening" readonly id="no_rekening">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-header">
                            <h6>Bukti Pembayaran</h6>
                        </div>
                        <div class="card-body">

                            <div class="container">

                                <input type="file" id="file" style="display: none" accept="image/*" hidden
                                    style="" id="bukti" name="bukti">
                                <div class="img-area" data-img="">
                                    <i class="fas fa-receipt icon"></i>
                                    <br>
                                    <h3 style="text-align: center">Unggah Bukti pembayaran</h3>
                                    <p>Pastikan file kurang dari <span>2MB</span></p>
                                </div>
                                <button type="button" class="select-image"> Pilih Bukti</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const selectImage = document.querySelector('.select-image');
        const inputFile = document.querySelector('#file');
        const imgArea = document.querySelector('.img-area');

        selectImage.addEventListener('click', function() {
            inputFile.click();
        })

        inputFile.addEventListener('change', function() {
            const image = this.files[0]
            if (image.size < 2000000) {
                const reader = new FileReader();
                reader.onload = () => {
                    const allImg = imgArea.querySelectorAll('img');
                    allImg.forEach(item => item.remove());
                    const imgUrl = reader.result;
                    const img = document.createElement('img');
                    img.src = imgUrl;
                    imgArea.appendChild(img);
                    imgArea.classList.add('active');
                    imgArea.dataset.img = image.name;

                    // Set z-index dynamically
                    const zIndexValue = allImg.length + 1; // Make sure it's higher than existing images
                    img.style.zIndex = zIndexValue;
                    imgArea.style.zIndex = zIndexValue;
                    imgArea.querySelector('::before').style.zIndex = zIndexValue -
                        1; // Set pseudo-element z-index

                }
                reader.readAsDataURL(image);
            } else {
                alert("Image size more than 2MB");
            }
        })
    </script>



    <script>
        function validateForm() {

            var selectedBank = document.querySelector('#bankSelect').value;
            var bukti = document.querySelector('#file');
            console.log(bukti.value);

            if (selectedBank === 'Pilih Bank') {
                alert('Harap pilih bank sebelum melanjutkan.');
                return false; // Prevent form submission
            }

            if (bukti.files.length <= 0) {
                alert('Harap Masukan Bukti terlebih dahulu');
                return false;
            }


            // if (bukti.value == null) {
            //     alert('Harap Masukan Bukti Terlebih dahulu');
            //     return false;
            // }



            // If the bank is selected, you can proceed with the form submission
            return true;
        }


        function updateNoRekening() {
            var selectedBankId = document.querySelector('#bankSelect').value;
            var bukti = document.querySelector('#file');

            console.log(selectedBankId);

            if (selectedBankId === 'Pilih Bank') {
                console.log("masuk sini");
                document.querySelector('#no_rekening').value = null;
                document.querySelector('#nominal').value = null;
                document.getElementById('file').setAttribute('hidden', 'true');
            } else {
                bukti.removeAttribute('hidden');
                var bankData = {!! json_encode($banks) !!};
                // Find the selected bank in the bankData array
                var selectedBank = bankData.find(function(bank) {
                    return bank.id == selectedBankId;
                });
                // Update the No Rekening field with the selected bank's information
                document.querySelector('#no_rekening').value = selectedBank.va_number;
                document.querySelector('#nominal').value = selectedBank.nominal;
            }

            // Assuming you have a JavaScript variable called 'bankData' containing bank information
            // You may need to fetch the bank data from the server using AJAX if not available in JavaScript
        }
    </script>
@endsection
