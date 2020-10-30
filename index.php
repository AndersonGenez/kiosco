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
                        <h3>Log In de usuario</h3>
                     </div>
                     <div class="card-body" style="overflow-y:auto; max-height: 450px;">
                        <form action="login.php" method="post">
                           <input name="usuario" class="form-control form-control-lg" placeholder="Usuario"><br>
                           <input name="clave" type="text" class="form-control form-control-lg" placeholder="Contraseña"><br>
                     </div>
                     <div class=" mt-3 mb-3">
                     <input type="submit" value="Ingresar" class="btn btn-primary">
                     </div>
                     <p><a href="create.php">Crear nuevo usuario</a></p>
                     </form>
                  </div>
               </div>
            </div>
      </div>
   </body>
</html>