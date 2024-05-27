<form class="form-event" action="process_event.php" method="post">
  <div class="form-group">
    <label for="event_name">Nombre del evento:</label>
    <input type="text" id="event_name" name="event_name" required>
  </div><br>

  <div class="form-group">
    <label for="price">Precio:</label>
    <input type="number" id="price" name="price" step="0.01" required>
  </div><br>

  <div class="form-group">
    <label for="event_date">Fecha:</label>
    <input type="date" id="event_date" name="event_date" required>
  </div><br>

  <div class="form-group">
    <label for="description">Descripción:</label><br>
    <textarea id="description" name="description" rows="10" cols="50" required></textarea>
  </div><br>

  <div class="form-group">
    <label for="event_url">URL del evento:</label>
    <input type="url" id="event_url" name="event_url" required>
  </div><br>

  <div class="form-group">
    <label for="street">Calle:</label>
    <input type="text" id="street" name="street" required>
  </div><br>

  <div class="form-group">
    <label for="province">Provincia:</label>
    <select id="province" name="province" required>
      <?php
      // Completar con las opciones de provincia desde la base de datos
      ?>
    </select>
  </div><br>
  
  <div class="form-group">
    <label for="music_style">Estilo de música:</label>
    <select id="music_style" name="music_style" required>
      <?php
      // Completar con las opciones de estilo de música desde la base de datos
      ?>
    </select>
  </div><br>

  <div class="form-group">
    <label for="event_type">Tipo de evento:</label>
    <select id="event_type" name="event_type" required>
      <?php
      // Completar con las opciones de tipo de evento desde la base de datos
      ?>
    </select>
  </div><br>

  <button type="submit" class="btn btn-primary">Crear evento</button>
</form>