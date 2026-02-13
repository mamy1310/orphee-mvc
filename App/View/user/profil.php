<div class="row mt-5">
    <div class="col-md-4">
        <div class="card shadow text-center">
            <div class="card-body">
                <?php if ($data->avatar): ?>
                    <img src="<?= ROOT_URL ?>/public/images/<?= htmlspecialchars($data->avatar) ?>" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                <?php else: ?>
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px;">
                        <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                    </div>
                <?php endif; ?>

                <h3 class="card-title"><?= htmlspecialchars($data->pseudo) ?></h3>
                <p class="text-muted">
                    <i class="bi bi-envelope"></i> <?= htmlspecialchars($data->email) ?>
                </p>

                <div class="d-grid gap-2 mt-4">
                    <a href="<?= ROOT_URL ?>/user/modification" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Modifier le profil
                    </a>
                    <a href="<?= ROOT_URL ?>/user/deconnexion" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informations du compte</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">Pseudo :</th>
                            <td><?= htmlspecialchars($data->pseudo) ?></td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td><?= htmlspecialchars($data->email) ?></td>
                        </tr>
                        <tr>
                            <th>ID Utilisateur :</th>
                            <td><span class="badge bg-secondary"><?= $data->id_user ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
