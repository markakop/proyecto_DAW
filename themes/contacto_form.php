<?php
include_once '../bbdd/enviar_email.php';

if (isset($_POST['email']) && isset($_POST['mensaje'])) {
  sendEmailContact($_POST['email'],$_POST['mensaje']);
  header("location: ../paginas/home.php");
}
?>

<form class="form-event" method="post" action="">
  <div class="form-group">
    <label for="email" data-toggle="tooltip" title="Su correo electrónico, le contestaremos enviandole un email a este correo">
      <i class="fas fa-info-circle"></i> Correo electrónico:
    </label>
    <input type="email" id="email" name="email" placeholder="Inserte su correo electrónico" required>
  </div></br>
  <div class="form-group">
    <label for="subject" data-toggle="tooltip" title="Explica en pocas palabras el motivo por el cual quiere contactar con nosotros">
      <i class="fas fa-info-circle"></i> Asunto:
    </label>
    <input type="text" class="form-control" id="subject" name="subject" placeholder="Ingrese el asunto" required>
  </div></br>
  <div class="form-group">
    <label for="mensaje" data-toggle="tooltip" title="Cuantanos...">
      <i class="fas fa-info-circle"></i> Cuerpo:
    </label>
    <textarea class="form-control" name="mensaje" id="mensaje" rows="5" placeholder="Ingrese el cuerpo" required></textarea>
  </div></br>
  <button type="submit">Enviar</button>
</form></br>
