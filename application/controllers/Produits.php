	
<?php

// application/controllers/Produits.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller {

    public function liste() {


        
        // On charge le modèle 'produits_model'

        $this->load->model('produits_model');

        $aListe = $this->produits_model->liste();






        // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue      

        $aView["liste_produits"] = $aListe;



        // Appel de la vue avec transmission du tableau  

        $this->load->view('liste', $aView);
    }

    //ajout----------------------------------------------------------------------------------------------------------------------------------------------------------




    public function ajout() {
        // Exécute la requête 
        $this->load->model('produits_model');


        if ($this->input->post()) { // 2ème appel de la page: traitement du formulaire
            $data = $this->input->post();





            //verif ref
            $aListe = $this->produits_model->ajout_verif_ref();



            //validation formulaires

            $this->load->library('form_validation');
            $this->form_validation->run('ajout');








            //validation du formulaire----------------------------------------------------------------------

            if ($this->form_validation->run() == FALSE) {   //si le formulaire n'est pas bon
                //select categorie
                $acategorie = $this->produits_model->ajout_categorie();

                // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue      
                $aView["liste_categorie"] = $acategorie;
                $this->load->view('ajout', $aView);
            } else {



                if ($aListe <> 0) {

                    redirect("produits/ajout");
                } else {



                    $this->load->library('upload');

                    $this->load->model('produits_model');

                    //insertion
                    $this->produits_model->insert();

                    //upload-----------------------------------------------------------------------------------------
                    //select id pour image
                    $id = $this->produits_model->id_image();

                    $nom_photo = get_object_vars($id[0]);

                    $nom_final = $nom_photo['pro_id'];




                    $this->load->library('upload');
                    $config['overwrite'] = true;


                    // On créé un tableau de configuration pour l'upload

                    $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier
                    $config['file_name'] = $nom_final;                    // nom du fichier final

                    $config['allowed_types'] = 'gif|jpg|png'; // Types autorisés (ici pour des images)


                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('fichier')) {

                        // Echec : on récupère les erreurs dans une variable (une chaîne)

                        $errors = $this->upload->display_errors();



                        // on réaffiche la vue du formulaire en passant les erreurs 

                        $aView["errors"] = $errors;
                    } else {




                        //recupere l'extension de l'image

                        $extension = $this->upload->data('file_ext');


                        //retire le point de l'extension
                        $data['pro_photo'] = substr($extension, 1);




                        //redirection
                        redirect("produits/liste");
                    }
                }
            }
        } else {
            //select categorie
            $acategorie = $this->produits_model->ajout_categorie();


            // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue      

            $aView["liste_categorie"] = $acategorie;



            // Appel de la vue avec transmission du tableau  

            $this->load->view('ajout', $aView);
        }
    }

    //modif--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function modif($id) {

        $this->load->model('produits_model');
        //recuperation donnée bdd

        $results = $this->db->query("SELECT * FROM produits WHERE pro_id=?", $id);

        // Récupération des résultats    

        $aView["page_modif"] = $results->row();




        //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //liste déroulante


        $acategorie = $this->produits_model->categorie_modif();



        // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue      

        $aView["liste_categorie"] = $acategorie;





        //---------------------------------------------------------------------






        if ($this->input->post()) {


            $data = $this->input->post();                   //recupere les données de chaque champ
            //condition de pro_bloque
            if ($data["pro_bloque"] == 0) {
                $data["pro_bloque"] = Null;
            }



            //upload-----------------------------------------------------------------------------------------
            $this->load->library('upload');
            $config['overwrite'] = true;


            // On créé un tableau de configuration pour l'upload

            $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier
            $config['file_name'] = $id;                    // nom du fichier final

            $config['allowed_types'] = 'gif|jpg|png'; // Types autorisés (ici pour des images)


            $this->upload->initialize($config);



            $this->load->library('form_validation');
            $this->form_validation->run('ajout');




            //verification du formulaire------------------------------------------------------------------------

            if ($this->form_validation->run() == FALSE || !$this->upload->do_upload('fichier')) {   //si le formulaire n'est pas bon
                $this->load->view('modif', $aView);
                $aView["errors"] = "Format d'image incorrect";
            } else {


                //recupere l'extension de l'image
                $extension = $this->upload->data('file_ext');
                //retire le point de l'extension
                $data['pro_photo'] = substr($extension, 1);

                //modification dans la bdd

                $this->produits_model->update_modif($id, $data);
               redirect("produits/liste");
            }
        } else {

            $this->load->model('produits_model');
            $this->load->view('modif', $aView);

            // 1er appel de la page: affichage du formulaire
        }
    }

    //suppression--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function suppression($pro_id) {
        $this->load->model('produits_model');
        //requete suppression
        $this->produits_model->suppression($pro_id);

        redirect('produits/liste');
    }

   
    
    
    
    
    //panier--------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    public function panier(){
    $this->load->view('panier');
    }
    
    //ajout au pannier

    public function ajoutePanier() { //ajoute un produit au panier
        $data = $this->input->post();
       
        

        if ($this->session->panier == null) { // création du panier s'il n'existe pas
            $this->session->panier = array();

            $tab = $this->session->panier;

            //On ajoute le produit

            array_push($tab, $data); // Empile un ou plusieurs éléments à la fin d'un tableau

            $this->session->panier = $tab;

            redirect("produits/liste");
            
        } else { //si le panier existe
            $tab = $this->session->panier;

            $idProduit = $this->input->post('pro_id');

            $sortie = false;

            foreach ($tab as $produit) { //on cherche si le produit existe déjà dans le panier
                if ($produit['pro_id'] == $idProduit) {

                    $sortie = true;
                }
            }

            if ($sortie) { //si le produit existe déjà, l'utilisateur est averti
                echo '<div class="alert alert-danger">Ce produit est déjà dans le panier.</div>';

                $this->liste();
            } else { //sinon le produit est ajouté dans le panier
                array_push($tab, $data);

                $this->session->panier = $tab;

               redirect("produits/liste");
            }
        }
    }
    
    
    	//ajout supplementaire au panier
