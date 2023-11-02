<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan Anda Berhasil</title>

</head>
@include('layouts.auth')

<body style="background-color: #0771BD">
    <div class="error-404 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="card py-3 rounded-5">
                <div class="row g-0">
                    <div class="col col-xl-5">
                        <div class="card-body p-4">
                            <h1 class="display-3"><span class="text-primary" style="font-weight: bold">S</span><span
                                    class="text-danger" style="font-weight: bold">U</span><span class="text-success"
                                    style="font-weight: bold">C</span><span class="text-primary"
                                    style="font-weight: bold">C</span><span class="text-danger"
                                    style="font-weight: bold">E</span><span class="text-success"
                                    style="font-weight: bold">S</span></h1>
                            <h4 class="font-weight-bold ">Please Login Again</h4>
                            <p>Your account has been changed
                                <br>Re-enter with your changes
                            </p>


                            <div class="mt-5"> <a href="{{ route('/', ['id' => 1]) }}"
                                    class="btn btn-lg px-md-5 rounded-5"
                                    style="background: linear-gradient(to right, #0771BD, #2EA3F8); color: white; ">
                                    Back</a>

                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</body>

</html>
