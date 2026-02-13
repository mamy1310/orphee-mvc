<?php

namespace App\Service;

use \Core\Session;
use \App\Model\User;

class UserService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function validateUser($data)
    {
        $errors = [];

        if (empty(trim($data['pseudo'] ?? ''))) {
            $errors[] = 'Le pseudo est requis.';
        } elseif (strlen(trim($data['pseudo'])) < 2) {
            $errors[] = 'Le pseudo doit contenir au moins 2 caractères.';
        }

        if (empty($data['email'] ?? '')) {
            $errors[] = 'L\'email est requis.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email n\'est pas valide.';
        }

        if (empty($data['password'] ?? '')) {
            $errors[] = 'Le mot de passe est requis.';
        } elseif (strlen($data['password']) < 6) {
            $errors[] = 'Le mot de passe doit contenir au moins 6 caractères.';
        }

        return $errors;
    }

    public function validateLogin($email, $password)
    {
        $errors = [];

        if (empty($email)) {
            $errors[] = 'L\'email est requis.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email n\'est pas valide.';
        }

        if (empty($password)) {
            $errors[] = 'Le mot de passe est requis.';
        }

        return $errors;
    }

    public function authenticate($email, $password)
    {
        $errors = $this->validateLogin($email, $password);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
                'user' => null
            ];
        }

        $userData = $this->userModel->SelectByEmail($email);

        if ($userData && password_verify($password, $userData->password)) {
            $session = new Session;
            $session->set('user', $userData);
            return [
                'success' => true,
                'errors' => [],
                'user' => $userData
            ];
        }

        return [
            'success' => false,
            'errors' => ['Email ou mot de passe incorrect.'],
            'user' => null
        ];
    }

    public function register($data, $avatar = '')
    {
        $errors = $this->validateUser($data);

        if (empty($errors)) {
            $existingUser = $this->userModel->SelectByEmail($data['email']);
            if ($existingUser) {
                $errors[] = 'Cet email est déjà utilisé.';
            }
        }

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
                'user' => null
            ];
        }

        if ($this->userModel->Insert($data['pseudo'], $data['email'], $data['password'], $avatar)) {
            return [
                'success' => true,
                'errors' => [],
                'user' => null
            ];
        }

        return [
            'success' => false,
            'errors' => ['Erreur lors de l\'enregistrement.'],
            'user' => null
        ];
    }

    public function logout()
    {
        $session = new Session;
        $session->remove('user');
    }

    public function getAuthenticatedUser()
    {
        $session = new Session;
        return $session->get('user');
    }

    public function isAuthenticated()
    {
        $session = new Session;
        return $session->has('user');
    }

    public function validateEditProfile($data)
    {
        $errors = [];

        if (empty(trim($data['pseudo'] ?? ''))) {
            $errors[] = 'Le pseudo est requis.';
        } elseif (strlen(trim($data['pseudo'])) < 2) {
            $errors[] = 'Le pseudo doit contenir au moins 2 caractères.';
        }

        if (empty($data['email'] ?? '')) {
            $errors[] = 'L\'email est requis.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email n\'est pas valide.';
        }

        if (!empty($data['password'] ?? '') && strlen($data['password']) < 6) {
            $errors[] = 'Le mot de passe doit contenir au moins 6 caractères.';
        }

        return $errors;
    }

    public function updateProfile($userId, $data, $avatar = '')
    {
        $errors = $this->validateEditProfile($data);

        if (empty($errors)) {
            $existingUser = $this->userModel->SelectByEmail($data['email']);
            if ($existingUser && $existingUser->id_user != $userId) {
                $errors[] = 'Cet email est déjà utilisé.';
            }
        }

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $password = !empty($data['password']) ? $data['password'] : '';

        if ($this->userModel->Update($userId, $data['pseudo'], $data['email'], $password, $avatar)) {
            $updatedUser = $this->userModel->SelectById($userId);
            $session = new Session;
            $session->set('user', $updatedUser);
            return [
                'success' => true,
                'errors' => []
            ];
        }

        return [
            'success' => false,
            'errors' => ['Erreur lors de la mise à jour du profil.']
        ];
    }

    public function validateImage($file)
    {
        $errors = [];

        $mimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        $fileMimeType = mime_content_type($file['tmp_name']);
        if (!in_array($fileMimeType, $mimeTypes)) {
            $errors[] = 'Le fichier n\'est pas une image valide.';
        }

        $fileName = strtolower($file['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array($fileExtension, $extensions)) {
            $errors[] = 'Extension de fichier non autorisée. Formats acceptés : JPG, PNG, GIF, WEBP.';
        }

        return $errors;
    }

    public function uploadAvatar($file)
    {
        $errors = $this->validateImage($file);
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'path' => ''];
        }

        $uploadDir = ROOT_PATH . '/public/images/avatars/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return ['success' => true, 'errors' => [], 'path' => 'avatars/' . $filename];
        }

        return ['success' => false, 'errors' => ['Erreur lors du téléchargement de l\'image.'], 'path' => ''];
    }
}
