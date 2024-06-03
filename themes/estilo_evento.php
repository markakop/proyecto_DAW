<div class="filtro-eventos">
    <img class="img-buscar" src="../img/iconos/concierto.png" alt="">
    <div class="filtro-buscar">
        <?php echo $estilo ?>
    </div>
</div>
<div class="eventos">

    <?php foreach ($eventos_estilos as $evento) {
        echo 
        '<div class="evento-container">
            
            <div class="event-img">
                <img src="'.$evento["url"].'">
            </div>

            <div class="bloque">

                <div class="texts">
                    <div class="event-titulo">'.$evento["nombre"].'</div>
                    <div class="sitio">
                        <img class="ubicacion" src="../img/iconos/ubicacion.png" alt="">
                        Castellon
                    </div>
                    <div class="fecha">
                        <img class="calendario" src="../img/iconos/calendario.png" alt="">
                        '.$evento["fecha"].'
                    </div>
                    <div class="precio"> Precio '.$evento["precio"].'€</div>
                </div>

                <div class="buttons">
                    <div class="button-categoria">
                        <a class="button-event-red" href="ev_nombre.php?id_evento='.$evento["id"].'">Quiero ir</a>
                    </div>
                </div>

            </div>

        </div>';
    }
    ?>

</div>