<?php

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
class PrecioModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='PrecioModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='precio';
	const SQL_INSERT='INSERT INTO `precio` (`idPrecio`,`idTipoSolicitud`,`idTipoAbono`,`idActividad`,`NombrePrecio`,`DescripcionPrecio`,`Precio`,`FechaAlta`,`FechaBaja`) VALUES (?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `precio` (`idTipoSolicitud`,`idTipoAbono`,`idActividad`,`NombrePrecio`,`DescripcionPrecio`,`Precio`,`FechaAlta`,`FechaBaja`) VALUES (?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `precio` SET `idPrecio`=?,`idTipoSolicitud`=?,`idTipoAbono`=?,`idActividad`=?,`NombrePrecio`=?,`DescripcionPrecio`=?,`Precio`=?,`FechaAlta`=?,`FechaBaja`=? WHERE `idPrecio`=?';
	const SQL_SELECT_PK='SELECT * FROM `precio` WHERE `idPrecio`=?';
	const SQL_SELECT='SELECT * FROM `precio`';
	const SQL_DELETE_PK='DELETE FROM `precio` WHERE `idPrecio`=?';
	const FIELD_IDPRECIO=1851537897;
	const FIELD_IDTIPOSOLICITUD=993437133;
	const FIELD_IDTIPOABONO=-1060829608;
	const FIELD_IDACTIVIDAD=481523386;
	const FIELD_NOMBREPRECIO=-1803976137;
	const FIELD_DESCRIPCIONPRECIO=-26400117;
	const FIELD_PRECIO=-400820466;
	const FIELD_FECHAALTA=1534012461;
	const FIELD_FECHABAJA=1534031371;
	private static $PRIMARY_KEYS=array(self::FIELD_IDPRECIO);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_IDPRECIO);
	private static $FIELD_NAMES=array(
		self::FIELD_IDPRECIO=>'idPrecio',
		self::FIELD_IDTIPOSOLICITUD=>'idTipoSolicitud',
		self::FIELD_IDTIPOABONO=>'idTipoAbono',
		self::FIELD_IDACTIVIDAD=>'idActividad',
		self::FIELD_NOMBREPRECIO=>'NombrePrecio',
		self::FIELD_DESCRIPCIONPRECIO=>'DescripcionPrecio',
		self::FIELD_PRECIO=>'Precio',
		self::FIELD_FECHAALTA=>'FechaAlta',
		self::FIELD_FECHABAJA=>'FechaBaja');
	private static $PROPERTY_NAMES=array(
		self::FIELD_IDPRECIO=>'idPrecio',
		self::FIELD_IDTIPOSOLICITUD=>'idTipoSolicitud',
		self::FIELD_IDTIPOABONO=>'idTipoAbono',
		self::FIELD_IDACTIVIDAD=>'idActividad',
		self::FIELD_NOMBREPRECIO=>'NombrePrecio',
		self::FIELD_DESCRIPCIONPRECIO=>'DescripcionPrecio',
		self::FIELD_PRECIO=>'Precio',
		self::FIELD_FECHAALTA=>'FechaAlta',
		self::FIELD_FECHABAJA=>'FechaBaja');
	private static $PROPERTY_TYPES=array(
		self::FIELD_IDPRECIO=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDTIPOSOLICITUD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDTIPOABONO=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDACTIVIDAD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NOMBREPRECIO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DESCRIPCIONPRECIO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PRECIO=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_FECHAALTA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHABAJA=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_IDPRECIO=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_IDTIPOSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_IDTIPOABONO=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_IDACTIVIDAD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_NOMBREPRECIO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_DESCRIPCIONPRECIO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_PRECIO=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,true),
		self::FIELD_FECHAALTA=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true),
		self::FIELD_FECHABAJA=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_IDPRECIO=>null,
		self::FIELD_IDTIPOSOLICITUD=>null,
		self::FIELD_IDTIPOABONO=>null,
		self::FIELD_IDACTIVIDAD=>null,
		self::FIELD_NOMBREPRECIO=>null,
		self::FIELD_DESCRIPCIONPRECIO=>null,
		self::FIELD_PRECIO=>null,
		self::FIELD_FECHAALTA=>null,
		self::FIELD_FECHABAJA=>null);
	private $idPrecio;
	private $idTipoSolicitud;
	private $idTipoAbono;
	private $idActividad;
	private $NombrePrecio;
	private $DescripcionPrecio;
	private $Precio;
	private $FechaAlta;
	private $FechaBaja;

	/**
	 * set value for idPrecio 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $idPrecio
	 * @return PrecioModel
	 */
	public function &setIdPrecio($idPrecio) {
		$this->notifyChanged(self::FIELD_IDPRECIO,$this->idPrecio,$idPrecio);
		$this->idPrecio=$idPrecio;
		return $this;
	}

	/**
	 * get value for idPrecio 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getIdPrecio() {
		return $this->idPrecio;
	}

	/**
	 * set value for idTipoSolicitud 
	 *
	 * type:INT,size:10,default:null,unique,nullable
	 *
	 * @param mixed $idTipoSolicitud
	 * @return PrecioModel
	 */
	public function &setIdTipoSolicitud($idTipoSolicitud) {
		$this->notifyChanged(self::FIELD_IDTIPOSOLICITUD,$this->idTipoSolicitud,$idTipoSolicitud);
		$this->idTipoSolicitud=$idTipoSolicitud;
		return $this;
	}

	/**
	 * get value for idTipoSolicitud 
	 *
	 * type:INT,size:10,default:null,unique,nullable
	 *
	 * @return mixed
	 */
	public function getIdTipoSolicitud() {
		return $this->idTipoSolicitud;
	}

	/**
	 * set value for idTipoAbono 
	 *
	 * type:INT,size:10,default:null,unique,nullable
	 *
	 * @param mixed $idTipoAbono
	 * @return PrecioModel
	 */
	public function &setIdTipoAbono($idTipoAbono) {
		$this->notifyChanged(self::FIELD_IDTIPOABONO,$this->idTipoAbono,$idTipoAbono);
		$this->idTipoAbono=$idTipoAbono;
		return $this;
	}

	/**
	 * get value for idTipoAbono 
	 *
	 * type:INT,size:10,default:null,unique,nullable
	 *
	 * @return mixed
	 */
	public function getIdTipoAbono() {
		return $this->idTipoAbono;
	}

	/**
	 * set value for idActividad 
	 *
	 * type:INT,size:10,default:null,unique,nullable
	 *
	 * @param mixed $idActividad
	 * @return PrecioModel
	 */
	public function &setIdActividad($idActividad) {
		$this->notifyChanged(self::FIELD_IDACTIVIDAD,$this->idActividad,$idActividad);
		$this->idActividad=$idActividad;
		return $this;
	}

	/**
	 * get value for idActividad 
	 *
	 * type:INT,size:10,default:null,unique,nullable
	 *
	 * @return mixed
	 */
	public function getIdActividad() {
		return $this->idActividad;
	}

	/**
	 * set value for NombrePrecio 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $NombrePrecio
	 * @return PrecioModel
	 */
	public function &setNombrePrecio($NombrePrecio) {
		$this->notifyChanged(self::FIELD_NOMBREPRECIO,$this->NombrePrecio,$NombrePrecio);
		$this->NombrePrecio=$NombrePrecio;
		return $this;
	}

	/**
	 * get value for NombrePrecio 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getNombrePrecio() {
		return $this->NombrePrecio;
	}

	/**
	 * set value for DescripcionPrecio 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $DescripcionPrecio
	 * @return PrecioModel
	 */
	public function &setDescripcionPrecio($DescripcionPrecio) {
		$this->notifyChanged(self::FIELD_DESCRIPCIONPRECIO,$this->DescripcionPrecio,$DescripcionPrecio);
		$this->DescripcionPrecio=$DescripcionPrecio;
		return $this;
	}

	/**
	 * get value for DescripcionPrecio 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDescripcionPrecio() {
		return $this->DescripcionPrecio;
	}

	/**
	 * set value for Precio 
	 *
	 * type:FLOAT,size:12,default:null,nullable
	 *
	 * @param mixed $Precio
	 * @return PrecioModel
	 */
	public function &setPrecio($Precio) {
		$this->notifyChanged(self::FIELD_PRECIO,$this->Precio,$Precio);
		$this->Precio=$Precio;
		return $this;
	}

	/**
	 * get value for Precio 
	 *
	 * type:FLOAT,size:12,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPrecio() {
		return $this->Precio;
	}

	/**
	 * set value for FechaAlta 
	 *
	 * type:TIMESTAMP,size:19,default:null,nullable
	 *
	 * @param mixed $FechaAlta
	 * @return PrecioModel
	 */
	public function &setFechaAlta($FechaAlta) {
		$this->notifyChanged(self::FIELD_FECHAALTA,$this->FechaAlta,$FechaAlta);
		$this->FechaAlta=$FechaAlta;
		return $this;
	}

	/**
	 * get value for FechaAlta 
	 *
	 * type:TIMESTAMP,size:19,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFechaAlta() {
		return $this->FechaAlta;
	}

	/**
	 * set value for FechaBaja 
	 *
	 * type:TIMESTAMP,size:19,default:null,nullable
	 *
	 * @param mixed $FechaBaja
	 * @return PrecioModel
	 */
	public function &setFechaBaja($FechaBaja) {
		$this->notifyChanged(self::FIELD_FECHABAJA,$this->FechaBaja,$FechaBaja);
		$this->FechaBaja=$FechaBaja;
		return $this;
	}

	/**
	 * get value for FechaBaja 
	 *
	 * type:TIMESTAMP,size:19,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFechaBaja() {
		return $this->FechaBaja;
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
			self::FIELD_IDPRECIO=>$this->getIdPrecio(),
			self::FIELD_IDTIPOSOLICITUD=>$this->getIdTipoSolicitud(),
			self::FIELD_IDTIPOABONO=>$this->getIdTipoAbono(),
			self::FIELD_IDACTIVIDAD=>$this->getIdActividad(),
			self::FIELD_NOMBREPRECIO=>$this->getNombrePrecio(),
			self::FIELD_DESCRIPCIONPRECIO=>$this->getDescripcionPrecio(),
			self::FIELD_PRECIO=>$this->getPrecio(),
			self::FIELD_FECHAALTA=>$this->getFechaAlta(),
			self::FIELD_FECHABAJA=>$this->getFechaBaja());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_IDPRECIO=>$this->getIdPrecio());
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
	 * Match by attributes of passed example instance and return matched rows as an array of PrecioModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param PrecioModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PrecioModel[]
	 */
	public static function findByExample(PDO $db,PrecioModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of PrecioModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PrecioModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `precio`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of PrecioModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return PrecioModel[]
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
	 * returns the result as an array of PrecioModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return PrecioModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new PrecioModel();
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
	 * Execute select query and return matched rows as an array of PrecioModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return PrecioModel[]
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
		$sql='DELETE FROM `precio`'
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
		$this->setIdPrecio($result['idPrecio']);
		$this->setIdTipoSolicitud($result['idTipoSolicitud']);
		$this->setIdTipoAbono($result['idTipoAbono']);
		$this->setIdActividad($result['idActividad']);
		$this->setNombrePrecio($result['NombrePrecio']);
		$this->setDescripcionPrecio($result['DescripcionPrecio']);
		$this->setPrecio($result['Precio']);
		$this->setFechaAlta($result['FechaAlta']);
		$this->setFechaBaja($result['FechaBaja']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return PrecioModel
	 */
	public static function findById(PDO $db,$idPrecio) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$idPrecio);
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
		$o=new PrecioModel();
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
		$stmt->bindValue(1,$this->getIdPrecio());
		$stmt->bindValue(2,$this->getIdTipoSolicitud());
		$stmt->bindValue(3,$this->getIdTipoAbono());
		$stmt->bindValue(4,$this->getIdActividad());
		$stmt->bindValue(5,$this->getNombrePrecio());
		$stmt->bindValue(6,$this->getDescripcionPrecio());
		$stmt->bindValue(7,$this->getPrecio());
		$stmt->bindValue(8,$this->getFechaAlta());
		$stmt->bindValue(9,$this->getFechaBaja());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getIdPrecio()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getIdTipoSolicitud());
			$stmt->bindValue(2,$this->getIdTipoAbono());
			$stmt->bindValue(3,$this->getIdActividad());
			$stmt->bindValue(4,$this->getNombrePrecio());
			$stmt->bindValue(5,$this->getDescripcionPrecio());
			$stmt->bindValue(6,$this->getPrecio());
			$stmt->bindValue(7,$this->getFechaAlta());
			$stmt->bindValue(8,$this->getFechaBaja());
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
			$this->setIdPrecio($lastInsertId);
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
		$stmt->bindValue(10,$this->getIdPrecio());
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
		$stmt->bindValue(1,$this->getIdPrecio());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch TiposolicitudModel which references this PrecioModel. Will return null in case reference is invalid.
	 * `precio`.`idTipoSolicitud` -> `tiposolicitud`.`idTipoSolicitud`
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
	 * Fetch TipoabonoModel which references this PrecioModel. Will return null in case reference is invalid.
	 * `precio`.`idTipoAbono` -> `tipoabono`.`idTipoAbono`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TipoabonoModel
	 */
	public function fetchTipoabonoModel(PDO $db, $sort=null) {
		$filter=array(TipoabonoModel::FIELD_IDTIPOABONO=>$this->getIdTipoAbono());
		$result=TipoabonoModel::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch ActividadModel which references this PrecioModel. Will return null in case reference is invalid.
	 * `precio`.`idActividad` -> `actividad`.`idActividad`
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'PrecioModel');
	}

	/**
	 * get single PrecioModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return PrecioModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new PrecioModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of PrecioModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return PrecioModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('PrecioModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>