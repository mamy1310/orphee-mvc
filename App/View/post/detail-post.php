<div class="container mt-5">
    <a href="<?= ROOT_URL ?>/post" class="btn btn-light mb-4">
        <i class="bi bi-arrow-left"></i> Retour
    </a>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h2><?= htmlspecialchars($post->title) ?></h2>
                    <div class="d-flex align-items-center mb-4">
                        <?php if ($post->avatar): ?>
                            <img src="<?= ROOT_URL ?>/public/images/<?= htmlspecialchars($post->avatar) ?>" alt="Avatar" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                        <?php else: ?>
                            <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-fill text-white"></i>
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="mb-0"><strong><?= htmlspecialchars($post->pseudo) ?></strong></p>
                            <small class="text-muted">Par cet utilisateur</small>
                        </div>
                    </div>

                    <div class="card-text mb-4">
                        <?= nl2br(htmlspecialchars($post->content)) ?>
                    </div>

                    <?php if ($isAuthor): ?>
                        <div class="d-flex gap-2 mb-4">
                            <a href="<?= ROOT_URL ?>/post/edit/<?= $post->id_post ?>" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form method="POST" action="<?= ROOT_URL ?>/post/delete/<?= $post->id_post ?>" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?');">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <h4 class="mb-4"><i class="bi bi-chat"></i> Commentaires</h4>

            <?php if (empty($comments)): ?>
                <p class="text-muted">Aucun commentaire pour le moment.</p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <?php if ($comment->avatar): ?>
                                    <img src="<?= ROOT_URL ?>/public/images/<?= htmlspecialchars($comment->avatar) ?>" alt="Avatar" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person-fill text-white"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="flex-grow-1">
                                    <p class="mb-1"><strong><?= htmlspecialchars($comment->pseudo) ?></strong></p>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($comment->content)) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-chat-fill"></i> Ajouter un commentaire</h5>
                </div>
                <div class="card-body">
                    <?php 
                    $session = new \Core\Session();
                    if ($session->has('user')): 
                    ?>
                        <form method="POST" action="<?= ROOT_URL ?>/post/addComment/<?= $post->id_post ?>">
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="4" placeholder="Votre commentaire..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-send"></i> Envoyer
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-muted">
                            <a href="<?= ROOT_URL ?>/user/connexion">Connectez-vous</a> pour ajouter un commentaire.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
