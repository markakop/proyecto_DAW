<!doctype html>
<html lang="es">

<head>
    <title>Inicio</title>
    <?php include '../bbdd/conexion_bbdd.php';
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
    $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : null;
    $estilo = isset($_POST["estilo"]) ? $_POST["estilo"] : null;
    $eventos = new Consultas();
    /*if ($nombre != "" || $fecha != "" || $estilo != "") {
        $datos_eventos = $eventos->obtenerEventosFiltro($nombre, $fecha, $estilo);
    } else {*/
        $datos_eventos = $eventos->obtenerEventos();
    //}
    //print_r($datos_eventos);
    ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../estilos/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>


</head>

<body>
    <header>
        <?php include '../themes/nav.php'; ?>
    </header>

    <main>
        <?php
        include '../themes/filtro.php';
        include '../themes/eventos.php';
        ?>
    </main>

    <footer>
        <?php include '../themes/prefooter.php'; ?>
        <?php include '../themes/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        var PaginationReal;
        var eventos_java = <?php echo json_encode($datos_eventos);  ?>;
    </script>
     <script type="module">
        import {
            Pagination
        } from "../js/pagination.js";
        PaginationReal = new Pagination({
            "items_per_page": 6,
            "data": eventos_java,
            "num_numbers_page": 4
        });
        PaginationReal.showPage(1);
    </script>
</body>

</html>