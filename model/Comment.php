<?php
class Comment
{
    private $id;
    private $comment;
    private $date;
    private $report;
    private $date_report;
    private $id_article;
    private $pseudo;
    private $email;
    

    public function __construct(Array $data)  // on oblige les paramètres à passer sous forme de tableau
    {
        $this->hydrate($data);
    }
    public function hydrate($data)
    {
        if (isset($data['id']))
        {
            $this->setId($data['id']);
        }
        if (isset($data['id_article']))
        {
            $this->setId_article($data['id_article']);
        }
        if (isset($data['pseudo']))       
        {
            $this->setPseudo($data['pseudo']);
        }
        if (isset($data['comment']))
        {
            $this->setComment($data['comment']);
        }
        if (isset($data['date']))
        {
            $this->setDate($data['date']);
        }
        if (isset($data['report']))
        {
            $this->setReport($data['report']);
        }
        if (isset($data['date_report']))
        {
            $this->setDate_report($data['date_report']);
        }
        if (isset($data['email']))
        {
            $this->setEmail($data['email']);
        }
    }

    // GETTERS
    
    public function getId()
    {
        return $this->id;
    }
    public function getId_article()
    {
        return $this->id_article;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getComment()
    {
        return $this->comment;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getReport()
    {
        return $this->report;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getDate_Report()
    {
        return $this->date_report;
    }

    // SETTERS

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setId_article($id_article)
    {
        $this->id_article = $id_article;
        return $this;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = htmlspecialchars($pseudo); 
        return $this;
    }
    public function setComment($comment)
    {
        $this->comment = htmlspecialchars($comment);
        return $this;
    }
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    public function setReport($report)
    {
        $this->report = $report;
        return $this;
    }
    public function setDate_report($date_report)
    {
        $this->date_report = htmlspecialchars($date_report);
        return $this;
    }
     public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);
        return $this;
    }
}