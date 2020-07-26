<?php

namespace Db;

use App\Model\Socio;
use Model\Usuario;
use Db\db;
use Model\Empleado;
use PHPUnit\Framework\Exception;

include_once __DIR__ . '/../../src/Db/db.php';

abstract class UsuarioDb extends db
{

	// private function view_users(){
	// 	try {
	// 		$SQL = "SELECT * FROM users";
	// 		$result = $this->connect()->prepare($SQL);
	// 		$result->execute();
	// 		return $result->fetchAll(PDO::FETCH_OBJ);	
	// 	} catch (Exception $e) {
	// 		die('Error Administrator(view_users) '.$e->getMessage());
	// 	} finally{
	// 		$result = null;
	// 	}
	// }

	// function get_view_users(){
	// 	return $this->view_users();

	public static function createEmpleado(Empleado $empleado)
	{
		UsuarioDb::createUser($empleado, $empleado->getUserRolEmpleado());
	}

	public static function createSocio(Socio $socio)
	{
		UsuarioDb::createUser($socio, null);
	}

	private static function createUser(Usuario $user, ?int $rolEmpleado)
	{
		var_dump($user);
		// try {
		$SQL = 'INSERT INTO usuarios (Username,Nombre, Apellido, RolUsuarioID, RolEmpleadoID) VALUES (?,?,?,?,?)';
		$result = db::connect()->prepare($SQL);
		$result->execute(array(
			$user->getUserName(),
			$user->getNombre(),
			$user->getApellido(),
			$user->getUserRol(),
			$rolEmpleado
		));
		// } catch (Exception $e) {
		// 	die('Error ClienteRepository(Create) '.$e->getMessage());
		// } finally{
		// 	$result = null;
		// }
	}

	public static function update_Empleado(Empleado $data, ?int $usuarioId)
	{
		try {
			$SQL = 'UPDATE Usuarios SET Username = ?, Nombre = ?, Apellido = ?, RolUsuarioId = ?, RolEmpleadoId = ? WHERE id_user = ?';
			$result = db::connect()->prepare($SQL);
			$result->execute(array(
				$data->getUsername(),
				$data->getNombre(),
				$data->getApellido(),
				$data->getUserRol(),
				$data->getUserRolEmpleado()
			));
		} catch (Exception $e) {
			die('Error Administrator(update_user) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	// function set_register_user($data)
	// {
	// 	$this->register_users($data);
	// }



	// function set_update_user($data){
	// 	$this->update_user($data);
	// }

	// private function delete_user($id){
	// 	try {
	// 		$SQL = 'DELETE FROM users WHERE id_user = ?';
	// 		$result = $this->connect()->prepare($SQL);
	// 		$result->execute(array($id));			
	// 	} catch (Exception $e) {
	// 		die('Error Administrator(delete_user) '.$e->getMessage());
	// 	} finally{
	// 		$result = null;
	// 	}
	// }

	// function set_delete_user($id){
	// 	$this->delete_user($id);
	// }	
}
