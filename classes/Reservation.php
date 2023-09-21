<?php
class Reservation {
    private ?int $id;
    private ?int $book_id;
    private ?int $client_id;
    private ?string $start_date;
    private ?string $end_date;
    private ?string $isClosed;
    private ?string $isArchived;
    private ?string $date_return;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getBookId() {
        return $this->book_id;
    }

    public function setBookId($book_id) {
        $this->book_id = $book_id;
        return $this;
    }

    public function getClientId() {
        return $this->client_id;
    }

    public function setClientId($client_id) {
        $this->client_id = $client_id;
        return $this;
    }

    public function getDateStart() {
        return $this->start_date;
    }

    public function setDateStart($start_date) {
        $this->start_date= $start_date;
        return $this;
    }

    public function getDateEnd() {
        return $this->end_date;
    }

    public function setDateEnd($end_date) {
        $this->end_date = $end_date;
        return $this;
    }

    public function getIsClosed() {
        return $this->isClosed;
    }

    public function setIsClosed($isClosed) {
        $this->isClosed = $isClosed;
        return $this;
    }

    public function getisArchived() {
        return $this->isArchived;
    }

    public function setisArchived($isArchived) {
        $this->isArchived = $isArchived;
        return $this;
    }
    public function getDateReturn() {
        return $this->date_return;
    }
    public function setDateReturn($date_return) {
        $this->date_return = $date_return;
        return $this;
    }




    static function getReservation(): array
    {
        // requete sql pour recuperer les donnees


        $db = Connect::connect();


        // execute la requete
        $sql = "SELECT reservation.*, clients.firstname, clients.lastname, book.title,
                               book.author FROM reservation

                               LEFT JOIN clients ON reservation.client_id=clients.id
                               LEFT JOIN book ON reservation.book_id=book.id
                               WHERE reservation.isClosed=0 AND reservation.isArchived=0
                               ORDER BY reservation.start_date;";
        
        $query=$db->prepare($sql);
        $query->execute();

        $res= $query->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC=> pour afficher en forme de tableau associatif
        
        return $res; // => toujours on doit faire un return si non on aura pas de donnees.

    }


    static function getAllReservations(): array
    {
        // requete sql pour recuperer les donnees


        $db = Connect::connect();


        // execute la requete
        $sql = "SELECT reservation.*, clients.firstname, clients.lastname, book.title,
                               book.author FROM reservation

                               LEFT JOIN clients ON reservation.client_id=clients.id
                               LEFT JOIN book ON reservation.book_id=book.id
                               ORDER BY reservation.isArchived, reservation.isClosed, reservation.start_date;";
        
        $query=$db->prepare($sql);
        $query->execute();

        $allRes= $query->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC=> pour afficher en forme de tableau associatif
        
        return $allRes; // => toujours on doit faire un return si non on aura pas de donnees.

    }

   public static function closeReservation($id):void
   {
    $db = Connect::connect();
    $sql="UPDATE reservation SET isClosed=1, date_return=:date_return WHERE id=:id";
    $date_return=(new DateTime('now'))->format('Y-m-d');
    $query=$db->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT );
    $query->bindValue(':date_return',$date_return,PDO::PARAM_STR );
    $query->execute();
   }

    

    public static function addReservation($obj):void
{
    $sql = "INSERT INTO reservation(client_id, book_id,  end_date, isClosed, isArchived, start_date, date_return) 
                  VALUES(:client_id, :book_id, :end_date, :isClosed, :isArchived, :start_date, :date_return)";

    $db = Connect::connect();

    // execute la requete
    $query = $db->prepare($sql);
     
    $query->bindValue(':client_id', $obj->getClientId(), PDO::PARAM_STR);
    $query->bindValue(':book_id', $obj->getBookId(), PDO::PARAM_STR);
    $query->bindValue(':end_date',$obj->getDateEnd(), PDO::PARAM_INT);
    $query->bindValue(':isClosed', $obj->getIsClosed(), PDO::PARAM_STR);
    $query->bindValue(':isArchived', $obj->getIsArchived(), PDO::PARAM_STR);
    $query->bindValue(':start_date', $obj->getDateStart(), PDO::PARAM_STR);
    $query->bindValue(':date_return', $obj->getDateReturn(), PDO::PARAM_STR);
    

    $query->execute();

    if($query)
    {
        header('Location: reservations.php?success=1');
    }
    else
    {
        header('Location: reservations.php?success= 0');
    }
}

}

