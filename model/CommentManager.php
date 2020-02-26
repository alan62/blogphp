<?php
class CommentManager extends DbConnect
{
    
    public function __construct()
    {
        // connexion à la BDD exécutée à l'instanciation
        $this->log();
    }

    public function getReported()
    {
        $report = false;
        $query = $this->db->query("SELECT * FROM comments WHERE report = 1");
        $queryReport = $query->fetch(PDO::FETCH_ASSOC);
        if ($queryReport)
        {
            $report = true;
        }
        return $report;
    }

    public function getAllReported()
    {
        // retourne la liste de tous les commmentaires, et l'article relié
        $comments = [];
        $query = $this->db->query('SELECT comments.id, id_article, pseudo, comment, date_comment, report, date_report, email, articles.title 
        FROM comments
        INNER JOIN articles ON comments.id_article = articles.id
        WHERE comments.report = 1
        ORDER BY comments.date_comment DESC');
        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }
    
        return $comments;
    }

    public function getPosted($id_article)
    {
        // retourne la liste des commentaires publiés sous forme de tableau d'objets
        $comments = [];
        $query = $this->db->prepare('SELECT id, id_article, pseudo, comment, date_comment, report, date_report, email FROM comments WHERE id_article = ? ORDER BY report, date_comment DESC');
        $query->execute([
            $id_article
        ]);
        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function add(Comment $comment)
    {
        $query = $this->db->prepare("INSERT INTO comments(id_article, pseudo, comment, date_report, email, date_comment, report) VALUES(:id_article, :pseudo, :comment, NOW(),'',NOW(), 0)");
        var_dump($this->db->errorInfo());
        $query->execute([
            'id_article' => $comment->getId_article(),
            'pseudo' => $comment->getPseudo(),
            'comment' => $comment->getComment()
        ]);
        var_dump($this->db->errorInfo());
    }

    public function accept(Comment $comment)
    {
        $query = $this->db->prepare("UPDATE comments SET report = 0 WHERE id = ?");
        $result = $query->execute([
            $comment->getId()
        ]);
        return (bool) $result;
    }

    public function report(Comment $comment)
    {
        $query = $this->db->prepare("UPDATE comments SET report = 1 WHERE id = ?");
        $query->execute([
            $comment->getId()
        ]);
    }
    
    public function delete(Comment $comment)
    {
        $query = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        $result = $query->execute([
            $comment->getId()
        ]);
        return (bool) $result;
    }
}