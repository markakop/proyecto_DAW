<link rel='stylesheet' href='../estilos/productos.min.css' type='text/css' />

<?php
include '../bbdd/conexion_bbdd.php';
$eventos = new Consultas();
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: zona-admin.php");
    exit();
}
$datos_eventos = $eventos->obtenerEventosAdmin();
if ($datos_eventos > 0) { ?>
    <table cellpadding="2" cellspacing="0" width="100%">
        <form name="listado">
            <tr>
                <td colspan="6" height="10"></td>
            </tr>
            <tr bgcolor="D9D9D9" class="fixed-row">
                <td height="25"><SPAN CLASS="txtsubtitu">Nombre evento</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Precio</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Fecha</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Activo</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Url compra</SPAN></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" height="5"></td>
            </tr>
            <?php
            $i = 0;
            foreach ($datos_eventos as $evento) {
                $idP = $evento["id"];
                echo '<tr class="lines-colors" bgcolor="BDAC7C">';
                echo '<td valign="top"><input type="text" name="nombre' . $i . '"  value="' . $evento["nombre"] . '" size="30"></td>';
                echo '<td valign="top"><input type="text" name="precio' . $i . '"  value="' . $evento["precio"] . '" size="5"></td>';
                echo '<td valign="top"><input type="text" name="fecha' . $i . '"  value="' . $evento["fecha"] . '" size="20"></td>';
                echo '<td valign="top" class="align-active"><input  type="checkbox" name="active' . $i . '" ' . ($evento["activo"] == "S" ? "checked" : "") . '></td>';
                echo '<td valign="top"><input type="text" size="20" name="url' . $i . '" value="' . $evento["url_compra"] . '"></td>';

                echo '<td class="td-button" valign="top">';
                echo '<input class="btn-modify" type="button" value="Modificar" onclick="modifica(' . $idP . ', ' . $i . ')">&nbsp;';
                echo '</td>';

                echo '<td class="td-button" valign="top">';
                echo '<input class="btn-modify" type="button" value="Borrar" onclick="borra(' . $idP . ')"><br>';
                echo '</td>';

                echo '</tr>';
                echo "\n";
                $i++;
            } ?>
        </form>
    </table>

    <script>
        function modifica(idP, index) {
            var nombre = document.getElementsByName('nombre' + index)[0].value;
            var precio = document.getElementsByName('precio' + index)[0].value;
            var fecha = document.getElementsByName('fecha' + index)[0].value;
            var active = document.getElementsByName('active' + index)[0].checked ? 'S' : 'N';
            var url = document.getElementsByName('url' + index)[0].value;

            var data = {
                id: idP,
                nombre: nombre,
                precio: precio,
                fecha: fecha,
                activo: active,
                url_compra: url
            };

            console.log(data);

            fetch('../bbdd/modificar_evento.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(response => response.json())
                .then(result => {
                    if (result.success) {
                        console.log(result.success);
                    } else {
                        console.log(result.success);
                    }
                });
        }

        function borra(idP) {

            var data = {
                id: idP
            };

            console.log(data);

            if (confirm('¿Está seguro de que desea eliminar este evento?')) {
                fetch('../bbdd/borrar_evento.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    }).then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            console.log(result.success);
                            location.reload();
                        } else {
                            console.log(result.success);
                        }
                    });
            }
        }
    </script>

<?php }
?>