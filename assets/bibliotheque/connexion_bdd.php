<?php

function connexionBase()
{
    
    //parametre de connexion serveur
    $host='localhost'; 
    $login="root";               //Votre loggin d'acces au serveur de bdd
    $password="123";            //le password pour vous identifier aupres du serveur
    $base="Jarditou";          //la bdd avec laquelle vous voulez travailler
    
    
    try {
        
            {
        
              $db=new PDO('mysql:host='.$host.';charset=utf8;dbname='.$base,$login,$password);
                 return $db;
             
            }
        }
         catch (Exception $e) 
            {
        
                echo 'Erreur : ' .$e->getMessage().'<br>';
                echo 'N° : ' . $e->getCode() . '<br>';
                die('Connexion au serveur impossible.');
        
            }

}
    
    


?>