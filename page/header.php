<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/header.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/logo/bilthoven_logp.png" alt="AnnexBios" style="height: 100px; margin-left:15%" class="img-fluid">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="margin-right: 6%;">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold" href="#">FILM AGENDA</a>
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

    <div class="purple-section d-flex flex-column flex-md-row align-items-center text-center text-md-start" style="background-color: #6e4778; padding: 20px; color: white; font-weight: bold;">
        <span class="mb-2 mb-md-0" style="margin-left: 5%;">KOOP JE TICKETS</span>
        <select class="text-white fw-bold mt-2 mt-md-0 ms-md-3" style="background-color: #a386b1; height: 5vh; width: 230px; font-size: 15px;">
            <option>Kies je film</option>
        </select>
        <button class="fw-bold mt-2 mt-md-0 ms-md-3" style="background-color: #fff; color: #6e4778; font-size: 15px; height: 4vh; width: 150px;">BESTEL TICKETS</button>
    </div>
    
    <!-- Correcte versie van Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
