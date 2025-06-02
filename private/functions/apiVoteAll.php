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
            return $data["jeux_id"];
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
        $requeteGame = mysqli_query($connection, "SELECT ID FROM viewers WHERE ID = " . $user . "");
        $data = mysqli_fetch_all($requeteGame, MYSQLI_ASSOC);

        if ($data) {
            return $data["ID"];
        } else {
            return false;
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
