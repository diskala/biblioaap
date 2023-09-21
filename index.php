<?php
//require 'configuration/Connect.php';
 
 
//Connect::connect();
require_once 'templates/header.html.php';

?>

<!-- Liste de livres -->
<h2 class="text-center mt-4">Liste des livres</h2>
<div class="biblioapp-dashboard-books rounded p-3 m-4 d-flex gap-2 bg-light shadow switch-row">
    <?php include "templates/_partials/_books-card.html.php";?>
    <div class="card col-md-3 col-sm-5 col-sm-12 card-bg">
        <div class="card-body text-light">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-sm btn-outline-light">Voir</a>
            <a href="#" class="btn btn-sm btn-success">Réserver</a>
        </div>
    </div>
    
</div>
<p class="text-center mb-4">
    <a href="books.php" class="btn btn-outline-primary text-center">Voir tous les livres</a>
</p>

<hr>

<!-- Liste de réservations -->
<h3 class="text-center mt-4">Réservations en cours</h2>
<div class="rounded p-3 m-4 bg-light shadow">
<?php include "templates/_partials/_currentReservations-table.html.php";?>
    
</div>
<p class="text-center mb-4">
    <a href="reservations.php" class="btn btn-outline-primary text-center">Voir toutes les réservations</a>
</p>

<hr>

<!-- Liste de actions rapides -->
<h3 class="text-center mt-4">Actions rapides</h2>
<div class="d-flex text-center justify-content-center p-4 switch-row">
    <div class="col-md-3 col-sm-12 border rounded p-3 m-4">
        <p>
            Vous pouvez ajouter un livre à partir de cette page en quelques clics.
        </p>
        <a href="books.php" class="btn btn-outline-primary text-center">
            <i class="bi bi-plus-circle"></i>
            Ajouter un livre
        </a>
    </div>
    <div class="col-md-3 col-sm-12 border rounded p-3 m-4">
        <p>
            Vous pouvez ajouter une réservation en cliquant sur le bouton.
        </p>
        <a href="reservations.php" class="btn btn-outline-primary text-center">
            <i class="bi bi-plus-circle"></i>
            Ajouter une réservation
        </a>
    </div>
    <div class="col-md-3 col-sm-12 border rounded p-3 m-4">
        <p>
            Un nouvel adhérent ? Vous pouvez l'ajouter à partir de cette page.
        </p>
        <a href="clients.php" class="btn btn-outline-primary text-center">
            <i class="bi bi-plus-circle"></i>
            Ajouter un client
        </a>
    </div>
</div>

<?php

require 'templates/footer.html.php';
