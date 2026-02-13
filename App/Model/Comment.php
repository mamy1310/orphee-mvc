<?php

namespace App\Model;

use \Core\Model;

class Comment extends Model
{
    public function SelectByPost($postId)
    {
        $data = $this->db->prepare("SELECT c.*, u.pseudo, u.avatar FROM comment c JOIN user u ON c.author_id = u.id_user WHERE c.post_id = ? ORDER BY c.id_comment ASC");
        $data->execute([$postId]);
        return $data->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Insert($content, $authorId, $postId)
    {
        $data = $this->db->prepare("INSERT INTO comment (content, author_id, post_id) VALUES (?, ?, ?)");
        return $data->execute([$content, $authorId, $postId]);
    }

    public function Delete($id)
    {
        $data = $this->db->prepare("DELETE FROM comment WHERE id_comment = ?");
        return $data->execute([$id]);
    }

    public function SelectById($id)
    {
        $data = $this->db->prepare("SELECT * FROM comment WHERE id_comment = ?");
        $data->execute([$id]);
        return $data->fetch(\PDO::FETCH_OBJ);
    }
}
