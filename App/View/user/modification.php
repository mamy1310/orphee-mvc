<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="<?= ROOT_URL ?>/user/profil" class="btn btn-light mb-4">
                <i class="bi bi-arrow-left"></i> Retour
            </a>

            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0"><i class="bi bi-pencil"></i> Modifier mon profil</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php foreach ($errors as $error): ?>
                                <p class="mb-0"><i class="bi bi-exclamation-circle"></i> <?= $error ?></p>
                            <?php endforeach; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= ROOT_URL ?>/user/modification" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= htmlspecialchars($pseudo ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="form-text text-muted">Laissez vide pour conserver votre mot de passe actuel. Minimum 6 caractères.</small>
                        </div>

                        <div class="mb-4">
                            <label for="avatar" class="form-label">Avatar</label>
                            <?php if ($user->avatar): ?>
                                <div class="mb-2">
                                    <img src="<?= ROOT_URL ?>/public/images/<?= htmlspecialchars($user->avatar) ?>" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                            <small class="form-text text-muted">Formats acceptés : JPG, PNG, GIF. Laissez vide pour conserver l'actuel.</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="bi bi-check-circle"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
