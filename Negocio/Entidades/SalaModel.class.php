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
class SalaModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='SalaModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='sala';
	const SQL_INSERT='INSERT INTO `sala` (`idSala`,`NombreSala`,`CapacidadSala`,`DescripcionSala`,`FechaAlta`,`FechaBaja`) VALUES (?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `sala` (`NombreSala`,`CapacidadSala`,`DescripcionSala`,`FechaAlta`,`FechaBaja`) VALUES (?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `sala` SET `idSala`=?,`NombreSala`=?,`CapacidadSala`=?,`DescripcionSala`=?,`FechaAlta`=?,`FechaBaja`=? WHERE `idSala`=?';
	const SQL_SELECT_PK='SELECT * FROM SALA WHERE IDSALA=?';
        const SQL_SELECT='SELECT * FROM SALA';
	const SQL_DELETE_PK='DELETE FROM `sala` WHERE `idSala`=?';
	const FIELD_IDSALA=-1779113975;
	const FIELD_NOMBRESALA=949418583;
	const FIELD_CAPACIDADSALA=-86431542;
	const FIELD_DESCRIPCIONSALA=448909253;
	const FIELD_FECHAALTA=395767018;
	const FIELD_FECHABAJA=395785928;
	private static $PRIMARY_KEYS=array(self::FIELD_IDSALA);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_IDSALA);
	private static $FIELD_NAMES=array(
		self::FIELD_IDSALA=>'idSala',
		self::FIELD_NOMBRESALA=>'NombreSala',
		self::FIELD_CAPACIDADSALA=>'CapacidadSala',
		self::FIELD_DESCRIPCIONSALA=>'DescripcionSala',
		self::FIELD_FECHAALTA=>'FechaAlta',
		self::FIELD_FECHABAJA=>'FechaBaja');
	private static $PROPERTY_NAMES=array(
		self::FIELD_IDSALA=>'idSala',
		self::FIELD_NOMBRESALA=>'NombreSala',
		self::FIELD_CAPACIDADSALA=>'CapacidadSala',
		self::FIELD_DESCRIPCIONSALA=>'DescripcionSala',
		self::FIELD_FECHAALTA=>'FechaAlta',
		self::FIELD_FECHABAJA=>'FechaBaja');
	private static $PROPERTY_TYPES=array(
		self::FIELD_IDSALA=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NOMBRESALA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CAPACIDADSALA=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DESCRIPCIONSALA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHAALTA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FECHABAJA=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_IDSALA=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NOMBRESALA=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_CAPACIDADSALA=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_DESCRIPCIONSALA=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,true),
		self::FIELD_FECHAALTA=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false),
		self::FIELD_FECHABAJA=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_IDSALA=>null,
		self::FIELD_NOMBRESALA=>null,
		self::FIELD_CAPACIDADSALA=>null,
		self::FIELD_DESCRIPCIONSALA=>null,
		self::FIELD_FECHAALTA=>'',
		self::FIELD_FECHABAJA=>'');
	private $idSala;
	private $NombreSala;
	private $CapacidadSala;
	private $DescripcionSala;
	private $FechaAlta;
	private $FechaBaja;

	/**
	 * set value for idSala 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $idSala
	 * @return SalaModel
	 */
	public function &setIdSala($idSala) {
		$this->notifyChanged(self::FIELD_IDSALA,$this->idSala,$idSala);
		$this->idSala=$idSala;
		return $this;
	}

	/**
	 * get value for idSala 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getIdSala() {
		return $this->idSala;
	}

	/**
	 * set value for NombreSala 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $NombreSala
	 * @return SalaModel
	 */
	public function &setNombreSala($NombreSala) {
		$this->notifyChanged(self::FIELD_NOMBRESALA,$this->NombreSala,$NombreSala);
		$this->NombreSala=$NombreSala;
		return $this;
	}

	/**
	 * get value for NombreSala 
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getNombreSala() {
		return $this->NombreSala;
	}

	/**
	 * set value for CapacidadSala 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $CapacidadSala
	 * @return SalaModel
	 */
	public function &setCapacidadSala($CapacidadSala) {
		$this->notifyChanged(self::FIELD_CAPACIDADSALA,$this->CapacidadSala,$CapacidadSala);
		$this->CapacidadSala=$CapacidadSala;
		return $this;
	}

	/**
	 * get value for CapacidadSala 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCapacidadSala() {
		return $this->CapacidadSala;
	}

	/**
	 * set value for DescripcionSala 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @param mixed $DescripcionSala
	 * @return SalaModel
	 */
	public function &setDescripcionSala($DescripcionSala) {
		$this->notifyChanged(self::FIELD_DESCRIPCIONSALA,$this->DescripcionSala,$DescripcionSala);
		$this->DescripcionSala=$DescripcionSala;
		return $this;
	}

	/**
	 * get value for DescripcionSala 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDescripcionSala() {
		return $this->DescripcionSala;
	}

	/**
	 * set value for FechaAlta 
	 *
	 * type:DATE,size:10,default:null
	 *
	 * @param mixed $FechaAlta
	 * @return SalaModel
	 */
	public function &setFechaAlta($FechaAlta) {
		$this->notifyChanged(self::FIELD_FECHAALTA,$this->FechaAlta,$FechaAlta);
		$this->FechaAlta=$FechaAlta;
		return $this;
	}

	/**
	 * get value for FechaAlta 
	 *
	 * type:DATE,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getFechaAlta() {
		return $this->FechaAlta;
	}

	/**
	 * set value for FechaBaja 
	 *
	 * type:DATE,size:10,default:null
	 *
	 * @param mixed $FechaBaja
	 * @return SalaModel
	 */
	public function &setFechaBaja($FechaBaja) {
		$this->notifyChanged(self::FIELD_FECHABAJA,$this->FechaBaja,$FechaBaja);
		$this->FechaBaja=$FechaBaja;
		return $this;
	}

	/**
	 * get value for FechaBaja 
	 *
	 * type:DATE,size:10,default:null
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
			self::FIELD_IDSALA=>$this->getIdSala(),
			self::FIELD_NOMBRESALA=>$this->getNombreSala(),
			self::FIELD_CAPACIDADSALA=>$this->getCapacidadSala(),
			self::FIELD_DESCRIPCIONSALA=>$this->getDescripcionSala(),
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
			self::FIELD_IDSALA=>$this->getIdSala());
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
//                                if (null===self::$stmts[$statement][$dbInstanceId]) {
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
	 * Match by attributes of passed example instance and return matched rows as an array of SalaModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param SalaModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SalaModel[]
	 */
	public static function findByExample(PDO $db,SalaModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of SalaModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SalaModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `sala`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of SalaModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return SalaModel[]
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
	 * returns the result as an array of SalaModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return SalaModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new SalaModel();
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
	 * Execute select query and return matched rows as an array of SalaModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return SalaModel[]
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
		$sql='DELETE FROM `sala`'
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
		$this->setIdSala($result['idSala']);
		$this->setNombreSala($result['NombreSala']);
		$this->setCapacidadSala($result['CapacidadSala']);
		$this->setDescripcionSala($result['DescripcionSala']);
		$this->setFechaAlta($result['FechaAlta']);
		$this->setFechaBaja($result['FechaBaja']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return SalaModel
	 */
	public static function findById(PDO $db,$idSala) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
                $stmt->bindValue(1,$idSala);
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
		$o=new SalaModel();
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
		$stmt->bindValue(1,$this->getIdSala());
		$stmt->bindValue(2,$this->getNombreSala());
		$stmt->bindValue(3,$this->getCapacidadSala());
		$stmt->bindValue(4,$this->getDescripcionSala());
		$stmt->bindValue(5,$this->getFechaAlta());
		$stmt->bindValue(6,$this->getFechaBaja());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
            
		if (null===$this->getIdSala()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getNombreSala());
			$stmt->bindValue(2,$this->getCapacidadSala());
			$stmt->bindValue(3,$this->getDescripcionSala());
			$stmt->bindValue(4,$this->getFechaAlta());
			$stmt->bindValue(5,$this->getFechaBaja());
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
			$this->setIdSala($lastInsertId);
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
		$stmt->bindValue(7,$this->getIdSala());
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
		$stmt->bindValue(1,$this->getIdSala());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch ClaseModel's which this SalaModel references.
	 * `sala`.`idSala` -> `clase`.`idSala`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return ClaseModel[]
	 */
	public function fetchClaseModelCollection(PDO $db, $sort=null) {
		$filter=array(ClaseModel::FIELD_IDSALA=>$this->getIdSala());
		return ClaseModel::findByFilter($db, $filter, true, $sort);
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'SalaModel');
	}

	/**
	 * get single SalaModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return SalaModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new SalaModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of SalaModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return SalaModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('SalaModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>