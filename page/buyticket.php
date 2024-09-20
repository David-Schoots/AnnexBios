<?php
include_once("header.php");
include "../modules/core/db_connect.php"; // Ensure database connection is included
include_once("../api/api-call.php"); // Ensure api call connection is included
// session_destroy();

$id = htmlspecialchars($_GET['id']);
$data = getApiMovie($id); // Get the data from the api that is linked to a specific movie

$playingData = getApiMoviePlaying($id);

if (empty($playingData) || !isset($playingData['data'])) {
    echo '<div class="alert alert-danger" role="alert">De film draait momenteel niet. Probeer het later opnieuw.</div>';
    exit;
}


$movieName = $data['data'][0]['title'];

// Initialize variables
$editable_chairs = [];
$total_rows = 10;
$chair_reserved = [];
$delete_chair = [];
$selected_chair = [];

// session_destroy();
// Get selected chairs from session 
if (isset($_SESSION['temp_reserved_chair'])) {
    foreach ($_SESSION['temp_reserved_chair'] as $key => $value) {
       if($value['name'] == $movieName) {
            $selected_chair[] = [
                "row" => $value['row'],
                "num" => $value['num'],
                "type" => $value['type'],
                "name" => $value['name']
        ];
       }
    }
}

// Query database for reserved chairs
$query = "SELECT id, chair_number, chair_row, date_chair_reserved FROM temporary_reserved_chairs WHERE movie_name = '$movieName'";
$sqli_prepare = $con->prepare($query);
$sqli_prepare->bind_result($id, $chair_number, $chair_row, $date_chair_reserved);

if (!$sqli_prepare) {
    echo mysqli_error($con);
} else {
    if ($sqli_prepare->execute()) {
        while ($sqli_prepare->fetch()) {
            $current_time = new DateTime();
            $start_date = new DateTime($date_chair_reserved);
            $since_start = $start_date->diff($current_time);

            // Check if reservation is expired (1 hour and 10 minutes)
            if ($since_start->h >= 1 || ($since_start->h == 0 && $since_start->i >= 10)) {
                $delete_chair[] = $id;
                unset($_SESSION['temp_reserved_chair'][$id]);
            } else {
                // Chair is still reserved
                $chair_reserved[] = [
                    "row" => $chair_row,
                    "num" => $chair_number,
                    "id" => $id
                ];

                // If chair is in session, it's editable
                if (isset($_SESSION['temp_reserved_chair'][$id])) {
                    $editable_chairs[] = [
                        "row" => $chair_row,
                        "num" => $chair_number
                    ];
                }
            }
        }
    }

$query = "SELECT id, chair_number, chair_row FROM reserved_chairs WHERE movie_name = '$movieName'";
$sqli_prepare = $con->prepare($query);
$sqli_prepare->bind_result($id, $chair_number, $chair_row);

if (!$sqli_prepare) {
    echo mysqli_error($con);
} else {
    if ($sqli_prepare->execute()) {
        while ($sqli_prepare->fetch()) {
            
                $chair_reserved[] = [
                    "row" => $chair_row,
                    "num" => $chair_number,
                    "id" => $id
                ];
            }
        }
    }

    // Delete expired chairs from the database
    if (count($delete_chair) > 0) {
        foreach ($delete_chair as $delete) {
            $delete_prepare = $con->prepare("DELETE FROM `temporary_reserved_chairs` WHERE id = ?");
            $delete_prepare->bind_param("i", $delete);
            if (!$delete_prepare) {
                echo mysqli_error($con);
            } else {
                $delete_prepare->execute();
                $delete_prepare->close();
            }
        }
    }
    $sqli_prepare->close();
}
?>

<!-- HTML Code for Ticket Selection -->
<div class="container col-12 text-uppercase bg-white d-flex align-items-center p-3" style="height: 75px;">
    <h2 class="text-left m-0 fs-1" style="color: #6E4F7D;">TICKETS BESTELLEN</h2>
</div>

