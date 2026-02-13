<?php 

namespace App\Model;

use \Core\Model;

class Abonne extends Model
{
    public function SelectAll()
    {
        $data = $this->db->query("SELECT * FROM abonne");
        return $data->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Insert($nom, $prenom, $email)
    {
        $data = $this->db->prepare("INSERT INTO abonne (nom, prenom, email) VALUES (?, ?, ?)");
        return $data->execute([$nom, $prenom, $email]);
    }

    public function SelectById($id)
    {
        $data = $this->db->prepare("SELECT * FROM abonne WHERE id_abonne = ?");
        $data->execute([$id]);
        return $data->fetch(\PDO::FETCH_OBJ);
    }

    public function Update($id, $nom, $prenom, $email)
    {
        $data = $this->db->prepare("UPDATE abonne SET nom = ?, prenom = ?, email = ? WHERE id_abonne = ?");
        return $data->execute([$nom, $prenom, $email, $id]);
    }

    public function Delete($id)
    {
        $data = $this->db->prepare("DELETE FROM abonne WHERE id_abonne = ?");
        return $data->execute([$id]);
    }
}