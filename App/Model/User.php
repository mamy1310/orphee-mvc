<?php

namespace App\Model;

use \Core\Model;

class User extends Model
{
    public function SelectAll()
    {
        $data = $this->db->query("SELECT * FROM user");
        return $data->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Insert($pseudo, $email, $password, $avatar)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $data = $this->db->prepare("INSERT INTO user (pseudo, email, password, avatar) VALUES (?, ?, ?, ?)");
        return $data->execute([$pseudo, $email, $hashedPassword, $avatar]);
    }

    public function SelectById($id)
    {
        $data = $this->db->prepare("SELECT * FROM user WHERE id_user = ?");
        $data->execute([$id]);
        return $data->fetch(\PDO::FETCH_OBJ);
    }

    public function SelectByEmail($email)
    {
        $data = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $data->execute([$email]);
        return $data->fetch(\PDO::FETCH_OBJ);
    }

    public function Update($id, $pseudo, $email, $password = '', $avatar = '')
    {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $data = $this->db->prepare("UPDATE user SET pseudo = ?, email = ?, password = ?, avatar = ? WHERE id_user = ?");
            return $data->execute([$pseudo, $email, $hashedPassword, $avatar, $id]);
        } else {
            if (!empty($avatar)) {
                $data = $this->db->prepare("UPDATE user SET pseudo = ?, email = ?, avatar = ? WHERE id_user = ?");
                return $data->execute([$pseudo, $email, $avatar, $id]);
            } else {
                $data = $this->db->prepare("UPDATE user SET pseudo = ?, email = ? WHERE id_user = ?");
                return $data->execute([$pseudo, $email, $id]);
            }
        }
    }

    public function Delete($id)
    {
        $data = $this->db->prepare("DELETE FROM user WHERE id_user = ?");
        return $data->execute([$id]);
    }
}