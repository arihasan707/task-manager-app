<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Task Manager</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

    <!-- Vendor CSS Files -->
    <link href="backend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="backend/vendor/DataTables/datatables.min.css" />
    <link href="backend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="backend/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="backend/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="backend/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="backend/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="backend/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="backend/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-5" href="#" data-bs-toggle="dropdown">
                        <img src="backend/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{auth()->user()->nama}}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{auth()->user()->nama}}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" id="logOut" href="{{route('logout')}}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>

                            <form action="{{route('logout')}}" method="post" class="d-none off">
                                @csrf
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->

    <main id="main" class="main">

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2 class="bold">Task Manager</h2>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Task
                    </button>
                </div>
                @if (session('sukses'))
                <div class="alert alert-success" role="alert">
                    {{ session('sukses') }}
                </div>
                @endif
                @error('task')
                <div class="alert alert-danger" role="alert">
                    Gagal menyimpan! {{ $message }}
                </div>
                @enderror
                @error('foto')
                <div class="alert alert-danger" role="alert">
                    Gagal menyimpan! {{ $message }}
                </div>
                @enderror
                <div class="card1 ">
                    <table class="ui celled table" style=" width:100%; padding:0px;">
                        <thead>
                            <tr style=" background-color:#0d6efd; color:white;">
                                <th>No.</th>
                                <th>Tgl/Waktu</th>
                                <th>Nama Tugas</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr id="index_{{$task->id}}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>{{ $task->nama }}</td>
                                <td>{{ $task->deskripsi }}</td>
                                <td><img src="{{ asset('upload/' . $task->foto)}}" alt="foto" width="140px"></td>
                                <td id="status_{{$task->id}}">@if ($task->status == 1)
                                    <span class="badge rounded-pill text-bg-success">Selesai</span>
                                    @else
                                    <span class="badge rounded-pill text-bg-danger">Belum Selesai</span>
                                    @endif
                                </td>
                                <td id="ok_{{$task->id}}" class="d-content">
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-success btn-sm selesai m-1" data-id="{{$task->id}}"><i class="bx bx-check"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm delete m-1" data-id="{{$task->id}}"><i class="bx bx-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tugas Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('simpanTask')}}" method="post" id="task" enctype="multipart/form-data">
                            @csrf
                            <div class=" mb-2">
                                <label for="exampleFormControlInput1" class="form-label bold">Nama Tugas :</label>
                                <input type="text" name="task" placeholder="Masukan nama tugas" class="form-control">
                            </div>
                            <div class=" mb-2">
                                <label for="exampleFormControlInput1" class="form-label bold">Deskripsi :</label>
                                <input type="text" name="deskripsi" placeholder="Masukan deskripsi" class="form-control">
                            </div>
                            <div class=" mb-2">
                                <label for="exampleFormControlInput1" class="form-label bold">Masukan Foto :</label>
                                <input type="file" name="foto" placeholder="Masukan deskripsi" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </main><!-- ======= Footer ======= -->



    <footer id="footer" class="footer">
        <div class="copyright">

        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script type="text/javascript" src="backend/js/jquery.js"></script>
    <!-- Vendor JS Files -->
    <script type="text/javascript" src="backend/vendor/DataTables/datatables.min.js">
    </script>
    <script src="backend/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="backend/vendor/chart.js/chart.min.js"></script>
    <script src="backend/vendor/echarts/echarts.min.js"></script>
    <script src="backend/vendor/quill/quill.min.js"></script>
    <script src="backend/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="backend/vendor/tinymce/tinymce.min.js"></script>
    <script src="backend/vendor/sweet/sweetalert2.all.min.js"></script>

    <!-- sweetalert -->


    <!-- Template Main JS File -->
    <script>
        $(document).ready(function() {
            $('#inbox').DataTable();
        });

        $('#inbox').DataTable({
            responsive: true
        });
    </script>

    <script>
        $('#logOut').on('click', function(e) {
            e.preventDefault();
            $('.off').submit();
        })

        $(document).ready(function() {

            $('.delete').on('click', function(e) {
                e.preventDefault()
                const id = $(this).data('id')
                Swal.fire({
                    title: "Yakin ingin hapus data ini?",
                    text: "Data akan terhapus permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#6c757d",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Ya Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "DELETE",
                            url: "/home/" + id,
                            success: function(response) {
                                console.log(response);
                                Swal.fire({
                                    title: "Terhapus!",
                                    text: response.message,
                                    icon: "success"
                                });

                                $('#index_' + id).remove();
                            }
                        });
                    }
                })
            })

            $('.selesai').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id')
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "PUT",
                    url: "/home/" + id,
                    data: {
                        "status": 1
                    },
                    success: function(response) {

                        $('#status_' + id).html(
                            "<span class='badge rounded-pill text-bg-success'>Selesai</span>"
                        );
                    }
                });
            })

        })
    </script>




</body>

</html>