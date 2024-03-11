<?php 
	include("auth.php");
	include("menu_institucion.php");
	include("conexion.php");
	$email = $_SESSION["usuario_institucion"];
	$sql = "SELECT c.*, u.* FROM tbcliente c
                JOIN tbusuario u ON c.idcliente = u.idcliente
                WHERE u.email = '$email'";
	$fila = mysqli_query($cn,$sql);
	$r = mysqli_fetch_assoc($fila);
?>
<!DOCTYPE html>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel = "stylesheet" href = "CSS/Estiloinstitucion.css">
    </head>
    <body>
        <h3>
            BIENVENIDO(A) <?php echo $r["razonsocial"]?>
        </h3>
		<table align = "center">
			<tr>
				<td rowspan = "5">
					<center>
						<img src = "imginstitucion/<?php echo $r["email"];?>.jpg" width = "180" height = "180">
					</center>
				</td>
				<td><b>RUC</b></td>
				<td><?php echo $r["nrodocumento"];?></td>
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
                <td><b>NIVEL</b></td>
                <td colspan = "2"><?php echo $r["ciclo_grado_nivel"];?></td>
            </tr>
        </table>
        <?php
            }
        ?>
    </body>
</html>