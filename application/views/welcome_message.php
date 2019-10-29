<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="includes/loginstyle/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="includes/loginstyle/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="includes/loginstyle/css/form-elements.css">
        <link rel="stylesheet" href="includes/loginstyle/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="includes/loginstyle/ico/logo_sa.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/loginstyle/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/loginstyle/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/loginstyle/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>
    
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login</h3>
                                    <p>Informe seu Usuario e senha:</p>
                                    <h3 style="color:red;"><?php echo $this->session->flashdata('alert');?></h3>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-sign-in"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                            <?php echo form_open("login/autenticar"); ?>
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Email</label>
                                        <input type="text" name="email" placeholder="Email..." class="form-username form-control" id="form-email">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn">Loggar!</button>
                                </form>
                            <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center" style="margin-top: 20px;" >
		               <a title="newUser" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#new_User">Ainda nao se Cadastrou ?</a>
	                </div>  


                <!--
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                            <h3>...or login with:</h3>
                            <div class="social-login-buttons">
                                <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                </a>
                            </div>
                        </div>
                    </div>
                -->
                </div>
            </div>
            
        </div>


       <!-- Javascript-->
        <script src="includes/loginstyle/js/jquery-1.11.1.min.js"></script>
        <script src="includes/loginstyle/bootstrap/js/bootstrap.min.js"></script>
        <script src="includes/loginstyle/js/jquery.backstretch.min.js"></script>
        <script src="includes/loginstyle/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    
<!-- Modal de inserir cliente-->
<div class="modal fade" id="new_User" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header  bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Cadastro de usuario</h4>
      </div>
      <div class="modal-body">
       
  <?php echo form_open('login/cadastro', 'id="form-usuario"'); ?>
    
    <form action="" method="post" ENCTYPE="multipart/form-data">
      <div class="row">
        <div class="form-group col-md-6">
            <label for="nome_usuario">Nome do Usuario</label> 
            <input type="text" class="form-control" id="nome_usuario" name="nome_usuario"
                placeholder="informe o nome do usuario" required
                value="<?php echo isset($view_nome_usuario) ? $view_nome_usuario: '' ; ?>">
        </div>     
        <div class="form-group col-md-6">
            <label for="email_usuario">email</label> 
            <input type="text" class="form-control" id="email_usuario" name="email_usuario"
                placeholder="informe o seu email" required
                value="<?php echo isset($view_email_usuario) ? $view_email_usuario: '' ; ?>">
        </div>
    </div>
    

     <div class="row">
        <div class="form-group col-md-6">
            <label for="password2">Senha</label> 
            <input type="text" class="form-control" id="password2" name="password2"
                placeholder="repita a senha" required
                value="<?php echo isset($view_password2) ? $view_password2: '' ; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="password">Confirme a Senha</label> 
            <input type="text" class="form-control" id="password" name="password"
                placeholder="informe uma senha" required
                value="<?php echo isset($view_password) ? $view_password: '' ; ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="tipo_usuario">Voce é</label> 
            <select class="custom-select" id="tipo_usuario" name="tipo_usuario">
                <option selected value="1">Estudante</option>
                <option value="2">Professor</option>
                <option value="3">Funcionario</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="sexo">Sexo</label> 
            <select class="custom-select" id="sexo_select" name="sexo_select">
                <option selected value="1">Feminino</option>
                <option value="2">Masculino</option>
            </select>
        </div>
    </div>

    <div class="row">
        
        <div class="form-group col-md-6">
            <label for="idade">Idade</label> 
            <input type="text" class="form-control" id="idade" name="idade"
                placeholder="informe uma idade" required
                value="<?php echo isset($view_idade) ? $view_idade : '' ; ?>">
        </div>
    </div>

        <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" name="btsalvar" value="Salvar" /> 
                <a onClick="history.go(-1)" class="btn btn-default">Cancelar</a>
        </div>

    <?php echo form_close(); ?>

		</div>

      </div>
    </div>
  </div>
</div> <!-- /.modal -->

    </body>

</html>
