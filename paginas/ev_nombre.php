<!doctype html>
<html lang="es">

<head>
    <title>Evento</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../estilos/style.css" />
</head>

<body>
    <header>
        <?php
        include '../themes/general/nav.php';
        include '../bbdd/conexion_bbdd.php'; 

        $eventos = new Consultas();
        if(isset($_GET["id_evento"])){
            $id=$_GET["id_evento"];
            $evento_select = $eventos->obtenerEventoId($id);
            
        }else{
            //Hacer error
        }
        ?>
    </header>


    <main>
        <?php
        include '../themes/event-select.php';
        ?>
    </main>


    <footer>
        <?php
            include '../themes/general/prefooter.php';
            include '../themes/general/footer.php';
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>