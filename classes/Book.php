<?php
require "configuration/connect.php";
require "services/Slug.php";
//require "book.php";

class Book
{
    private ?int $id;
    private ?string $title;
    private ?string $author;
    private ?string $description;
    private ?string $cover;
    private ?string $category;
    private ?int $price;
    private ?int $year;
    private ?string $editor;
    private ?string $language;
    private ?int $pages;
    private ?string $format;
    private ?string $isbn;
    private ?bool $active;
    private ?string $slug;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function getEditor()
    {
        return $this->editor;
    }

    public function setEditor($editor)
    {
        $this->editor = $editor;
        return $this;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function setPages($pages)
    {
        $this->pages = $pages;
        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $res = Slug::toSlug($slug);
        $this->slug = $res;
        return $this;
    }
    //custom méthodes:
    //pour récuperer les livres
    public static function getBooks():array
    {
        // requete sql pour recuperer les donnees
        $sql = "SELECT* FROM book";

        $db = Connect::connect();

        // execute la requete
        $query = $db->prepare($sql);
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC=> pour afficher en forme de tableau associatif
        return $books; // => toujours on doit faire un return si non on aura pas de donnees.

    }

    static function getOneBook($slug): array
    {
        // requete sql pour recuperer les donnees


        $db = Connect::connect();


        // execute la requete
        $query = $db->prepare("SELECT * FROM book WHERE slug=:slug");
        $query->bindValue(':slug', $slug, PDO::PARAM_STR);

        $query->execute();
        $book = $query->fetch(PDO::FETCH_ASSOC); // FETCH_ASSOC=> pour afficher en forme de tableau associatif
        return $book; // => toujours on doit faire un return si non on aura pas de donnees.

    }

    public static function deleteBook($id): void
    {
        $db = Connect::connect();


        // execute la requete
        $query = $db->prepare("DELETE FROM book WHERE id=:id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();


        //$book=$query->fetch(PDO::FETCH_ASSOC); // FETCH_ASSOC=> pour afficher en forme de tableau associatif
        //return $book;
    }

    public static function editBook($obj): void
    {
        $db = Connect::connect();


        // execute la requete
        $query = $db->prepare("UPDATE book SET title=:title, author=:author, category=:category,
                               description=:description, year=:year, isbn=:isbn, slug=:slug
                               WHERE id=:id;");
        $query->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
        $query->bindValue(':title', $obj->getTitle(), PDO::PARAM_STR);
        $query->bindValue(':author', $obj->getAuthor(), PDO::PARAM_STR);
        $query->bindValue(':category', $obj->getCategory(), PDO::PARAM_STR);
        $query->bindValue(':description', $obj->getDescription(), PDO::PARAM_STR);
        $query->bindValue(':year', $obj->getYear(), PDO::PARAM_INT);
        $query->bindValue(':isbn', $obj->getIsbn(), PDO::PARAM_STR);
        $query->bindValue(':slug', $obj->getSlug(), PDO::PARAM_STR);
        
        $query->execute();

        

        header('Location: book.php?slug='.$obj->getSlug());
        //$book=$query->fetch(PDO::FETCH_ASSOC); // FETCH_ASSOC=> pour afficher en forme de tableau associatif
        //return $book;
    }


    public static function addBook($obj)
    {
        $sql = "INSERT INTO book(title,author, category, description ,  year , isbn , slug) 
            VALUES(:title , :author, :category,:description, :year, :isbn, :slug)";





        $db = Connect::connect();

        // execute la requete
        $query = $db->prepare($sql);
        $query->bindValue(':title', $obj->getTitle(), PDO::PARAM_STR);
        $query->bindValue(':author', $obj->getAuthor(), PDO::PARAM_STR);
        $query->bindValue(':category', $obj->getCategory(), PDO::PARAM_STR);
        $query->bindValue(':description', $obj->getDescription(), PDO::PARAM_STR);
        $query->bindValue(':year', $obj->getYear(), PDO::PARAM_INT);
        $query->bindValue(':isbn', $obj->getIsbn(), PDO::PARAM_STR);
        $query->bindValue(':slug', $obj->getSlug(), PDO::PARAM_STR);

        $query->execute();
    }

    
  
}
