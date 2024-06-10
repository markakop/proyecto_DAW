<?php
    include_once '../bbdd/conexion_bbdd.php';
    include_once '../bbdd/Evento.php';
    $consultas = new Consultas();
    if (isset($_POST['event_name'])) {
        //insertar las imagenes
        $nombre_img = str_replace(' ', '_',$_POST['event_name']);
        $id_buscador = $consultas->insertarImagen($nombre_img,$_POST['img-evento']);
        $id_cartel = $consultas->insertarImagen($nombre_img."_cartel",$_POST['img-cartel']);

        //completar con cosas de la direccion

        $evento = new Evento(
            $_POST['event_name'],
            5, //completar cuando inserte direccion y tal
            $_POST['price']!="" ? $_POST['price'] : (int) 0,
            $_POST['event_date'],
            isset($_POST ['description']) ? $_POST ['description'] : "",
            $id_buscador,
            $id_cartel,
            $_POST['event_url'],
            $_POST['music_style'],
            $_POST['event_type'],
            "N"
        );

        $consultas->insertarEvento($evento);
       
        //Logica para enviar correo

        //header("Location: email.php");
    }

    $provincias = $consultas->obtenerProvincias();
    $estilos = $consultas->obtenerEstilos();
    $tipos = $consultas->obtenerTiposEvento();
?>

<form class="form-event" action="" method="post">

  <div class="row">
        <div class="">
            <label for="email" data-toggle="tooltip" title="Su correo electrónico, le mandaremos un correo cuando comprobemos que su evento esta correctamente insertado y subamos su evento (campo obligatorio)">
                <i class="fas fa-info-circle"></i> Correo electrónico:
            </label>
            <input type="email" id="email" name="email" placeholder="Inserte su correo electrónico" required>
        </div>
  </div></br>
  
  <div class="row">
      <div class="form-group col-sm-4">
          <label for="event_name" data-toggle="tooltip" title="El nombre de su evento (campo obligatorio)">
                <i class="fas fa-info-circle"></i> Nombre del evento:
          </label>
          <input type="text" id="event_name" name="event_name" placeholder="Escribe el nombre del evento">
      </div>
      <div class="form-group col-sm-4">
          <label for="price" data-toggle="tooltip" title="El precio de la entrada, deja el campo vacio si la entrada es gratis">
                <i class="fas fa-info-circle"></i> Precio:
          </label>
          <input type="number" id="price" name="price" step="1" placeholder="El precio de la entrada">
      </div>
      <div class="form-group col-sm-4">
          <label for="event_date"  data-toggle="tooltip" title="La fecha en la que se desarrollara el evento (campo obligatorio)">
                <i class="fas fa-info-circle"></i> Fecha:
          </label>
          <input type="date" id="event_date" name="event_date" required>
      </div>
  </div></br>
  
  <div class="row">
      <div class="form-group col-sm-12">
          <label for="description"  data-toggle="tooltip" title="La descripción del evento que le apareceran a los usuarios cuando busquen el evento">
                <i class="fas fa-info-circle"></i> Descripción:
          </label>
          <textarea id="description" name="description" rows="3" cols="50" placeholder="Una breve descripción del evento"></textarea>
      </div>
  </div></br>

  <div class="row">
      <div class="form-group col-sm-4">
          <label for="event_url"  data-toggle="tooltip" title="El enlace de la web oficial del evento, donde se compraran la entrada del evento">
                <i class="fas fa-info-circle"></i> URL del evento:
          </label>
          <input type="url" id="event_url" name="event_url" placeholder="URL de la pagina para la compra de entradas" required>
      </div>
      <div class="form-group col-sm-4">
          <label for="province">Provincia:</label>
          <select id="province" name="province" required>
              <option value="">Seleccione la provincia donde se realizara su evento</option>
              <?php
                  foreach ($provincias as $provincia) {
                    echo "<option value='".$provincia["id_provincia"]."'>". iconv('ISO-8859-1', 'UTF-8', $provincia["provincia"])."</option>";
                  }
            ?>
          </select>
      </div>
      <div class="form-group col-sm-4">
          <label for="locallidad">Localidad:</label>
          <select id="localidad" name="localidad" required>
              <option value="">Seleccione una localidad:</option>
              <?php 
                  foreach ($provincias as $provincia) {
                    echo "<option value='".$provincia["id_provincia"]."'>". mb_convert_encoding($provincia["provincia"], 'UTF-8', 'auto')."</option>";
                  }
            ?>
          </select>
      </div>
  </div></br>

  <div class="row">
      <div class="form-group col-sm-4">
          <label for="street">Calle:</label>
          <input type="text" id="street" name="calle" placeholder="La calle del evento" required>
      </div>

      <div class="form-group col-sm-4">
          <label for="music_style"  data-toggle="tooltip" title="">Estilo de música:</label>
          <select id="music_style" name="music_style" required>
              <option value="">Seleccione el estilo musical de su evento</option>
              <?php
                  foreach ($estilos as $estilo) {
                      echo "<option value='".$estilo["id_estilo"]."'>".$estilo["ds_estilo"]."</option>";
                  }
            ?>
          </select>
      </div>
      <div class="form-group col-sm-4">
          <label for="event_type">Tipo de evento:</label>
          <select id="event_type" name="event_type" required>
              <option value="">Seleccione el tipo de evento</option>
              <?php
                  foreach ($tipos as $tipo) {
                      echo "<option value='".$tipo["id_tipo_evento"]."'>".$tipo["tipo_evento"]."</option>";
                  }
            ?>
          </select>
      </div>
  </div></br>

  <div class="row">
      <div class="form-group col-sm-6">
          <label for="img-cartel"  data-toggle="tooltip" title="La imagen del cartel del evento. Sus dimensiones tienen que ser de 600x750 o proporcional. Una vez pongas el enlace de una imagen correctamente, se previsualizara como se vera en la pagina">
                <i class="fas fa-info-circle"></i> Imagen del cartel:
          </label>
          <input type="url" id="img-cartel" name="img-cartel" placeholder="URL de la imagen del cartel del evento">
      </div>

      <div class="form-group col-sm-6">
          <label for="img-evento"  data-toggle="tooltip" title="La imagen del evento. Sus dimensiones tienen que ser de 1340x496 o proporcional (como 567x210). Una vez pongas el enlace de una imagen correctamente, se previsualizara como se vera en la pagina">
                <i class="fas fa-info-circle"></i> Imagen del evento:
          </label>
          <input type="url" id="img-evento" name="img-evento" placeholder="URL de la imagen del evento">
      </div>
  </div></br>

  <div id="img-new-event" class="row">
    
      <div id="img-cartel-img" class="form-group col-sm-6">
            <div class="container" style="display: none;">
                <div class="cargando">
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <span class="texto-cargando">Cargando...</span>
                </div>
            </div>
            <img class="img-der-evento" src="" alt="imagen del cartel"  style="display: none;">
      </div>
      <div id="img-evento-img" class="form-group col-sm-6 event-img">
            <div class="container" style="display: none;">
                <div class="cargando">
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <span class="texto-cargando">Cargando...</span>
                </div>
            </div>
            <img src="" alt="imagen del evento"  style="display: none;">
      </div>
      </br>
  </div></br>

  <button type="" class="btn btn-primary"style="display: none;">Crear evento</button>
  <button type="submit" id="envio">Crear evento</button>
</form></br>