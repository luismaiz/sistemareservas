<?php

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
class TiposolicitudModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='TiposolicitudModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='tiposolicitud';
	const SQL_INSERT='INSERT INTO `tiposolicitud` (`idTipoSolicitud`,`NombreSolicitud`,`DescripcionSolicitud`,`FechaAlta`,`FechaBaja`) VALUES (?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `tiposolicitud` (`NombreSolicitud`,`DescripcionSolicitud`,`FechaAlta`,`FechaBaja`) VALUES (?,?,?,?)';
	const SQL_UPDATE='UPDATE `tiposolicitud` SET `idTipoSolicitud`=?,`NombreSolicitud`=?,`DescripcionSolicitud`=?,`FechaAlta`=?,`FechaBaja`=? WHERE `idTipoSolicitud`=?';
	const SQL_SELECT_PK='SELECT * FROM `tiposolicitud` WHERE `idTipoSolicitud`=?';
	const SQL_DELETE_PK='DELETE FROM `tiposolicitud` WHERE `idTipoSolicitud`=?';
	const FIELD_IDTIPOSOLICITUD=686305399;
	const FIELD_NOMBRESOLICITUD=388414653;
	const FIELD_DESCRIPCIONSOLICITUD=2062764245;
	const FIELD_FECHAALTA=-1524597161;
	const FIELD_FECHABAJA=-1524578251;
	private static $PRIMARY_KEYS=array(self::FIELD_IDTIPOSOLICITUD);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_IDTIPOSOLICITUD);
	private static $FIELD_NAMES=array(
		self::FIELD_IDTIPOSOLICITUD=>'idTipoSolicitud',
		self::FIELD_NOMBRESOLICITUD=>'NombreSolicitud',
		self::FIELD_DESCRIPCIONSOLICITUD=>'DescripcionSolicitud',
		self::FIELD_FECHAALTA=>'FechaAlta',
		self::FIELD_FECHABAJA=>'FechaBaja');
	private static $PROPERTY_NAMES=array(
		self::FIELD_IDTIPOSOLICITUD=>'idTipoSolicitud',
		self::FIELD_NOMBRESOLICITUD=>'NombreSolicitud',
		self::FIELD_DESCRIPCIONSOLICITUD=>'DescripcionSolicitud',
		self::FIELD_FECHAALTA=>'FechaAlta',
		self::FIELD_FECHABAJA=>'FechaBaja');
	private static $PROPERTY_TYPES=array(
		self::FIELD_IDTIPOSOLICITUD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NOMBRESOLICITUD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DESCRIPCIONSOLICITUD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHAALTA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHABAJA=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_IDTIPOSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NOMBRESOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_DESCRIPCIONSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_FECHAALTA=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true),
		self::FIELD_FECHABAJA=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_IDTIPOSOLICITUD=>null,
		self::FIELD_NOMBRESOLICITUD=>null,
		self::FIELD_DESCRIPCIONSOLICITUD=>null,
		self::FIELD_FECHAALTA=>null,
		self::FIELD_FECHABAJA=>null);
	private $idTipoSolicitud;
	private $NombreSolicitud;
	private $DescripcionSolicitud;
	private $FechaAlta;
	private $FechaBaja;

	/**
	 * set value for idTipoSolicitud 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $idTipoSolicitud
	 * @return TiposolicitudModel
	 */
	public function &setIdTipoSolicitud($idTipoSolicitud) {
		$this->notifyChanged(self::FIELD_IDTIPOSOLICITUD,$this->idTipoSolicitud,$idTipoSolicitud);
		$this->idTipoSolicitud=$idTipoSolicitud;
		return $this;
	}

	/**
	 * get value for idTipoSolicitud 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getIdTipoSolicitud() {
		return $this->idTipoSolicitud;
	}

	/**
	 * set value for NombreSolicitud 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $NombreSolicitud
	 * @return TiposolicitudModel
	 */
	public function &setNombreSolicitud($NombreSolicitud) {
		$this->notifyChanged(self::FIELD_NOMBRESOLICITUD,$this->NombreSolicitud,$NombreSolicitud);
		$this->NombreSolicitud=$NombreSolicitud;
		return $this;
	}

	/**
	 * get value for NombreSolicitud 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getNombreSolicitud() {
		return $this->NombreSolicitud;
	}

	/**
	 * set value for DescripcionSolicitud 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $DescripcionSolicitud
	 * @return TiposolicitudModel
	 */
	public function &setDescripcionSolicitud($DescripcionSolicitud) {
		$this->notifyChanged(self::FIELD_DESCRIPCIONSOLICITUD,$this->DescripcionSolicitud,$DescripcionSolicitud);
		$this->DescripcionSolicitud=$DescripcionSolicitud;
		return $this;
	}

	/**
	 * get value for DescripcionSolicitud 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDescripcionSolicitud() {
		return $this->DescripcionSolicitud;
	}

	/**
	 * set value for FechaAlta 
	 *
	 * type:TIMESTAMP,size:19,default:null,nullable
	 *
	 * @param mixed $FechaAlta
	 * @return TiposolicitudModel
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
	 * @return TiposolicitudModel
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
			self::FIELD_IDTIPOSOLICITUD=>$this->getIdTipoSolicitud(),
			self::FIELD_NOMBRESOLICITUD=>$this->getNombreSolicitud(),
			self::FIELD_DESCRIPCIONSOLICITUD=>$this->getDescripcionSolicitud(),
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
			self::FIELD_IDTIPOSOLICITUD=>$this->getIdTipoSolicitud());
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
	 * Match by attributes of passed example instance and return matched rows as an array of TiposolicitudModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param TiposolicitudModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return TiposolicitudModel[]
	 */
	public static function findByExample(PDO $db,TiposolicitudModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of TiposolicitudModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return TiposolicitudModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `tiposolicitud`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of TiposolicitudModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return TiposolicitudModel[]
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
	 * returns the result as an array of TiposolicitudModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return TiposolicitudModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new TiposolicitudModel();
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
	 * Execute select query and return matched rows as an array of TiposolicitudModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return TiposolicitudModel[]
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
		$sql='DELETE FROM `tiposolicitud`'
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
		$this->setIdTipoSolicitud($result['idTipoSolicitud']);
		$this->setNombreSolicitud($result['NombreSolicitud']);
		$this->setDescripcionSolicitud($result['DescripcionSolicitud']);
		$this->setFechaAlta($result['FechaAlta']);
		$this->setFechaBaja($result['FechaBaja']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return TiposolicitudModel
	 */
	public static function findById(PDO $db,$idTipoSolicitud) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$idTipoSolicitud);
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
		$o=new TiposolicitudModel();
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
		$stmt->bindValue(1,$this->getIdTipoSolicitud());
		$stmt->bindValue(2,$this->getNombreSolicitud());
		$stmt->bindValue(3,$this->getDescripcionSolicitud());
		$stmt->bindValue(4,$this->getFechaAlta());
		$stmt->bindValue(5,$this->getFechaBaja());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getIdTipoSolicitud()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getNombreSolicitud());
			$stmt->bindValue(2,$this->getDescripcionSolicitud());
			$stmt->bindValue(3,$this->getFechaAlta());
			$stmt->bindValue(4,$this->getFechaBaja());
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
			$this->setIdTipoSolicitud($lastInsertId);
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
		$stmt->bindValue(6,$this->getIdTipoSolicitud());
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
		$stmt->bindValue(1,$this->getIdTipoSolicitud());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch PrecioModel's which this TiposolicitudModel references.
	 * `tiposolicitud`.`idTipoSolicitud` -> `precio`.`idTipoSolicitud`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PrecioModel[]
	 */
	public function fetchPrecioModelCollection(PDO $db, $sort=null) {
		$filter=array(PrecioModel::FIELD_IDTIPOSOLICITUD=>$this->getIdTipoSolicitud());
		return PrecioModel::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch SolicitudModel's which this TiposolicitudModel references.
	 * `tiposolicitud`.`idTipoSolicitud` -> `solicitud`.`idTipoSolicitud`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SolicitudModel[]
	 */
	public function fetchSolicitudModelCollection(PDO $db, $sort=null) {
		$filter=array(SolicitudModel::FIELD_IDTIPOSOLICITUD=>$this->getIdTipoSolicitud());
		return SolicitudModel::findByFilter($db, $filter, true, $sort);
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'TiposolicitudModel');
	}

	/**
	 * get single TiposolicitudModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return TiposolicitudModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new TiposolicitudModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of TiposolicitudModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return TiposolicitudModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('TiposolicitudModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>