<div class="filtro-eventos">
    <img class="img-buscar" src="../img/iconos/concierto.png" alt="">
    <div class="filtro-buscar">
        Eventos
    </div>
</div>

<div class="eventos" id="eventos">

    <?php foreach ($datos_eventos as $evento) {
        echo
        '<div class="evento-container">
            
            <div class="event-img">
                <img src="' . $evento['url_imagen']. '" alt="' . $evento['nombre_img'] . '">
            </div>

            <div class="bloque">

                <div class="texts">
                    <div class="event-titulo">' . $evento["nombre"] . '</div>
                    <div class="sitio">
                        <img class="ubicacion" src="../img/iconos/ubicacion.png" alt="">
                        Castellon
                    </div>
                    <div class="fecha">
                        <img class="calendario" src="../img/iconos/calendario.png" alt="">
                        ' . $evento["fecha"] . '
                    </div>
                    <div class="precio"> Precio ' . $evento["precio"] . '€</div>
                </div>

                <div class="buttons">
                    <div class="button-event">
                        <a class="button-event-cat" href="tipo_evento.php?estilo=' . $evento["estilo"] . '">' . $evento["estilo"] . '</a>
                    </div>
                    <div class="button-categoria">
                        <a class="button-event-red" href="ev_nombre.php?id_evento=' . $evento["id"] . '">Quiero ir</a>
                    </div>
                </div>

            </div>

        </div>';
    }
    ?>
</div>
<div class="patient-page" id="paginator">HOLA</div>