<?php
 
 require_once "classes/Book.php";
 
$totalBooks=count(Book::getBooks()) ;
require_once 'templates/header.html.php';

if(!empty($_POST)){
    $book=new Book();
    $book->setTitle($_POST['title'])
         ->setAuthor($_POST['author'])
         ->setDescription($_POST['description'])
         ->setCategory($_POST['category'])
         ->setYear($_POST['year'])
         ->setIsbn($_POST['isbn'])
         ->setSlug($_POST['slug']);
         
        

Book::addBook($book);
if(isset($_GET['success'])){
if( $_GET['success']==1)
{
   echo "<div class=alert alert-success role=alert>Enregistrement reussi
   </div>" ;
}
elseif($_GET['success']==false)
{
   echo "<div class=alert alert-danger role=alert>
     Une erreur s\'est produite!! merci de réessayer.
  </div>";
}
}
 
}
?>

<!-- Liste de livres -->
<div class="text-center mt-4">
<h2 >Bibliothèque
    <span class="badge rounded-pill text-bg-primary mx-2"><?= $totalBooks;?></span>
</h2>

<button type="button" class="btn close" data-bs-toggle="modal" data-bs-target="#addBook"> Ajouter un livre</button>
</div>
<div class= "row rounded p-3 m-4 gap-4 bg-light shadow switch-row justify-content-center" >
<?php include "templates/_partials/_books-card.html.php";?></div>

<div class="modal fade" id="addBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  action=""  method="post" >
  <div class="mb-3">
   <label for="title" class="form-label">Titre</label>
    <input type ="text" name ="title" list="listeCategorie" class="form-control" id="title" aria-describedby="titleHelp">
    <div id="titleHelp" class="form-text"></div>

    <label for="author" class="form-label">Auteur</label>
    <input type ="text" name ="author" list="listeCategorie" class="form-control" id="author" aria-describedby="authorHelp">
    <div id="authorHelp" class="form-text"></div>
    

    <label for="category" class="form-label">Choisir une catigorie</label>
    <select name ="category" list="listeCategorie" class="form-control" id="category" aria-describedby="categorieHelp">
        <option value="" selected>Choisir une categorie</option>
        <option value="roman">Roman</option>
        <option value="essai">Essai</option>
        <option value="theatre">Théâtre</option>
        <option value="biographie">Biographie</option>
        <option value="poésie">Poésie</option>
    
    </select>
    <div id="categorielHelp" class="form-text">We'll never share your email with anyone else.</div>

    <label for="description" class="form-label">Description</label>
    <input type ="text" name ="description" list="listeCategorie" class="form-control" id="description" aria-describedby="authorHelp">
    <div id="authorHelp" class="form-text"></div>
    
    <label for="year" class="form-label">L'annee de l'édition</label>
    <input type ="text" name ="year" list="listeCategorie" class="form-control" id="year" aria-describedby="yearHelp">
    <div id="yearlHelp" class="form-text"></div>

    

    <label for="isbn" class="form-label">N°:siret</label>
    <input type ="text" name ="isbn" list="listeCategorie" class="form-control" id="isbn" aria-describedby="isbnHelp">
    <div id="isbnHelp" class="form-text"></div>

    <label for="slug" class="form-label">SLUG</label>
    <input type ="text" name ="slug" list="listeCategorie" class="form-control" id="slug" aria-describedby="yearHelp">
    <div id="slugHelp" class="form-text"></div>

     
  
  </div>
 
  <button type="submit" class="btn btn-primary">Valide</button>
</form>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>
  </div>
</div>
    

<p class="text-center mb-4">
    <!--<a href="books.php" class="btn btn-outline-primary text-center">Ajouter des livres</a>-->
</p>

<hr>

 
<?php

require 'templates/footer.html.php';
?>

