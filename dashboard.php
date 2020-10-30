<?php
require_once 'clases/RepositorioUsuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
   $usuario = unserialize($_SESSION['usuario']);
   $nomApe = $usuario->getNombreApellido();
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
      <title>Home</title>
   </head>
   <body>
   <div>
         <div class="container-fluid">
            <div class="row justify-content-beetween bg-warning fluid">
               <div class="col-9">
                  <div class="nav-scroller bg-warning shadow  d-lg-flex pt-2 pb-2">
                     <?php
                        $e = new RepositorioUsuario();
                        if ($usuario->getUsuario()  == $e->dueno() ){
                           echo 
                           '<a href="dashboardOwner.php" style="text-decoration:none;">
                          <input type="button" class="btn nav-link btn-outline-primary my-2 my-sm-0 mt-2 mr-2 mb-3" 
                           value="Sección principal">
                           </a>';
                        }
                     ?>
                     <input type="button" class="btn nav-link btn-outline-primary my-2 my-sm-0 mt-2 mr-2 mb-3"  value="Buscar productos"></input>
                     <input type="button" class="btn nav-link btn-outline-primary my-2 my-sm-0 mt-2 mr-2 mb-3" onclick="location.href='agregarProducto.php'" value="Agregar Productos"></input>
                     <input type="button" class="btn btn-outline-primary my-2 my-sm-0 mt-2 mr-2 mb-3" onclick="location.href='actualizarStock.php'" value="Actualizar stock"></input>
                  </div>
               </div>
               <div class="col-3">
                  <?php
                  echo '<p>Bienvenido ' . $usuario->getNombre(); 
                  ?>
                     <input class="btn btn-primary text-white" type="button" value="Cerrar sesión" onclick="location.href='logout.php'">  
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
               <h3 class="mb-4">
                  Buscar productos
               </h3>
               <div >
                  <input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg mb-3" placeholder="Nombre de producto">
                  <input type="button" onclick="busqueda();" class="btn btn-outline-success my-2 my-sm-0" value="Buscar">
               </div>
            </div>
            <div class="col-6">
               <div class="card text-center mb-4">
                  <div class="card-header">
                     <h5 class="card-title">Sus resultados se veran aquí</h5>
                  </div>
                  <div class="card-body" style="overflow-y:auto; max-height: 450px;">
                     <div id="resultados" class="card-text"><p>Esperando tareas</p></div>
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