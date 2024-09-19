<?php
    session_start();
    include "../core/db_connect.php";

    $chair_num = (int)$_GET['chair_num'];
    $chair_row = (int)$_GET['chair_row'];
    $type_ticket = $_GET['type_ticket'];
    $name = $_GET['name'];

    // Remove the chair from temporary_reserved_chairs table
    $sqli_prepare = $con->prepare("DELETE FROM `temporary_reserved_chairs` WHERE chair_number = ? AND chair_row = ? AND movie_name = ? LIMIT 1");
    $sqli_prepare->bind_param('iis', $chair_num, $chair_row, $name);

    if (!$sqli_prepare->execute()) {
        echo json_encode(["error" => true, "message" => "Failed to remove chair"]);
    } else {
        // Also remove it from the session if it exists
        foreach ($_SESSION['temp_reserved_chair'] as $key => $value) {
            if ($value['num'] == $chair_num && $value['row'] == $chair_row && $value['name'] == $name) {
                unset($_SESSION['temp_reserved_chair'][$key]);
                break;
            }
        }

        $currentChair = "";
        $totalTicketDisplay = "";

        $amountOfType = 0;
        $totalPrijs = 0;
        $totalNormalTickets = 0;
        $totalChildTickets = 0;
        $totalOlderTickets = 0;

        foreach ($_SESSION['temp_reserved_chair'] as $chair) {
            if ($chair['type'] == $type_ticket && $chair['name'] == $name) {
                $amountOfType++;
            }
            if($chair['type'] == "normal" && $chair['name'] == $name) {
                $totalPrijs += 9;
                $totalNormalTickets++;
            } else if($chair['type'] == "child" && $chair['name'] == $name) {
                $totalPrijs += 5;
                $totalChildTickets++;
            } else if($chair['type'] == "older" && $chair['name'] == $name) {
                $totalPrijs += 7;
                $totalOlderTickets++;
            }
            if($chair['name'] == $name) {
                $chair['num'] = strval($chair['num']);
                $chair['row'] = strval($chair['row']);

                $currentChair = $currentChair . "Rij ". $chair['row'].", Stoel ".$chair['num']." | ";
            }
        }

        $totalTicketDisplay = $totalTicketDisplay . $totalNormalTickets . "x Normaal  |  " . $totalChildTickets . "x Kinderen t/m 14  |  " . $totalOlderTickets . "x 65+";
        $totalTicket = $totalNormalTickets + $totalChildTickets + $totalOlderTickets;
        
        $data = [
            "error" => false,
            "reserved" => false,
            "amountOfType" => $amountOfType,
            "amountTotalPrice" => $totalPrijs,
            "currentChairs" => $currentChair,
            "totalTicketDisplay" => $totalTicketDisplay,
            "totalTickets" => $totalTicket

        ];

        echo json_encode($data);
    }

    $sqli_prepare->close();
    $con->close();
?>