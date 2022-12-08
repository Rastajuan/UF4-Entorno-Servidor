document
	.getElementById("registrarse")
	.addEventListener("click", validarRegistro);

//Validacion del formulario de registro
function validarRegistro() {
	var usuario = document.getElementById("usuario").value;
	var contrasena = document.getElementById("contrasena").value;
	var repiteContrasena = document.getElementById("repiteContrasena").value;
	var nombre = document.getElementById("nombre").value;
	var apellidos = document.getElementById("apellidos").value;

	if (usuario == "") {
		alert("El campo email es obligatorio");
		return false;
	}

	if (contrasena == "") {
		alert("El campo password es obligatorio");
		return false;
	}

	if (repiteContrasena == "") {
		alert("El campo password2 es obligatorio");
		return false;
	}
	if (nombre == "") {
		alert("El campo nombre es obligatorio");
		return false;
	}
	if (apellidos == "") {
		alert("El campo apellidos es obligatorio");
		return false;
	}

	return true;
}
