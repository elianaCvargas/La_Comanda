<?php
namespace Db;

use PDO;

class db{	
	protected static function connect(){
		try {
			$connect = new PDO('mysql:host=localhost;dbname=la_comanda;charset=utf8;','root','');
			$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $connect;	
		} catch (Exception $e) {
			die('Error db(connect) '.$e->getMessage());
		}
	}
}
?>