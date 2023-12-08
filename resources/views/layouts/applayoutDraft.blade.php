<!doctype html>
<html>
<head>
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  </head>
<body>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link"></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
          </li>
        </ul>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
          <img src="{{asset('images/rh.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">RH</span>
        </a>
        
        <!-- Sidebar -->
        <div class="sidebar" style="height:auto;">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              @if(Auth::user()->photo)
              <img src="{{asset('upload/image/'.Auth::user()->photo)}}" class="img-circle elevation-3" alt="Image user">
              @else
              <img src="{{asset('upload/image/anonymous.png')}}" class="img-circle elevation-3" alt="Image user">
              @endif
            </div>
            <div class="info">
              @if(Auth::user())
              <a href="#" class="d-block ">{{Auth::user()->name}} {{Auth::user()->prenom}}</a>
              @endif
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Tableau de bord
                  </p>
                </a>
                <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                      <a href="#" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p class ="ml-2">
                          Utilisateurs
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{route('users.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>La liste des utilisateurs</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('users.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ajouter un utilisateur</p>
                          </a>
                        </li>
                      </li>
                    </ul>
                  </nav>
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                           with font-awesome or any other icon font library -->
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link">
                          <i class="fas fa-user-tie"></i>
                          <p class ="ml-2">
                            Employes
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{route('employes.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Les employés</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('employes.create')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Ajouter un employé</p>
                            </a>
                          </li>
                        </li>
                      </ul>
                    </nav>
                            <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                      <a href="#" class="nav-link">
                        <i class="fas fa-island-tropical"></i>
                        <p class ="ml-2">
                          Conges
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{route('conges.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Les congés</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('conges.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ajouter un congé</p>
                          </a>
                        </li>
                      </li>
                    </ul>
                  </nav>
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                           with font-awesome or any other icon font library -->
                      <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link">
                          <i class="fa fa-industry" aria-hidden="true"></i>
                          <p class ="ml-2">
                            Sociétés
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{route('conges.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Les congés</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('conges.create')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Ajouter un congé</p>
                            </a>
                          </li>
                        </li>
                      </ul>
                    </nav>
                    <nav class="mt-2">
                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                          <a href="#" class="nav-link">
                            <i class="fas fa-file-contract"></i>
                            <p class ="ml-2">
                              Contrats
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{route('conges.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Les contrats</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('conges.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ajouter un congé</p>
                              </a>
                            </li>
                          </li>
                        </ul>
                      </nav>
                      <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                          <!-- Add icons to the links using the .nav-icon class
                               with font-awesome or any other icon font library -->
                          <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link">
                              <i class="fas fa-lights-holiday"></i>
                              <p class ="ml-2">
                                Conges
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{route('conges.index')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Les congés</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{route('conges.create')}}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ajouter un congé</p>
                                </a>
                              </li>
                            </li>
                          </ul>
                        </nav>
                        <nav class="mt-2">
                          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview menu-open">
                              <a href="#" class="nav-link">
                                <i class="fas fa-lights-holiday"></i>
                                <p class ="ml-2">
                                  Conges
                                  <i class="right fas fa-angle-left"></i>
                                </p>
                              </a>
                              <ul class="nav nav-treeview">
                                <li class="nav-item">
                                  <a href="{{route('conges.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Les congés</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="{{route('conges.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ajouter un congé</p>
                                  </a>
                                </li>
                              </li>
                            </ul>
                          </nav>
                          <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                              <!-- Add icons to the links using the .nav-icon class
                                   with font-awesome or any other icon font library -->
                              <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link">
                                  <i class="fas fa-lights-holiday"></i>
                                  <p class ="ml-2">
                                    Conges
                                    <i class="right fas fa-angle-left"></i>
                                  </p>
                                </a>
                                <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                    <a href="{{route('conges.index')}}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Les congés</p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="{{route('conges.create')}}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Ajouter un congé</p>
                                    </a>
                                  </li>
                                </li>
                              </ul>
                            </nav>
                <!-- /.sidebar-menu -->
              </div>
              <!-- /.sidebar -->
            </aside>
          
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  @yield('content')
                </div>
              </div>
                <!-- /.content-wrapper -->
    <!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<!-- date-range-picker -->
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@yield('js')

</body>


</html>
