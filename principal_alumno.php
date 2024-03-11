<?php 
	include("auth.php");
	include("menu_alumno.php");
	include("conexion.php");
	$email = $_SESSION["usuario_alumno"];
	$sql = "SELECT c.*, u.*, e.nombre AS nombre_escuela, f.nombre AS nombre_facultad FROM tbcliente c
                JOIN tbusuario u ON c.idcliente = u.idcliente
                LEFT JOIN tbescuela e ON c.idescuela = e.idescuela
                LEFT JOIN tbfacultad f ON c.idfacultad = f.idfacultad
                WHERE u.email = '$email'";
	$fila = mysqli_query($cn,$sql);
	$r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estiloalumno.css">
    </head>
    <body>
        <h3>
            BIENVENIDO(A) <?php echo $r["nombre"]." ".$r["appaterno"]." ".$r["apmaterno"];?>
        </h3>
		<table align = "center">
			<tr>
				<td rowspan = "6">
					<center>
						<img src = "imgalumno/<?php echo $r["email"];?>.jpg" width = "180" height = "180">
					</center>
				</td>
				<td><b>DNI</b></td>
				<td><?php echo $r["nrodocumento"];?></td>
			</tr>
            <tr>
				<td><b>CÓDIGO UNIVERSITARIO</b></td>
				<td><?php echo $r["codigo"];?></td>
			</tr>
            <tr>
                <td><b>DIRECCIÓN</b></td>
                <td><?php echo $r["direccion"];?></td>
            </tr>
			<tr>
				<td><b>DISTRITO</b></td>
				<td><?php echo $r["distrito"];?></td>
			</tr>
            <tr>
				<td><b>TELÉFONO</b></td>
				<td><?php echo $r["telefono"];?></td>
			</tr>
			<tr>
				<td><b>CELULAR</b></td>
				<td><?php echo $r["celular"];?></td>
			</tr>
		</table>
        <br>
		<?php
            if ($r["estado"] == 0) {
                echo "<center><h2>Actualiza tus datos personales</h2></center>";
            } else {
        ?>
        <table align = "center">
            <tr>
                <td><b>ESCUELA</b></td>
                <td colspan = "2"><?php echo $r["nombre_escuela"];?></td>
            </tr>
            <tr>
                <td><b>FACULTAD</b></td>
                <td colspan = "2"><?php echo $r["nombre_facultad"];?></td>
            </tr>
            <tr>
                <td><b>AÑO DE INGRESO</b></td>
                <td><b>MODALIDAD</b></td>
                <td><b>CICLO</b></td>
            </tr>
            <tr>
                <td><?php echo $r["yearingreso"];?></td>
                <td><?php echo $r["modalidad"];?></td>
                <td><?php echo $r["ciclo_grado_nivel"];?></td>
            </tr>
        </table>
        <?php
            }
        ?>
    </body>
</html>