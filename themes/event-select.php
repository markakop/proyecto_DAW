<?php if(!$evento_select == 0){
$imagen_evento = 'data:' . $evento_select['extension_e'] . ';base64,' . base64_encode($evento_select['imagen_evento']);
$imagen_cartel = 'data:' . $evento_select['extension_c'] . ';base64,' . base64_encode($evento_select['imagen_cartel']);
echo
 '<div class="bloque-img-evento">
    <div class="bloque-img">
        <img class="img-nombre" src="' . $imagen_evento . '" alt="' . $evento_select['nombre_img_e'] . '">
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
            <a class="button-event-red" href="'. $evento_select["url_compra"] .'" target="_blank">Comprar</a>
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
                 <img class="img-der-evento" src="' . $imagen_cartel . '" alt="' . $evento_select['nombre_img_e'] . '">
            </div>
        </div>
    </div>
</div>';}else{
    //hacer pagina de error
}
?>
