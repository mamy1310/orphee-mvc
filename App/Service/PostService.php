<?php

namespace App\Service;

use \Core\Session;
use \App\Model\Post;
use \App\Model\Comment;

class PostService
{
    private $postModel;
    private $commentModel;

    public function __construct()
    {
        $this->postModel = new Post;
        $this->commentModel = new Comment;
    }

    public function getAllPosts()
    {
        return $this->postModel->SelectAll();
    }

    public function getPostById($id)
    {
        return $this->postModel->SelectById($id);
    }

    public function validatePost($data)
    {
        $errors = [];

        if (empty(trim($data['title'] ?? ''))) {
            $errors[] = 'Le titre est requis.';
        } elseif (strlen(trim($data['title'])) < 3) {
            $errors[] = 'Le titre doit contenir au moins 3 caractères.';
        }

        if (empty(trim($data['content'] ?? ''))) {
            $errors[] = 'Le contenu est requis.';
        } elseif (strlen(trim($data['content'])) < 10) {
            $errors[] = 'Le contenu doit contenir au moins 10 caractères.';
        }

        return $errors;
    }

    public function createPost($data)
    {
        $errors = $this->validatePost($data);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
                'post' => null
            ];
        }

        $session = new Session;
        $user = $session->get('user');

        if (!$user) {
            return [
                'success' => false,
                'errors' => ['Vous devez être connecté pour créer un post.'],
                'post' => null
            ];
        }

        if ($this->postModel->Insert(trim($data['title']), trim($data['content']), $user->id_user)) {
            return [
                'success' => true,
                'errors' => [],
                'post' => null
            ];
        }

        return [
            'success' => false,
            'errors' => ['Erreur lors de la création du post.'],
            'post' => null
        ];
    }

    public function updatePost($postId, $data)
    {
        $errors = $this->validatePost($data);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
                'post' => null
            ];
        }

        if ($this->postModel->Update($postId, trim($data['title']), trim($data['content']))) {
            return [
                'success' => true,
                'errors' => [],
                'post' => null
            ];
        }

        return [
            'success' => false,
            'errors' => ['Erreur lors de la mise à jour du post.'],
            'post' => null
        ];
    }

    public function deletePost($postId)
    {
        return $this->postModel->Delete($postId);
    }

    public function getCommentsByPost($postId)
    {
        return $this->commentModel->SelectByPost($postId);
    }

    public function validateComment($data)
    {
        $errors = [];

        if (empty(trim($data['content'] ?? ''))) {
            $errors[] = 'Le commentaire ne peut pas être vide.';
        } elseif (strlen(trim($data['content'])) < 3) {
            $errors[] = 'Le commentaire doit contenir au moins 3 caractères.';
        }

        return $errors;
    }

    public function addComment($postId, $data)
    {
        $errors = $this->validateComment($data);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $session = new Session;
        $user = $session->get('user');

        if (!$user) {
            return [
                'success' => false,
                'errors' => ['Vous devez être connecté pour commenter.']
            ];
        }

        if ($this->commentModel->Insert(trim($data['content']), $user->id_user, $postId)) {
            return [
                'success' => true,
                'errors' => []
            ];
        }

        return [
            'success' => false,
            'errors' => ['Erreur lors de l\'ajout du commentaire.']
        ];
    }

    public function isPostAuthor($postId, $userId)
    {
        $post = $this->postModel->SelectById($postId);
        return $post && $post->author_id == $userId;
    }
}
