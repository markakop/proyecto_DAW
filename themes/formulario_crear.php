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
          <label for="event_date"  data-toggle="tooltip" title="La fecha en la que se desarrollara el evento">
                <i class="fas fa-info-circle"></i> Fecha:
          </label>
          <input type="date" id="event_date" name="event_date" required>
      </div>
  </div></br>
  
  <div class="row">
      <div class="form-group col-sm-12">
          <label for="description"  data-toggle="tooltip" title="">
                <i class="fas fa-info-circle"></i> Descripción:
          </label>
          <textarea id="description" name="description" rows="3" cols="50" placeholder="Una breve descripción del evento" required></textarea>
      </div>
  </div></br>

  <div class="row">
      <div class="form-group col-sm-4">
          <label for="event_url"  data-toggle="tooltip" title="">
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
          <select id="music_style" name="estilo-musical" required>
              <option value="">Seleccione el estilo musical de su evento</option>
              <?php
                  foreach ($estilos as $estilo) {
                      echo "<option value='".$estilo["id_estilo"]."'>".$estilo["ds_estilo"]."</option>";
                  }
            ?>
          </select>
      </div>
      <div class="form-group col-sm-4">
          <label for="event_type"  data-toggle="tooltip" title="">Tipo de evento:</label>
          <select id="event_type" name="tipo-evento" required>
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
          <label for="imagen-cartel"  data-toggle="tooltip" title="">
                <i class="fas fa-info-circle"></i> Imagen del cartel:
          </label>
          <input type="url" id="imagen-cartel" name="imagen-cartel" placeholder="URL de la imagen del cartel del evento">
      </div>

      <div class="form-group col-sm-6">
          <label for="imagen-buscador"  data-toggle="tooltip" title="">
            <i class="fas fa-info-circle"></i> Imagen del evento:
          </label>
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