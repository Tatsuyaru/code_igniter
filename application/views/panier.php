<html>

    <head>
        <title>Panier</title>
        <link rel="stylesheet" href="<?= base_url("assets/css/liste.css"); ?>">
    </head>
    <body>
        <h1>Mon panier</h1>

        <?php
        if ($this->session->panier != null) {
            ?>
            <div class="row">
                <div class="col"> 
                    <table>
                        <thead>
                            <tr>
                                <th>Produit</th>

                                <th>Prix</th>

                                <th>Quantité</th>

                                <th>Prix total</th>

                                <th>Supprimer</th>    
                            </tr>    
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;

                            foreach ($this->session->panier as $produit) {
                                ?>
                                <tr>
                                    <td><?= $produit['pro_libelle']; ?></td>
                                    <td><?= str_replace('.', ',', $produit['pro_prix']); ?> <sup>€</sup></td>
                                    <td>
                                        <div class="panier_qte">
                                            <div class="panier_qte_valeur">
                                                <a href="<?= site_url('produits/qtemoins/' . $produit['pro_id']); ?>" type="button" role="button"> - </a>
                                                <?= $produit['pro_qte'] ?>     
                                                <a href="<?= site_url('produits/qteplus/' . $produit['pro_id']); ?>" type="button" role="button">+</a>
                                            </div>
                                        </div> 
                                    </td>
                                    <td><?= str_replace('.', ',', ($produit['pro_qte'] * $produit['pro_prix'])); ?> <sup>€</sup></td>    
                                    <td>
                                        <?php $total += $produit['pro_qte'] * $produit['pro_prix']; ?>
                                        <a href="<?= site_url('produits/effaceProduit/' . $produit['pro_id']); ?>">Suppimer l'article</a>            
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div>
                        <h3>Récapitulatif</h3>
                        <div>
                            <h5>TOTAL : <?= str_replace('.', ',', $total); ?> <sup>€</sup></h5>

                            <a href="<?= site_url("produits/efface"); ?>" >Supprimer le panier</a>  

                            <a href="<?= site_url("produits/liste"); ?>">Retour boutique</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        } else {
            ?>
            <div class="alert alert-danger">Votre panier est vide. Pour le remplir, vous pouvez visiter notre <a href="<?= site_url("produits/liste"); ?>">boutique</a>.</div>
            <?php
        }
        ?>   
    </body>
</html>