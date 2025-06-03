<?php

$connection = new mysqli("localhost", "root", "", "exercicebonus2");
$data = [];

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
function verifGame($id)
{
    if ($id) {
        global $connection;
        $requeteGame = mysqli_query($connection, "SELECT jeux_id FROM jeux WHERE jeux_id = " . $id . "");
        $data = mysqli_fetch_all($requeteGame, MYSQLI_ASSOC);

        if ($data) {
            return $data[0]["jeux_id"];
        } else {
            errorGestion("verifGame");
        }
    }
}

function verifBareme($fun, $graph, $durée)
{
    global $connection;
    $allResult = [];
    if ($fun) {
        $newFun = intval($fun);
        if ($newFun > 7) {
            $newFun = 7;
        }
        array_push($allResult, $newFun);
    }
    if ($graph) {
        $newGraph = intval($graph);
        if ($newGraph > 7) {
            $newGraph = 7;
        }
        array_push($allResult, $newGraph);
    }
    if ($durée) {
        $newDuree = intval($durée);
        if ($newDuree > 7) {
            $newDuree = 7;
        }
        array_push($allResult, $newDuree);
    }

    return $allResult;
}

function verifUser($user)
{
    if ($user) {
        global $connection;
        $userEscaped = $connection->real_escape_string($user);
        $requeteUser = mysqli_query($connection, "SELECT * FROM `viewers` WHERE `nom` = '" . $userEscaped . "'");
        $dataUser = mysqli_fetch_all($requeteUser, MYSQLI_ASSOC);

        if ($dataUser) {
            return intval($dataUser[0]["ID"]);
        } else {
            mysqli_query($connection, "INSERT INTO `viewers`(`nom`) VALUES ('" . $userEscaped . "')");
            $requeteNewUser = mysqli_query($connection, "SELECT ID FROM viewers WHERE nom = '" . $userEscaped . "'");
            $dataNewUser = mysqli_fetch_all($requeteNewUser, MYSQLI_ASSOC);
            return intval($dataNewUser[0]["ID"]);
        }
    }
}

function verifNote($all)
{
    $fun = $all[0];
    $graph = $all[1];
    $duree = $all[2];
    $calcul = $fun + $duree + $graph;
    if ($calcul >= 20) {
        $calcul = 20;
    }
    return $calcul;
}

function errorGestion($call)
{
    return "Error in call of : " . $call;
}

function insertVote($user, $note, $jeu)
{
    global $connection;
    if ($user && $note && $jeu) {
        $stmt = $connection->prepare(
            "INSERT INTO `notes` (`ID`, `idUser`, `jeu_id`, `valeur`) VALUES (null, ?, ?, ?)"
        );
        if ($stmt) {
            $stmt->bind_param("iii", $user, $jeu, $note);
            $stmt->execute();
            $stmt->close();
        }
    }
}
