<?php

namespace App\Model;

use \Core\Model;

class Post extends Model
{
    public function SelectAll()
    {
        $data = $this->db->query("SELECT p.*, u.pseudo, u.avatar, COUNT(c.id_comment) as comment_count FROM post p JOIN user u ON p.author_id = u.id_user LEFT JOIN comment c ON p.id_post = c.post_id GROUP BY p.id_post ORDER BY p.id_post DESC");
        return $data->fetchAll(\PDO::FETCH_OBJ);
    }

    public function SelectById($id)
    {
        $data = $this->db->prepare("SELECT p.*, u.pseudo, u.avatar, u.id_user FROM post p JOIN user u ON p.author_id = u.id_user WHERE p.id_post = ?");
        $data->execute([$id]);
        return $data->fetch(\PDO::FETCH_OBJ);
    }

    public function SelectByAuthor($authorId)
    {
        $data = $this->db->prepare("SELECT p.*, u.pseudo, u.avatar FROM post p JOIN user u ON p.author_id = u.id_user WHERE p.author_id = ? ORDER BY p.id_post DESC");
        $data->execute([$authorId]);
        return $data->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Insert($title, $content, $authorId)
    {
        $data = $this->db->prepare("INSERT INTO post (title, content, author_id) VALUES (?, ?, ?)");
        return $data->execute([$title, $content, $authorId]);
    }

    public function Update($id, $title, $content)
    {
        $data = $this->db->prepare("UPDATE post SET title = ?, content = ? WHERE id_post = ?");
        return $data->execute([$title, $content, $id]);
    }

    public function Delete($id)
    {
        $data = $this->db->prepare("DELETE FROM post WHERE id_post = ?");
        return $data->execute([$id]);
    }

    public function GetCommentCount($postId)
    {
        $data = $this->db->prepare("SELECT COUNT(*) as count FROM comment WHERE post_id = ?");
        $data->execute([$postId]);
        return $data->fetch(\PDO::FETCH_OBJ)->count;
    }
}
