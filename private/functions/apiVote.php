<?php

function verifInfo($jeu, $fun, $graph, $duree, $user)
{
    if (!$jeu) return false;
    elseif (!$fun) return false;
    elseif (!$graph) return false;
    elseif (!$duree) return false;
    elseif (!$user) return false;
    else return true;
}

$jeu_id = $_POST['jeu_id'];
$fun = $_POST['fun'];
$graph = $_POST['graph'];
$duree = $_POST['duree'];
$user = $_POST['user'];

if (verifInfo($ĵeu_id, $fun, $graph, $duree, $user)) {
    //
}
