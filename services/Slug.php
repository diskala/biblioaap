<?php
 
  // service de gestion pour biblioApp
   
  class Slug
  {
     public string $input;

     // méthode pour générer un slug
     

public static function toSlug(string $input){
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $input);     
return $slug;  
  }
}
?>