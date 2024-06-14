<!doctype html>
<html lang="es">

<head>
    <title>Entranet</title>
    <?php include '../bbdd/conexion_bbdd.php';
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : "";
    $estilo = isset($_POST["estilo"]) ? $_POST["estilo"] : "";
    $tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : "";
    $provincia = isset($_GET["provincia"]) ? $_GET["provincia"] : "";
    $consultas = new Consultas();
    if ($nombre != "" || $fecha != "" || $estilo != "" || $tipo !="" || $provincia !="") {
        $datos_eventos = $consultas->obtenerEventosFiltro($nombre, $fecha, $estilo, $tipo, $provincia);
    } else {
        $estilo = isset($_GET["estilo"]) ? $_GET["estilo"] : "";
        if ($estilo == "")
            $datos_eventos = $consultas->obtenerEventos();
        else {
            $estilo = $consultas->obtenerIdEstiloEveto($estilo);
            $datos_eventos = $consultas->obtenerEventosFiltro($nombre, $fecha, $estilo, $tipo, $provincia);
        }
    }


    $mostrar_eventos = [];
    foreach ($datos_eventos as $evento) {
        $evento["nombre"] =   iconv('ISO-8859-1', 'UTF-8', $evento["nombre"]);
        $evento["provincia"] =   iconv('ISO-8859-1', 'UTF-8', $evento["provincia"]);
        $evento["nombre_img"] =   iconv('ISO-8859-1', 'UTF-8', $evento["nombre_img"]);
        $mostrar_eventos[]= $evento;
    }
    
    ?>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../estilos/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>


</head>

<body>
    <header>
        <?php include '../themes/general/nav.php'; ?>
    </header>

    <main>
        <?php
        include '../themes/filtro.php';
        include '../themes/eventos.php';
        ?>
    </main>

    <footer>
        <?php include '../themes/general/prefooter.php'; ?>
        <?php include '../themes/general/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        var PaginationReal;
        var eventos_java = <?php echo json_encode($mostrar_eventos);  ?>;
    </script>
     <script type="module">
        import {
            Pagination
        } from "../js/pagination.js";
        PaginationReal = new Pagination({
            "items_per_page": 10,
            "data": eventos_java,
            "num_numbers_page": 4
        });
        PaginationReal.showPage(1);
    </script>
</body>

</html>