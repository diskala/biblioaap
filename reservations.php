<?php
 require_once "classes/Reservation.php";
 require_once "classes/Book.php";
 require_once "classes/Client.php";
  
 

 $totalReservations = count(Reservation::getAllReservations());
 if(isset($_GET))
 {
    if(isset($_GET['idResa']))
    {
        Reservation::closeReservation($_GET['idResa']);
    }
 }//Traitement du formulaire modal
 
if(!empty($_POST)) {
    empty($_POST['isClosed']) ? $closed = false : $closed = true;
    empty($_POST['isArchived']) ? $archived = false : $archived = true;
    $reservation = new Reservation();
    $reservation->setClientId($_POST['clientId'])
        ->setBookId($_POST['bookId'])
        ->setDateStart($_POST['startDate'])
        ->setDateEnd($_POST['endDate'])
        ->setDatereturn($_POST['returnDate'])
        ->setIsClosed($closed)
        ->setIsArchived($archived)
    ;
    Reservation::addReservation($reservation);
    //var_dump($reservation);
}else{
    $clients = Client::getClient();
    $books = Book::getBooks();
}

 require 'templates/header.html.php';
 ?>
 <div class="text-center mt-4">
     <h2><i class="bi bi-book mx-2"></i> BiblioApp - 
         <span class="badge rounded-pill text-bg-success mx-2"> <?= $totalReservations; ?> Réservations</span>
     </h2>
     <br>
     <button name="ajout" type="button" class="btn btn-outline-danger btn-lg text-bg-warning" data-bs-toggle="modal" data-bs-target="#addReservation">
         Ajouter une Réservation
     </button>
 </div>
 <div class="rounded p-3 m-4 gap-4 bg-light shadow switch-row row justify-content-center">
 <?php if(isset($_GET['success'])) : ?>
        <?php if($_GET['success']) : ?>
            <div id="msgAlert" class="alert alert-success" role="alert">Enregistrement réussi !</div>
        <?php elseif(!$_GET['success'])  : ?>
            <div id="msgAlert" class="alert alert-danger" role="alert">Erreur, veuillez réessayer</div>
        <?php endif ?>
    <?php endif ?>

     <?php include 'templates/_partials/_reservations-table.html.php'; ?>
 </div>

 <!-- Modal - TODO : sécuriser le formulaire d'ajout de réservation --> 
<div class="modal fade" id="addReservation" tabindex="-1" role="dialog" aria-labelledby="addReservationLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addReservationLabel">Ajouter une Réservation</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="form-group">
                <label for="bookReservation">Livre</label>
                <select value="" class="custom-select form-control" name="bookId" id="bookReservation" placeholder="Sélectionnez un livre" required>
                    <?php foreach($books as $book) : ?>
                        <option value = "<?= $book['id'] ?>"> <?= $book['title'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="clientReservation">Client</label>
                <select value="" class="custom-select form-control" name="clientId" id="clientReservation" placeholder="Sélectionnez un client" required>
                    <?php foreach($clients as $client) : ?>
                        <option value = "<?= $client['id'] ?>"> <?= $client['lastname'] . " " . $client['firstname'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="startReservation">Début</label>
                <input type="date" class="form-control" name="startDate" id="startReservation" aria-describedby="startHelp" placeholder="Entrez une date ..." required>
                <small id="startHelp" class="form-text text-muted">Choisissez une date</small>
            </div>
            <div class="form-group">
                <label for="endReservation">Fin</label>
                <input type="date" class="form-control" name="endDate" id="endReservation" aria-describedby="endHelp" placeholder="Entrez une date ..." required>
                <small id="endHelp" class="form-text text-muted">Choisissez une date</small>
            </div>
            <div class="form-group">
                <label for="returnReservation">Retour</label>
                <input type="date" class="form-control" name="returnDate" id="returnReservation" aria-describedby="returnHelp" placeholder="Entrez une date ..." required>
                <small id="returnHelp" class="form-text text-muted">Choisissez une date</small>
            </div>
            <div class="checkbox">
                <label><input name="isClosed" type="checkbox"> Cloturé ?</label>
            </div>
            <div class="checkbox">
                <label><input name="isArchived" type="checkbox"> Archivé ?</label>
            </div>
            <div class="row mt-2 offset-md-1">
                <div class="col-md-5">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save mx-2"></i>
                        Enregistrer
                    </button>
                </div>
                
                <div class="col-md-5 offset-md-1">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" float-right>
                        <i class="bi bi-x-circle mx-2"></i>
                        Annuler
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

 <?php
 
 require 'templates/footer.html.php';
 