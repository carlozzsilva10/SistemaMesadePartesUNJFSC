<?php 
	include("auth.php");
	include("menu_personal.php");
	include("conexion.php");
	$email = $_SESSION["usuario_personal"];
    $sql = "SELECT c.*, u.*, f.nombre AS nombre_facultad, con.nombre AS nombre_condicion, cat.nombre AS nombre_categoria, car.nombre AS nombre_cargo FROM tbcliente c
                JOIN tbusuario u ON c.idcliente = u.idcliente
                LEFT JOIN tbfacultad f ON c.idfacultad = f.idfacultad
                LEFT JOIN tbcondicion con ON c.idcondicion = con.idcondicion
                LEFT JOIN tbcategoria cat ON c.idcategoria = cat.idcategoria
                LEFT JOIN tbcargo car ON c.idcargo = car.idcargo
                WHERE u.email = '$email'";
	$fila = mysqli_query($cn,$sql);
	$r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estilopersonal.css">
    </head>
    <body>
        <h3>
            BIENVENIDO(A) <?php echo $r["nombre"]." ".$r["appaterno"]." ".$r["apmaterno"];?>
        </h3>
        </center>
		<table align = "center">
			<tr>
				<td rowspan = "6">
					<center>
						<img src = "imgpersonal/<?php echo $r["email"];?>.jpg" width = "180" height = "180">
					</center>
				</td>
				<td><b>DNI</b></td>
				<td><?php echo $r["nrodocumento"];?></td>
			</tr>
            <tr>
				<td><b>CÓDIGO ADMINISTRATIVO/DOCENTE</b></td>
				<td><?php echo $r["codigo"];?></td>
			</tr>
            <tr>
                <td><b>DIRECCIÓN</b></td>
                <td colspan = "2"><?php echo $r["direccion"];?></td>
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
                    <td><b>CONDICIÓN</b></td>
                    <td colspan = "2"><?php echo $r["nombre_condicion"];?></td>
                </tr>
                <tr>
                    <td><b>CATEGORIA</b></td>
                    <td colspan = "2"><?php echo $r["nombre_categoria"];?></td>
                </tr>
                <tr>
                    <td><b>FACULTAD</b></td>
                    <td colspan = "2"><?php echo $r["nombre_facultad"];?></td>
                </tr>
                <tr>
                    <td><b>CARGO</b></td>
                    <td><b>AÑO DE INGRESO</b></td>
                    <td><b>GRADO</b></td>
                </tr>
                <tr>
                    <td><?php echo $r["nombre_cargo"];?></td>
                    <td><?php echo $r["yearingreso"];?></td>
                    <td><?php echo $r["ciclo_grado_nivel"];?></td>
                </tr>
            </table>
        <?php
            }
        ?>
    </body>
</html>