var descripcion = document.getElementById("descripcion");
var consola = document.querySelector('#resultados');
var resultadoU = document.getElementsByTagName('p');

function vaciar() {
	while (consola.firstChild) {
		consola.removeChild(consola.firstChild);
	}
}

function limpiar() { // función del botón limpiar, despeja la consola
	var consola = document.getElementById("resultados");
	vaciar();
	consola.innerHTML = "Esperando tareas";
}
//
//En el inventario entran todos los productos cuyo stock sea mínimo, en este caso menos de 10
//El dueño del local allí sabrá qué productos debe comprar para abastecer el negocio
// 
function inventario() {
	var xhr = new XMLHttpRequest();

	//Definimos qué habrá que hacer cuando cambie la propiedad onreadystate:
	xhr.onreadystatechange = function () {

		//Si salió todo bien...
		if (this.readyState == 4 && this.status == 200) {

			respuestaInv = JSON.parse(this.responseText);
			vaciar(); //Se despeja la bandeja de resultados antes de llenarla

			//Creamos una pequeña tabla como titulo de los datos mostrados
			var top = document.createElement('table');
			top.setAttribute('class', 'table');
			var col1 = document.createElement('th');
			var col2 = document.createElement('th');
			var txt1 = document.createElement('p');
			var txt2 = document.createElement('p');
			txt1.innerHTML = "Stock";
			txt2.innerHTML = "Productos que se deben reponer";
			col1.appendChild(txt1);
			col2.appendChild(txt2);
			top.appendChild(col1);
			top.appendChild(col2);
			consola.appendChild(top);

			//Se arrojan los resultados en la bandeja de resultados
			for (let i = 0; i < Object.keys(respuestaInv).length; i++) {
				console.log(respuestaInv[i].nombre, respuestaInv[i].stock);
				resultFila = document.createElement('div');
				contenido = document.createElement('p');
				resultFila.appendChild(contenido);
				espacio = "\xa0 \xa0 \xa0 \xa0 \xa0";
				contenido.innerHTML = respuestaInv[i].stock + espacio + espacio + espacio + respuestaInv[i].nombre;
				resultFila.className = "card-text alert alert-primary text-left";
				consola.appendChild(resultFila);
			}
		}
	};
	xhr.open("GET", "recibidor.php?prueba=" + "bandera", true);
	xhr.send();
}

function busqueda() {
	var Busqueda = new XMLHttpRequest();

	//Definimos qué habrá que hacer cuando cambie la propiedad onreadystate:
	Busqueda.onreadystatechange = function () {

		//Si salió todo bien...
		if (this.readyState == 4 && this.status == 200) {
			//Interpretamos el JSON que llegó como respuesta de PHP
			//         var resultados =  this.response;
			respBusqueda = JSON.parse(this.responseText);
			vaciar(); //Se despeja la bandeja de resultados antes de llenarla

			var top = document.createElement('table');
			top.setAttribute('class', 'table');
			var col1 = document.createElement('th');
			var col2 = document.createElement('th');
			var txt1 = document.createElement('p');
			var txt2 = document.createElement('p');
			txt1.innerHTML = "Precio";
			txt2.innerHTML = "Producto";
			col1.appendChild(txt1);
			col2.appendChild(txt2);
			top.appendChild(col1);
			top.appendChild(col2);
			consola.appendChild(top);

			//Se arrojan los resultados en la bandeja de resultados
			for (let i = 0; i < Object.keys(respBusqueda).length; i++) {
				console.log(respBusqueda[i].precio, respBusqueda[i].descripcion);
				resultFila = document.createElement('div');
				contenido = document.createElement('p');
				resultFila.appendChild(contenido);
				espacio = "\xa0 \xa0 \xa0 \xa0 \xa0";
				contenido.innerHTML = respBusqueda[i].precio + espacio + espacio + espacio + respBusqueda[i].descripcion;
				resultFila.className = "card-text alert alert-primary text-left";
				consola.appendChild(resultFila);
			}

		}
	};
	Busqueda.open("GET", "buscar.php?descripcion=" + descripcion.value, true);
	Busqueda.send();
}


function borrar(id) {

	xhrBorrar = new XMLHttpRequest();

	//Definimos qué habrá que hacer cuando cambie la propiedad onreadystate:
	xhrBorrar.onreadystatechange = function () {

		//Si salió todo bien...
		if (this.readyState == 4 && this.status == 200) {
			if (this.response == true) {
				limpiar();
				consola.innerHTML = "El usuario ha sido borrado";
			}
			if (this.response == false) {
				alert("algo salió mal");
			}
		}
	}
	xhrBorrar.open("GET", "borrador.php?borrar=" + id, true);
	xhrBorrar.send();
}

