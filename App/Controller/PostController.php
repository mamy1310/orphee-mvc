<?php

namespace App\Controller;

use \Core\Controller;
use \Core\Session;
use \App\Service\PostService;

class PostController extends Controller
{
    private $postService;

    public function __construct()
    {
        parent::__construct();
        $this->postService = new PostService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();

        return $this->render('layout.php', 'post/accueil.php', [
            'posts' => $posts,
        ]);
    }

    public function add()
    {
        $session = new Session;
        if (!$session->has('user')) {
            header('Location: ' . ROOT_URL . '/user/connexion');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
            ];

            $result = $this->postService->createPost($data);

            if ($result['success']) {
                header('Location: ' . ROOT_URL . '/post');
                exit;
            }

            return $this->render('layout.php', 'post/add-post.php', [
                'errors' => $result['errors'],
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
        }

        return $this->render('layout.php', 'post/add-post.php', [
            'errors' => [],
            'title' => '',
            'content' => '',
        ]);
    }

    public function detail($id)
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            header('Location: ' . ROOT_URL . '/post');
            exit;
        }

        $comments = $this->postService->getCommentsByPost($id);
        $session = new Session;
        $user = $session->get('user');
        $isAuthor = $user && $user->id_user == $post->author_id;

        return $this->render('layout.php', 'post/detail-post.php', [
            'post' => $post,
            'comments' => $comments,
            'isAuthor' => $isAuthor,
        ]);
    }

    public function edit($id)
    {
        $session = new Session;
        if (!$session->has('user')) {
            header('Location: ' . ROOT_URL . '/user/connexion');
            exit;
        }

        $post = $this->postService->getPostById($id);
        $user = $session->get('user');

        if (!$post || $post->author_id != $user->id_user) {
            header('Location: ' . ROOT_URL . '/post');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
            ];

            $result = $this->postService->updatePost($id, $data);

            if ($result['success']) {
                header('Location: ' . ROOT_URL . '/post/detail/' . $id);
                exit;
            }

            return $this->render('layout.php', 'post/edit-post.php', [
                'post' => $post,
                'errors' => $result['errors'],
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
        }

        return $this->render('layout.php', 'post/edit-post.php', [
            'post' => $post,
            'errors' => [],
            'title' => $post->title,
            'content' => $post->content,
        ]);
    }

    public function delete($id)
    {
        $session = new Session;
        if (!$session->has('user')) {
            header('Location: ' . ROOT_URL . '/user/connexion');
            exit;
        }

        $post = $this->postService->getPostById($id);
        $user = $session->get('user');

        if (!$post || $post->author_id != $user->id_user) {
            header('Location: ' . ROOT_URL . '/post');
            exit;
        }

        $this->postService->deletePost($id);
        header('Location: ' . ROOT_URL . '/post');
        exit;
    }

    public function addComment($postId)
    {
        $session = new Session;
        if (!$session->has('user')) {
            header('Location: ' . ROOT_URL . '/user/connexion');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'content' => $_POST['content'] ?? '',
            ];

            $result = $this->postService->addComment($postId, $data);

            if (!$result['success']) {
                $_SESSION['comment_errors'] = $result['errors'];
            }

            header('Location: ' . ROOT_URL . '/post/detail/' . $postId);
            exit;
        }

        header('Location: ' . ROOT_URL . '/post/detail/' . $postId);
        exit;
    }
}
