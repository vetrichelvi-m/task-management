<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Task Management </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href=""> @php
                        $user = Auth::user();
                    @endphp
                            <div class="small"><b>{{ $user->name }}</b></div>
                        </a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="{{ route('task.create') }}" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Task
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        {{-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div> --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Comment
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>


                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    @php
                        $user = Auth::user();
                    @endphp
                    <div class="small">Logged in as:<b>{{ $user->name }}</b></div>

                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>

                    <div class="card mb-4">

                        <div class="card-body bg-primary">

                            <body class="bg-primary">
                                <div id="layoutAuthentication">
                                    <div id="layoutAuthentication_content">
                                        <main>
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-7">
                                                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                                                            <div class="card-header">
                                                                <h3 class="text-center font-weight-light my-4">Create
                                                                    Task</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form method="POST"
                                                                    action="{{ route('task.store') }}"
                                                                    enctype="multipart/form-data" id="FormID">
                                                                    @csrf
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <div class="form-floating mb-3 mb-md-0">
                                                                                <label
                                                                                    for="inputFirstName">Title</label>
                                                                                <input class="form-control"
                                                                                    name="title" id="inputFirstName"
                                                                                    type="text"
                                                                                    placeholder="Enter your Title" />

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-floating">
                                                                                <textarea name="description" id="description" class="form-control" placeholder="Enter Description"
                                                                                    style="resize: none;"></textarea>
                                                                                <label
                                                                                    for="description">Description</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <div class="form-floating mb-3 mb-md-0">
                                                                                <select name="user_id"
                                                                                    id="assigned_user_id"
                                                                                    class="form-control">
                                                                                    <option value="">Select User
                                                                                    </option>
                                                                                    @foreach ($users as $user)
                                                                                        <option
                                                                                            value="{{ $user->id }}">
                                                                                            {{ $user->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <label
                                                                                    for="inputPasswordConfirm">Assigned
                                                                                    User</label>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-floating mb-3 mb-md-0">
                                                                                <select name="status" id="status"
                                                                                    class="form-control">
                                                                                    <option value="">Select
                                                                                        Status</option>
                                                                                    <option value="open">Open
                                                                                    </option>
                                                                                    <option value="in_progress">In
                                                                                        Progress</option>
                                                                                    <option value="completed">Completed
                                                                                    </option>
                                                                                </select>
                                                                                <label
                                                                                    for="inputPasswordConfirm">Status</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-floating mb-3">
                                                                            <div class="form-group">
                                                                                <label for="assigned_user_id">file
                                                                                    Upload</label>
                                                                                <input class="form-control"
                                                                                    name="file" id="file"
                                                                                    type="file">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="mt-4 mb-0">
                                                                        <div class="d-grid"><button type="submit"
                                                                                class="btn btn-primary btn-block">Create
                                                                                Account</button>
                                                                        </div>

                                                                    </div>

                                                                </form>
                                                            </div>
                                                            <div class="card-footer text-center py-3">
                                                                <div class="small"><button
                                                                        onclick="javascript:window.history.back();">Go
                                                                        Back</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>

                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
                                </script>
                                <script src="js/scripts.js"></script>
                            </body>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>

@include('task.script')
<script>
    $("#FormID").validate({
        rules: {

            'title': {
                required: true
            }
        },

        messages: {

            'title': {
                required: "Enter title"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
</script>
