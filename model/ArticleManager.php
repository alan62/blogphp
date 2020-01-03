<?php
class ArticleManager extends DbConnect
{
    
    public function __construct()
    {
        // connexion à la BDD exécutée à l'instanciation
        $this->log();
    }
    public function get($id)
    {
        $query = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_creation FROM articles WHERE id = ?');
        $query->execute([
            $id
        ]);
        $article = $query->fetch(PDO::FETCH_ASSOC);
        return new Article($article);
    }
    public function exists($id)
    {
        if (is_numeric($id))
        {
            $query = $this->db->prepare("SELECT id FROM articles WHERE id = ?");
            $query->execute([
                $id
            ]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }  
    }
    public function getAll()
	{
		// retourne la liste de tous les articles sous forme de tableau d'objets
		$articles = [];
		$query = $this->db->query("SELECT id, title, date_creation, date_update FROM articles ORDER BY date_update DESC");
		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$articles[] = new Article($data);
		}
		return $articles;
	}
    public function getPosted()
	{
		// retourne la liste des articles publiés sous forme de tableau d'objets
		$articles = [];
		$query = $this->db->query("SELECT id, title, content, date_creation FROM articles  ORDER BY date_creation");
		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$articles[] = new Article($data);
		}
        return $articles;
	}
    public function add(Article $article) // oblige à recevoir un objet Article en paramètre
    {
        $query = $this->db->prepare("INSERT INTO articles(title, content, date_creation, date_update) VALUES(?, ?, NOW(), NOW(), ?)");
        $query->execute([
            $article->getTitle(),
            $article->getContent(),
        ]);
    }
    public function update(Article $article)
    {
        $query = $this->db->prepare("UPDATE articles SET title = :title, content = :content, date_update = NOW() WHERE id = :id") or die(print_r($this->db->errorInfo()));
        $query->execute([
            ':title' => $article->getTitle(),
            ':content' => $article->getContent(),
            ':id' => $article->getId()
        ]);
    }
    public function delete(Article $article)
    {
        $query = $this->db->prepare("DELETE FROM articles WHERE id = ?");
        $result = $query->execute([
            $article->getId()
        ]);
        
        return (bool) $result;
    }
}