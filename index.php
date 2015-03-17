</body>
</html>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MORELLI - Modulo de Ventas On-Line</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="http://morelli.com.ar/sitio/"><b>Morelli</b><br>[Modulo de Ventas Web]</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Inicia sesion para ingresar al sitio</p>
        <form action="LogIn.php" method="POST">
        <?php 
        if($_GET["estado"]=="error"){
          ?>
          <div class="form-group has-feedback has-error">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" id="user" name="user" placeholder="Usuario"/>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
             </div>
             <div class="form-group has-feedback">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Clave"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
             </div>
             <label class="control-label" for="user pass"><i class="fa fa-times-circle-o"></i> Usuario o clave incorrecta</label>
           </div>
           <?php
        }else{
          ?>
            <div class="form-group has-feedback">
              <input type="text" class="form-control" id="user" name="user" placeholder="Usuario"/>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
             </div>
             <div class="form-group has-feedback">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Clave"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
             </div>
           <?php
        }
          
            ?>
          
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" id="chk_rec" name="chk_rec"> Recordar Contraseña
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
       

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>