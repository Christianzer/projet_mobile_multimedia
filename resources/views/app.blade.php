<!DOCTYPE html>
<?php
$util = session('utilisateur');
?>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/img/edu1.png')}}">
    <title>Gestion des Messages</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body id="page-top">

<div id="app">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SECRETAIRE PRINCIPAL<sup class="text-secondary">SP</sup></div>
            </router-link>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <router-link class="nav-link" to="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span class="text-uppercase">Tableau de Bord</span>
                </router-link>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <router-link class="nav-link collapsed" to="/classe">
                    <i class="fas fa-fw fa-cog"></i>
                    <span class="text-uppercase">Gestion des classes</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link collapsed" to="/etudiant">
                    <i class="fas fa-fw fa-cog"></i>
                    <span class="text-uppercase">Gestion des etudiants</span>
                </router-link>
            </li>

            <li class="nav-item">
                <router-link class="nav-link collapsed" to="/message_etudiant">
                    <i class="fas fa-fw fa-cog"></i>
                    <span class="text-uppercase">Gestion message etudiant</span>
                </router-link>
            </li>


            <li class="nav-item">
                <router-link class="nav-link collapsed" to="/message_classe">
                    <i class="fas fa-fw fa-cog"></i>
                    <span class="text-uppercase">Gestion message classe</span>
                </router-link>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('login.admin')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span class="text-uppercase">Deconnexion</span>
                </a>
            </li>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                            <h1 class="h3 mb-0 text-gray-800 text-primary">{{$util[0]->nom}} {{$util[0]->prenoms}} </h1>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <router-view></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
