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
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Select2 -->
</head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
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
        @guest
        <div class="float-right">
        <form action="{{route('login')}}" method="post">
       @csrf
       @method('post')
       <button class="btn btn-primary">Se connecter</button>
       </form>   
      </div>
       @endguest
       <div class="float-right" style="margin-left:850px;margin-top:15px;">
       <form action="{{route('logout')}}" method="post" class="form-group">
         @csrf
         @method('post')
         <button class="btn btn-danger form-control">
           Se Deconnecter
         </button>
       </form>
      </div>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('users.informations')}}" class="brand-link">
          <img src="{{asset('images/rh.png')}}" alt="Rh Image" class="brand-image img-circle elevation-3"
               style="opacity: .8;margin-top:1px;">
          <span class="brand-text font-weight-light" style="font-size:25px;">RH Management</span>
        </a>
        
        <!-- Sidebar -->
        <div class="sidebar" style="height:auto;">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
             @if(auth()->user()->photo)
              <img src="{{asset('upload/employe/'.Auth::user()->photo)}}" class="rounded-circle" alt="Image user" width="50px"height="20px">
              @else
              <img src="{{asset('upload/employe/anonymous.png')}}" class="rounded-circle mt-3" alt="Image user">
              @endif
            </div>
            <div class="info">
              @if(Auth::user())
              <a href="{{route('users.edit',['id' => auth()->user()->id])}}" class="d-block mt-3 ml-1 ">{{Auth::user()->name}} {{Auth::user()->prenom}}</a>
              @endif
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          @if(auth()->user()->role == 'admin')
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview">
                <a href="{{route('users.informations')}}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Tableau de bord
                  </p>
                </a>
                <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link">
                          <i class="fas fa-user-tie"></i>
                          <p class ="ml-2">
                            Utilisateurs
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Les utilisateurs</p>
                            </a>
                          </li>
                        </li>
                    </ul>
                  </nav>
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                           with font-awesome or any other icon font library -->
                      <li class="nav-item has-treeview ">
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
                    <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                        <i class="fas fa-file-contract"></i>
                        <p class ="ml-2">
                          Contrats
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{route('contrats.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Les contrats</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{route('contrats.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ajouter un contrat</p>
                          </a>
                        </li>
                      </li>
                    </ul>
                  </nav>
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                           with font-awesome or any other icon font library -->
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="fas fa-plane"></i>
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
                        <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                            <i class="fas fa-plus"></i>
                            <p class ="ml-2">
                              Soldes
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{route('soldes.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Les soldes</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('soldes.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ajouter un solde</p>
                              </a>
                            </li>
                          </li>
                        </ul>
                      </nav>
                            </nav>
                            @else 
                            <nav class="mt-2">
                              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class
                                     with font-awesome or any other icon font library -->
                                <li class="nav-item has-treeview">
                                  <a href="{{route('users.informations')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                      Tableau de bord
                                    </p>
                                  </a>
                                              <!-- Sidebar Menu -->
                            <nav class="mt-2">
                              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class
                                     with font-awesome or any other icon font library -->
                                  <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                      <!-- Add icons to the links using the .nav-icon class
                                           with font-awesome or any other icon font library -->
                                      <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                          <i class="fas fa-file-contract"></i>
                                          <p class ="ml-2">
                                            Contrats
                                            <i class="right fas fa-angle-left"></i>
                                          </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                          <li class="nav-item">
                                            <a href="{{route('contrats.index')}}" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Les contrats</p>
                                            </a>
                                          </li>
                                        </li>
                                      </ul>
                                    </nav>
                                    <nav class="mt-2">
                                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <!-- Add icons to the links using the .nav-icon class
                                             with font-awesome or any other icon font library -->
                                        <li class="nav-item has-treeview">
                                          <a href="#" class="nav-link">
                                            <i class="fas fa-plane"></i>
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
                                          </li>
                                        </ul>
                                      </nav>
                                      </nav>
                                              </nav>
                                              
                            @endif
    
      <!-- /.sidebar-menu -->
    
    <!-- /.sidebar -->
  </aside>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
           @yield('content')
          </div><!-- /.container-fluid -->
        </section>
       
      <!-- /.content-wrapper -->
    </div>
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 <a href="#">Taha Elmaniari</a>.</strong> Tous les droits sont réservés
    </footer>
  
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
  <!-- Control Sidebar -->
                 <aside class="control-sidebar control-sidebar-dark">
                   <!-- Control sidebar content goes here -->
                </aside>
    <!-- /.content -->
  
    </div>

  
  </body>
    <!-- ./wrapper -->
    
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
