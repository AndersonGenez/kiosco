<?php
require_once 'clases/RepositorioUsuario.php';

if (isset($_GET['acceso'])) {

	session_start();
	if (isset($_SESSION['usuario'])) {
		$usuario = unserialize($_SESSION['usuario']);
		$nomApe = $usuario->getNombreApellido();


		//$mysqli = new mysqli("localhost", "root", "", "kiosco");
		$e = new RepositorioUsuario();

		if ($usuario->getUsuario() === $e->dueno()) {
			header('Location: dashboardOwner.php');
		}
		elseif(isset($_SESSION['usuario'])) {
			header('Location: dashboard.php');
		}
		else {
			header('Location: index.php');
		}
    }
}