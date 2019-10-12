<!DOCTYPE html>

<html>
<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- REQUIRED JS SCRIPTS -->

  <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href= "<?php echo base_url(); ?>includes/plugins/jQueryUI/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
 


  <title>projeto de software</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>includes/layout/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
  page. However, you can choose any other skin. Make sure you
  apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>includes/layout/css/skins/skin-green.min.css">

  
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="lko" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>ar</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SW</b>project</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
    
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account Menu  -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar -
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              hidden-xs hides the username on small devices so only the image appears. -->
              <!--<span class="hidden-xs"><?php print_r (ucwords(($_SESSION['usuario_logado']['username']))); ?> </span>-->
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu  
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              
                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
               Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
               /.row 
              </li>
             Menu Footer -->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) 
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
           Status 
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      -->


      <!-- search form (Optional) 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links 
        <li><a href="http://localhost/sistema/inicio"><i class="fa fa-line-chart"></i> <span>Inicio</span></a></li>-->
				<li><a href="http://localhost/ps/demograficos"><i class="fa fa-folder-open"></i> <span>Questionario Demografico</span></a></li>     
				<li><a href="http://localhost/ps/questoes"><i class="fa fa-folder-open"></i> <span>Cadastrar Questões</span></a></li>     
        <li><a href="http://localhost/ps/questionarios"><i class="fa fa-folder-open"></i> <span>Montar Questionarios</span></a></li>  
				<li><a href="http://localhost/ps/usuarios"><i class="fa fa-folder-open"></i> <span>Usuarios</span></a></li>        
        <li><a href="http://localhost/ps/login/logout" onclick="return confirm('Deseja sair?')">
        <i class="fa fa-sign-out"></i> <span>Sair</span></a>
      </ul>

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div id="inner-content-div">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!--<?php// echo $this->session->flashdata('mensagem');?>-->
         <div id="title" style='text-align:center' ><?= $title ?></div>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">


      <div id="contents"><?= $contents ?></div>

    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<!-- AdminLTE App -->
<script src="<?php echo base_url("includes/layout/js/adminlte.min.js"); ?>"></script>

</body>
</html>

</body>
</html>
