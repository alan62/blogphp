<?php 
class Article {

    private $id;
    private $title;
    private $content;
    private $date_creation;
    private $date_update;


    public function __construct(Array $data) // on oblige les paramètres à passer sous forme de tableau
    {
        $this->hydrate($data);
    }


    public function hydrate($data)
    {
        if (isset($data['id']))
        {
            $this->setId($data['id']);
        }
        if (isset($data['title']))
        {
            $this->setTitle($data['title']);
        }
        if (isset($data['content']))
        {
            $this->setContent($data['content']);
        }
        if (isset($data['date_creation']))
        {
            $this->setDate_creation($data['date_creation']);
        }
        if (isset($data['date_update']))
        {
            $this->setDate_update($data['date_update']);
        }
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getDate_creation()
    {
        return $this->date_creation;
    }
    public function getDate_update()
    {
        return $this->date_update;
    }
    
    // SETTERS
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setTitle($title)
    {
        $this->title = htmlspecialchars($title);  // Convertit les caractères spéciaux en entités HTML
        return $this;
    }
    public function setContent($content)
    {
        $this->content = htmlspecialchars_decode($content); //  Afin de convertir les entités spéciales en caractères 
        return $this;
    }
    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;
        return $this;
    }
    public function setDate_update($date_update)
    {
        $this->date_update = $date_update;
        return $this;
    }
}
