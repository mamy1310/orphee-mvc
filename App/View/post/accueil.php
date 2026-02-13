<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1><i class="bi bi-chat-dots"></i> Forum</h1>
                <?php 
                $session = new \Core\Session();
                if ($session->has('user')): 
                ?>
                    <a href="<?= ROOT_URL ?>/post/add" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle"></i> Créer un post
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if (empty($posts)): ?>
                <div class="alert alert-info text-center">
                    <p class="mb-0">Aucun post pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <?php if ($post->avatar): ?>
                                    <img src="<?= ROOT_URL ?>/public/images/<?= htmlspecialchars($post->avatar) ?>" alt="Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-person-fill text-white"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">
                                        <a href="<?= ROOT_URL ?>/post/detail/<?= $post->id_post ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($post->title) ?>
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted small mb-2">
                                        Par <strong><?= htmlspecialchars($post->pseudo) ?></strong>
                                    </p>
                                    <p class="card-text"><?= htmlspecialchars(substr($post->content, 0, 150)) ?>...</p>
                                    <a href="<?= ROOT_URL ?>/post/detail/<?= $post->id_post ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-chat"></i> <?= $post->comment_count ?> commentaire<?= $post->comment_count > 1 ? 's' : '' ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
