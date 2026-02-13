<div class="row justify-content-center mt-5">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-body p-5">
                <h2 class="card-title text-center mb-4">Inscription</h2>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php foreach ($errors as $error): ?>
                            <p class="mb-0"><i class="bi bi-exclamation-circle"></i> <?= $error ?></p>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= ROOT_URL ?>/user/inscription" enctype="multipart/form-data">
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
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="form-text text-muted">Minimum 6 caractères</small>
                    </div>

                    <div class="mb-4">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        <small class="form-text text-muted">Formats acceptés : JPG, PNG, GIF, WEBP</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-person-plus"></i> S'inscrire
                        </button>
                    </div>

                    <hr class="my-4">

                    <p class="text-center">
                        Déjà inscrit ?
                        <a href="<?= ROOT_URL ?>/user/connexion" class="text-decoration-none">
                            Se connecter
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
