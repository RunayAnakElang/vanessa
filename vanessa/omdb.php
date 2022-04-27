<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="input-group mb-3">
                    <input type="text" id="input_key" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button class="btn btn-primary" id="cari">Cari</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="movie-list">

                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $("#cari").click(function() {
                // console.log('tombol berhasil di tekan');
                $.ajax({
                    url: "http://omdbapi.com/",
                    dataType: "JSON",
                    type: "get",
                    data: {
                        "apikey": "84625a75",
                        "s": $("#input_key").val()
                    },
                    success: function(result) {
                        // console.log(result);
                        let movies = result.Search;
                        $('#movie-list').html('');
                        if (result.Response == "True") {
                            $.each(movies, function(i, data) {
                                $('#movie-list').append(`<div class="col-md-12 mb-3">
                                                        <div class="card" style="width: 18rem;">
                                                        <img src="` + data.Poster + `" class="card-img-top" height="300px">
                                                        <div class="card-body"><h5 class="card-title">` + data.Title + `</h5>
                                                        <p class="card-text">Year : ` + data.Year + `</p>
                                                        <button id="btn-details" data-id="` + data.imdbID + `" class="btn btn-primary">Details</button>
                                                        </div></div></div>
                                                    `);
                            });


                            $('#btn-details').click(function() {
                                // alert($(this).data('id'));
                                $.ajax({
                                    url: "http://omdbapi.com/",
                                    dataType: "JSON",
                                    type: "get",
                                    data: {
                                        "apikey": "84625a75",
                                        "i": $(this).data('id')
                                    },
                                    success: function(result) {
                                        console.log(result);

                                        Swal.fire({
                                            title: result.Actors,
                                            text: result.Plot,
                                            imageUrl: result.Poster,
                                            imageWidth: 200,
                                            imageHeight: 400,
                                            imageAlt: 'Custom image',
                                        })
                                    }
                                })
                            })




                        } else {
                            $('#movie-list').append(`
                                    <div class="col-sm-12 text-center">
                                        <h1>` + result.Error + `</h1>
                                    </div>
                                `);
                        }
                    }
                })
            })
        })
    </script>
</body>

</html> 