<?php require_once "classes/Reservation.php";?>

<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Voir</th>
                <th scope="col">Livre</th>
                <th scope="col">Client</th>
                <th scope="col">Début</th>
                <th scope="col">Fin</th>
                <th scope="col">Rendu?</th>
                <th scope="col">Cloturé?</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (Reservation::getAllReservations() as $item):?>
                  <?=include "_Reservation-row.html.php";?>
                <?php endforeach ?>
            
             
        </tbody>
    </table>