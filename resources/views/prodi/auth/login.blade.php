@extends('layouts.auth')


@section('content')
    login


    <script>
        var myHeaders = new Headers();
        myHeaders.append("debug", "true");
        myHeaders.append("Authorization",
            "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzNyIsImp0aSI6IjA1OTYxNjYzNjkxOGNkZTc0YWEwYmUwMzVjNmZkYzIyY2I3NDdlNTM3ZjU4OGE1NjA0YzViMGRlZTMwOGExNWM2ODI1YjNjN2YyZDhlMGVhIiwiaWF0IjoxNjk4MDI4ODM4LjgxODM4MiwibmJmIjoxNjk4MDI4ODM4LjgxODM4NywiZXhwIjoxNjk4MTE1MjM4LjgxMjIwNywic3ViIjoiIiwic2NvcGVzIjpbXX0.c0e3MM-M-Z5CgVts0F_GEZhBtzkRdU1W4_mz1CM-6lsoE4Kw47c8yqL8p1TJM2_TWXusTfEF3SxR4o2F60nbMwrUnB6XGyRCqdrxKqSAdgOByNdPvni0NxadRAu-b5Up0XVwN0uaKhV6qAns9LTVV7gVXydQNOAk6uqjQ3Mi4ruQ1UWaiSvWg4PAoOvnRSWG1QTURTZUgo2fJtoCqlDxqkbGk_5xm7Eu9YPcq8wBB0tp6IS0m3Eacqypj4nSF5kf9F9A1esVNzv26rS-SwuAEa_WYw58g1YliITrOr_ODZui4rFYVLscWHDTyNrY5i2pgjpQdzIM5dIKKxWFA_F7K5oRHlsNfoNg8s5nvk6Hrl6KtCBDQoO7WDdMt-4n6VOYUdW5klLyCWMC12YN4xWNY6XUZUVF2HAohWBmaMeuaTo9IqWCMfBksnslZ2rDn12ikTKaZ5Zg9w4w1UNd5J-9DM6ykps639jFAy14ooGW__Y2X-_AvmDoG1zkk6yQaedKot65h_ORRTrbvLXVnfGpWuqc3LSPH6zS7BhdO2gcnqoeLC7Aaz53Y6_5aorQTzEqlpgqUZTzq7iqkzk4n4eHQ0zleUepHZ1DYx2fIQkgIiGOAXcwevuu-bmsybrj8kz8T7Hl2s4pVZBLi06RYA20sx65BGH-zr2LRJ_AJvp3nIY"
        );
        myHeaders.append("Cookie",
            "XSRF-TOKEN=eyJpdiI6InRxTG9hYTJzVXQ4OU53Zm10aDVmaWc9PSIsInZhbHVlIjoiM3lYOVJnSE9KUmxCQml6a0hNVVcxSWtuSDZwQjUwYjVudER2THJVZnVMaXlCaTliRkpPVHEwWWcwTm85eXA4eG1qRTFYTWwvMkdsUFlJcU9nMlFBa2Q1QUZsNWtJSm9sekVpb0RyL3dhNWlSa1R6TGZmZEoyUEhDQ3NiSENTaUciLCJtYWMiOiJiZDc3ODY0OTY4Mjg2N2VmZTVmNDM3ZWQwMzlmMWVmYjdmYzFjZmY0ZmUxNjk3ZDZiZjcyYWYxN2UzNjAxOGYzIn0%3D; laravelapipolije_session=eyJpdiI6Ii9YRkZsQi80bFg3cjNoYmlWRHd5NEE9PSIsInZhbHVlIjoiM25mSmdmTTlZVEtLQURaYUpVYVBtWjRJWnhRYU5FSDBEcVRHenhyTmJvT0FiUS9XbUZHUW5yQ2w5MitTMC9XNUxzeld2L0Q1SURTeGZ4N3lvMFBxZC83ejQ2QmhXUVJHekJnMGx5V2dIbENoRnlZQlRJdEU3SGxrNVpXUVk5UnoiLCJtYWMiOiI1MTk1ZDUzNTMzNzk5Nzk2ZmM4YTA3Mzg1M2YxNDI2M2MwMWRkMDkzM2Y1MDYyYTg0MzkwMzJiOWY3MTlmZTNiIn0%3D"
        );

        var urlencoded = new URLSearchParams();

        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            body: urlencoded,
            redirect: 'follow'
        };

        fetch("http://api.polije.ac.id/resources/akademik/mahasiswa?nim=e41211674", requestOptions)
            .then(response => response.text())
            .then(result => console.log(result))
            .catch(error => console.log('error', error));
    </script>
@endsection