public function qteplus($id)
	
{
	
    $tab = $this->session->panier;
	
    $temp = array();
	
 
	
    for ($i=0; $i<count($tab); $i++) //on parcourt le tableau produit après produit
	
    {
	
        if ($tab[$i]['pro_id'] !== $id)
	
        {
	
            array_push($temp, $tab[$i]);
	
        }
	
        else
	
        {
	
            $tab[$i]['pro_qte']++;
	
            array_push($temp, $tab[$i]);
	
        }
	
    }
	
 
	
    $tab = $temp;
	
    unset($temp);
	
    $this->session->panier=$tab;
	
    redirect("produits/panier");
	
}








//soustraction supplementaire au panier
public function qtemoins($id)
	
{
	
    $tab = $this->session->panier;
	
    $temp = array();
	
 
	
    for ($i=0; $i<count($tab); $i++) //on parcourt le tableau produit après produit
	
    {
	
        if ($tab[$i]['pro_id'] !== $id)
	
        {
	
            array_push($temp, $tab[$i]);
	
        }
	
        else
	
        {
	
            $tab[$i]['pro_qte']--;
	
            array_push($temp, $tab[$i]);
	
        }
	
    }
	
 
	
    $tab = $temp;
	
    unset($temp);
	
    $this->session->panier=$tab;
	
   redirect("produits/panier");
	
}







//efface un article du pannier
public function effaceProduit($id)
	
{
	
    $tab = $this->session->panier;
	
    $temp = array(); //création d'un tableau temporaire vide
	
 
	
    for ($i=0; $i<count($tab); $i++) //on cherche dans le panier les produits à ne pas supprimer
	
    {
	
        if ($tab[$i]['pro_id'] !== $id)
	
        {
	
             array_push($temp, $tab[$i]); // ces produits sont ajoutés dans le tableau temporaire
	
        }
	
    }
	
 
	
   $tab = $temp;
	
   unset($temp);
	
   $this->session->panier = $tab; // le panier prend la valeur du tableau temporaire et ne contient donc plus le produit à supprimer
	
 
	
       redirect("produits/panier");
	
}




//efface le pannier

public function efface()
	
{
	
    $this->session->panier = array();
	
    
    redirect("produits/panier");
	
}

}

?>