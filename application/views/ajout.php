<?php
    include "entete.php";
    $date=date('Y-m-d');
?>

<html>

    <head>

        <title>Formulaire d'ajout d'un produit</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= base_url("assets/css/liste.css"); ?>">
    </head>

    <body>



        <?php echo form_open_multipart(); ?>
        <div class="container">


            <label for="pro_cat_id" class="form">Catégorie</label><br>
            <select name='pro_cat_id'  class="form-control">                    <!--liste déroulante-->
                <?php
                foreach ($liste_categorie as $row) {
                    echo "<option value='$row->cat_id'>$row->cat_nom</option>";
                }
                ?>
            </select>

            <div>
                <label for="pro_ref" class="form">reference</label><br>
                <input type="text" name="pro_ref" id="pro_ref" class="form-control" value="<?php echo set_value('pro_ref'); ?>">
            </div>
            <div class='msg_erreur' ><?= form_error('pro_ref'); ?></div>     <!--message d'erreur-->

            <div>
                <label for="pro_libelle" class="form"> libelle</label><br>
                <input type="text" name="pro_libelle" id="pro_libelle"  class="form-control" value="<?php echo set_value('pro_libelle'); ?>">
            </div>
            <div class='msg_erreur'><?= form_error('pro_libelle'); ?></div>

            <div>
                <label for="pro_description" class="form">description</label><br>

                <textarea name="pro_description" id="pro_description" class="form-control"><?php echo set_value('pro_ref'); ?></textarea>
            </div>
            <div class='msg_erreur'><?= form_error('pro_description'); ?></div>

            <div>
                <label for="pro_prix" class="form">prix</label><br>
                <input type="text" name="pro_prix" id=pro_prix" class="form-control" value="<?php echo set_value('pro_prix'); ?>">
            </div>
            <div class='msg_erreur'><?= form_error('pro_prix'); ?></div>

            <div>
                <label for="pro_stock"class="form">stock</label><br>
                <input type="text" name="pro_stock" id="pro_stock" class="form-control" value="<?php echo set_value('pro_stock'); ?>">
            </div>
             <div class='msg_erreur'><?= form_error('pro_stock'); ?></div>
            
            
            <div>
                <label for="pro_couleur"class="form">couleur</label><br>
                <input type="text" name="pro_couleur" id="pro_couleur" class="form-control"value="<?php echo set_value('pro_couleur'); ?>"  >
            </div>
             
              <div class='msg_erreur'><?= form_error('pro_couleur'); ?></div>

            <!--boutton radio-->
            <br><p>Visibilité :</p>
            <input type="radio" value="0" name="pro_bloque" id="pro_bloque" checked>
            <label for="pro_bloque"class="form">Oui</label><br>

            <input type="radio" value="1" name="pro_bloque" id="pro_bloque">
            <label for="pro_bloque">Non</label><br>

            <input type="hidden" name="pro_d_ajout" value="<?php echo $date; ?>">
            
            <input type="file"  id="pro_photo" name="fichier">
            <div class='msg_erreur'><?= form_error('Image'); ?></div>
             
            <br><br>
            <input type="submit" value="Ajouter" class="btn btn-outline-dark"><br>
        </div>
    </form>

    <footer>

        <?php include "pieddepage.php" ?>
    </footer>
</body>

</html>

