<?php
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if ($data) : ?>
                <div class="card">
                    <div class="card-header">
                            <h3>Détails de l'abonné</h3>
                        </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th width="30%">ID</th>
                                    <td><?= htmlspecialchars($data->id_abonne) ?></td>
                                </tr>
                                <tr>
                                    <th>Prénom</th>
                                    <td><?= htmlspecialchars($data->prenom) ?></td>
                                </tr>
                                <tr>
                                    <th>Nom</th>
                                    <td><?= htmlspecialchars($data->nom) ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= htmlspecialchars($data->email) ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= ROOT_URL."/" ?>" class="btn btn-light">Retour</a>
                            <div>
                                <a href="<?= ROOT_URL."/abonne/modification/".$data->id_abonne ?>" class="btn btn-primary">Modifier</a>
                                <a href="<?= ROOT_URL."/abonne/delete/".$data->id_abonne ?>" class="btn btn-danger" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonné ?')">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-danger">Abonné introuvable</div>
                <a href="<?= ROOT_URL."/" ?>" class="btn btn-secondary">Retour</a>
            <?php endif; ?>
        </div>
    </div>
</div>