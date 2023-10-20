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
@endsection
