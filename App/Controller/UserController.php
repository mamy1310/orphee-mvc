<?php 

namespace App\Controller;

use \Core\Controller;
use \App\Service\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService;
    }

    public function connexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $result = $this->userService->authenticate($email, $password);

            if ($result['success']) {
                header('Location: ' . ROOT_URL . '/');
                exit;
            }

            return $this->render('layout.php', 'user/connexion.php', [
                'errors' => $result['errors'],
                'email' => $email,
            ]);
        }

        return $this->render('layout.php', 'user/connexion.php', [
            'errors' => [],
            'email' => '',
        ]);
    }

    public function profil()
    {
        if (!$this->userService->isAuthenticated()) {
            header('Location: ' . ROOT_URL . '/user/connexion');
            exit;
        }

        return $this->render('layout.php', 'user/profil.php', [
            'data' => $this->userService->getAuthenticatedUser(),
        ]);
    }

    public function deconnexion()
    {
        $this->userService->logout();
        header('Location: ' . ROOT_URL . '/user/connexion');
        exit;
    }

    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $avatar = '';
            $avatarErrors = [];
            
            if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])) {
                $result = $this->userService->uploadAvatar($_FILES['avatar']);
                if (!$result['success']) {
                    $avatarErrors = $result['errors'];
                } else {
                    $avatar = $result['path'];
                }
            }

            $data = [
                'pseudo' => $_POST['pseudo'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
            ];

            $result = $this->userService->register($data, $avatar);
            $errors = array_merge($result['errors'], $avatarErrors);

            if ($result['success'] && empty($avatarErrors)) {
                header('Location: ' . ROOT_URL . '/user/connexion');
                exit;
            }

            return $this->render('layout.php', 'user/inscription.php', [
                'errors' => $errors,
                'pseudo' => $data['pseudo'],
                'email' => $data['email'],
            ]);
        }

        return $this->render('layout.php', 'user/inscription.php', [
            'errors' => [],
            'pseudo' => '',
            'email' => '',
        ]);
    }

    public function modification()
    {
        if (!$this->userService->isAuthenticated()) {
            header('Location: ' . ROOT_URL . '/user/connexion');
            exit;
        }

        $user = $this->userService->getAuthenticatedUser();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $avatar = $user->avatar;
            $avatarErrors = [];
            
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK && !empty($_FILES['avatar']['name'])) {
                $result = $this->userService->uploadAvatar($_FILES['avatar']);
                if (!$result['success']) {
                    $avatarErrors = $result['errors'];
                } else {
                    $avatar = $result['path'];
                }
            }

            $data = [
                'pseudo' => $_POST['pseudo'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
            ];

            $result = $this->userService->updateProfile($user->id_user, $data, $avatar);
            $errors = array_merge($result['errors'], $avatarErrors);

            if ($result['success'] && empty($avatarErrors)) {
                header('Location: ' . ROOT_URL . '/user/profil');
                exit;
            }

            return $this->render('layout.php', 'user/modification.php', [
                'user' => $user,
                'errors' => $errors,
                'pseudo' => $data['pseudo'],
                'email' => $data['email'],
            ]);
        }

        return $this->render('layout.php', 'user/modification.php', [
            'user' => $user,
            'errors' => [],
            'pseudo' => $user->pseudo,
            'email' => $user->email,
        ]);
    }
}