function administradores() {
	xhrAdmin = new XMLHttpRequest();

	//Definimos qué habrá que hacer cuando cambie la propiedad onreadystate:
	xhrAdmin.onreadystatechange = function () {

		//Si salió todo bien...
		if (this.readyState == 4 && this.status == 200) {

			var respuesta = JSON.parse(this.responseText);

			vaciar(); //Se despeja la bandeja de resultados antes de llenarla

			//Creamos una pequeña tabla como titulo de los datos mostrados
			var top = document.createElement('table');
			top.setAttribute('class', 'table');
			var col1 = document.createElement('th');
			var col2 = document.createElement('th');
			var txt1 = document.createElement('p');
			var txt2 = document.createElement('p');
			txt1.innerHTML = "Nombre";
			txt2.innerHTML = "Usuario";
			col1.appendChild(txt1);
			col2.appendChild(txt2);
			top.appendChild(col1);
			top.appendChild(col2);
			consola.appendChild(top);

			//Se arrojan los resultados en la bandeja de resultados
			for (let i = 0; i < Object.keys(respuesta).length; i++) {
				console.log(respuesta[i].nombre, respuesta[i].usuario);
				resultFila = document.createElement('div');
				contenido = document.createElement('p');
				var deleteB = document.createElement('input');
				deleteB.setAttribute('type', 'button');
				deleteB.setAttribute('value', 'borrar');
				deleteB.setAttribute('class', 'btn btn-danger');
				deleteB.setAttribute('onclick', 'borrar(' + respuesta[i].id + ');');
				resultFila.appendChild(contenido);
				espacio = "\xa0 \xa0 \xa0 \xa0 \xa0";
				contenido.innerHTML = respuesta[i].nombre + espacio + espacio + espacio + espacio + respuesta[i].usuario;
				resultFila.className = "card-text alert alert-primary text-left";
				resultFila.appendChild(deleteB);
				consola.appendChild(resultFila);
			}
		}
	};
	xhrAdmin.open("GET", "delete.php?bandera=" + "tal", true);
	xhrAdmin.send();
}


function listaStock() {
	var bandeja = document.querySelector('#resultados');

	var xhrListaStock = new XMLHttpRequest();
	//Definimos qué habrá que hacer cuando cambie la propiedad onreadystate:
	xhrListaStock.onreadystatechange = function () {

		//Si salió todo bien...
		if (this.readyState == 4 && this.status == 200) {
			respuesta = JSON.parse(this.response);
			vaciar(); //Se despeja la bandeja de resultados antes de llenarla

			var top = document.createElement('table');
			top.setAttribute('class', 'table');
			var col1 = document.createElement('th');
			var col2 = document.createElement('th');
			var txt1 = document.createElement('p');
			var txt2 = document.createElement('p');
			txt1.innerHTML = "Stock";
			txt2.innerHTML = "Producto";
			col1.appendChild(txt1);
			col2.appendChild(txt2);
			top.appendChild(col1);
			top.appendChild(col2);
			bandeja.appendChild(top);

				//Se arrojan los resultados en la bandeja de resultados
			for (let i = 0; i < Object.keys(respuesta).length; i++) {
				console.log(respuesta[i].stock, respuesta[i].descripcion);
				resultFila = document.createElement('div');
				contenido = document.createElement('p');
				var actualizarB = document.createElement('input');
				actualizarB.setAttribute('type', 'button');
				actualizarB.setAttribute('value', 'Actualizar Stock');
				actualizarB.setAttribute('class', 'btn btn-primary');
				actualizarB.setAttribute('onclick', 'location.href="actualizarStock.php?actualizar=' + respuesta[i].id + "\"");
				resultFila.appendChild(contenido);
				espacio = "\xa0 \xa0 \xa0 \xa0 \xa0";
				contenido.innerHTML = respuesta[i].stock + espacio + espacio + espacio + respuesta[i].descripcion;
				resultFila.className = "card-text alert alert-primary text-left";
				resultFila.appendChild(actualizarB);
				bandeja.appendChild(resultFila);
			}
		}
	};
	xhrListaStock.open("GET", "administradorDeStocks.php?descripcion=" + descripcion.value, true);
	xhrListaStock.send();
}