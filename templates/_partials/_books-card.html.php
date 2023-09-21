<?php
// fichier de composants (partial) pour la listes des livres sous forme de carte

require_once 'classes/Book.php';
?>
<?php
foreach(Book::getBooks() as $book):?>


    
   <div class="card col-md-3 col-sm-5 col-sm-12 card-bg">
        <div class="card-body text-light">
            <h5 class="card-title"><?=substr($book['title'],0,20);?></h5>
            <h6 class="card-subtitle mb-2"><?=$book['author'];?></h6>
            <p class="card-text"><?=substr($book['description'],0,110);?></p>
            <p class="card-text"><?=$book['category'];?></p>
            <p class="card-text"><?=$book['year'];?></p>
            <a href="book.php?slug=<?=$book['slug'];?>" class="btn btn-sm btn-outline-light">Voir</a>
            <a href="reservation.php?id=<?=$book['id'];?>" class="btn btn-sm btn-success">Reservation</a>
        </div>
    </div>
<?php endforeach ?>


<?php
/*foreach(Book::getBooks() as $book)
{
echo ' <div class=card col-md-3 col-sm-5 col-sm-12 card-bg>';
   echo ' <div class=card-body text-light>';
   echo '     <h5 class=card-title>Card title</h5>';
   echo '     <h6 class=card-subtitle mb-2>Card subtitle</h6>';
   echo '     <p class=card-text>Some quick example text to build on the card title and make up the bulk of the card\' s content.</p>';
   echo '     <a href=# class="btn btn-sm btn-outline-light>Voir</a>';
   echo '     <a href="#" class="btn btn-sm btn-success>Réserver</a>';
   echo ' </div>';
echo '</div>';
}*/
?>