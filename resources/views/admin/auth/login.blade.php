@extends('layouts.auth')
@section('content')
    <div class="container pt-5">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto my-auto">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                <div class="text-white">{{ $errors->first() }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="p-4">
                            <div class="mb-3 text-center">
                                <img src="{{ asset('/') }}assets/images/logoblack.png" width="60" alt="" />
                            </div>
                            <div class="text-center mb-4">
                                <h5 class="">Admin Login Page</h5>
                                <p class="mb-0">Please log in to your account</p>
                            </div>
                            <div class="form-body">
                                <form class="row g-3" method="POST" action="{{ route('admin-login') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmailAddress"
                                            placeholder="jhon@example.com" name="email">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" name="password"
                                                id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a
                                                href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end"> <a href="auth-basic-forgot-password.html">Forgot
                                            Password ?</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Sign in</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center ">
                                            <p class="mb-0">Don't have an account yet? <a
                                                    href="auth-basic-signup.html">Sign up here</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
