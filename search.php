<?php
$db = mysqli_connect('localhost', 'root', '', 'immobilier-db');

$output = "";
if (isset($_POST['query'])) {
    $search = $_POST['query'];
    $sql = "SELECT * FROM annonce WHERE titre_annonce LIKE '%$search%'";

    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $titre = $row['titre_annonce'];
            $image = $row['image_annonce'];
            $description = $row['description_annonce'];
            $superficie = $row['superficie_annonce'];
            $adresse = $row['adresse_annonce'];
            $montant = $row['montant_annonce'];
            $date = $row['date_annonce'];
            $type = $row['type_annonce'];
            $id_annonce = $row['id_annonce'];
            ?>
            <div class="card col-3">
                <img src="assets/img/<?php echo $image; ?>" alt="Ad Image" height="50%">
                <h5>
                    <?php echo $titre; ?>
                </h5>
                <p>
                    <?php echo $superficie; ?>M²
                </p>
                <p>
                    <?php echo $montant; ?>$
                </p>
                <button type="button" class="btn btn-primary" id="modal" data-toggle="modal"
                    data-target='#modal<?= $id_annonce; ?>'>Open Modal</button>

                <!-- Modal -->
                <div class="modal" id="modal<?= $id_annonce ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">
                                    <?php echo $titre; ?>

                                </h4>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <?php echo $id_annonce; ?>
                            <div class="modal-body">
                                <p>
                                    <strong>description:</strong>
                                    <?php echo $description; ?>
                                </p>
                                <p><strong>Superficie:</strong>
                                    <?php echo $superficie; ?>
                                </p>
                                <p><strong>Adresse:</strong>
                                    <?php echo $adresse; ?>
                                </p>
                            </div>
                            <?php echo $date; ?>
                            <div class="modal-footer">
                                <div>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal<?= $id_annonce ?>">
                                        Supprimer
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?= $id_annonce ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est définitive.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Annuler</button>
                                                    <form method="post">
                                                        <input type="hidden" name="idDelete" value="<?= $id_annonce ?>">
                                                        <button type="submit" name="delete"
                                                            class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#modifier<?= $id_annonce ?>">
                                        Modifier
                                    </button>
                                    <div class="modal fade" id="modifier<?= $id_annonce ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="deleteModalLabel" class="modifierModal" aria-hidden="true">


                                        <form method="post" class="formEdit">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                            <h4 style="display:block;">Edit Offre :</h4>
                                            <input type="hidden" name="idModify" value="<?php echo $id_annonce; ?>">
                                            <div class="form-group">
                                                <label for="titre">Title:</label>
                                                <input type="text" class="form-control" id="titre" name="titre"
                                                    value="<?php echo $titre; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="text" class="form-control" id="image" name="image"
                                                    value="<?php echo $image; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <input type="text" class="form-control" id="description" name="description"
                                                    value="<?php echo $description; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="superficie">Surface:</label>
                                                <input type="text" class="form-control" id="superficie" name="superficie"
                                                    value="<?php echo $superficie; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="adresse">Address:</label>
                                                <input type="text" class="form-control" id="adresse" name="adresse"
                                                    value="<?php echo $adresse; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="montant">Amount:</label>
                                                <input type="text" class="form-control" id="montant" name="montant"
                                                    value="<?php echo $montant; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Type:</label>
                                                <input type="text" class="form-control" id="type" name="type"
                                                    value="<?php echo $type; ?>">
                                            </div>
                                            <button type="submit" name="modify" class="btn btn-primary active">Modifier</button>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
        ;
    }
    ;
} ?>