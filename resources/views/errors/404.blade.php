<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>

</head>
@include('layouts.auth')

<body style="background-color: #0771BD">
    <div class="error-404 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="card py-5 rounded-5">
                <div class="row g-0">
                    <div class="col col-xl-5">
                        <div class="card-body p-4">
                            <h1 class="display-1"><span class="text-primary" style="font-weight: bold">4</span><span
                                    class="text-danger" style="font-weight: bold">0</span><span class="text-success"
                                    style="font-weight: bold">4</span></h1>
                            <h2 class="font-weight-bold display-4">Lost in Space</h2>
                            <p>You have reached the edge of the universe.
                                <br>The page you requested could not be found.
                                <br>Dont'worry and return to the previous page.
                            </p>


                            <div class="mt-5"> <a href="{{ route('/', ['id' => 1]) }}"
                                    class="btn btn-lg px-md-5 rounded-5"
                                    style="background: linear-gradient(to right, #0771BD, #2EA3F8); color: white; ">Go
                                    Home</a>

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
