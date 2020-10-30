<?php
   require_once 'clases/RepositorioUsuario.php';
   session_start();
   if (isset($_SESSION['usuario'])) {
      $usuario = unserialize($_SESSION['usuario']);
      $nomApe = $usuario->getNombreApellido();
      //Si el usuario no es el dueño, no se le permitira visitar esta pagina
      $e = new RepositorioUsuario();
      if ($usuario->getUsuario()  != $e->dueno() ){
         header('Location: dashboard.php');
      }
   }
   else {
      header('Location: index.php');
   }
      ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="bootstrap.min.css">
      <link rel="icon" href="favicon.ico">
      <title>Home Dueño</title>
   </head>
   <body>
      <div>
         <div class="container-fluid">
            <div class="row justify-content-beetween bg-warning fluid">
               <div class="col-9">
                  <div class="nav-scroller bg-warning shadow  d-lg-flex pt-2 pb-2">
                     <input type="button" class="btn nav-link btn-outline-primary my-2 my-sm-0 mt-2 mr-2 mb-3" onclick="inventario();" value="Datos de inventario"></input>
                     <input type="button" class="btn nav-link btn-outline-primary my-2 my-sm-0 mt-2 mr-2 mb-3" onclick="administradores();" value="Administrar usuarios"></input>
                     <input type="button" class="btn btn-outline-primary my-2 my-sm-0 mt-2 mr-2 mb-3" onclick="location.href='dashboard.php'" value="Buscar productos"></input>
                  </div>
               </div>
               <div class="col-3">
                  <?php
                     echo '<p>Bienvenido ' . $usuario->getNombre();
                     
                     ?>
                  <a href="logout.php">
                  <input class="btn btn-primary text-white" type="button" value="Cerrar sesión">
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class=" h-25 text-center bg-primary shadow">
         <h2 class="display-4">Area de administración</h2>
      </div>
      <br>
      <div class="container-fluid" style="max-width:70%;">
         <div class="row justify-content-center">
            <div class="col-6">
                  <div class="alert alert-info">
                     <h4>Inicie navegando por las opciones que aparecen arriba</h4>
                  </div>
               </div>
            <div class="col-6">
               <div class="card text-center mb-4">
                  <div class="card-header">
                  <h5 class="card-title">Sus resultados se veran aquí</h5>
                  </div>
                  <div class="card-body" style="overflow-y:auto; max-height: 450px;">
                     <div id="resultados" class="card-text">
                     <?php
                        if (isset($_GET['mensaje'])){
                            echo '<div id="mensaje" class="alert alert-primary text-center">
                                            <p>'.$_GET['mensaje'].'</p>
                                          </div>';
                        } else{
                           echo '<p>Esperando tareas</p>';
                        }
                        ?>
                     </div>
                  </div>
                  <div class=" mt-3 mb-3">
                     <input type="button" href="#" class="btn btn-outline-success my-2 my-sm-0 mt-2" value="Limpiar" onclick="limpiar();">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="script.js"></script>
   </body>
</html>