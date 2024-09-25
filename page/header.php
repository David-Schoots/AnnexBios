<?php
include_once("../api/api-call.php");
$data = getApiMovies();

session_start();
if (!isset($_SESSION['temp_reserved_chair'])) {
    $_SESSION['temp_reserved_chair'] = [];
}



/* checks if the id from the film is in the movieloop.php */
/* if (isset($_GET['data'])) {
    // Decode and deserialize the data
    $encodedMovie = $_GET['id'];
    $movie = json_decode(base64_decode($encodedMovie), true);
} */

/* checks if the button with id [id] is pressed  */

/* if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $movie = null;
    foreach ($getMovies as $item) {
        if ($item['id'] == $id) {
            $movie = $item;
            break;
        }
    }
}
 */
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AnnexBios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/header.css">
    <!-- datepicker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- cursor.css -->
    <link rel="stylesheet" href="../css/cursor.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/override.js" defer></script>
    <script src="../js/reserve_chair.js"></script>
</head>

<body class="d-flex flex-column">
    <div class="fixed-top">
        <nav class="navbar navbar-expand-md navbar-light bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../page/index.php">
                    <img src="../assets/logo/bilthoven_logp.png" alt="AnnexBios" style="height: 100px; margin-left:15%" class="img-fluid">
                </a>
                <div class="navbar-toggler collapsed">
                    <span class="navbar-toggler-icon"></span>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav" style="margin-right: 6%;">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-bold" href="overview.php">FILM AGENDA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-bold" href="#">ALLE VESTIGINGEN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-bold" href="#">CONTACT</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="purple-section d-flex flex-column flex-md-row align-items-center text-center text-md-start"
            style="background-color: #6e4778; padding: 20px; color: white; font-weight: bold;">
            <span class="mb-2 mb-md-0" style="margin-left: 5%;">KOOP JE TICKETS</span>
            <form action="buyticket.php" method="get">
                <select id="id" name="id" class="text-white fw-bold mt-2 mt-md-0 ms-md-3"
                    style="background-color: #a386b1; height: 5vh; width: 230px; font-size: 15px;">
                    <?php
                    $get_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;
                    ?>
                    <?php foreach ($data['data'] as $movie): ?>
                        <?php
                        $movie_id = htmlspecialchars($movie['api_id']);
                        ?>
                        <option value="<?= htmlspecialchars($movie_id) ?>" <?= isset($get_id) && $movie_id == $get_id ? 'selected' : '' ?>>
                            <?= htmlspecialchars($movie['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input class="fw-bold mt-2 mt-md-0 ms-md-3" style="background-color: #fff; color: #6e4778; font-size: 15px; height: 4vh; width: 150px;" type="submit" value="BESTEL TICKETS">
            </form>
        </div>
    </div>

</body>

</html>