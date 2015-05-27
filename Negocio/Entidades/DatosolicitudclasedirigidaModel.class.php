<?php
require_once("helpers/Db2PhpEntityBase.class.php");
require_once("helpers/Db2PhpEntityModificationTracking.class.php");
require_once 'helpers/DFCAggregate.class.php';
class DatosolicitudclasedirigidaModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='DatosolicitudclasedirigidaModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='datosolicitudclasedirigida';
	const SQL_INSERT='INSERT INTO `datosolicitudclasedirigida` (`idDatosSolicitudClaseDirigida`,`idSolicitud`,`Titular`,`IBAN`,`Entidad`,`Oficina`,`DigitoControl`,`Cuenta`) VALUES (?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `datosolicitudclasedirigida` (`idSolicitud`,`Titular`,`IBAN`,`Entidad`,`Oficina`,`DigitoControl`,`Cuenta`) VALUES (?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `datosolicitudclasedirigida` SET `idDatosSolicitudClaseDirigida`=?,`idSolicitud`=?,`Titular`=?,`IBAN`=?,`Entidad`=?,`Oficina`=?,`DigitoControl`=?,`Cuenta`=? WHERE `idDatosSolicitudClaseDirigida`=?';
	const SQL_SELECT_PK='SELECT * FROM `datosolicitudclasedirigida` WHERE `idDatosSolicitudClaseDirigida`=?';
	const SQL_DELETE_PK='DELETE FROM `datosolicitudclasedirigida` WHERE `idDatosSolicitudClaseDirigida`=?';
	const FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=-890942132;
	const FIELD_IDSOLICITUD=-1396452684;
	const FIELD_TITULAR=-960535950;
	const FIELD_IBAN=1780964987;
	const FIELD_ENTIDAD=-1245408716;
	const FIELD_OFICINA=-1199671978;
	const FIELD_DIGITOCONTROL=-1621949914;
	const FIELD_CUENTA=1986800285;
	private static $PRIMARY_KEYS=array(self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA);
	private static $FIELD_NAMES=array(
		self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=>'idDatosSolicitudClaseDirigida',
		self::FIELD_IDSOLICITUD=>'idSolicitud',
		self::FIELD_TITULAR=>'Titular',
		self::FIELD_IBAN=>'IBAN',
		self::FIELD_ENTIDAD=>'Entidad',
		self::FIELD_OFICINA=>'Oficina',
		self::FIELD_DIGITOCONTROL=>'DigitoControl',
		self::FIELD_CUENTA=>'Cuenta');
	private static $PROPERTY_NAMES=array(
		self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=>'idDatosSolicitudClaseDirigida',
		self::FIELD_IDSOLICITUD=>'idSolicitud',
		self::FIELD_TITULAR=>'Titular',
		self::FIELD_IBAN=>'iban',
		self::FIELD_ENTIDAD=>'Entidad',
		self::FIELD_OFICINA=>'Oficina',
		self::FIELD_DIGITOCONTROL=>'DigitoControl',
		self::FIELD_CUENTA=>'Cuenta');
	private static $PROPERTY_TYPES=array(
		self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_IDSOLICITUD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TITULAR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IBAN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ENTIDAD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OFICINA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DIGITOCONTROL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CUENTA=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_IDSOLICITUD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_TITULAR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,true),
		self::FIELD_IBAN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,4,0,true),
		self::FIELD_ENTIDAD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,4,0,true),
		self::FIELD_OFICINA=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,4,0,true),
		self::FIELD_DIGITOCONTROL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,2,0,true),
		self::FIELD_CUENTA=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=>null,
		self::FIELD_IDSOLICITUD=>null,
		self::FIELD_TITULAR=>null,
		self::FIELD_IBAN=>null,
		self::FIELD_ENTIDAD=>null,
		self::FIELD_OFICINA=>null,
		self::FIELD_DIGITOCONTROL=>null,
		self::FIELD_CUENTA=>null);
	private $idDatosSolicitudClaseDirigida;
	private $idSolicitud;
	private $Titular;
	private $iban;
	private $Entidad;
	private $Oficina;
	private $DigitoControl;
	private $Cuenta;

	/**
	 * set value for idDatosSolicitudClaseDirigida 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $idDatosSolicitudClaseDirigida
	 * @return DatosolicitudclasedirigidaModel
	 */
	public function &setIdDatosSolicitudClaseDirigida($idDatosSolicitudClaseDirigida) {
		$this->notifyChanged(self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA,$this->idDatosSolicitudClaseDirigida,$idDatosSolicitudClaseDirigida);
		$this->idDatosSolicitudClaseDirigida=$idDatosSolicitudClaseDirigida;
		return $this;
	}

	/**
	 * get value for idDatosSolicitudClaseDirigida 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getIdDatosSolicitudClaseDirigida() {
		return $this->idDatosSolicitudClaseDirigida;
	}

	/**
	 * set value for idSolicitud 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $idSolicitud
	 * @return DatosolicitudclasedirigidaModel
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
	 * set value for Titular 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @param mixed $Titular
	 * @return DatosolicitudclasedirigidaModel
	 */
	public function &setTitular($Titular) {
		$this->notifyChanged(self::FIELD_TITULAR,$this->Titular,$Titular);
		$this->Titular=$Titular;
		return $this;
	}

	/**
	 * get value for Titular 
	 *
	 * type:VARCHAR,size:150,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTitular() {
		return $this->Titular;
	}

	/**
	 * set value for IBAN 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @param mixed $iban
	 * @return DatosolicitudclasedirigidaModel
	 */
	public function &setIban($iban) {
		$this->notifyChanged(self::FIELD_IBAN,$this->iban,$iban);
		$this->iban=$iban;
		return $this;
	}

	/**
	 * get value for IBAN 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getIban() {
		return $this->iban;
	}

	/**
	 * set value for Entidad 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @param mixed $Entidad
	 * @return DatosolicitudclasedirigidaModel
	 */
	public function &setEntidad($Entidad) {
		$this->notifyChanged(self::FIELD_ENTIDAD,$this->Entidad,$Entidad);
		$this->Entidad=$Entidad;
		return $this;
	}

	/**
	 * get value for Entidad 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEntidad() {
		return $this->Entidad;
	}

	/**
	 * set value for Oficina 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @param mixed $Oficina
	 * @return DatosolicitudclasedirigidaModel
	 */
	public function &setOficina($Oficina) {
		$this->notifyChanged(self::FIELD_OFICINA,$this->Oficina,$Oficina);
		$this->Oficina=$Oficina;
		return $this;
	}

	/**
	 * get value for Oficina 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOficina() {
		return $this->Oficina;
	}

	/**
	 * set value for DigitoControl 
	 *
	 * type:VARCHAR,size:2,default:null,nullable
	 *
	 * @param mixed $DigitoControl
	 * @return DatosolicitudclasedirigidaModel
	 */
	public function &setDigitoControl($DigitoControl) {
		$this->notifyChanged(self::FIELD_DIGITOCONTROL,$this->DigitoControl,$DigitoControl);
		$this->DigitoControl=$DigitoControl;
		return $this;
	}

	/**
	 * get value for DigitoControl 
	 *
	 * type:VARCHAR,size:2,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDigitoControl() {
		return $this->DigitoControl;
	}

	/**
	 * set value for Cuenta 
	 *
	 * type:VARCHAR,size:10,default:null,nullable
	 *
	 * @param mixed $Cuenta
	 * @return DatosolicitudclasedirigidaModel
	 */
	public function &setCuenta($Cuenta) {
		$this->notifyChanged(self::FIELD_CUENTA,$this->Cuenta,$Cuenta);
		$this->Cuenta=$Cuenta;
		return $this;
	}

	/**
	 * get value for Cuenta 
	 *
	 * type:VARCHAR,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCuenta() {
		return $this->Cuenta;
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
			self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=>$this->getIdDatosSolicitudClaseDirigida(),
			self::FIELD_IDSOLICITUD=>$this->getIdSolicitud(),
			self::FIELD_TITULAR=>$this->getTitular(),
			self::FIELD_IBAN=>$this->getIban(),
			self::FIELD_ENTIDAD=>$this->getEntidad(),
			self::FIELD_OFICINA=>$this->getOficina(),
			self::FIELD_DIGITOCONTROL=>$this->getDigitoControl(),
			self::FIELD_CUENTA=>$this->getCuenta());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_IDDATOSSOLICITUDCLASEDIRIGIDA=>$this->getIdDatosSolicitudClaseDirigida());
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
	 * Match by attributes of passed example instance and return matched rows as an array of DatosolicitudclasedirigidaModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param DatosolicitudclasedirigidaModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return DatosolicitudclasedirigidaModel[]
	 */
	public static function findByExample(PDO $db,DatosolicitudclasedirigidaModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of DatosolicitudclasedirigidaModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return DatosolicitudclasedirigidaModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `datosolicitudclasedirigida`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of DatosolicitudclasedirigidaModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return DatosolicitudclasedirigidaModel[]
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
	 * returns the result as an array of DatosolicitudclasedirigidaModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return DatosolicitudclasedirigidaModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new DatosolicitudclasedirigidaModel();
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
	 * Execute select query and return matched rows as an array of DatosolicitudclasedirigidaModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return DatosolicitudclasedirigidaModel[]
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
		$sql='DELETE FROM `datosolicitudclasedirigida`'
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
		$this->setIdDatosSolicitudClaseDirigida($result['idDatosSolicitudClaseDirigida']);
		$this->setIdSolicitud($result['idSolicitud']);
		$this->setTitular($result['Titular']);
		$this->setIban($result['IBAN']);
		$this->setEntidad($result['Entidad']);
		$this->setOficina($result['Oficina']);
		$this->setDigitoControl($result['DigitoControl']);
		$this->setCuenta($result['Cuenta']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return DatosolicitudclasedirigidaModel
	 */
	public static function findById(PDO $db,$idDatosSolicitudClaseDirigida) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$idDatosSolicitudClaseDirigida);
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
		$o=new DatosolicitudclasedirigidaModel();
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
		$stmt->bindValue(1,$this->getIdDatosSolicitudClaseDirigida());
		$stmt->bindValue(2,$this->getIdSolicitud());
		$stmt->bindValue(3,$this->getTitular());
		$stmt->bindValue(4,$this->getIban());
		$stmt->bindValue(5,$this->getEntidad());
		$stmt->bindValue(6,$this->getOficina());
		$stmt->bindValue(7,$this->getDigitoControl());
		$stmt->bindValue(8,$this->getCuenta());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getIdDatosSolicitudClaseDirigida()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getIdSolicitud());
			$stmt->bindValue(2,$this->getTitular());
			$stmt->bindValue(3,$this->getIban());
			$stmt->bindValue(4,$this->getEntidad());
			$stmt->bindValue(5,$this->getOficina());
			$stmt->bindValue(6,$this->getDigitoControl());
			$stmt->bindValue(7,$this->getCuenta());
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
			$this->setIdDatosSolicitudClaseDirigida($lastInsertId);
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
		$stmt->bindValue(9,$this->getIdDatosSolicitudClaseDirigida());
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
		$stmt->bindValue(1,$this->getIdDatosSolicitudClaseDirigida());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch SolicitudModel which references this DatosolicitudclasedirigidaModel. Will return null in case reference is invalid.
	 * `datosolicitudclasedirigida`.`idSolicitud` -> `solicitud`.`idSolicitud`
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'DatosolicitudclasedirigidaModel');
	}

	/**
	 * get single DatosolicitudclasedirigidaModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return DatosolicitudclasedirigidaModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new DatosolicitudclasedirigidaModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of DatosolicitudclasedirigidaModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return DatosolicitudclasedirigidaModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('DatosolicitudclasedirigidaModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>