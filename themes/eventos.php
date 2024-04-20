<div class="filtro-eventos">
    <img class="img-buscar" src="./img/concierto.png" alt="">
    <div class="filtro-buscar">
        Eventos
    </div>
</div>
<div class="eventos">

    <?php foreach ($datos_eventos as $evento) {
        echo '<div class="evento-container">
        
        <div class="event-img">
            <img class="img-fest" src="' . $evento["imagen"] . '" alt="">
        </div>

        <div class="bloque">

            <div class="texts">
                <div class="event-titulo">' . $evento["nombre"] . '</div>
                <div class="sitio">
                    <img class="ubicacion" src="./img/ubicacion.png" alt="">
                    Castellon
                </div>
                <div class="fecha">
                    <img class="calendario" src="./img/calendario.png" alt="">
                    ' . $evento["fecha"] . '
                </div>
                <div class="precio"> Precio ' . $evento["precio"] . '</div>
            </div>

            <div class="buttons">
                <div class="button-event">
                    <a class="button-event-cat" href="">Festival</a>
                </div>
                <div class="button-categoria">
                    <a class="button-event-red" href="">Quiero ir</a>
                </div>
            </div>

        </div>

    </div>';
    }
    ?>

</div>