<?php
Class DbConnect 
{
	protected $db;
	public function log()
	{
	    try
	    { //nom de la base de donnée projet4 
	       $this->db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
	        return $this->db;
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }
	}
	 function dbConnect() 
	 {  
       if ($this->db instanceof PDO) 
       		{
            	return $this->db;
       		}
     }
}