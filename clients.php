<?php
require_once "configuration/Connect.php";
require_once "templates/header.html.php";

 
$db = Connect::connect();
$sql = $db->prepare("SELECT* FROM clients");
$sql->execute();
$clients = $sql->fetchAll(PDO::FETCH_ASSOC);



?>

<h3 class="text-center mt-4">Réservations en cours</h2>
    <div class="rounded p-3 m-4 bg-light shadow">
        <table class="table table-striped">
            <thead>
                <tr>

                    
                    <th scope="col">Prenom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Age</th>
                    <th scope="col">Caution</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $item): ?>
                    <tr>

                        <td><?= $item['firstname']; ?></td>
                        <td><?= $item['lastname']; ?></td>
                        <td><?php $date = new DateTime('now');
                            echo $date->format('Y') - $item['year']; ?></td>
                        <td>
                            <?php if ($item['deposit'] === 1) {
                                echo "<p class=badge bg-success rounded-pill> Déposée</p>";
                            } else {
                                echo "<p class=badge bg-warning text-dark rounded-pill>Non déposée</p>";
                            }
                            ?>

                        </td>
                    </tr>
                <?php endforeach ?>