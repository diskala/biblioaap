<?php
require "classes/Book.php";
require 'templates/header.html.php';



/**
 * Page d'un livre seul
 */
$book = Book::getOneBook($_GET['slug']);
//var_dump($book);
if (isset($_POST['id'])) { // si il y'a une requete $_POST avec formType alors 
    if (isset($_POST['delete'])) // si 'formType' est egale en valeur à delete 
    {

        Book::deleteBook($_POST['id']);
    } 
    elseif (isset($_POST['edit'])) {
        $book = new Book();
        $book->setId($_POST['id'])
            ->setTitle($_POST['title'])
            ->setAuthor($_POST['author'])
            ->setCategory($_POST['category'])
            ->setDescription($_POST['description'])
            ->setYear($_POST['year'])
            ->setIsbn($_POST['isbn'])
            ->setSlug($_POST['title']);

        Book::editBook($book);

    }
}
?>
<h1 class="text-center"><?= $book['title']; ?></h1>
<div class="justify-content-center d-flex gap-3">
<button type="button" class="btn close" data-bs-toggle="modal" data-bs-target="#editBook"> Modifier</button>

    <form action="" method="post">
        <input name="delete" type="submit" value="Supprimer">
        <input type="text" name='id' value="<?= $book['id'] ?>" hidden>


    </form>





    <div class="modal fade" id="editBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">

                            <label for="id" class="form-label">Identifiant</label>
                            <input type="text" name="id" list="listeCategorie" class="form-control" id="id" aria-describedby="titleHelp" value="<?= $book['id']; ?>" hidden>
                            <div id="titleHelp" class="form-text"></div>

                            <label for="title" class="form-label">Titre</label>
                            <input type="text" name="title" list="listeCategorie" class="form-control" id="title" aria-describedby="titleHelp" value="<?= $book['title']; ?>">
                            <div id="titleHelp" class="form-text"></div>

                            <label for="author" class="form-label">Auteur</label>
                            <input type="text" name="author" list="listeCategorie" class="form-control" id="author" aria-describedby="authorHelp" value="<?= $book['author']; ?>">
                            <div id="authorHelp" class="form-text"></div>


                            <label for="category" class="form-label">Choisir une catigorie</label value="<?= $book['category']; ?>">
                            <select name="category" list="listeCategorie" class="form-control" id="category" aria-describedby="categorieHelp">
                                <option value="" selected>Choisir une categorie</option>
                                <option value="roman">Roman</option>
                                <option value="essai">Essai</option>
                                <option value="theatre">Théâtre</option>
                                <option value="biographie">Biographie</option>
                                <option value="poésie">Poésie</option>

                            </select>
                            <div id="categorielHelp" class="form-text">We'll never share your email with anyone else.</div>

                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" list="listeCategorie" class="form-control" id="description" aria-describedby="authorHelp" value="<?= $book['description']; ?>">
                            <div id="authorHelp" class="form-text"></div>

                            <label for="year" class="form-label">L'annee de l'édition</label>
                            <input type="text" name="year" list="listeCategorie" class="form-control" id="year" aria-describedby="yearHelp" value="<?= $book['year']; ?>">
                            <div id="yearlHelp" class="form-text"></div>



                            <label for="isbn" class="form-label">N°:siret</label>
                            <input type="text" name="isbn" list="listeCategorie" class="form-control" id="isbn" aria-describedby="isbnHelp" value="<?= $book['isbn']; ?>">
                            <div id="isbnHelp" class="form-text"></div>

                            <label for="slug" class="form-label">SLUG</label>
                            <input type="text" name="slug" list="listeCategorie" class="form-control" id="slug" aria-describedby="slugHelp" value="<?= $book['slug']; ?>">
                            <div id="slugHelp" class="form-text"></div>



                        </div>

                        <button name="edit" type="submit" class="btn btn-primary">Valide</button>
                    </form>

                     
                </div>
            </div>
        </div>


        <p class="text-center mb-4">
            <!--<a href="books.php" class="btn btn-outline-primary text-center">Ajouter des livres</a>-->
        </p>

        <hr>

        <?php require "templates/footer.html.php"; ?>