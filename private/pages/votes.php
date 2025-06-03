<?php

use function PHPSTORM_META\type;

$connection = new mysqli("localhost", "root", "", "exercicebonus2");
$data = [];
$retourValeur = "";

include("private/functions/apiVoteAll.php");
include("private/functions/tools.php");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    $requeteUser = mysqli_query($connection, "SELECT * FROM notes");
    $data = mysqli_fetch_all($requeteUser, MYSQLI_ASSOC);
}

if ($_POST) {
    $jeu_id = $_POST['jeu_id'];
    $fun = $_POST['fun'];
    $graph = $_POST['graph'];
    $user = $_POST['user'];
    $durée = $_POST['duree'];
    $gameId = verifGame($jeu_id);
    $allBareme = verifBareme($fun, $graph, $durée);
    $thisUser = verifUser($user);
    if ($gameId != false && $allBareme != false && $thisUser != false) {
        $newNote = verifNote($allBareme);
        insertVote($thisUser, $newNote, $gameId);
    }
}

?>


<?php include('./private/structures/header.php'); ?>

<head>
    <title>Page vote best</title>
    <meta name="description" content="C'est ma page 1 bravo " />
</head>
<main>
    <section class="mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex flex-column align-items-center">
                    <div class="d-flex flex-column p-5 rounded border border-dark">
                        <p class=" fs-1 text-center">Voici ma page <span class="fw-bold">votes</span>.php</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <p class="fs-1 text-center">Votes actuel :</p>
                </div>
                <?php
                foreach ($data as $value) {
                    $user = haveUser($value["idUser"]);
                    $game = haveGame($value["jeu_id"]);
                    $note = $value["valeur"];
                    echo '<div class="col-12 mt-3">';
                    echo "<div class='container-fluid'>";
                    echo "<div class='row radius border d-flex flex-row justify-content-center'>";

                    echo '<div class="col-2 d-flex flex-column align-items-center">';
                    echo '<img src="' . $game["image"] . '" class="img-fluid w-50">';
                    echo '</div>';
                    echo '<div class="col-2 d-flex flex-column align-items-center">';
                    echo '<p class="fs-6">Nom du jeu : ' . $game["name"] . '</p>';
                    echo '</div>';
                    echo '<div class="col-2 d-flex flex-column align-items-center">';
                    echo '<p class="fs-6">Nom du user : ' . $user . '</p>';
                    echo '</div>';
                    echo '<div class="col-2 d-flex flex-column align-items-center">';
                    echo '<p class="fs-6">Note : ' . $note . '/20</p>';
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <p class="fs-1 text-center">Voter un jeu</p>
                </div>
                <span><?php echo $retourValeur ?></span>
                <form action="votes" method="post">
                    <div class="col-12 mt-3 d-flex flex-column align-items-center">
                        <label for="jeu_id" class="form-label">GameID</label>
                        <input type="number" class="form-control w-25" name="jeu_id" id="jeu_id" required>
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column align-items-center">
                        <label for="fun" class="form-label">Fun</label>
                        <input type="number" class="form-control w-25" name="fun" id="fun" required>
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column align-items-center">
                        <label for="graph" class="form-label">Graph</label>
                        <input type="number" class="form-control w-25" name="graph" id="graph" required>
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column align-items-center">
                        <label for="duree" class="form-label">Duree</label>
                        <input type="number" class="form-control w-25" name="duree" id="duree" required>
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column align-items-center">
                        <label for="user" class="form-label">User</label>
                        <input type="text" class="form-control w-25" name="user" id="user" required>
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column align-items-center">
                        <button type="submit" class="btn btn-primary">Envoyez</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include('./private/structures/footer.php'); ?>