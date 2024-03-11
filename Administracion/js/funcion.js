function cargarInfo() {
	// Crear una variable httprequest
	var xmlhttp;

	// Recepcionar el valor que se escribe en la caja de texto  y lo guardamos en una variable
	var n = document.getElementById("caja").value;

	// Si caja de texto esta vacía, el div resultado debe limpiarse
		if (n == '') {
			document.getElementById("resultado").innerHTML = '';
		}

	// Generar nuestro objeto xmlhttprequest;
		if(window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

	// Cuando el objeto está listo, realiza la acción de mostrar el resultado
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("resultado").innerHTML = xmlhttp.responseText;
		} else {
			document.getElementById("resultado").innerHTML='<img src = "../asset/img/loading.gif" width = "40" height = "40">';
		}
	}
	xmlhttp.open("POST","../controller/c_busqueda.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("valor="+n);
}