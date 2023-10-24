@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('quisioner-index') }}"><i class="bx bxs-book-open"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Nama Alumni</li>
                </ol>
            </nav>
        </div>
    </div>

    <button class="btn btn-outline-primary btn-sm mb-3 w-auto m-3" data-bs-toggle="modal"
        data-bs-target="#list-quesioner">Section</button>


    <x-modal-small id="list-quesioner" footer="footer" title="title" body="body">
        <x-slot name="title">Section</x-slot>
        <x-slot name="id">list-quesioner</x-slot>
        <x-slot name="body">
            <form action="" method="post" enctype="multipart/form-data">
                <button type="button" class="btn btn-success btn-lg btn-block">1</button>
                <button type="button" class="btn btn-success btn-lg btn-block">2</button>
                <button type="button" class="btn btn-success btn-lg btn-block">3</button>
                <button type="button" class="btn btn-success btn-lg btn-block">4</button>
                <button type="button" class="btn btn-success btn-lg btn-block">5</button>
                <button type="button" class="btn btn-success btn-lg btn-block">6</button>
                <button type="button" class="btn btn-success btn-lg btn-block">7</button>
                <button type="button" class="btn btn-success btn-lg btn-block">8</button>
                <button type="button" class="btn btn-success btn-lg btn-block">9</button>


                <div id="overlay" class="overlay"></div>
            </form>

        </x-slot>
    </x-modal-small>
    <div class="container">
        <h1 class="text-center mt-3">Data Pribadi</h1>
        <form>
            <div class="form-group">
                <label for="question1">Question</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="yes" value="Ya">
                    <label class="form-check-label" for="yes">Ya</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="no" value="Tidak">
                    <label class="form-check-label" for="no">Tidak</label>
                </div>
            </div>
            <div class="form-group">
                <label for="question2">Nama Lengkap Anda</label>
                <input type="number" class="form-control" name="question2" min="0">
            </div>
            <div class="form-group">
                <label for="question3">Tentang Anda</label>
                <textarea class="form-control" name="question3" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="question3">Tentang Anda</label>
                <textarea class="form-control" name="question3" rows="3"></textarea>
            </div>
            <ul class="pagination">
                <li class="page-item">
                    <button type="button" class="page-link" id="prevBtn" onclick="changePage(-1)">Previous</button>
                </li>
                <li class="page-item">
                    <button type="button" class="page-link" id="nextBtn" onclick="changePage(1)">Next</button>
                </li>
            </ul>
        </form>
    </div>

    {{-- <script>
        let currentPage = 1;
        showPage(currentPage);

        function changePage(n) {
            showPage(currentPage += n);
        }

        function showPage(n) {
            const pages = document.querySelectorAll(".form-page");
            if (n < 1) {
                currentPage = 1;
            }
            if (n > pages.length) {
                currentPage = pages.length;
            }
            for (let i = 0; i < pages.length; i++) {
                pages[i].classList.remove("active");
            }
            pages[currentPage - 1].classList.add("active");

            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");

            if (currentPage === 1) {
                prevBtn.classList.add("disabled");
            } else {
                prevBtn.classList.remove("disabled");
            }

            if (currentPage === pages.length) {
                nextBtn.innerHTML = "Submit";
            } else {
                nextBtn.innerHTML = "Next";
            }
        }
    </script> --}}
@endsection