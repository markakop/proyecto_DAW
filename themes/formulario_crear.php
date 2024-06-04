<?php
    include '../bbdd/conexion_bbdd.php';
    $eventos = new Consultas();
    $provincias = $eventos->obtenerProvincias();
    $estilos = $eventos->obtenerEstilos();
    $tipos = $eventos->obtenerTiposEvento();
?>

<form class="form-event" action="process_event.php" method="post">
  
  <div class="row">
      <div class="form-group col-sm-4">
          <label for="event_name">Nombre del evento:</label>
          <input type="text" id="event_name" name="event_name" placeholder="Escribe el nombre del evento">
      </div>
      <div class="form-group col-sm-4">
          <label for="price">Precio:</label>
          <input type="number" id="price" name="price" step="1" placeholder="El precio de la entrada, dejala en blanco si la entrada es gratis">
      </div>
      <div class="form-group col-sm-4">
          <label for="event_date">Fecha:</label>
          <input type="date" id="event_date" name="event_date">
      </div>
  </div></br>
  
  <div class="row">
      <div class="form-group col-sm-12">
          <label for="description">Descripción:</label>
          <textarea id="description" name="description" rows="10" cols="50" placeholder="Una breve descripción del evento"></textarea>
      </div>
  </div></br>

  <div class="row">
      <div class="form-group col-sm-4">
          <label for="event_url">URL del evento:</label>
          <input type="url" id="event_url" name="event_url" placeholder="URL de la pagina para la compra de entradas">
      </div>
      <div class="form-group col-sm-4">
          <label for="province">Provincia:</label>
          <select id="province" name="province">
              <option value="">Seleccione la provincia donde se realizara su evento</option>
              <?php
                  foreach ($provincias as $provincia) {
                      echo "<option value='".$provincia["id_provincia"]."'>".$provincia["provincia"]."</option>";
                  }
            ?>
          </select>
      </div>
  </div></br>

  <div class="row">
      <div class="form-group col-sm-4">
          <label for="street">Calle:</label>
          <input type="text" id="street" name="calle" placeholder="">
      </div>

      <div class="form-group col-sm-4">
          <label for="music_style">Estilo de música:</label>
          <select id="music_style" name="estilo-musical">
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
          <select id="event_type" name="tipo-evento">
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
          <label for="imagen-cartel">Imagen del cartel:</label>
          <input type="url" id="imagen-cartel" name="imagen-cartel" placeholder="URL de la imagen del cartel del evento">
      </div>

      <div class="form-group col-sm-6">
          <label for="imagen-buscador">Imagen del evento:</label>
          <input type="url" id="event_url" name="event_url" placeholder="URL de la imagen del evento">
      </div>
  </div></br>

  <div id="img-new-event" class="row" style="display: none;">
      <div class="form-group col-sm6">
          <img src="" alt="">
      </div>
      <div class="form-group col-sm6">
          <img src="" alt="">
      </div>
  </div>

  <button type="submit" class="btn btn-primary">Crear evento</button>
</form></br>