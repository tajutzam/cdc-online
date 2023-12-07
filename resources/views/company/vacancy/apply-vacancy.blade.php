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

        ::selection {
            color: #fff;
            background: #4285f4;
        }

        .no-bullet {
            list-style-type: none;
        }

        .select-btn li {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .select-btn {
            height: 40px;

            padding: 0 20px;
            font-size: 17px;
            background: #fff;
            border-radius: 7px;
            justify-content: space-between;
            /* box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); */
            border: 2px solid #e8e4e4;

        }

        .select-btn i {
            font-size: 17px;
            transition: transform 0.3s linear;
        }

        .wrapper.active .select-btn i {
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

        .wrapper.active .content {
            display: block;
        }

        .content .search {
            position: relative;
        }

        .search i {
            /* top: 50%; */
            left: 15px;
            color: #999;
            font-size: 15px;
            pointer-events: none;
            transform: translateY(-50%);
            position: absolute;
        }

        .search input {
            height: 50px;
            width: 100%;
            outline: none;
            font-size: 17px;
            border-radius: 5px;
            padding: 0 20px 0 43px;
            border: 1px solid #B3B3B3;
        }

        .search input:focus {
            padding-left: 42px;
            border: 2px solid #4285f4;
        }

        .search input::placeholder {
            color: #bfbfbf;
        }

        .content .options {
            margin-top: 10px;
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
            font-size: 17px;
        }

        .options li:hover,
        li.selected {
            border-radius: 5px;
            background: #f2f2f2;
        }
    </style>
    <div class="container-fluid">

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
                            <a href="{{ route('vacancy-company-apply-next') }}"> <button type="button"
                                    class="btn btn-primary">Selanjutnya</button></a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="form">
                                <div class="form-group">
                                    <div class="wrapper">
                                        <label style="font-weight: bold" for="">Bank Tujuan</label>
                                        <div class="select-btn pt-1 ps-3">

                                            <span> Pilih Bank </span>
                                            <i class="uil uil-angle-down"></i>
                                        </div>
                                        <div class="content">
                                            <div class="search ">
                                                <i class="mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-search"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                                    </svg></i>
                                                <input spellcheck="false" type="text" placeholder="Cari Bank">
                                            </div>
                                            <ul class="options no-bullet"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold" for="noRekening">No Rekening</label>
                                    <input type="text" class="form-control" id="noRekening" placeholder="No Rekening"
                                        style="background-color: #f0f0f0;">
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold" for="tarif">Tarif</label>
                                    <input type="text" class="form-control" id="tarif" placeholder="Tarif Layanan"
                                        style="background-color: #f0f0f0;">
                                </div>

                            </div>



                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <input type="file" id="file" accept="image/*" hidden>
                            <div class="img-area" data-img="">
                                <i class='bx bxs-cloud-upload icon'></i>
                                <h3>Unggah Bukti pembayaran</h3>
                                <p>Pastikan file kurang dari <span>2MB</span></p>
                            </div>
                            <button class="select-image"> Pilih Bukti</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        const wrapper = document.querySelector(".wrapper"),
            selectBtn = wrapper.querySelector(".select-btn"),
            searchInp = wrapper.querySelector("input"),
            options = wrapper.querySelector(".options");

        let countries = ["BRI", "Bank Mega", "BSI", "BCA"];

        function addBank(selectedBank) {
            options.innerHTML = "";
            countries.forEach(bank => {
                let isSelected = bank == selectedBank ? "selected" : "";
                let li = `<li onclick="updateName(this)" class="${isSelected}">${bank}</li>`;
                options.insertAdjacentHTML("beforeend", li);
            });
        }
        addBank();

        function updateName(selectedLi) {
            searchInp.value = "";
            addBank(selectedLi.innerText);
            wrapper.classList.remove("active");
            selectBtn.firstElementChild.innerText = selectedLi.innerText;
        }

        searchInp.addEventListener("keyup", () => {
            let arr = [];
            let searchWord = searchInp.value.toLowerCase();
            arr = countries.filter(data => {
                return data.toLowerCase().startsWith(searchWord);
            }).map(data => {
                let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
                return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
            }).join("");
            options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! bank not found</p>`;
        });

        selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));
    </script>
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
@endsection