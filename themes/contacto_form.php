<?php
    if (isset($_POST['body'])) {
      //enviar corrreo
    }
?>

<form class="form-event" method="post" action="">
  <div class="form-group">
    <label for="subject" data-toggle="tooltip" title="Explica en pocas palabras el motivo por el cual quiere contactar con nosotros">
        <i class="fas fa-info-circle"></i> Asunto:
    </label>
    <input type="text" class="form-control" id="subject" placeholder="Ingrese el asunto" required>
  </div></br>
  <div class="form-group">
    <label for="body" data-toggle="tooltip" title="Cuantanos...">
        <i class="fas fa-info-circle"></i> Cuerpo:
    </label>
    <textarea class="form-control" id="body" rows="5" placeholder="Ingrese el cuerpo" required></textarea>
  </div></br>
  <button type="submit">Enviar</button>
</form></br>