<?php
?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des Abonnés</h1>
        <a href="<?= ROOT_URL."/abonne/creation" ?>" class="btn btn-primary">+ Ajouter un abonné</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)) : ?>
                    <?php foreach ($data as $abonne) : ?>
                        <tr>
                            <td><?= $abonne->id_abonne ?></td>
                            <td><?= $abonne->prenom ?></td>
                            <td><?= $abonne->nom ?></td>
                            <td><?= $abonne->email ?></td>
                            <td>
                                <a href="<?= ROOT_URL."/abonne/details/".$abonne->id_abonne ?>" class="btn btn-sm btn-light">Détails</a>
                                <a href="<?= ROOT_URL."/abonne/modification/".$abonne->id_abonne ?>" class="btn btn-sm btn-primary">Modifier</a>
                                <a href="<?= ROOT_URL."/abonne/delete/".$abonne->id_abonne ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Aucun abonné trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>