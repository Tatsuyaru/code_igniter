<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produits_model extends CI_Model {

    //liste
    public function liste() {

        $this->load->database();

        $requete = $this->db->query("SELECT * FROM produits where pro_bloque is NULL");

        $aProduits = $requete->result();



        return $aProduits;
    }

    //requete pour compter les resultats existant dans la bdd pour la reference
    public function ajout_verif_ref() {
        $data = $this->input->post();
        $this->load->database();



        $this->db->select("pro_ref");                       //select
        $this->db->from('produits');                        //nom table
        $this->db->where('pro_ref', $data["pro_ref"]);      //le where
        $existant = $this->db->count_all_results();         // renvoi un entier(count)

        return $existant;
    }

    //requete liste deroulante categorie
    public function ajout_categorie() {

        $this->load->database();



        $results2 = $this->db->query("SELECT  cat_nom,cat_id FROM categories");


        // Récupération des résultats    

        $acategorie = $results2->result();

        return $acategorie;
    }

    //upload
    public function id_image() {

        $this->load->database();

        $results = $this->db->query("SELECT pro_id FROM produits where pro_id = LAST_INSERT_ID()");

        // Récupération des résultats    

        $id = $results->result();



        return $id;
    }

    public function insert() {

        $this->load->database();
        $data = $this->input->post();
        if ($data["pro_bloque"] == 0) {
            $data["pro_bloque"] = Null;
        }
        $acategorie = $this->db->insert('produits', $data);
        return $acategorie;
    }

    public function categorie_modif() {

        $results2 = $this->db->query("SELECT distinct cat_nom,cat_id FROM categories");


        $acategorie = $results2->result();
        return $acategorie;
    }

    public function update_modif($id,$data) {
        $this->load->database();
        
                           //recupere les données de chaque champ
        //condition de pro_bloque
        if ($data["pro_bloque"] == 0) {
            $data["pro_bloque"] = Null;
        }

        $where = $this->db->where('pro_id', $id);       //condition de la requete
        $this->db->update('produits', $data, $where);   //update
    }
    
    
    public function suppression($pro_id) {
        $this->load->database();
        $where = $this->db->where('pro_id', $pro_id);       //condition de la requete
        $this->db->delete('produits', $where);   //requete de modification

    }
    
    
    
    //liste
    public function panier($row) {

        $this->load->database();

        $requete = $this->db->query("SELECT * FROM produits where pro_id=".$row->pro_id);

        $produit_selection = $requete->result();



        return $produit_selection;
    }

}
