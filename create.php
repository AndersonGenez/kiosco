<?php
   require_once 'clases/ControladorSesion.php';
   if (isset($_POST['usuario']) && isset($_POST['clave'])) {
       $cs = new ControladorSesion();
       $result = $cs->create($_POST['usuario'], $_POST['nombre'], 
       $_POST['apellido'], $_POST['clave']);
       if( $result[0] === true ) {
           $redirigir = 'dashboard.php?mensaje='.$result[1];
       }
       else {
           $redirigir = 'create.php?mensaje='.$result[1];
       }
       header('Location: ' . $redirigir);
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <title>Bienvenido al sistema</title>
      <link rel="stylesheet" href="bootstrap.min.css">
      <link rel="icon" href="favicon.ico">
   </head>
   <body class="bg-lighht">
      <div class="header text-center bg-primary mb-4">
         <h1>Administración de local</h1>
      </div>
      <div class="container">
      <div class="row justify-content-center">
         <div class="col-4">
            <?php
               if (isset($_GET['mensaje'])) {
                 echo '<div id="mensaje" class="alert alert-primary text-center">
                 <p>'.$_GET['mensaje'].'</p>
                 </div>';
               }
               ?>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-4">
            <div class="card text-center mb-4">
               <div class="card-header bg-warning">
                  <h3>Registrarse</h3>
               </div>
               <div class="card-body" style="overflow-y:auto; max-height: 450px;">
                  <form action="create.php" method="post">
                     <input name="usuario" class="form-control form-control-lg" placeholder="Usuario"><br>
                     <input name="clave" type="password" class="form-control form-control-lg" placeholder="Contraseña"><br>
                     <input name="nombre" class="form-control form-control-lg" placeholder="Nombre"><br>
                     <input name="apellido" class="form-control form-control-lg" placeholder="Apellido"><br>
                     <div class=" mt-3 mb-3">
                        <input type="submit" value="Registrarse" class="btn btn-primary">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>