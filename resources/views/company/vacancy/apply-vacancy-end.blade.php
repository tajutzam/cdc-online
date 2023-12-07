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
                            <a href="{{ route('vacancy-next') }}"> <button type="button" class="btn btn-secondary">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
                                </tr>
                                <tr>

                                    <th style=" width: 70px">Diunggah</th>
                                    <td>:</td>
                                    <td>12 Januari 2022</td>
                                </tr>
                                <tr>

                                    <th style=" width: 70px">Kadaluwarsa</th>
                                    <td>:</td>
                                    <td>18 Januari 2022</td>
                                </tr>
                                <tr>
                                    <th style=" width: 70px">Tautan</th>
                                    <td>:</td>
                                    <td><a href="google.com">google.com</a></td>
                                </tr>

                                <tr>
                                    <th style=" width: 70px">Deskripsi</th>
                                    <td>:</td>
                                    <td>
                                        Unyuvevev
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

                        <div class="container">

                            <input type="file" id="file" accept="image/*" hidden>
                            <div class="img-area" data-img="">
                                <i class='bx bxs-cloud-upload icon'></i>
                                <h3>Poster Anda</h3>

                            </div>

                        </div>
                    </div>

                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row" style="justify-items: end; text-align: end;">
                            <div class="col">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    {{-- <button type="button" class="btn btn-primary">Left</button> --}}

                                    <a href="{{ route('vacancy-company-history') }}"><button type="button"
                                            class="btn btn-success"> <i class="fas fa-check"></i> Konfirmasi</button></a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
@endsection
