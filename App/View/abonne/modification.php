<?php
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                            <h3>Modifier un abonné</h3>
                        </div>
                <div class="card-body">
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ($data) : ?>
                        <form method="POST" action="<?= ROOT_URL."/abonne/modification/".$data->id_abonne ?>" novalidate>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom *</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" 
                                       value="<?= htmlspecialchars($prenom ?? $data->prenom) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom" 
                                       value="<?= htmlspecialchars($nom ?? $data->nom) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($email ?? $data->email) ?>" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="<?= ROOT_URL."/" ?>" class="btn btn-light">Annuler</a>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </form>
                    <?php else : ?>
                        <div class="alert alert-danger">Abonné introuvable</div>
                        <a href="<?= ROOT_URL."/" ?>" class="btn btn-secondary">Retour</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>