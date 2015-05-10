<?php

require_once("helpers/Db2PhpEntityBase.class.php");
require_once("helpers/Db2PhpEntityModificationTracking.class.php");
require_once 'helpers/DFCAggregate.class.php';

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
class ClaseModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='ClaseModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='clase';
	const SQL_INSERT='INSERT INTO `clase` (`idClase`,`idActividad`,`idSala`,`FechaInicio`,`HoraInicio`,`FechaFin`,`HoraFin`,`Ocupacion`,`Dia`,`Publicada`) VALUES (?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `clase` (`idActividad`,`idSala`,`FechaInicio`,`HoraInicio`,`FechaFin`,`HoraFin`,`Ocupacion`,`Dia`,`Publicada`) VALUES (?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `clase` SET `idClase`=?,`idActividad`=?,`idSala`=?,`FechaInicio`=?,`HoraInicio`=?,`FechaFin`=?,`HoraFin`=?,`Ocupacion`=?,`Dia`=?,`Publicada`=? WHERE `idClase`=?';
	const SQL_SELECT_PK='SELECT * FROM `clase` WHERE `idClase`=?';
        const SQL_SELECT='SELECT * FROM `clase`';
	const SQL_DELETE_PK='DELETE FROM `clase` WHERE `idClase`=?';
	const FIELD_IDCLASE=766399627;
	const FIELD_IDACTIVIDAD=1539203806;
	const FIELD_IDSALA=717925634;
	const FIELD_FECHAINICIO=-1994536546;
	const FIELD_HORAINICIO=1991559839;
	const FIELD_FECHAFIN=-1080335502;
	const FIELD_HORAFIN=1901521425;
	const FIELD_OCUPACION=1616557811;
	const FIELD_DIA=-23799336;
	const FIELD_PUBLICADA=1325081073;
	private static $PRIMARY_KEYS=array(self::FIELD_IDCLASE);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_IDCLASE);
	private static $FIELD_NAMES=array(
		self::FIELD_IDCLASE=>'idClase',
		self::FIELD_IDACTIVIDAD=>'idActividad',
		self::FIELD_IDSALA=>'idSala',
		self::FIELD_FECHAINICIO=>'FechaInicio',
		self::FIELD_HORAINICIO=>'HoraInicio',
		self::FIELD_FECHAFIN=>'FechaFin',
		self::FIELD_HORAFIN=>'HoraFin',
		self::FIELD_OCUPACION=>'Ocupacion',
		self::FIELD_DIA=>'Dia',
		self::FIELD_PUBLICADA=>'Publicada');
	private static $PROPERTY_NAMES=array(
		self::FIELD_IDCLASE=>'idClase',
		self::FIELD_IDACTIVIDAD=>'idActividad',
		self::FIELD_IDSALA=>'idSala',
		self::FIELD_FECHAINICIO=>'FechaInicio',
		self::FIELD_HORAINICIO=>'HoraInicio',
		self::FIELD_FECHAFIN=>'FechaFin',
		self::FIELD_HORAFIN=>'HoraFin',
		self::FIELD_OCUPACION=>'Ocupacion',
		self::FIELD_DIA=>'Dia',
		self::FIELD_PUBLICADA=>'Publicada');
	private static $PROPERTY_TYPES=array(
		self::FIELD_IDCLASE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDACTIVIDAD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDSALA=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_FECHAINICIO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_HORAINICIO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHAFIN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_HORAFIN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OCUPACION=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DIA=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_PUBLICADA=>Db2PhpEntity::PHP_TYPE_BOOL);
	private static $FIELD_TYPES=array(
		self::FIELD_IDCLASE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_IDACTIVIDAD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_IDSALA=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_FECHAINICIO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,false),
		self::FIELD_HORAINICIO=>array(Db2PhpEntity::JDBC_TYPE_TIME,8,0,true),
		self::FIELD_FECHAFIN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,false),
		self::FIELD_HORAFIN=>array(Db2PhpEntity::JDBC_TYPE_TIME,8,0,true),
		self::FIELD_OCUPACION=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_DIA=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_PUBLICADA=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_IDCLASE=>null,
		self::FIELD_IDACTIVIDAD=>0,
		self::FIELD_IDSALA=>0,
		self::FIELD_FECHAINICIO=>'',
		self::FIELD_HORAINICIO=>null,
		self::FIELD_FECHAFIN=>'',
		self::FIELD_HORAFIN=>null,
		self::FIELD_OCUPACION=>null,
		self::FIELD_DIA=>null,
		self::FIELD_PUBLICADA=>null);
	private $idClase;
	private $idActividad;
	private $idSala;
	private $FechaInicio;
	private $HoraInicio;
	private $FechaFin;
	private $HoraFin;
	private $Ocupacion;
	private $Dia;
	private $Publicada;

	/**
	 * set value for idClase 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $idClase
	 * @return ClaseModel
	 */
	public function &setIdClase($idClase) {
		$this->notifyChanged(self::FIELD_IDCLASE,$this->idClase,$idClase);
		$this->idClase=$idClase;
		return $this;
	}

	/**
	 * get value for idClase 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getIdClase() {
		return $this->idClase;
	}

	/**
	 * set value for idActividad 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @param mixed $idActividad
	 * @return ClaseModel
	 */
	public function &setIdActividad($idActividad) {
		$this->notifyChanged(self::FIELD_IDACTIVIDAD,$this->idActividad,$idActividad);
		$this->idActividad=$idActividad;
		return $this;
	}

	/**
	 * get value for idActividad 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getIdActividad() {
		return $this->idActividad;
	}

	/**
	 * set value for idSala 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @param mixed $idSala
	 * @return ClaseModel
	 */
	public function &setIdSala($idSala) {
		$this->notifyChanged(self::FIELD_IDSALA,$this->idSala,$idSala);
		$this->idSala=$idSala;
		return $this;
	}

	/**
	 * get value for idSala 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getIdSala() {
		return $this->idSala;
	}

	/**
	 * set value for FechaInicio 
	 *
	 * type:VARCHAR,size:10,default:null
	 *
	 * @param mixed $FechaInicio
	 * @return ClaseModel
	 */
	public function &setFechaInicio($FechaInicio) {
		$this->notifyChanged(self::FIELD_FECHAINICIO,$this->FechaInicio,$FechaInicio);
		$this->FechaInicio=$FechaInicio;
		return $this;
	}

	/**
	 * get value for FechaInicio 
	 *
	 * type:VARCHAR,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getFechaInicio() {
		return $this->FechaInicio;
	}

	/**
	 * set value for HoraInicio 
	 *
	 * type:TIME,size:8,default:null,nullable
	 *
	 * @param mixed $HoraInicio
	 * @return ClaseModel
	 */
	public function &setHoraInicio($HoraInicio) {
		$this->notifyChanged(self::FIELD_HORAINICIO,$this->HoraInicio,$HoraInicio);
		$this->HoraInicio=$HoraInicio;
		return $this;
	}

	/**
	 * get value for HoraInicio 
	 *
	 * type:TIME,size:8,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getHoraInicio() {
		return $this->HoraInicio;
	}

	/**
	 * set value for FechaFin 
	 *
	 * type:VARCHAR,size:10,default:null
	 *
	 * @param mixed $FechaFin
	 * @return ClaseModel
	 */
	public function &setFechaFin($FechaFin) {
		$this->notifyChanged(self::FIELD_FECHAFIN,$this->FechaFin,$FechaFin);
		$this->FechaFin=$FechaFin;
		return $this;
	}

	/**
	 * get value for FechaFin 
	 *
	 * type:VARCHAR,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getFechaFin() {
		return $this->FechaFin;
	}

	/**
	 * set value for HoraFin 
	 *
	 * type:TIME,size:8,default:null,nullable
	 *
	 * @param mixed $HoraFin
	 * @return ClaseModel
	 */
	public function &setHoraFin($HoraFin) {
		$this->notifyChanged(self::FIELD_HORAFIN,$this->HoraFin,$HoraFin);
		$this->HoraFin=$HoraFin;
		return $this;
	}

	/**
	 * get value for HoraFin 
	 *
	 * type:TIME,size:8,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getHoraFin() {
		return $this->HoraFin;
	}

	/**
	 * set value for Ocupacion 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $Ocupacion
	 * @return ClaseModel
	 */
	public function &setOcupacion($Ocupacion) {
		$this->notifyChanged(self::FIELD_OCUPACION,$this->Ocupacion,$Ocupacion);
		$this->Ocupacion=$Ocupacion;
		return $this;
	}

	/**
	 * get value for Ocupacion 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOcupacion() {
		return $this->Ocupacion;
	}

	/**
	 * set value for Dia 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $Dia
	 * @return ClaseModel
	 */
	public function &setDia($Dia) {
		$this->notifyChanged(self::FIELD_DIA,$this->Dia,$Dia);
		$this->Dia=$Dia;
		return $this;
	}

	/**
	 * get value for Dia 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDia() {
		return $this->Dia;
	}

	/**
	 * set value for Publicada 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $Publicada
	 * @return ClaseModel
	 */
	public function &setPublicada($Publicada) {
		$this->notifyChanged(self::FIELD_PUBLICADA,$this->Publicada,$Publicada);
		$this->Publicada=$Publicada;
		return $this;
	}

	/**
	 * get value for Publicada 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPublicada() {
		return $this->Publicada;
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
			self::FIELD_IDCLASE=>$this->getIdClase(),
			self::FIELD_IDACTIVIDAD=>$this->getIdActividad(),
			self::FIELD_IDSALA=>$this->getIdSala(),
			self::FIELD_FECHAINICIO=>$this->getFechaInicio(),
			self::FIELD_HORAINICIO=>$this->getHoraInicio(),
			self::FIELD_FECHAFIN=>$this->getFechaFin(),
			self::FIELD_HORAFIN=>$this->getHoraFin(),
			self::FIELD_OCUPACION=>$this->getOcupacion(),
			self::FIELD_DIA=>$this->getDia(),
			self::FIELD_PUBLICADA=>$this->getPublicada());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_IDCLASE=>$this->getIdClase());
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
				if (null===self::$stmts[$statement][$dbInstanceId]) {
					self::$stmts[$statement][$dbInstanceId]=$db->prepare($statement);
				}
				return self::$stmts[$statement][$dbInstanceId];
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
	 * Match by attributes of passed example instance and return matched rows as an array of ClaseModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param ClaseModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return ClaseModel[]
	 */
	public static function findByExample(PDO $db,ClaseModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of ClaseModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return ClaseModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `clase`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of ClaseModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return ClaseModel[]
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
	 * returns the result as an array of ClaseModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return ClaseModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new ClaseModel();
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
	 * Execute select query and return matched rows as an array of ClaseModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return ClaseModel[]
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
		$sql='DELETE FROM `clase`'
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
		$this->setIdClase($result['idClase']);
		$this->setIdActividad($result['idActividad']);
		$this->setIdSala($result['idSala']);
		$this->setFechaInicio($result['FechaInicio']);
		$this->setHoraInicio($result['HoraInicio']);
		$this->setFechaFin($result['FechaFin']);
		$this->setHoraFin($result['HoraFin']);
		$this->setOcupacion($result['Ocupacion']);
		$this->setDia($result['Dia']);
		$this->setPublicada($result['Publicada']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return ClaseModel
	 */
	public static function findById(PDO $db,$idClase) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$idClase);
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
		$o=new ClaseModel();
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
		$stmt->bindValue(1,$this->getIdClase());
		$stmt->bindValue(2,$this->getIdActividad());
		$stmt->bindValue(3,$this->getIdSala());
		$stmt->bindValue(4,$this->getFechaInicio());
		$stmt->bindValue(5,$this->getHoraInicio());
		$stmt->bindValue(6,$this->getFechaFin());
		$stmt->bindValue(7,$this->getHoraFin());
		$stmt->bindValue(8,$this->getOcupacion());
		$stmt->bindValue(9,$this->getDia());
		$stmt->bindValue(10,$this->getPublicada());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getIdClase()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getIdActividad());
			$stmt->bindValue(2,$this->getIdSala());
			$stmt->bindValue(3,$this->getFechaInicio());
			$stmt->bindValue(4,$this->getHoraInicio());
			$stmt->bindValue(5,$this->getFechaFin());
			$stmt->bindValue(6,$this->getHoraFin());
			$stmt->bindValue(7,$this->getOcupacion());
			$stmt->bindValue(8,$this->getDia());
			$stmt->bindValue(9,$this->getPublicada());
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
			$this->setIdClase($lastInsertId);
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
		$stmt->bindValue(11,$this->getIdClase());
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
		$stmt->bindValue(1,$this->getIdClase());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch ActividadModel which references this ClaseModel. Will return null in case reference is invalid.
	 * `clase`.`idActividad` -> `actividad`.`idActividad`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return ActividadModel
	 */
	public function fetchActividadModel(PDO $db, $sort=null) {
		$filter=array(ActividadModel::FIELD_IDACTIVIDAD=>$this->getIdActividad());
		$result=ActividadModel::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch SalaModel which references this ClaseModel. Will return null in case reference is invalid.
	 * `clase`.`idSala` -> `sala`.`idSala`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SalaModel
	 */
	public function fetchSalaModel(PDO $db, $sort=null) {
		$filter=array(SalaModel::FIELD_IDSALA=>$this->getIdSala());
		$result=SalaModel::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'ClaseModel');
	}

	/**
	 * get single ClaseModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return ClaseModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new ClaseModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of ClaseModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return ClaseModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('ClaseModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>