<!-- Dropdown for Movie Selection, Datepicker, and Timepicker -->
<div class="container col-12 text-uppercase d-flex align-items-center p-0 my-4">
    <div class="col-12 d-flex flex-column flex-sm-row gap-3">
        <?php foreach ($data['data'] as $movie): ?>
        <p class="d-flex justify-content-center align-items-center p-2 mb-0 bg-white"><?= $movie['title'] ?></p>
        <?php endforeach; ?>

        <select class="form-select">
            <?php foreach (array_column($playingData['data'], 'play_time') as $play_time): ?>
                <option value="<?= htmlspecialchars($play_time) ?>"><?= htmlspecialchars($play_time) ?></option>
            <?php endforeach; ?>
        </select>

    </div>
</div>



<!-- Seat Selection UI -->
<div class="container bg-white d-flex flex-column">

    <div class="container my-5">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px; color: #6E4F7D;">STAP 1: KIES JE STOEL</h4>
        </div>

        <!-- Render Chairs -->
        <div id="chairs" class="container px-2" style="position: relative; overflow: visible;">
            <div id="choose-chair-pop-up" class="position-absolute bg-white d-flex flex-column gap-2 rounded"
                style="z-index: 9999; pointer-events: none; opacity: 0; transition: opacity 600ms ease; min-width: 200px; border: 1px solid #6E4F7D; overflow: hidden;">
                <table class="table table-hover m-0 p-0">

                    <head>
                        <tr>
                            <th colspan="2">Kies een ticket</th>
                        </tr>
                    </head>
                    <tbody>
                        <tr class="pointer" id="chair-pop-up-normal">
                            <td>
                                Normaal
                            </td>
                        </tr>
                        <tr class="pointer" id="chair-pop-up-child">
                            <td>
                                Kind t/m 11 jaar
                            </td>
                        </tr>
                        <tr class="pointer" id="chair-pop-up-older">
                            <td>
                                65+
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <?php
            for ($i = 1; $i <= $total_rows; $i++) {
            ?>
                <div class="d-flex">
                    <?php

                    // Last row has 12 chairs, others have 11
                    $num_chairs = ($i === $total_rows) ? 12 : 11;

                    for ($x = 0; $x < $num_chairs; $x++) {
                        $src = '../assets/chairs/non_reserved_chair.png';
                        $isSelected = false;
                        $is_clickable = true;

                        // Check if chair is reserved
                        foreach ($chair_reserved as $reserved) {
                            if ($i == $reserved['row'] && $x == $reserved['num']) {
                                $src = '../assets/chairs/reserved_chair.png';
                                $is_clickable = false;

                                // If chair is temp reserved, show as such
                                foreach ($selected_chair as $session_chair) {
                                    if ($i == $session_chair['row'] && $x == $session_chair['num'] && $movieName == $session_chair['name']) {
                                        $src = '../assets/chairs/temp_reserved_chair.png';
                                        $isSelected = true;
                                        $is_clickable = true;

                                        $type = $session_chair['type'];
                                    }
                                }
                            }
                        }
                ?>
                <!-- Chair UI -->
                <img src="<?= $src ?>" style="object-fit: contain;"
                    <?= $is_clickable === true && $isSelected === false ? 'onclick="chooseChairPopUp(this);"' : '' ?>
                    <?= $isSelected === true ? 'onclick="remove_chair(this, \'' . $type . '\');"' : '' ?>
                    class="chair col mt-3 p-1 <?= $is_clickable ? 'pointer' : 'no-pointer' ?>" data-num="<?= $x ?>"
                    data-row="<?= $i ?>" data-name="<?= $movieName ?>" width="15" height="75">
                <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Ticket Details -->
    <div class="container my-5" style="color: #6E4F7D;">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px; color: #6E4F7D; ">STAP 2: KIES JE TICKET</h4>
        </div>
        <table class="table table-hover bg-light">
            <thead>
                <tr>
                    <th scope="col" style="width: 80%;">TICKETS</th>
                    <th scope="col" class="text-end" style="width: 10%;">PRIJS</th>
                    <th scope="col" class="text-end" style="width: 10%;">AANTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Normaal</td>
                    <td class="text-end">€9,00</td>
                    <?php
                        $normalTicketCount = 0;
                        if(isset($_SESSION['temp_reserved_chair'])) {
                            foreach($_SESSION['temp_reserved_chair'] as $chair) {
                                if ($chair['type'] === 'normal' && $chair['name'] === $movieName) {
                                    $normalTicketCount++;
                                }
                            }
                        }
                    ?>
                    <td class="text-end">
                        <input oninput="ticketValidator();"
                            style="width: 50px; outline: none; border: 1px solid #6E4F7D; padding: 0 5px; border-radius: 5px;"
                            class="rounded bg-light" type="text" value="<?= $normalTicketCount ?>"
                            id="normal-ticket-input">
                    </td>
                </tr>
                <tr>
                    <td>Kind t/m 11 jaar</td>
                    <td class="text-end">€5,00</td>
                    <?php
                        $childTicketCount = 0;
                        if(isset($_SESSION['temp_reserved_chair'])) {
                            foreach($_SESSION['temp_reserved_chair'] as $chair) {
                                if ($chair['type'] === 'child' && $chair['name'] === $movieName) {
                                    $childTicketCount++;
                                }
                            }
                        }
                    ?>
                    <td class="text-end">
                        <input oninput="ticketValidator();"
                            style="width: 50px; outline: none; border: 1px solid #6E4F7D; padding: 0 5px; border-radius: 5px;"
                            class="rounded bg-light" type="text" value="<?= $childTicketCount ?>"
                            id="child-ticket-input">
                    </td>
                </tr>
                <tr>
                    <td>65+</td>
                    <td class="text-end">€7,00</td>
                    <?php
                        $olderTicketCount = 0;
                        if(isset($_SESSION['temp_reserved_chair'])) {
                            foreach($_SESSION['temp_reserved_chair'] as $chair) {
                                if ($chair['type'] === 'older' && $chair['name'] === $movieName) {
                                    $olderTicketCount++;
                                }
                            }
                        }
                    ?>
                    <td class="text-end">
                        <input oninput="ticketValidator();"
                            style="width: 50px; outline: none; border: 1px solid #6E4F7D; padding: 0 5px; border-radius: 5px;"
                            class="rounded bg-light" type="text" value="<?= $olderTicketCount ?>"
                            id="older-ticket-input">
                    </td>
                </tr>
                <tr>
                    <?php
                    $normalTicketTotalPrijs = $normalTicketCount * 9;
                    $childTicketTotalPrijs = $childTicketCount * 5;
                    $olderTicketTotalPrijs = $olderTicketCount * 7;
                    $totalPrice = $normalTicketTotalPrijs + $childTicketTotalPrijs + $olderTicketTotalPrijs;
                    ?>
                    <td>Totaal Prijs</td>
                    <td class="text-end" id="total-price-ticket"><?= "€" . $totalPrice . ",00"  ?></td>
                    <td class="text-end">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container my-5" style="color: #6E4F7D;">
        <div class="row">
            <h4 class="p-4" style="font-size: 30px; color: #6E4F7D; ">STAP 3: CONTROLEER JE BESTELLING</h4>
        </div>
        <div class="container border border-3 p-0 d-flex flex-row">
            <img src="<?= htmlspecialchars($data['data'][0]['image']) ?>" alt="" class="m-2" width="25%" height="auto">
            <div class="container d-flex flex-column">
                <h1 class="mt-3 w-100"><?= $data['data'][0]['title'] ?></h1>
                <div class="d-flex flex-row">
                    <?php foreach ($data['data'][0]['viewing_guides']['symbols'] as $symbol): ?>
                                    <img src="<?= $symbol['image'] ?>" alt="<?= $symbol['name'] ?>" class="me-1" style="height: 30px;">
                    <?php endforeach; ?>
                </div>
                <div class="w-100 h-100 mt-4">
                    <div class="d-flex flex-row fs-5">
                        <p class="fw-bold">Bioscoop:</p><p>&nbsp;&nbsp;Bilthoven (Zaal 1)</p>
                    </div>
                    <div class="d-flex flex-row fs-5">
                        <p class="fw-bold fs-5">Wanneer:</p><p>&nbsp;&nbsp;<?= $data['data'][0]['first_play_time']; ?></p>
                    </div>
                    <div class="d-flex flex-row fs-5">
                        <p class="fw-bold fs-5">Stoelen:</p><p id="huidige-stoelen">&nbsp;&nbsp;<?php foreach($_SESSION['temp_reserved_chair'] as $chairs){ if($chairs['name'] == $movieName){ echo 'Rij '.$chair['row'].', Stoel '.$chair['num'].' | '; }} ?></p>
                    </div>
                    <div class="d-flex flex-row fs-5">
                        <p class="fw-bold fs-5">Tickets:</p><p id="total-tickets">&nbsp;&nbsp;<?= $normalTicketCount ?>x&nbsp;Normaal&nbsp;&nbsp;|&nbsp;&nbsp;<?= $childTicketCount ?>x&nbsp;Kinderen t/m 14&nbsp;&nbsp;|&nbsp;&nbsp;<?= $olderTicketCount ?>x&nbsp;65+</p>
                    </div>
                    <div class="d-flex flex-row fs-5 mt-5">
                        <p class="fw-bold fs-5">Totaal:</p><p id="total-ticket-price">&nbsp;&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="thanks.php" method="POST">

        <div class="container my-5 w-100" style="color: #6E4F7D;">
            <div class="row">
                <h4 class="p-4" style="font-size: 30px; color: #6E4F7D; ">STAP 4: VUL JE GEGEVENS IN</h4>
            </div>
            <div class="container w-100 d-flex flex-column">
                <div class="w-50" action="index.php">
                    <div class="d-flex flex-row w-100">
                        <input class="border border-3 w-50" type="text" name="email" id="fname" placeholder="Voornaam" required novalidate>
                        <input class="border border-3 w-50 ms-2" type="text" name="email" id="lname" placeholder="Achternaam" required novalidate>
                    </div>
                    <div class="d-flex flex-column">
                        <input class="mt-2 w-100 border border-3" type="email" name="email" id="email" placeholder="E-mailadress*" required validate>
                        <input class="mt-2 w-100 border border-3" type="email" name="emailCheck" id="emailCheck" placeholder="E-mailadress*" required validate>
                    </div>  
                </div>
            </div>
        </div>
        <div class="container my-5 w-100" style="color: #6E4F7D;">
            <div class="row">
                    <h4 class="p-4" style="font-size: 30px; color: #6E4F7D; ">STAP 5: KIES JE BETAALWIJZE</h4>
            </div>
            <div class="w-100 d-flex flex-row">
                <input class="me-4" type="radio" id="bioscoopbon" name="paymethod" value="bioscoopbon" required>
                <img class="me-5" src="../assets/icons/biosbon.png" alt="biosbon"  width="7.5%" height="10%">
                <input class="me-4" type="radio" id="maestro" name="paymethod" value="maestro" required>
                <img class="me-5" src="../assets/icons/Maestro_logo.png" alt="Maestro Kaart" width="7.5%" height="10%">
                <input class="me-4" type="radio" id="iDeal" name="paymethod" value="iDeal" required>
                <img src="../assets/icons/iDEAL-logo.png" alt="iDeal" width="7.5%" height="10%">
            </div>
            <div class="w-100 mt-5">
                <input type="checkbox" id="voorwaarden" name="voorwaarden" required>
                <label for="voorwaarden">Ja, ik ga akkoord met de algemene voorwaarden</label>
                <input type="hidden" id="name" name="name" value="<?= $movieName ?>" >
            </div>
        </div>
    
</div>
<div class="container d-flex flex-column mt-5 mb-5 p-0">
    <input class="btn btn-primary text-uppercase p-0 m-0" style="background-color: #6E4F7D; border:none; height: 10vh;" type="submit" id="submit" name="submit" value="Afrekenen">
</div>
</form>

<?php include_once("footer.php"); ?>