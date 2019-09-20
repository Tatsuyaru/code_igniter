

<!DOCTYPE html>

<html lang="fr">

    <head>

        <meta charset="utf-8">

        <title>Liste des produits</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="stylesheet" href="<?= base_url("assets/css/liste.css"); ?>">
    </head>

    <body>

        <?php require "entete.php"; ?>

        <div class="row">
            <h1 class="offset-4">Produits</h1>
            
            <?php if($this->session->panier<>Null){?> 
            <img src="<?= base_url("assets/images/panier.png"); ?>" class="offset-5 panier"/>
            <?php }?>
        </div>

        <div class='row'>
            <div class="<?= $this->session->panier? "col-8 offset-1": "col-10 offset-1" ;?>">



                <table id="liste">
                    <th class="th">Panier</th><th class="th">Photo</th> <th class="th">ID</th>  <th class="th"> Reference</th> <th class="th">Libelle</th><th class="th">Description</th><th class="th">Suppression</th>
                    <?php
                    foreach ($liste_produits as $row) {
                        ?>
                        <tr>
                            <td class="case">
                                <?php echo form_open("Produits/ajoutePanier"); ?>
                                <input class="form-control" name="pro_qte" id="pro_qte" value="1">
                                <input type="hidden" name="pro_prix" value="<?= $row->pro_prix ?>">
                                <input type="hidden" name="pro_id" value="<?= $row->pro_id ?>">
                                <input type="hidden" name="pro_libelle" value="<?= $row->pro_libelle ?>">
                                <div class="form-group">

                                    <input class="btn btn-default btn-sm" type="submit" value="Ajouter au panier">            
                                </div>
                                </form>
                            </td>
                            <td class="case"><img class="icon" src="<?= base_url("assets/images/") . $row->pro_id . "." . $row->pro_photo; ?> ">      </td>
                            <td class="case"><a id="idliste" href="modif/<?= $row->pro_id ?> " title="modifier"> <?= $row->pro_id; ?>     </a> </td>
                            <td class="case"><?= $row->pro_ref ?></td>
                            <td class="case"><?= $row->pro_libelle ?></td>
                            <td class="case"><?= $row->pro_description ?></td>
                            <td class="case">
                                <a href='<?= base_url("index.php/produits/suppression/$row->pro_id") ?>'>    
                            <input type="button"  id="buttonliste" value="Supprimer"class='btn btn-outline-light '>
                                </a> 
                            </td>     <!-- suppression -->
                        </tr>
                    <?php }
                    ?>
                </table>
                
                <center><a href='ajout'><br><input type='button' name='button1'value='Ajouter'  class='btn btn-outline-dark'></a></center>

            </div>
                
                <?php if ($this->session->panier && $this->session->panier<>Null) { ?>
                    <table class="col-3">
                        <thead>
                        <th class="th">Articles</th><th class="th">Quantité</th>
                        </thead>
                        <tbody>
                            <?php foreach ($this->session->panier as $produit) {
                                ?>
                                <tr>
                                    <td><?= $produit['pro_libelle']; ?></td>
                                    <td><?= $produit['pro_qte'] ?> </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                            
                        </tbody>
                    </table>
                <?php } ?>
            </div>
       


        <?php include "pieddepage.php" ?>

    </body>

</html>
