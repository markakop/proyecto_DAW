<?php if(!$evento_select == 0){

echo '<div class="bloque-img-evento">
    <div class="bloque-img">
        <img class="img-nombre" src="../img/Evento/'.$evento_select["imagen_evento"].'" alt="">
    </div>
    <div class="bloque-texts">
        <div class="col-8 detalles">
            <div class="detalles-ev">
                <img src="../img/iconos/calendario.png" alt="">
                <div class="titulos">'.$evento_select["fecha"].'</div>
            </div>
            <div class="detalles-ev">
                <img src="../img/iconos/ubicacion.png" alt="">
                <div class="titulos">'.$evento_select["calle"].', '. $evento_select["provincia"].' '. $evento_select["codigo_postal"] .'</div>
            </div>
        </div>
        <div class="col-4 text-right button-comprar">
            <a class="button-event-red" href="">Comprar</a>
        </div>
    </div>
    <div class="descripcion-evnt">
        <div class="titulos-evento">
            '.$evento_select["nombre"].'
        </div>
        <div class="bloque-descripcion">
            <div class="col-8 event-text">
                '.$evento_select["descripcion"].'
            </div>
            <div class="col-4 box-evento">
                <img class="img-der-evento" src="../img/Evento/'.$evento_select["cartel"].'" alt="">
            </div>
        </div>
    </div>
</div>';}else{
    //hacer pagina de error
}
?>
