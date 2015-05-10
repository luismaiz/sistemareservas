<?php

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
require_once("helpers/Db2PhpEntityBase.class.php");
require_once("helpers/Db2PhpEntityModificationTracking.class.php");
require_once 'helpers/DFCAggregate.class.php';
class SolicitudModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='SolicitudModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='solicitud';
	const SQL_INSERT='INSERT INTO `solicitud` (`idSolicitud`,`idTipoSolicitud`,`idTipoTarifa`,`FechaSolicitud`,`Nombre`,`Apellidos`,`DNI`,`EMail`,`Direccion`,`CP`,`Sexo`,`FechaNacimiento`,`TutorLegal`,`Localidad`,`Telefono1`,`Telefono2`,`Provincia`,`DescripcionSolicitud`,`Otros`,`Localizador`,`Gestionado`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `solicitud` (`idTipoSolicitud`,`idTipoTarifa`,`FechaSolicitud`,`Nombre`,`Apellidos`,`DNI`,`EMail`,`Direccion`,`CP`,`Sexo`,`FechaNacimiento`,`TutorLegal`,`Localidad`,`Telefono1`,`Telefono2`,`Provincia`,`DescripcionSolicitud`,`Otros`,`Localizador`,`Gestionado`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `solicitud` SET `idSolicitud`=?,`idTipoSolicitud`=?,`idTipoTarifa`=?,`FechaSolicitud`=?,`Nombre`=?,`Apellidos`=?,`DNI`=?,`EMail`=?,`Direccion`=?,`CP`=?,`Sexo`=?,`FechaNacimiento`=?,`TutorLegal`=?,`Localidad`=?,`Telefono1`=?,`Telefono2`=?,`Provincia`=?,`DescripcionSolicitud`=?,`Otros`=?,`Localizador`=?,`Gestionado`=? WHERE `idSolicitud`=?';
	const SQL_SELECT_PK='SELECT * FROM `solicitud` WHERE `idSolicitud`=?';
	const SQL_DELETE_PK='DELETE FROM `solicitud` WHERE `idSolicitud`=?';
	const FIELD_IDSOLICITUD=1447296895;
	const FIELD_IDTIPOSOLICITUD=-901365461;
	const FIELD_IDTIPOTARIFA=-1345692680;
	const FIELD_FECHASOLICITUD=1971567697;
	const FIELD_NOMBRE=-2000412045;
	const FIELD_APELLIDOS=-363211669;
	const FIELD_DNI=887144117;
	const FIELD_EMAIL=2142891986;
	const FIELD_DIRECCION=1933345350;
	const FIELD_CP=-1911045129;
	const FIELD_SEXO=1732134387;
	const FIELD_FECHANACIMIENTO=-1008369908;
	const FIELD_TUTORLEGAL=624122573;
	const FIELD_LOCALIDAD=1691854207;
	const FIELD_TELEFONO1=-624351021;
	const FIELD_TELEFONO2=-624351020;
	const FIELD_PROVINCIA=-1945800509;
	const FIELD_DESCRIPCIONSOLICITUD=-2063103839;
	const FIELD_OTROS=-2141661721;
	const FIELD_LOCALIZADOR=-1900391240;
	const FIELD_GESTIONADO=207962573;
	private static $PRIMARY_KEYS=array(self::FIELD_IDSOLICITUD);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_IDSOLICITUD);
	private static $FIELD_NAMES=array(
		self::FIELD_IDSOLICITUD=>'idSolicitud',
		self::FIELD_IDTIPOSOLICITUD=>'idTipoSolicitud',
		self::FIELD_IDTIPOTARIFA=>'idTipoTarifa',
		self::FIELD_FECHASOLICITUD=>'FechaSolicitud',
		self::FIELD_NOMBRE=>'Nombre',
		self::FIELD_APELLIDOS=>'Apellidos',
		self::FIELD_DNI=>'DNI',
		self::FIELD_EMAIL=>'EMail',
		self::FIELD_DIRECCION=>'Direccion',
		self::FIELD_CP=>'CP',
		self::FIELD_SEXO=>'Sexo',
		self::FIELD_FECHANACIMIENTO=>'FechaNacimiento',
		self::FIELD_TUTORLEGAL=>'TutorLegal',
		self::FIELD_LOCALIDAD=>'Localidad',
		self::FIELD_TELEFONO1=>'Telefono1',
		self::FIELD_TELEFONO2=>'Telefono2',
		self::FIELD_PROVINCIA=>'Provincia',
		self::FIELD_DESCRIPCIONSOLICITUD=>'DescripcionSolicitud',
		self::FIELD_OTROS=>'Otros',
		self::FIELD_LOCALIZADOR=>'Localizador',
		self::FIELD_GESTIONADO=>'Gestionado');
	private static $PROPERTY_NAMES=array(
		self::FIELD_IDSOLICITUD=>'idSolicitud',
		self::FIELD_IDTIPOSOLICITUD=>'idTipoSolicitud',
		self::FIELD_IDTIPOTARIFA=>'idTipoTarifa',
		self::FIELD_FECHASOLICITUD=>'FechaSolicitud',
		self::FIELD_NOMBRE=>'Nombre',
		self::FIELD_APELLIDOS=>'Apellidos',
		self::FIELD_DNI=>'dni',
		self::FIELD_EMAIL=>'EMail',
		self::FIELD_DIRECCION=>'Direccion',
		self::FIELD_CP=>'cp',
		self::FIELD_SEXO=>'Sexo',
		self::FIELD_FECHANACIMIENTO=>'FechaNacimiento',
		self::FIELD_TUTORLEGAL=>'TutorLegal',
		self::FIELD_LOCALIDAD=>'Localidad',
		self::FIELD_TELEFONO1=>'Telefono1',
		self::FIELD_TELEFONO2=>'Telefono2',
		self::FIELD_PROVINCIA=>'Provincia',
		self::FIELD_DESCRIPCIONSOLICITUD=>'DescripcionSolicitud',
		self::FIELD_OTROS=>'Otros',
		self::FIELD_LOCALIZADOR=>'Localizador',
		self::FIELD_GESTIONADO=>'Gestionado');
	private static $PROPERTY_TYPES=array(
		self::FIELD_IDSOLICITUD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDTIPOSOLICITUD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDTIPOTARIFA=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_FECHASOLICITUD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_NOMBRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_APELLIDOS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DNI=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DIRECCION=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CP=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SEXO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHANACIMIENTO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TUTORLEGAL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LOCALIDAD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TELEFONO1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TELEFONO2=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PROVINCIA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DESCRIPCIONSOLICITUD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OTROS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LOCALIZADOR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GESTIONADO=>Db2PhpEntity::PHP_TYPE_BOOL);
	private static $FIELD_TYPES=array(
		self::FIELD_IDSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_IDTIPOSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_IDTIPOTARIFA=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_FECHASOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,true),
		self::FIELD_NOMBRE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,true),
		self::FIELD_APELLIDOS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_DNI=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,true),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_DIRECCION=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,true),
		self::FIELD_CP=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,5,0,true),
		self::FIELD_SEXO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,1,0,true),
		self::FIELD_FECHANACIMIENTO=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,true),
		self::FIELD_TUTORLEGAL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,true),
		self::FIELD_LOCALIDAD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_TELEFONO1=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,9,0,true),
		self::FIELD_TELEFONO2=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,9,0,true),
		self::FIELD_PROVINCIA=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,true),
		self::FIELD_DESCRIPCIONSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,3000,0,true),
		self::FIELD_OTROS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,3000,0,true),
		self::FIELD_LOCALIZADOR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_GESTIONADO=>array(Db2PhpEntity::JDBC_TYPE_BIT,1,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_IDSOLICITUD=>null,
		self::FIELD_IDTIPOSOLICITUD=>0,
		self::FIELD_IDTIPOTARIFA=>0,
		self::FIELD_FECHASOLICITUD=>null,
		self::FIELD_NOMBRE=>null,
		self::FIELD_APELLIDOS=>null,
		self::FIELD_DNI=>null,
		self::FIELD_EMAIL=>null,
		self::FIELD_DIRECCION=>null,
		self::FIELD_CP=>null,
		self::FIELD_SEXO=>null,
		self::FIELD_FECHANACIMIENTO=>null,
		self::FIELD_TUTORLEGAL=>null,
		self::FIELD_LOCALIDAD=>null,
		self::FIELD_TELEFONO1=>null,
		self::FIELD_TELEFONO2=>null,
		self::FIELD_PROVINCIA=>null,
		self::FIELD_DESCRIPCIONSOLICITUD=>null,
		self::FIELD_OTROS=>null,
		self::FIELD_LOCALIZADOR=>null,
		self::FIELD_GESTIONADO=>'');
	private $idSolicitud;
	private $idTipoSolicitud;
	private $idTipoTarifa;
	private $FechaSolicitud;
	private $Nombre;
	private $Apellidos;
	private $dni;
	private $EMail;
	private $Direccion;
	private $cp;
	private $Sexo;
	private $FechaNacimiento;
	private $TutorLegal;
	private $Localidad;
	private $Telefono1;
	private $Telefono2;
	private $Provincia;
	private $DescripcionSolicitud;
	private $Otros;
	private $Localizador;
	private $Gestionado;

	/**
	 * set value for idSolicitud 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $idSolicitud
	 * @return SolicitudModel
	 */
	public function &setIdSolicitud($idSolicitud) {
		$this->notifyChanged(self::FIELD_IDSOLICITUD,$this->idSolicitud,$idSolicitud);
		$this->idSolicitud=$idSolicitud;
		return $this;
	}

	/**
	 * get value for idSolicitud 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getIdSolicitud() {
		return $this->idSolicitud;
	}

	/**
	 * set value for idTipoSolicitud 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @param mixed $idTipoSolicitud
	 * @return SolicitudModel
	 */
	public function &setIdTipoSolicitud($idTipoSolicitud) {
		$this->notifyChanged(self::FIELD_IDTIPOSOLICITUD,$this->idTipoSolicitud,$idTipoSolicitud);
		$this->idTipoSolicitud=$idTipoSolicitud;
		return $this;
	}

	/**
	 * get value for idTipoSolicitud 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getIdTipoSolicitud() {
		return $this->idTipoSolicitud;
	}

	/**
	 * set value for idTipoTarifa 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @param mixed $idTipoTarifa
	 * @return SolicitudModel
	 */
	public function &setIdTipoTarifa($idTipoTarifa) {
		$this->notifyChanged(self::FIELD_IDTIPOTARIFA,$this->idTipoTarifa,$idTipoTarifa);
		$this->idTipoTarifa=$idTipoTarifa;
		return $this;
	}

	/**
	 * get value for idTipoTarifa 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getIdTipoTarifa() {
		return $this->idTipoTarifa;
	}

	/**
	 * set value for FechaSolicitud 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @param mixed $FechaSolicitud
	 * @return SolicitudModel
	 */
	public function &setFechaSolicitud($FechaSolicitud) {
		$this->notifyChanged(self::FIELD_FECHASOLICITUD,$this->FechaSolicitud,$FechaSolicitud);
		$this->FechaSolicitud=$FechaSolicitud;
		return $this;
	}

	/**
	 * get value for FechaSolicitud 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFechaSolicitud() {
		return $this->FechaSolicitud;
	}

	/**
	 * set value for Nombre 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @param mixed $Nombre
	 * @return SolicitudModel
	 */
	public function &setNombre($Nombre) {
		$this->notifyChanged(self::FIELD_NOMBRE,$this->Nombre,$Nombre);
		$this->Nombre=$Nombre;
		return $this;
	}

	/**
	 * get value for Nombre 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getNombre() {
		return $this->Nombre;
	}

	/**
	 * set value for Apellidos 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $Apellidos
	 * @return SolicitudModel
	 */
	public function &setApellidos($Apellidos) {
		$this->notifyChanged(self::FIELD_APELLIDOS,$this->Apellidos,$Apellidos);
		$this->Apellidos=$Apellidos;
		return $this;
	}

	/**
	 * get value for Apellidos 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getApellidos() {
		return $this->Apellidos;
	}

	/**
	 * set value for DNI 
	 *
	 * type:VARCHAR,size:10,default:null,nullable
	 *
	 * @param mixed $dni
	 * @return SolicitudModel
	 */
	public function &setDni($dni) {
		$this->notifyChanged(self::FIELD_DNI,$this->dni,$dni);
		$this->dni=$dni;
		return $this;
	}

	/**
	 * get value for DNI 
	 *
	 * type:VARCHAR,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDni() {
		return $this->dni;
	}

	/**
	 * set value for EMail 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $EMail
	 * @return SolicitudModel
	 */
	public function &setEMail($EMail) {
		$this->notifyChanged(self::FIELD_EMAIL,$this->EMail,$EMail);
		$this->EMail=$EMail;
		return $this;
	}

	/**
	 * get value for EMail 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEMail() {
		return $this->EMail;
	}

	/**
	 * set value for Direccion 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @param mixed $Direccion
	 * @return SolicitudModel
	 */
	public function &setDireccion($Direccion) {
		$this->notifyChanged(self::FIELD_DIRECCION,$this->Direccion,$Direccion);
		$this->Direccion=$Direccion;
		return $this;
	}

	/**
	 * get value for Direccion 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDireccion() {
		return $this->Direccion;
	}

	/**
	 * set value for CP 
	 *
	 * type:VARCHAR,size:5,default:null,nullable
	 *
	 * @param mixed $cp
	 * @return SolicitudModel
	 */
	public function &setCp($cp) {
		$this->notifyChanged(self::FIELD_CP,$this->cp,$cp);
		$this->cp=$cp;
		return $this;
	}

	/**
	 * get value for CP 
	 *
	 * type:VARCHAR,size:5,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCp() {
		return $this->cp;
	}

	/**
	 * set value for Sexo 
	 *
	 * type:VARCHAR,size:1,default:null,nullable
	 *
	 * @param mixed $Sexo
	 * @return SolicitudModel
	 */
	public function &setSexo($Sexo) {
		$this->notifyChanged(self::FIELD_SEXO,$this->Sexo,$Sexo);
		$this->Sexo=$Sexo;
		return $this;
	}

	/**
	 * get value for Sexo 
	 *
	 * type:VARCHAR,size:1,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSexo() {
		return $this->Sexo;
	}

	/**
	 * set value for FechaNacimiento 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @param mixed $FechaNacimiento
	 * @return SolicitudModel
	 */
	public function &setFechaNacimiento($FechaNacimiento) {
		$this->notifyChanged(self::FIELD_FECHANACIMIENTO,$this->FechaNacimiento,$FechaNacimiento);
		$this->FechaNacimiento=$FechaNacimiento;
		return $this;
	}

	/**
	 * get value for FechaNacimiento 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFechaNacimiento() {
		return $this->FechaNacimiento;
	}

	/**
	 * set value for TutorLegal 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @param mixed $TutorLegal
	 * @return SolicitudModel
	 */
	public function &setTutorLegal($TutorLegal) {
		$this->notifyChanged(self::FIELD_TUTORLEGAL,$this->TutorLegal,$TutorLegal);
		$this->TutorLegal=$TutorLegal;
		return $this;
	}

	/**
	 * get value for TutorLegal 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTutorLegal() {
		return $this->TutorLegal;
	}

	/**
	 * set value for Localidad 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $Localidad
	 * @return SolicitudModel
	 */
	public function &setLocalidad($Localidad) {
		$this->notifyChanged(self::FIELD_LOCALIDAD,$this->Localidad,$Localidad);
		$this->Localidad=$Localidad;
		return $this;
	}

	/**
	 * get value for Localidad 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLocalidad() {
		return $this->Localidad;
	}

	/**
	 * set value for Telefono1 
	 *
	 * type:VARCHAR,size:9,default:null,nullable
	 *
	 * @param mixed $Telefono1
	 * @return SolicitudModel
	 */
	public function &setTelefono1($Telefono1) {
		$this->notifyChanged(self::FIELD_TELEFONO1,$this->Telefono1,$Telefono1);
		$this->Telefono1=$Telefono1;
		return $this;
	}

	/**
	 * get value for Telefono1 
	 *
	 * type:VARCHAR,size:9,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTelefono1() {
		return $this->Telefono1;
	}

	/**
	 * set value for Telefono2 
	 *
	 * type:VARCHAR,size:9,default:null,nullable
	 *
	 * @param mixed $Telefono2
	 * @return SolicitudModel
	 */
	public function &setTelefono2($Telefono2) {
		$this->notifyChanged(self::FIELD_TELEFONO2,$this->Telefono2,$Telefono2);
		$this->Telefono2=$Telefono2;
		return $this;
	}

	/**
	 * get value for Telefono2 
	 *
	 * type:VARCHAR,size:9,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTelefono2() {
		return $this->Telefono2;
	}

	/**
	 * set value for Provincia 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @param mixed $Provincia
	 * @return SolicitudModel
	 */
	public function &setProvincia($Provincia) {
		$this->notifyChanged(self::FIELD_PROVINCIA,$this->Provincia,$Provincia);
		$this->Provincia=$Provincia;
		return $this;
	}

	/**
	 * get value for Provincia 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getProvincia() {
		return $this->Provincia;
	}

	/**
	 * set value for DescripcionSolicitud 
	 *
	 * type:VARCHAR,size:3000,default:null,nullable
	 *
	 * @param mixed $DescripcionSolicitud
	 * @return SolicitudModel
	 */
	public function &setDescripcionSolicitud($DescripcionSolicitud) {
		$this->notifyChanged(self::FIELD_DESCRIPCIONSOLICITUD,$this->DescripcionSolicitud,$DescripcionSolicitud);
		$this->DescripcionSolicitud=$DescripcionSolicitud;
		return $this;
	}

	/**
	 * get value for DescripcionSolicitud 
	 *
	 * type:VARCHAR,size:3000,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDescripcionSolicitud() {
		return $this->DescripcionSolicitud;
	}

	/**
	 * set value for Otros 
	 *
	 * type:VARCHAR,size:3000,default:null,nullable
	 *
	 * @param mixed $Otros
	 * @return SolicitudModel
	 */
	public function &setOtros($Otros) {
		$this->notifyChanged(self::FIELD_OTROS,$this->Otros,$Otros);
		$this->Otros=$Otros;
		return $this;
	}

	/**
	 * get value for Otros 
	 *
	 * type:VARCHAR,size:3000,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOtros() {
		return $this->Otros;
	}

	/**
	 * set value for Localizador 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $Localizador
	 * @return SolicitudModel
	 */
	public function &setLocalizador($Localizador) {
		$this->notifyChanged(self::FIELD_LOCALIZADOR,$this->Localizador,$Localizador);
		$this->Localizador=$Localizador;
		return $this;
	}

	/**
	 * get value for Localizador 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLocalizador() {
		return $this->Localizador;
	}

	/**
	 * set value for Gestionado 
	 *
	 * type:BIT,size:1,default:null
	 *
	 * @param mixed $Gestionado
	 * @return SolicitudModel
	 */
	public function &setGestionado($Gestionado) {
		$this->notifyChanged(self::FIELD_GESTIONADO,$this->Gestionado,$Gestionado);
		$this->Gestionado=$Gestionado;
		return $this;
	}

	/**
	 * get value for Gestionado 
	 *
	 * type:BIT,size:1,default:null
	 *
	 * @return mixed
	 */
	public function getGestionado() {
		return $this->Gestionado;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public static function getTableName() {
		return self::SQL_TABLE_NAME;
	}

	/**
	 * Get array with field id as index and field name as value
	 *
	 * @return array
	 */
	public static function getFieldNames() {
		return self::$FIELD_NAMES;
	}

	/**
	 * Get array with field id as index and property name as value
	 *
	 * @return array
	 */
	public static function getPropertyNames() {
		return self::$PROPERTY_NAMES;
	}

	/**
	 * get the field name for the passed field id.
	 *
	 * @param int $fieldId
	 * @param bool $fullyQualifiedName true if field name should be qualified by table name
	 * @return string field name for the passed field id, null if the field doesn't exist
	 */
	public static function getFieldNameByFieldId($fieldId, $fullyQualifiedName=true) {
		if (!array_key_exists($fieldId, self::$FIELD_NAMES)) {
			return null;
		}
		$fieldName=self::SQL_IDENTIFIER_QUOTE . self::$FIELD_NAMES[$fieldId] . self::SQL_IDENTIFIER_QUOTE;
		if ($fullyQualifiedName) {
			return self::SQL_IDENTIFIER_QUOTE . self::SQL_TABLE_NAME . self::SQL_IDENTIFIER_QUOTE . '.' . $fieldName;
		}
		return $fieldName;
	}

	/**
	 * Get array with field ids of identifiers
	 *
	 * @return array
	 */
	public static function getIdentifierFields() {
		return self::$PRIMARY_KEYS;
	}

	/**
	 * Get array with field ids of autoincrement fields
	 *
	 * @return array
	 */
	public static function getAutoincrementFields() {
		return self::$AUTOINCREMENT_FIELDS;
	}

	/**
	 * Get array with field id as index and property type as value
	 *
	 * @return array
	 */
	public static function getPropertyTypes() {
		return self::$PROPERTY_TYPES;
	}

	/**
	 * Get array with field id as index and field type as value
	 *
	 * @return array
	 */
	public static function getFieldTypes() {
		return self::$FIELD_TYPES;
	}

	/**
	 * Assign default values according to table
	 * 
	 */
	public function assignDefaultValues() {
		$this->assignByArray(self::$DEFAULT_VALUES);
	}


	/**
	 * return hash with the field name as index and the field value as value.
	 *
	 * @return array
	 */
	public function toHash() {
		$array=$this->toArray();
		$hash=array();
		foreach ($array as $fieldId=>$value) {
			$hash[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		return $hash;
	}

	/**
	 * return array with the field id as index and the field value as value.
	 *
	 * @return array
	 */
	public function toArray() {
		return array(
			self::FIELD_IDSOLICITUD=>$this->getIdSolicitud(),
			self::FIELD_IDTIPOSOLICITUD=>$this->getIdTipoSolicitud(),
			self::FIELD_IDTIPOTARIFA=>$this->getIdTipoTarifa(),
			self::FIELD_FECHASOLICITUD=>$this->getFechaSolicitud(),
			self::FIELD_NOMBRE=>$this->getNombre(),
			self::FIELD_APELLIDOS=>$this->getApellidos(),
			self::FIELD_DNI=>$this->getDni(),
			self::FIELD_EMAIL=>$this->getEMail(),
			self::FIELD_DIRECCION=>$this->getDireccion(),
			self::FIELD_CP=>$this->getCp(),
			self::FIELD_SEXO=>$this->getSexo(),
			self::FIELD_FECHANACIMIENTO=>$this->getFechaNacimiento(),
			self::FIELD_TUTORLEGAL=>$this->getTutorLegal(),
			self::FIELD_LOCALIDAD=>$this->getLocalidad(),
			self::FIELD_TELEFONO1=>$this->getTelefono1(),
			self::FIELD_TELEFONO2=>$this->getTelefono2(),
			self::FIELD_PROVINCIA=>$this->getProvincia(),
			self::FIELD_DESCRIPCIONSOLICITUD=>$this->getDescripcionSolicitud(),
			self::FIELD_OTROS=>$this->getOtros(),
			self::FIELD_LOCALIZADOR=>$this->getLocalizador(),
			self::FIELD_GESTIONADO=>$this->getGestionado());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_IDSOLICITUD=>$this->getIdSolicitud());
	}

	/**
	 * cached statements
	 *
	 * @var array<string,array<string,PDOStatement>>
	 */
	private static $stmts=array();
	private static $cacheStatements=true;
	
	/**
	 * prepare passed string as statement or return cached if enabled and available
	 *
	 * @param PDO $db
	 * @param string $statement
	 * @return PDOStatement
	 */
	protected static function prepareStatement(PDO $db, $statement) {
		if(self::isCacheStatements()) {
			if (in_array($statement, array(self::SQL_INSERT, self::SQL_INSERT_AUTOINCREMENT, self::SQL_UPDATE, self::SQL_SELECT_PK, self::SQL_DELETE_PK))) {
				$dbInstanceId=spl_object_hash($db);
//				if (null===self::$stmts[$statement][$dbInstanceId]) {
//					self::$stmts[$statement][$dbInstanceId]=$db->prepare($statement);
//				}
//				return self::$stmts[$statement][$dbInstanceId];
                                
                                self::$stmts[$statement][$dbInstanceId]=$db->prepare($statement);
			}
		}
		return $db->prepare($statement);
	}

	/**
	 * Enable statement cache
	 *
	 * @param bool $cache
	 */
	public static function setCacheStatements($cache) {
		self::$cacheStatements=true==$cache;
	}

	/**
	 * Check if statement cache is enabled
	 *
	 * @return bool
	 */
	public static function isCacheStatements() {
		return self::$cacheStatements;
	}

	/**
	 * Query by Example.
	 *
	 * Match by attributes of passed example instance and return matched rows as an array of SolicitudModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param SolicitudModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SolicitudModel[]
	 */
	public static function findByExample(PDO $db,SolicitudModel $example, $and=true, $sort=null) {
		$exampleValues=$example->toArray();
		$filter=array();
		foreach ($exampleValues as $fieldId=>$value) {
			if (null!==$value) {
				$filter[$fieldId]=$value;
			}
		}
		return self::findByFilter($db, $filter, $and, $sort);
	}

	/**
	 * Query by filter.
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * Will return matched rows as an array of SolicitudModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SolicitudModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `solicitud`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of SolicitudModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return SolicitudModel[]
	 */
	public static function fromStatement(PDOStatement $stmt) {
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * returns the result as an array of SolicitudModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return SolicitudModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new SolicitudModel();
			$o->assignByHash($result);
			$o->notifyPristine();
			$resultInstances[]=$o;
		}
		$stmt->closeCursor();
		return $resultInstances;
	}

	/**
	 * Get sql WHERE part from filter.
	 *
	 * @param array $filter
	 * @param bool $and
	 * @param bool $fullyQualifiedNames true if field names should be qualified by table name
	 * @param bool $prependWhere true if WHERE should be prepended to conditions
	 * @return string
	 */
	public static function buildSqlWhere($filter, $and, $fullyQualifiedNames=true, $prependWhere=false) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		return $filter->buildSqlWhere(new self::$CLASS_NAME, $fullyQualifiedNames, $prependWhere);
	}

	/**
	 * get sql ORDER BY part from DSCs
	 *
	 * @param array $sort array of DSC instances
	 * @return string
	 */
	protected static function buildSqlOrderBy($sort) {
		return DSC::buildSqlOrderBy(new self::$CLASS_NAME, $sort);
	}

	/**
	 * bind values from filter to statement
	 *
	 * @param PDOStatement $stmt
	 * @param DFCInterface $filter
	 */
	public static function bindValuesForFilter(PDOStatement &$stmt, DFCInterface $filter) {
		$filter->bindValuesForFilter(new self::$CLASS_NAME, $stmt);
	}

	/**
	 * Execute select query and return matched rows as an array of SolicitudModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return SolicitudModel[]
	 */
	public static function findBySql(PDO $db, $sql) {
		$stmt=$db->query($sql);
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * Delete rows matching the filter
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * @param PDO $db
	 * @param array $filter
	 * @param bool $and
	 * @return mixed
	 */
	public static function deleteByFilter(PDO $db, $filter, $and=true) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		if (0==count($filter)) {
			throw new InvalidArgumentException('refusing to delete without filter'); // just comment out this line if you are brave
		}
		$sql='DELETE FROM `solicitud`'
		. self::buildSqlWhere($filter, $and, false, true);
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Assign values from array with the field id as index and the value as value
	 *
	 * @param array $array
	 */
	public function assignByArray($array) {
		$result=array();
		foreach ($array as $fieldId=>$value) {
			$result[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		$this->assignByHash($result);
	}

	/**
	 * Assign values from hash where the indexes match the tables field names
	 *
	 * @param array $result
	 */
	public function assignByHash($result) {
		$this->setIdSolicitud($result['idSolicitud']);
		$this->setIdTipoSolicitud($result['idTipoSolicitud']);
		$this->setIdTipoTarifa($result['idTipoTarifa']);
		$this->setFechaSolicitud($result['FechaSolicitud']);
		$this->setNombre($result['Nombre']);
		$this->setApellidos($result['Apellidos']);
		$this->setDni($result['DNI']);
		$this->setEMail($result['EMail']);
		$this->setDireccion($result['Direccion']);
		$this->setCp($result['CP']);
		$this->setSexo($result['Sexo']);
		$this->setFechaNacimiento($result['FechaNacimiento']);
		$this->setTutorLegal($result['TutorLegal']);
		$this->setLocalidad($result['Localidad']);
		$this->setTelefono1($result['Telefono1']);
		$this->setTelefono2($result['Telefono2']);
		$this->setProvincia($result['Provincia']);
		$this->setDescripcionSolicitud($result['DescripcionSolicitud']);
		$this->setOtros($result['Otros']);
		$this->setLocalizador($result['Localizador']);
		$this->setGestionado($result['Gestionado']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return SolicitudModel
	 */
	public static function findById(PDO $db,$idSolicitud) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$idSolicitud);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		if(!$result) {
			return null;
		}
		$o=new SolicitudModel();
		$o->assignByHash($result);
		$o->notifyPristine();
		return $o;
	}

	/**
	 * Bind all values to statement
	 *
	 * @param PDOStatement $stmt
	 */
	protected function bindValues(PDOStatement &$stmt) {
		$stmt->bindValue(1,$this->getIdSolicitud());
		$stmt->bindValue(2,$this->getIdTipoSolicitud());
		$stmt->bindValue(3,$this->getIdTipoTarifa());
		$stmt->bindValue(4,$this->getFechaSolicitud());
		$stmt->bindValue(5,$this->getNombre());
		$stmt->bindValue(6,$this->getApellidos());
		$stmt->bindValue(7,$this->getDni());
		$stmt->bindValue(8,$this->getEMail());
		$stmt->bindValue(9,$this->getDireccion());
		$stmt->bindValue(10,$this->getCp());
		$stmt->bindValue(11,$this->getSexo());
		$stmt->bindValue(12,$this->getFechaNacimiento());
		$stmt->bindValue(13,$this->getTutorLegal());
		$stmt->bindValue(14,$this->getLocalidad());
		$stmt->bindValue(15,$this->getTelefono1());
		$stmt->bindValue(16,$this->getTelefono2());
		$stmt->bindValue(17,$this->getProvincia());
		$stmt->bindValue(18,$this->getDescripcionSolicitud());
		$stmt->bindValue(19,$this->getOtros());
		$stmt->bindValue(20,$this->getLocalizador());
		$stmt->bindValue(21,$this->getGestionado());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getIdSolicitud()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getIdTipoSolicitud());
			$stmt->bindValue(2,$this->getIdTipoTarifa());
			$stmt->bindValue(3,$this->getFechaSolicitud());
			$stmt->bindValue(4,$this->getNombre());
			$stmt->bindValue(5,$this->getApellidos());
			$stmt->bindValue(6,$this->getDni());
			$stmt->bindValue(7,$this->getEMail());
			$stmt->bindValue(8,$this->getDireccion());
			$stmt->bindValue(9,$this->getCp());
			$stmt->bindValue(10,$this->getSexo());
			$stmt->bindValue(11,$this->getFechaNacimiento());
			$stmt->bindValue(12,$this->getTutorLegal());
			$stmt->bindValue(13,$this->getLocalidad());
			$stmt->bindValue(14,$this->getTelefono1());
			$stmt->bindValue(15,$this->getTelefono2());
			$stmt->bindValue(16,$this->getProvincia());
			$stmt->bindValue(17,$this->getDescripcionSolicitud());
			$stmt->bindValue(18,$this->getOtros());
			$stmt->bindValue(19,$this->getLocalizador());
			$stmt->bindValue(20,$this->getGestionado());
		} else {
			$stmt=self::prepareStatement($db,self::SQL_INSERT);
			$this->bindValues($stmt);
		}
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$lastInsertId=$db->lastInsertId();
		if (false!==$lastInsertId) {
			$this->setIdSolicitud($lastInsertId);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Update this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateToDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_UPDATE);
		$this->bindValues($stmt);
		$stmt->bindValue(22,$this->getIdSolicitud());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Delete this instance from the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function deleteFromDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_DELETE_PK);
		$stmt->bindValue(1,$this->getIdSolicitud());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch ActividadsolicitudclasedirigidaModel's which this SolicitudModel references.
	 * `solicitud`.`idSolicitud` -> `actividadsolicitudclasedirigida`.`idSolicitud`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return ActividadsolicitudclasedirigidaModel[]
	 */
	public function fetchActividadsolicitudclasedirigidaModelCollection(PDO $db, $sort=null) {
		$filter=array(ActividadsolicitudclasedirigidaModel::FIELD_IDSOLICITUD=>$this->getIdSolicitud());
		return ActividadsolicitudclasedirigidaModel::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch DatosolicitudabonomensualModel's which this SolicitudModel references.
	 * `solicitud`.`idSolicitud` -> `datosolicitudabonomensual`.`idSolicitud`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return DatosolicitudabonomensualModel[]
	 */
	public function fetchDatosolicitudabonomensualModelCollection(PDO $db, $sort=null) {
		$filter=array(DatosolicitudabonomensualModel::FIELD_IDSOLICITUD=>$this->getIdSolicitud());
		return DatosolicitudabonomensualModel::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch DatosolicitudclasedirigidaModel's which this SolicitudModel references.
	 * `solicitud`.`idSolicitud` -> `datosolicitudclasedirigida`.`idSolicitud`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return DatosolicitudclasedirigidaModel[]
	 */
	public function fetchDatosolicitudclasedirigidaModelCollection(PDO $db, $sort=null) {
		$filter=array(DatosolicitudclasedirigidaModel::FIELD_IDSOLICITUD=>$this->getIdSolicitud());
		return DatosolicitudclasedirigidaModel::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch TiposolicitudModel which references this SolicitudModel. Will return null in case reference is invalid.
	 * `solicitud`.`idTipoSolicitud` -> `tiposolicitud`.`idTipoSolicitud`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TiposolicitudModel
	 */
	public function fetchTiposolicitudModel(PDO $db, $sort=null) {
		$filter=array(TiposolicitudModel::FIELD_IDTIPOSOLICITUD=>$this->getIdTipoSolicitud());
		$result=TiposolicitudModel::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch TipotarifaModel which references this SolicitudModel. Will return null in case reference is invalid.
	 * `solicitud`.`idTipoTarifa` -> `tipotarifa`.`idTipoTarifa`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TipotarifaModel
	 */
	public function fetchTipotarifaModel(PDO $db, $sort=null) {
		$filter=array(TipotarifaModel::FIELD_IDTIPOTARIFA=>$this->getIdTipoTarifa());
		$result=TipotarifaModel::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'SolicitudModel');
	}

	/**
	 * get single SolicitudModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return SolicitudModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new SolicitudModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of SolicitudModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return SolicitudModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('SolicitudModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>