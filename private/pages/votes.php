<?php
$connection = new mysqli("localhost", "root", "", "exercicebonus2");
$data = [];

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    $requeteUser = mysqli_query($connection, "SELECT * FROM notes");
    $data = mysqli_fetch_all($requeteUser, MYSQLI_ASSOC);
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
                <div class="col-12 mt-3">
                    <?php
                    foreach ($data as $value) {
                        echo $value["name"];
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('./private/structures/footer.php'); ?>