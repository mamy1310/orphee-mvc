<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="<?= ROOT_URL ?>/post/detail/<?= $post->id_post ?>" class="btn btn-light mb-4">
                <i class="bi bi-arrow-left"></i> Retour
            </a>

            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0"><i class="bi bi-pencil"></i> Modifier le post</h3>
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

                    <form method="POST" action="<?= ROOT_URL ?>/post/edit/<?= $post->id_post ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">Contenu</label>
                            <textarea class="form-control" id="content" name="content" rows="8" required><?= htmlspecialchars($content ?? '') ?></textarea>
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
