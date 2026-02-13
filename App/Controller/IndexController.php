<?php 


namespace App\Controller;

use \Core\Controller;
use \App\Model\Abonne;

class IndexController extends Controller
{
    public function index()
    {
        $abonne = new Abonne;

        return $this->render('layout.php', 'abonne/affichage.php', [
            'data' => $abonne->SelectAll(),
        ]);
    }

    private function validateAbonne($data)
    {
        $errors = [];

        if (empty(trim($data['prenom'] ?? ''))) {
            $errors[] = 'Le prénom est requis.';
        } elseif (strlen(trim($data['prenom'])) < 2) {
            $errors[] = 'Le prénom doit contenir au moins 2 caractères.';
        }

        if (empty(trim($data['nom'] ?? ''))) {
            $errors[] = 'Le nom est requis.';
        } elseif (strlen(trim($data['nom'])) < 2) {
            $errors[] = 'Le nom doit contenir au moins 2 caractères.';
        }

        if (empty($data['email'] ?? '')) {
            $errors[] = 'L\'email est requis.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email n\'est pas valide.';
        }

        return $errors;
    }

    public function creation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'prenom' => $_POST['prenom'] ?? '',
                'nom' => $_POST['nom'] ?? '',
                'email' => $_POST['email'] ?? '',
            ];

            $errors = $this->validateAbonne($data);

            if (empty($errors)) {
                $abonne = new Abonne;
                if ($abonne->Insert($data['nom'], $data['prenom'], $data['email'])) {
                    header('Location: ' . ROOT_URL . '/');
                    exit;
                } else {
                    $errors[] = 'Erreur lors de l\'enregistrement.';
                }
            }

            return $this->render('layout.php', 'abonne/creation.php', [
                'errors' => $errors,
                'prenom' => $data['prenom'],
                'nom' => $data['nom'],
                'email' => $data['email'],
            ]);
        }

        return $this->render('layout.php', 'abonne/creation.php', [
            'errors' => [],
            'prenom' => '',
            'nom' => '',
            'email' => '',
        ]);
    }

    public function details($id)
    {
        $abonne = new Abonne;

        return $this->render('layout.php', 'abonne/details.php', [
            'data' => $abonne->SelectById($id),
        ]);
    }

    public function modification($id)
    {
        $abonne = new Abonne;
        $data = $abonne->SelectById($id);

        if (!$data) {
            header('Location: ' . ROOT_URL . '/');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = [
                'prenom' => $_POST['prenom'] ?? '',
                'nom' => $_POST['nom'] ?? '',
                'email' => $_POST['email'] ?? '',
            ];

            $errors = $this->validateAbonne($formData);

            if (empty($errors)) {
                if ($abonne->Update($id, $formData['nom'], $formData['prenom'], $formData['email'])) {
                    header('Location: ' . ROOT_URL . '/');
                    exit;
                } else {
                    $errors[] = 'Erreur lors de la mise à jour.';
                }
            }

            return $this->render('layout.php', 'abonne/modification.php', [
                'data' => $data,
                'errors' => $errors,
                'prenom' => $formData['prenom'],
                'nom' => $formData['nom'],
                'email' => $formData['email'],
            ]);
        }

        return $this->render('layout.php', 'abonne/modification.php', [
            'data' => $data,
            'errors' => [],
            'prenom' => $data->prenom,
            'nom' => $data->nom,
            'email' => $data->email,
        ]);
    }

    public function delete($id)
    {
        $abonne = new Abonne;
        $abonne->Delete($id);
        header('Location: ' . ROOT_URL . '/');
        exit;
    }

}