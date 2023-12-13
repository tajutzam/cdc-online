<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Server Error</title>

</head>
@include('layouts.auth')

<body style="background-color: #0771BD">
    <div class="error-404 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="card rounded-5">
                <div class="row g-0">
                    <div class="col-xl-5">
                        <div class="card-body p-4">
                            <h1 class="display-1"><span class="text-primary" style="font-weight: bold">5</span><span
                                    class="text-danger" style="font-weight: bold">0</span><span class="text-success"
                                    style="font-weight: bold">0</span></h1>
                            <h2 class="font-weight-bold display-4">Sorry, unexpected error</h2>
                            <p>{{ $message }}
                            </p>

                            <div class="mt-5"> <a href="javascript:;" class="btn btn-lg px-md-5 rounded-5"
                                    style="background: linear-gradient(to right, #0771BD, #2EA3F8); color: white; ">Go
                                    Home</a>
                                <a href="javascript:;"
                                    class="btn btn-outline-dark btn-lg ms-3 px-md-5 rounded-5">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7"> <img src="{{ asset('/') }}assets/images/errors-images/505-error.png"
                            alt="" />
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</body>

</html>
