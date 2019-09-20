<?php

$config = array(
    'ajout' => array(
        array(
            'field' => 'pro_ref', //nom du champ de saisie
            'label' => 'reference', //nom de la colonne 
            'rules' => array(
                'required', //obligatoire
                'regex_match[/^[A-Za-z-0-9]{1,10}+$/]'  //regex
                
            ),
            'errors' => array(      //tableau d'erreur avec les messages a afficher en cas de probleme
                'required' => ' %s manquante',
                'regex_match' => 'La saisie du champ %s est invalide.'
            ),
        ),
        array(
            'field' => 'pro_libelle',
            'label' => 'libelle',
            'rules' => array(
                'required',
                'regex_match[/^[A-Za-z-é]{1,200}+$/]'
            ),
            'errors' => array(
                'required' => ' %s manquant',
                'regex_match' => 'La saisie du champ %s est invalide.'
            ),
        ),
        array(
            'field' => 'pro_description',
            'label' => 'description',
            'rules' => array(
                'required',
                'regex_match[/^[A-Za-z-é]{1,1000}+$/]'
            ),
            'errors' => array(
                'required' => ' %s manquante',
                'regex_match' => 'La saisie du champ %s est invalide.'
            ),
        ),
        array(
            'field' => 'pro_prix',
            'label' => 'prix',
            'rules' => array(
                'required',
                'regex_match[/^[0-9-.]{1,8}+$/]'
            ),
            'errors' => array(
                'required' => ' %s manquant',
                'regex_match' => 'La saisie du champ %s est invalide.'
            ),
        ),
        array(
            'field' => 'pro_stock',
            'label' => 'stock',
            'rules' => array(
                'required',
                'regex_match[/^[0-9]{1,9}+$/]'
            ),
            'errors' => array(
                'required' => ' %s manquant',
                'regex_match' => 'La saisie du champ %s est invalide.'
            ),
        ),
        array(
            'field' => 'pro_couleur',
            'label' => 'couleur',
            'rules' => array(
                'required',
                'regex_match[/^[A-Za-z-é]{1,30}+$/]'
            ),
            'errors' => array(
                'required' => ' %s manquante',
                'regex_match' => 'La saisie du champ %s est invalide.'
            ),
        ),
       
        
         
        
   
        
        ));
?>