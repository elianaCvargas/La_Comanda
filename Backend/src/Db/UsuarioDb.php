<?php

namespace Db;

use App\Model\Socio;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\UsuarioMapping;
use Common\Util\DbQueryBuilder;
use Model\Usuario;
use Db\db;
use Model\Empleado;
use PDO;
use PHPUnit\Framework\Exception;
use Slim\Http\Message;

include_once __DIR__ . '/../Db/db.php';
include_once __DIR__ . '/../Common/Util/DbQueryBuilder.php';

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
		// try {
		$SQL = 'INSERT INTO usuarios (Username,Nombre, Apellido, RolUsuarioID, RolEmpleadoID) VALUES (?,?,?,?,?)';
		$result = db::connect()->prepare($SQL);
		$result->execute(array(
			$user->getUserName(),
			$user->getNombre(),
			$user->getApellido(),
			$user->getRolUsuarioID(),
			$rolEmpleado
		));
		// } catch (Exception $e) {
		// 	die('Error ClienteRepository(Create) '.$e->getMessage());
		// } finally{
		// 	$result = null;
		// }
	}

	public static function modifyEmpleado(Empleado $empleado)
	{
		UsuarioDb::modifyUser($empleado, $empleado->getUserRolEmpleado());
	}

	public static function modifySocio(Socio $socio)
	{
		UsuarioDb::modifyUser($socio, null);
	}

	private static function modifyUser(Usuario $user, ?int $rolEmpleado)
	{
		// try {
		$updateFields = DbQueryBuilder::BuildUpdateFields(
			['Username', 'Nombre', 'Apellido', 'RolEmpleadoID'],
			[$user->getUserName(), $user->getNombre(), $user->getApellido(), $rolEmpleado]
		);

		$SQL = 'UPDATE usuarios SET ' . $updateFields . ' WHERE Id=?';
		$result = db::connect()->prepare($SQL);
		$result->execute(array(
			$user->getId()
		));

		// } catch (Exception $e) {
		// 	die('Error ClienteRepository(Create) '.$e->getMessage());
		// } finally{
		// 	$result = null;
		// }
	}

	public static function deleteEmpleado(int $id)
	{
		UsuarioDb::deleteUser($id);
	}

	public static function deleteSocio(int $id)
	{
		UsuarioDb::deleteUser($id);
	}

	private static function deleteUser(int $id)
	{
		// try {
		$SQL = 'DELETE FROM usuarios WHERE Id=?';
		$result = db::connect()->prepare($SQL);
		$result->execute(array(
			$id
		));

		// } catch (Exception $e) {
		// 	die('Error ClienteRepository(Create) '.$e->getMessage());
		// } finally{
		// 	$result = null;
		// }
	}

	public static function getUsuarioById(int $empleadoId)
	{
		$SQL = 'SELECT * FROM usuarios WHERE  Id = ?';
		$result = db::connect()->prepare($SQL);
		$result->execute(array(
			$empleadoId
		));
		$data = $result->fetch(PDO::FETCH_OBJ);
		if ($data) {
			return UsuarioMapping::dbDataToUsuario($data);
		} else {
			throw new ApplicationException("No existe el usuario");
		}
	}
}
