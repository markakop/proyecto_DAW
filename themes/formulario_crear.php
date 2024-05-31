<?php
    include '../bbdd/conexion_bbdd.php';
    $eventos = new Consultas();
    $provincias = $eventos->obtenerProvincias();
    $estilos = $eventos->obtenerEstilos();
    $tipos = $eventos->obtenerTiposEvento();
?>

<form class="form-event" action="process_event.php" method="post">
  <div class="form-group">
    <label for="event_name">Nombre del evento:</label>
    <input type="text" id="event_name" name="event_name" placeholder="Escribe el nombre del evento">
  </div><br>

  <div class="form-group">
    <label for="price">Precio:</label>
    <input type="number" id="price" name="price" step="0.01" placeholder="El precio de la entrada, dejala en blanco si la entrada es gratis">
  </div><br>

  <div class="form-group">
    <label for="event_date">Fecha:</label>
    <input type="date" id="event_date" name="event_date">
  </div><br>

  <div class="form-group">
    <label for="description">Descripción:</label><br>
    <textarea id="description" name="description" rows="10" cols="50" placeholder="Una breve descripción del evento"></textarea>
  </div><br>

  <div class="form-group">
    <label for="event_url">URL del evento:</label>
    <input type="url" id="event_url" name="event_url" placeholder="URL de la pagina para la compra de entradas">
  </div><br>

  
  <div class="form-group">
    <label for="province">Provincia:</label>
    <select id="province" name="province">
      <option value="">Seleccione la provincia donde se realizara su evento</option>
      <?php
        foreach ($provincias as $provincia) {
          echo "<option value='".$provincia["id_provincia"]."'>".$provincia["provincia"]."</option>";
        }
      ?>
    </select>
  </div><br>

  <div class="form-group">
    <label for="calle">Calle:</label>
    <input type="text" id="street" name="calle" placeholder="">
  </div><br>
  
  <div class="form-group">
    <label for="music_style">Estilo de música:</label>
    <select id="music_style" name="estilo-musical">
      <option value="">Seleccione el estilo musical de su evento</option>
      <?php
        foreach ($estilos as $estilo) {
          echo "<option value='".$estilo["id_estilo"]."'>".$estilo["ds_estilo"]."</option>";
        }
      ?>
    </select>
  </div><br>

  <div class="form-group">
    <label for="event_type">Tipo de evento:</label>
    <select id="event_type" name="tipo-evento">
      <option value="">Seleccione el tipo de evento</option>
      <?php
        foreach ($tipos as $tipo) {
          echo "<option value='".$tipo["id_tipo_evento"]."'>".$tipo["tipo_evento"]."</option>";
        }
      ?>
    </select>
  </div><br>

  <button type="submit" class="btn btn-primary">Crear evento</button>
</form>