<?php

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
class DatosolicitudabonomensualModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='DatosolicitudabonomensualModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='datosolicitudabonomensual';
	const SQL_INSERT='INSERT INTO `datosolicitudabonomensual` (`idDatosSolicitudAbonoMensual`,`idSolicitud`,`idTipoAbono`,`PrecioPagado`,`FechaInicio`,`FechaFin`) VALUES (?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `datosolicitudabonomensual` (`idSolicitud`,`idTipoAbono`,`PrecioPagado`,`FechaInicio`,`FechaFin`) VALUES (?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `datosolicitudabonomensual` SET `idDatosSolicitudAbonoMensual`=?,`idSolicitud`=?,`idTipoAbono`=?,`PrecioPagado`=?,`FechaInicio`=?,`FechaFin`=? WHERE `idDatosSolicitudAbonoMensual`=?';
	const SQL_SELECT_PK='SELECT * FROM `datosolicitudabonomensual` WHERE `idDatosSolicitudAbonoMensual`=?';
	const SQL_DELETE_PK='DELETE FROM `datosolicitudabonomensual` WHERE `idDatosSolicitudAbonoMensual`=?';
	const FIELD_IDDATOSSOLICITUDABONOMENSUAL=838948966;
	const FIELD_IDSOLICITUD=801296923;
	const FIELD_IDTIPOABONO=817091410;
	const FIELD_PRECIOPAGADO=1267968842;
	const FIELD_FECHAINICIO=-1174295948;
	const FIELD_FECHAFIN=-1822350756;
	private static $PRIMARY_KEYS=array(self::FIELD_IDDATOSSOLICITUDABONOMENSUAL);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_IDDATOSSOLICITUDABONOMENSUAL);
	private static $FIELD_NAMES=array(
		self::FIELD_IDDATOSSOLICITUDABONOMENSUAL=>'idDatosSolicitudAbonoMensual',
		self::FIELD_IDSOLICITUD=>'idSolicitud',
		self::FIELD_IDTIPOABONO=>'idTipoAbono',
		self::FIELD_PRECIOPAGADO=>'PrecioPagado',
		self::FIELD_FECHAINICIO=>'FechaInicio',
		self::FIELD_FECHAFIN=>'FechaFin');
	private static $PROPERTY_NAMES=array(
		self::FIELD_IDDATOSSOLICITUDABONOMENSUAL=>'idDatosSolicitudAbonoMensual',
		self::FIELD_IDSOLICITUD=>'idSolicitud',
		self::FIELD_IDTIPOABONO=>'idTipoAbono',
		self::FIELD_PRECIOPAGADO=>'PrecioPagado',
		self::FIELD_FECHAINICIO=>'FechaInicio',
		self::FIELD_FECHAFIN=>'FechaFin');
	private static $PROPERTY_TYPES=array(
		self::FIELD_IDDATOSSOLICITUDABONOMENSUAL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDSOLICITUD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDTIPOABONO=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PRECIOPAGADO=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_FECHAINICIO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHAFIN=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_IDDATOSSOLICITUDABONOMENSUAL=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_IDSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_IDTIPOABONO=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_PRECIOPAGADO=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,true),
		self::FIELD_FECHAINICIO=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,true),
		self::FIELD_FECHAFIN=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_IDDATOSSOLICITUDABONOMENSUAL=>null,
		self::FIELD_IDSOLICITUD=>null,
		self::FIELD_IDTIPOABONO=>null,
		self::FIELD_PRECIOPAGADO=>null,
		self::FIELD_FECHAINICIO=>null,
		self::FIELD_FECHAFIN=>null);
	private $idDatosSolicitudAbonoMensual;
	private $idSolicitud;
	private $idTipoAbono;
	private $PrecioPagado;
	private $FechaInicio;
	private $FechaFin;

	/**
	 * set value for idDatosSolicitudAbonoMensual 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $idDatosSolicitudAbonoMensual
	 * @return DatosolicitudabonomensualModel
	 */
	public function &setIdDatosSolicitudAbonoMensual($idDatosSolicitudAbonoMensual) {
		$this->notifyChanged(self::FIELD_IDDATOSSOLICITUDABONOMENSUAL,$this->idDatosSolicitudAbonoMensual,$idDatosSolicitudAbonoMensual);
		$this->idDatosSolicitudAbonoMensual=$idDatosSolicitudAbonoMensual;
		return $this;
	}

	/**
	 * get value for idDatosSolicitudAbonoMensual 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getIdDatosSolicitudAbonoMensual() {
		return $this->idDatosSolicitudAbonoMensual;
	}

	/**
	 * set value for idSolicitud 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $idSolicitud
	 * @return DatosolicitudabonomensualModel
	 */
	public function &setIdSolicitud($idSolicitud) {
		$this->notifyChanged(self::FIELD_IDSOLICITUD,$this->idSolicitud,$idSolicitud);
		$this->idSolicitud=$idSolicitud;
		return $this;
	}

	/**
	 * get value for idSolicitud 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getIdSolicitud() {
		return $this->idSolicitud;
	}

	/**
	 * set value for idTipoAbono 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $idTipoAbono
	 * @return DatosolicitudabonomensualModel
	 */
	public function &setIdTipoAbono($idTipoAbono) {
		$this->notifyChanged(self::FIELD_IDTIPOABONO,$this->idTipoAbono,$idTipoAbono);
		$this->idTipoAbono=$idTipoAbono;
		return $this;
	}

	/**
	 * get value for idTipoAbono 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getIdTipoAbono() {
		return $this->idTipoAbono;
	}

	/**
	 * set value for PrecioPagado 
	 *
	 * type:FLOAT,size:12,default:null,nullable
	 *
	 * @param mixed $PrecioPagado
	 * @return DatosolicitudabonomensualModel
	 */
	public function &setPrecioPagado($PrecioPagado) {
		$this->notifyChanged(self::FIELD_PRECIOPAGADO,$this->PrecioPagado,$PrecioPagado);
		$this->PrecioPagado=$PrecioPagado;
		return $this;
	}

	/**
	 * get value for PrecioPagado 
	 *
	 * type:FLOAT,size:12,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPrecioPagado() {
		return $this->PrecioPagado;
	}

	/**
	 * set value for FechaInicio 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @param mixed $FechaInicio
	 * @return DatosolicitudabonomensualModel
	 */
	public function &setFechaInicio($FechaInicio) {
		$this->notifyChanged(self::FIELD_FECHAINICIO,$this->FechaInicio,$FechaInicio);
		$this->FechaInicio=$FechaInicio;
		return $this;
	}

	/**
	 * get value for FechaInicio 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFechaInicio() {
		return $this->FechaInicio;
	}

	/**
	 * set value for FechaFin 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @param mixed $FechaFin
	 * @return DatosolicitudabonomensualModel
	 */
	public function &setFechaFin($FechaFin) {
		$this->notifyChanged(self::FIELD_FECHAFIN,$this->FechaFin,$FechaFin);
		$this->FechaFin=$FechaFin;
		return $this;
	}

	/**
	 * get value for FechaFin 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFechaFin() {
		return $this->FechaFin;
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
			self::FIELD_IDDATOSSOLICITUDABONOMENSUAL=>$this->getIdDatosSolicitudAbonoMensual(),
			self::FIELD_IDSOLICITUD=>$this->getIdSolicitud(),
			self::FIELD_IDTIPOABONO=>$this->getIdTipoAbono(),
			self::FIELD_PRECIOPAGADO=>$this->getPrecioPagado(),
			self::FIELD_FECHAINICIO=>$this->getFechaInicio(),
			self::FIELD_FECHAFIN=>$this->getFechaFin());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_IDDATOSSOLICITUDABONOMENSUAL=>$this->getIdDatosSolicitudAbonoMensual());
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
	 * Match by attributes of passed example instance and return matched rows as an array of DatosolicitudabonomensualModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param DatosolicitudabonomensualModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return DatosolicitudabonomensualModel[]
	 */
	public static function findByExample(PDO $db,DatosolicitudabonomensualModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of DatosolicitudabonomensualModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return DatosolicitudabonomensualModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `datosolicitudabonomensual`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of DatosolicitudabonomensualModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return DatosolicitudabonomensualModel[]
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
	 * returns the result as an array of DatosolicitudabonomensualModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return DatosolicitudabonomensualModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new DatosolicitudabonomensualModel();
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
	 * Execute select query and return matched rows as an array of DatosolicitudabonomensualModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return DatosolicitudabonomensualModel[]
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
		$sql='DELETE FROM `datosolicitudabonomensual`'
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
		$this->setIdDatosSolicitudAbonoMensual($result['idDatosSolicitudAbonoMensual']);
		$this->setIdSolicitud($result['idSolicitud']);
		$this->setIdTipoAbono($result['idTipoAbono']);
		$this->setPrecioPagado($result['PrecioPagado']);
		$this->setFechaInicio($result['FechaInicio']);
		$this->setFechaFin($result['FechaFin']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return DatosolicitudabonomensualModel
	 */
	public static function findById(PDO $db,$idDatosSolicitudAbonoMensual) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$idDatosSolicitudAbonoMensual);
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
		$o=new DatosolicitudabonomensualModel();
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
		$stmt->bindValue(1,$this->getIdDatosSolicitudAbonoMensual());
		$stmt->bindValue(2,$this->getIdSolicitud());
		$stmt->bindValue(3,$this->getIdTipoAbono());
		$stmt->bindValue(4,$this->getPrecioPagado());
		$stmt->bindValue(5,$this->getFechaInicio());
		$stmt->bindValue(6,$this->getFechaFin());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getIdDatosSolicitudAbonoMensual()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getIdSolicitud());
			$stmt->bindValue(2,$this->getIdTipoAbono());
			$stmt->bindValue(3,$this->getPrecioPagado());
			$stmt->bindValue(4,$this->getFechaInicio());
			$stmt->bindValue(5,$this->getFechaFin());
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
			$this->setIdDatosSolicitudAbonoMensual($lastInsertId);
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
		$stmt->bindValue(7,$this->getIdDatosSolicitudAbonoMensual());
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
		$stmt->bindValue(1,$this->getIdDatosSolicitudAbonoMensual());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch SolicitudModel which references this DatosolicitudabonomensualModel. Will return null in case reference is invalid.
	 * `datosolicitudabonomensual`.`idSolicitud` -> `solicitud`.`idSolicitud`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SolicitudModel
	 */
	public function fetchSolicitudModel(PDO $db, $sort=null) {
		$filter=array(SolicitudModel::FIELD_IDSOLICITUD=>$this->getIdSolicitud());
		$result=SolicitudModel::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch TipoabonoModel which references this DatosolicitudabonomensualModel. Will return null in case reference is invalid.
	 * `datosolicitudabonomensual`.`idTipoAbono` -> `tipoabono`.`idTipoAbono`
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'DatosolicitudabonomensualModel');
	}

	/**
	 * get single DatosolicitudabonomensualModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return DatosolicitudabonomensualModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new DatosolicitudabonomensualModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of DatosolicitudabonomensualModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return DatosolicitudabonomensualModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('DatosolicitudabonomensualModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>