<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="<?= ROOT_URL ?>/post" class="btn btn-light mb-4">
                <i class="bi bi-arrow-left"></i> Retour
            </a>

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="bi bi-plus-circle"></i> Créer un nouveau post</h3>
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

                    <form method="POST" action="<?= ROOT_URL ?>/post/add">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required>
                            <small class="form-text text-muted">Minimum 3 caractères</small>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">Contenu</label>
                            <textarea class="form-control" id="content" name="content" rows="8" required><?= htmlspecialchars($content ?? '') ?></textarea>
                            <small class="form-text text-muted">Minimum 10 caractères</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Créer le post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
