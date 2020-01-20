<?php
Class DbConnect 
{
	protected $db;
	public function log()
	{
	    try
	    { //nom de la base de donnée projet4 
		   $this->db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', ''); 
		   // new PDO('mysql:host=alanbeaucw175.mysql.db;dbname=alanbeaucw175;charset=utf8', 'alanbeaucw175', 'ascvfE159');
	        return $this->db;
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }
	}
}