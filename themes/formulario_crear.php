<form class="form-event" method="post" action="../bbdd/insertar_evento.php">
  <div class="form-group">
    <label for="event-name">Nombre del evento</label>
    <input type="text" class="form-control" id="event-name" name="event-name" placeholder="Ingrese el nombre del evento">
  </div>
  <div class="form-group">
    <label for="event-price">Precio (en €)</label>
    <input type="number" class="form-control" id="event-price" name="event-price" placeholder="Ingrese el precio del evento">
  </div>
  <div class="form-group">
    <label for="event-date">Fecha</label>
    <input type="date" class="form-control" id="event-date" name="event-date">
  </div>
  <div class="form-group">
    <label for="event-location">Localización</label>
    <input type="text" class="form-control" id="event-location" name="event-location" placeholder="Ingrese la localización del evento">
  </div>
  <div class="form-group">
    <label for="event-url">URL de la página del evento</label>
    <input type="url" class="form-control" id="event-url" name="event-url" placeholder="Ingrese la URL de la página del evento">
  </div>
  <div class="form-group">
    <label for="event-image-url">URL de la imagen del evento</label>
    <input type="url" class="form-control" id="event-image-url" name="event-image-url" placeholder="Ingrese la URL de la imagen del evento">
  </div>
  <button type="submit" class="btn btn-primary">Crear evento</button>
</form>
