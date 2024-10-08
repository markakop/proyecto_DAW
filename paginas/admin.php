<link rel='stylesheet' href='../estilos/productos.min.css' type='text/css' />
<title>Zona admin</title>

<?php
include '../bbdd/conexion_bbdd.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: zona-admin.php");
    exit();
}
$eventos = new Consultas();
$datos_eventos = $eventos->obtenerEventosAdmin();
if ($datos_eventos > 0) { ?>
    <style>
        /* Estilos para la imagen flotante */
        .image-popup {
            position: absolute;
            display: none;
            z-index: 100;
            border: 1px solid #ccc;
            background: #fff;
            padding: 5px;
        }

        .image-popup img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>

    <table cellpadding="2" cellspacing="0" width="100%">
        <form name="listado">
            <tr>
                <td colspan="1" height="10"><a class="button-home" href="../paginas/home.php">HOME</a></td>
            </tr>
            <tr bgcolor="D9D9D9" class="fixed-row">
                <td height="25"><SPAN CLASS="txtsubtitu">Nombre evento</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Precio</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Fecha</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Activo</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Url compra</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Imagen evento</SPAN></td>
                <td height="25"><SPAN CLASS="txtsubtitu">Imagen cartel</SPAN></td>
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
                echo '<td valign="top"><input type="text" name="nombre' . $i . '"  value="' . iconv('ISO-8859-1', 'UTF-8', $evento["nombre"]) . '" size="14"></td>';
                echo '<td valign="top"><input type="text" name="precio' . $i . '"  value="' . $evento["precio"] . '" size="3"></td>';
                echo '<td valign="top"><input type="text" name="fecha' . $i . '"  value="' . $evento["fecha"] . '" size="6"></td>';
                echo '<td valign="top" class="align-active"><input  type="checkbox" name="active' . $i . '" ' . ($evento["activo"] == "S" ? "checked" : "") . '></td>';
                echo '<td valign="top"><input type="text" size="18" name="url' . $i . '" value="' . $evento["url_compra"] . '"></td>';
                echo '<td valign="top"><input type="text" size="20" name="url_buscador' . $i . '" value="' . $evento["buscador"] . '" class="hover-image"></td>';
                echo '<td valign="top"><input type="text" size="20" name="url_cartel' . $i . '" value="' . $evento["cartel"] . '" class="hover-image"></td>';

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

    <div class="image-popup" id="image-popup">
        <img id="popup-img" src="" alt="Preview">
    </div>

    <script>
        function modifica(idP, index) {
            var nombre = document.getElementsByName('nombre' + index)[0].value;
            var precio = document.getElementsByName('precio' + index)[0].value;
            var fecha = document.getElementsByName('fecha' + index)[0].value;
            var active = document.getElementsByName('active' + index)[0].checked ? 'S' : 'N';
            var url = document.getElementsByName('url' + index)[0].value;
            var img_evento = document.getElementsByName('url_buscador' + index)[0].value;
            var cartel = document.getElementsByName('url_cartel' + index)[0].value;
            var data = {
                id: idP,
                nombre: nombre,
                precio: precio,
                fecha: fecha,
                activo: active,
                url_compra: url,
                img_evento: img_evento,
                cartel: cartel
            };
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
                        alert("Cambio realizado");
                    } else {
                        console.log(result.success);
                        alert("Fallo");
                    }
                });
        }

        function borra(idP) {
            var data = {
                id: idP
            };

            //console.log(data);

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
                            alert("Evento borrado");
                            location.reload();
                        } else {
                            console.log(result.success);
                            alert("Fallo");
                        }
                    });
            }
        }

        document.querySelectorAll('.hover-image').forEach(function(input) {
            input.addEventListener('mouseover', function(event) {
                var imageUrl = event.target.value;
                if (imageUrl) {
                    var popup = document.getElementById('image-popup');
                    var img = document.getElementById('popup-img');
                    img.src = imageUrl;
                    popup.style.display = 'block';
                    popup.style.left = event.pageX + 'px';
                    popup.style.top = event.pageY + 'px';
                }
            });

            input.addEventListener('mousemove', function(event) {
                var popup = document.getElementById('image-popup');
                popup.style.left = event.pageX + 'px';
                popup.style.top = event.pageY + 'px';
            });

            input.addEventListener('mouseout', function() {
                var popup = document.getElementById('image-popup');
                popup.style.display = 'none';
            });
        });
    </script>

<?php }
?>
