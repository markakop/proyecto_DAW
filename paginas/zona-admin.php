<!doctype html>
<html lang="es">

<head>
    <title>Zona Admin</title>
    <?php include '../bbdd/conexion_bbdd.php';
    $eventos = new Consultas();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {
            $result = $eventos->login($username, $password);
            if ($result) {
                header("Location: ../paginas/admin.php");
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Usuario o contraseña incorrectos');</script>";
            }
        }
    }

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
        <div class="login-block">
                <h2>Login</h2>
                <form action="#" method="post" class="form-login">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Iniciar sesión</button>
                </form>
        </div>
    </main>

    <footer>
        <?php include '../themes/prefooter.php'; ?>
        <?php include '../themes/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>