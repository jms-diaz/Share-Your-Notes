<?php

class Note
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getNote()
    {
        try {
            $this->db->query("SELECT *,
                             notes.id as noteId,
                             users.id as userId,
                             notes.created_at as noteCreated,
                             users.created_at as userCreated
                             FROM notes
                             INNER JOIN users
                             ON notes.user_id = users.id
                             ORDER BY notes.created_at DESC");

            return $results = $this->db->resultSet();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function addNote($data)
    {
        $this->db->query('INSERT INTO notes (title, user_id, body) VALUES (:title, :user_id, :body)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        return $this->db->execute() ? true : false;
    }

    public function updateNote($data)
    {
        $this->db->query('UPDATE notes SET title = :title, body = :body WHERE id = :id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':body', $data['body']);

        return $this->db->execute() ? true : false;
    }

    public function deleteNote($id)
    {
        $this->db->query('DELETE FROM notes WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute() ? true : false;
    }

    public function getNoteById($id)
    {
        $this->db->query('SELECT * FROM notes WHERE id = :id');
        $this->db->bind(':id', $id);

        return $row = $this->db->single();
    }
}
