<?php

namespace CustomShippingZoneFees\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use CustomShippingZoneFees\Model\CustomShippingZoneFees as ChildCustomShippingZoneFees;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n as ChildCustomShippingZoneFeesI18n;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery as ChildCustomShippingZoneFeesI18nQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModules as ChildCustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery as ChildCustomShippingZoneFeesModulesQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery as ChildCustomShippingZoneFeesQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZip as ChildCustomShippingZoneFeesZip;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery as ChildCustomShippingZoneFeesZipQuery;
use CustomShippingZoneFees\Model\Map\CustomShippingZoneFeesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

abstract class CustomShippingZoneFees implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CustomShippingZoneFees\\Model\\Map\\CustomShippingZoneFeesTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the fee field.
     * @var        double
     */
    protected $fee;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        ObjectCollection|ChildCustomShippingZoneFeesZip[] Collection to store aggregation of ChildCustomShippingZoneFeesZip objects.
     */
    protected $collCustomShippingZoneFeesZips;
    protected $collCustomShippingZoneFeesZipsPartial;

    /**
     * @var        ObjectCollection|ChildCustomShippingZoneFeesModules[] Collection to store aggregation of ChildCustomShippingZoneFeesModules objects.
     */
    protected $collCustomShippingZoneFeesModuless;
    protected $collCustomShippingZoneFeesModulessPartial;

    /**
     * @var        ObjectCollection|ChildCustomShippingZoneFeesI18n[] Collection to store aggregation of ChildCustomShippingZoneFeesI18n objects.
     */
    protected $collCustomShippingZoneFeesI18ns;
    protected $collCustomShippingZoneFeesI18nsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[ChildCustomShippingZoneFeesI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $customShippingZoneFeesZipsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $customShippingZoneFeesModulessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $customShippingZoneFeesI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of CustomShippingZoneFees\Model\Base\CustomShippingZoneFees object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (Boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (Boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>CustomShippingZoneFees</code> instance.  If
     * <code>obj</code> is an instance of <code>CustomShippingZoneFees</code>, delegates to
     * <code>equals(CustomShippingZoneFees)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return CustomShippingZoneFees The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return CustomShippingZoneFees The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return   int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [fee] column value.
     *
     * @return   double
     */
    public function getFee()
    {

        return $this->fee;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param      int $v new value
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFees The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CustomShippingZoneFeesTableMap::ID] = true;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fee] column.
     *
     * @param      double $v new value
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFees The current object (for fluent API support)
     */
    public function setFee($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->fee !== $v) {
            $this->fee = $v;
            $this->modifiedColumns[CustomShippingZoneFeesTableMap::FEE] = true;
        }


        return $this;
    } // setFee()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFees The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($dt !== $this->created_at) {
                $this->created_at = $dt;
                $this->modifiedColumns[CustomShippingZoneFeesTableMap::CREATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFees The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($dt !== $this->updated_at) {
                $this->updated_at = $dt;
                $this->modifiedColumns[CustomShippingZoneFeesTableMap::UPDATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CustomShippingZoneFeesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CustomShippingZoneFeesTableMap::translateFieldName('Fee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fee = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CustomShippingZoneFeesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CustomShippingZoneFeesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = CustomShippingZoneFeesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \CustomShippingZoneFees\Model\CustomShippingZoneFees object", 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomShippingZoneFeesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCustomShippingZoneFeesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCustomShippingZoneFeesZips = null;

            $this->collCustomShippingZoneFeesModuless = null;

            $this->collCustomShippingZoneFeesI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CustomShippingZoneFees::setDeleted()
     * @see CustomShippingZoneFees::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildCustomShippingZoneFeesQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(CustomShippingZoneFeesTableMap::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(CustomShippingZoneFeesTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(CustomShippingZoneFeesTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CustomShippingZoneFeesTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->customShippingZoneFeesZipsScheduledForDeletion !== null) {
                if (!$this->customShippingZoneFeesZipsScheduledForDeletion->isEmpty()) {
                    \CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery::create()
                        ->filterByPrimaryKeys($this->customShippingZoneFeesZipsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->customShippingZoneFeesZipsScheduledForDeletion = null;
                }
            }

                if ($this->collCustomShippingZoneFeesZips !== null) {
            foreach ($this->collCustomShippingZoneFeesZips as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->customShippingZoneFeesModulessScheduledForDeletion !== null) {
                if (!$this->customShippingZoneFeesModulessScheduledForDeletion->isEmpty()) {
                    \CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery::create()
                        ->filterByPrimaryKeys($this->customShippingZoneFeesModulessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->customShippingZoneFeesModulessScheduledForDeletion = null;
                }
            }

                if ($this->collCustomShippingZoneFeesModuless !== null) {
            foreach ($this->collCustomShippingZoneFeesModuless as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->customShippingZoneFeesI18nsScheduledForDeletion !== null) {
                if (!$this->customShippingZoneFeesI18nsScheduledForDeletion->isEmpty()) {
                    \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery::create()
                        ->filterByPrimaryKeys($this->customShippingZoneFeesI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->customShippingZoneFeesI18nsScheduledForDeletion = null;
                }
            }

                if ($this->collCustomShippingZoneFeesI18ns !== null) {
            foreach ($this->collCustomShippingZoneFeesI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[CustomShippingZoneFeesTableMap::ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CustomShippingZoneFeesTableMap::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::FEE)) {
            $modifiedColumns[':p' . $index++]  = 'FEE';
        }
        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'CREATED_AT';
        }
        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'UPDATED_AT';
        }

        $sql = sprintf(
            'INSERT INTO custom_shipping_zone_fees (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'FEE':
                        $stmt->bindValue($identifier, $this->fee, PDO::PARAM_STR);
                        break;
                    case 'CREATED_AT':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'UPDATED_AT':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CustomShippingZoneFeesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getFee();
                break;
            case 2:
                return $this->getCreatedAt();
                break;
            case 3:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['CustomShippingZoneFees'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CustomShippingZoneFees'][$this->getPrimaryKey()] = true;
        $keys = CustomShippingZoneFeesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFee(),
            $keys[2] => $this->getCreatedAt(),
            $keys[3] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCustomShippingZoneFeesZips) {
                $result['CustomShippingZoneFeesZips'] = $this->collCustomShippingZoneFeesZips->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCustomShippingZoneFeesModuless) {
                $result['CustomShippingZoneFeesModuless'] = $this->collCustomShippingZoneFeesModuless->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCustomShippingZoneFeesI18ns) {
                $result['CustomShippingZoneFeesI18ns'] = $this->collCustomShippingZoneFeesI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CustomShippingZoneFeesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setFee($value);
                break;
            case 2:
                $this->setCreatedAt($value);
                break;
            case 3:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CustomShippingZoneFeesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFee($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CustomShippingZoneFeesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::ID)) $criteria->add(CustomShippingZoneFeesTableMap::ID, $this->id);
        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::FEE)) $criteria->add(CustomShippingZoneFeesTableMap::FEE, $this->fee);
        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::CREATED_AT)) $criteria->add(CustomShippingZoneFeesTableMap::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(CustomShippingZoneFeesTableMap::UPDATED_AT)) $criteria->add(CustomShippingZoneFeesTableMap::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(CustomShippingZoneFeesTableMap::DATABASE_NAME);
        $criteria->add(CustomShippingZoneFeesTableMap::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \CustomShippingZoneFees\Model\CustomShippingZoneFees (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFee($this->getFee());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCustomShippingZoneFeesZips() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomShippingZoneFeesZip($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCustomShippingZoneFeesModuless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomShippingZoneFeesModules($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCustomShippingZoneFeesI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomShippingZoneFeesI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \CustomShippingZoneFees\Model\CustomShippingZoneFees Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('CustomShippingZoneFeesZip' == $relationName) {
            return $this->initCustomShippingZoneFeesZips();
        }
        if ('CustomShippingZoneFeesModules' == $relationName) {
            return $this->initCustomShippingZoneFeesModuless();
        }
        if ('CustomShippingZoneFeesI18n' == $relationName) {
            return $this->initCustomShippingZoneFeesI18ns();
        }
    }

    /**
     * Clears out the collCustomShippingZoneFeesZips collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCustomShippingZoneFeesZips()
     */
    public function clearCustomShippingZoneFeesZips()
    {
        $this->collCustomShippingZoneFeesZips = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCustomShippingZoneFeesZips collection loaded partially.
     */
    public function resetPartialCustomShippingZoneFeesZips($v = true)
    {
        $this->collCustomShippingZoneFeesZipsPartial = $v;
    }

    /**
     * Initializes the collCustomShippingZoneFeesZips collection.
     *
     * By default this just sets the collCustomShippingZoneFeesZips collection to an empty array (like clearcollCustomShippingZoneFeesZips());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomShippingZoneFeesZips($overrideExisting = true)
    {
        if (null !== $this->collCustomShippingZoneFeesZips && !$overrideExisting) {
            return;
        }
        $this->collCustomShippingZoneFeesZips = new ObjectCollection();
        $this->collCustomShippingZoneFeesZips->setModel('\CustomShippingZoneFees\Model\CustomShippingZoneFeesZip');
    }

    /**
     * Gets an array of ChildCustomShippingZoneFeesZip objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCustomShippingZoneFees is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildCustomShippingZoneFeesZip[] List of ChildCustomShippingZoneFeesZip objects
     * @throws PropelException
     */
    public function getCustomShippingZoneFeesZips($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCustomShippingZoneFeesZipsPartial && !$this->isNew();
        if (null === $this->collCustomShippingZoneFeesZips || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCustomShippingZoneFeesZips) {
                // return empty collection
                $this->initCustomShippingZoneFeesZips();
            } else {
                $collCustomShippingZoneFeesZips = ChildCustomShippingZoneFeesZipQuery::create(null, $criteria)
                    ->filterByCustomShippingZoneFees($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomShippingZoneFeesZipsPartial && count($collCustomShippingZoneFeesZips)) {
                        $this->initCustomShippingZoneFeesZips(false);

                        foreach ($collCustomShippingZoneFeesZips as $obj) {
                            if (false == $this->collCustomShippingZoneFeesZips->contains($obj)) {
                                $this->collCustomShippingZoneFeesZips->append($obj);
                            }
                        }

                        $this->collCustomShippingZoneFeesZipsPartial = true;
                    }

                    reset($collCustomShippingZoneFeesZips);

                    return $collCustomShippingZoneFeesZips;
                }

                if ($partial && $this->collCustomShippingZoneFeesZips) {
                    foreach ($this->collCustomShippingZoneFeesZips as $obj) {
                        if ($obj->isNew()) {
                            $collCustomShippingZoneFeesZips[] = $obj;
                        }
                    }
                }

                $this->collCustomShippingZoneFeesZips = $collCustomShippingZoneFeesZips;
                $this->collCustomShippingZoneFeesZipsPartial = false;
            }
        }

        return $this->collCustomShippingZoneFeesZips;
    }

    /**
     * Sets a collection of CustomShippingZoneFeesZip objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $customShippingZoneFeesZips A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function setCustomShippingZoneFeesZips(Collection $customShippingZoneFeesZips, ConnectionInterface $con = null)
    {
        $customShippingZoneFeesZipsToDelete = $this->getCustomShippingZoneFeesZips(new Criteria(), $con)->diff($customShippingZoneFeesZips);


        $this->customShippingZoneFeesZipsScheduledForDeletion = $customShippingZoneFeesZipsToDelete;

        foreach ($customShippingZoneFeesZipsToDelete as $customShippingZoneFeesZipRemoved) {
            $customShippingZoneFeesZipRemoved->setCustomShippingZoneFees(null);
        }

        $this->collCustomShippingZoneFeesZips = null;
        foreach ($customShippingZoneFeesZips as $customShippingZoneFeesZip) {
            $this->addCustomShippingZoneFeesZip($customShippingZoneFeesZip);
        }

        $this->collCustomShippingZoneFeesZips = $customShippingZoneFeesZips;
        $this->collCustomShippingZoneFeesZipsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CustomShippingZoneFeesZip objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CustomShippingZoneFeesZip objects.
     * @throws PropelException
     */
    public function countCustomShippingZoneFeesZips(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCustomShippingZoneFeesZipsPartial && !$this->isNew();
        if (null === $this->collCustomShippingZoneFeesZips || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomShippingZoneFeesZips) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomShippingZoneFeesZips());
            }

            $query = ChildCustomShippingZoneFeesZipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomShippingZoneFees($this)
                ->count($con);
        }

        return count($this->collCustomShippingZoneFeesZips);
    }

    /**
     * Method called to associate a ChildCustomShippingZoneFeesZip object to this object
     * through the ChildCustomShippingZoneFeesZip foreign key attribute.
     *
     * @param    ChildCustomShippingZoneFeesZip $l ChildCustomShippingZoneFeesZip
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFees The current object (for fluent API support)
     */
    public function addCustomShippingZoneFeesZip(ChildCustomShippingZoneFeesZip $l)
    {
        if ($this->collCustomShippingZoneFeesZips === null) {
            $this->initCustomShippingZoneFeesZips();
            $this->collCustomShippingZoneFeesZipsPartial = true;
        }

        if (!in_array($l, $this->collCustomShippingZoneFeesZips->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCustomShippingZoneFeesZip($l);
        }

        return $this;
    }

    /**
     * @param CustomShippingZoneFeesZip $customShippingZoneFeesZip The customShippingZoneFeesZip object to add.
     */
    protected function doAddCustomShippingZoneFeesZip($customShippingZoneFeesZip)
    {
        $this->collCustomShippingZoneFeesZips[]= $customShippingZoneFeesZip;
        $customShippingZoneFeesZip->setCustomShippingZoneFees($this);
    }

    /**
     * @param  CustomShippingZoneFeesZip $customShippingZoneFeesZip The customShippingZoneFeesZip object to remove.
     * @return ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function removeCustomShippingZoneFeesZip($customShippingZoneFeesZip)
    {
        if ($this->getCustomShippingZoneFeesZips()->contains($customShippingZoneFeesZip)) {
            $this->collCustomShippingZoneFeesZips->remove($this->collCustomShippingZoneFeesZips->search($customShippingZoneFeesZip));
            if (null === $this->customShippingZoneFeesZipsScheduledForDeletion) {
                $this->customShippingZoneFeesZipsScheduledForDeletion = clone $this->collCustomShippingZoneFeesZips;
                $this->customShippingZoneFeesZipsScheduledForDeletion->clear();
            }
            $this->customShippingZoneFeesZipsScheduledForDeletion[]= clone $customShippingZoneFeesZip;
            $customShippingZoneFeesZip->setCustomShippingZoneFees(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this CustomShippingZoneFees is new, it will return
     * an empty collection; or if this CustomShippingZoneFees has previously
     * been saved, it will retrieve related CustomShippingZoneFeesZips from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in CustomShippingZoneFees.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildCustomShippingZoneFeesZip[] List of ChildCustomShippingZoneFeesZip objects
     */
    public function getCustomShippingZoneFeesZipsJoinCountry($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCustomShippingZoneFeesZipQuery::create(null, $criteria);
        $query->joinWith('Country', $joinBehavior);

        return $this->getCustomShippingZoneFeesZips($query, $con);
    }

    /**
     * Clears out the collCustomShippingZoneFeesModuless collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCustomShippingZoneFeesModuless()
     */
    public function clearCustomShippingZoneFeesModuless()
    {
        $this->collCustomShippingZoneFeesModuless = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCustomShippingZoneFeesModuless collection loaded partially.
     */
    public function resetPartialCustomShippingZoneFeesModuless($v = true)
    {
        $this->collCustomShippingZoneFeesModulessPartial = $v;
    }

    /**
     * Initializes the collCustomShippingZoneFeesModuless collection.
     *
     * By default this just sets the collCustomShippingZoneFeesModuless collection to an empty array (like clearcollCustomShippingZoneFeesModuless());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomShippingZoneFeesModuless($overrideExisting = true)
    {
        if (null !== $this->collCustomShippingZoneFeesModuless && !$overrideExisting) {
            return;
        }
        $this->collCustomShippingZoneFeesModuless = new ObjectCollection();
        $this->collCustomShippingZoneFeesModuless->setModel('\CustomShippingZoneFees\Model\CustomShippingZoneFeesModules');
    }

    /**
     * Gets an array of ChildCustomShippingZoneFeesModules objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCustomShippingZoneFees is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildCustomShippingZoneFeesModules[] List of ChildCustomShippingZoneFeesModules objects
     * @throws PropelException
     */
    public function getCustomShippingZoneFeesModuless($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCustomShippingZoneFeesModulessPartial && !$this->isNew();
        if (null === $this->collCustomShippingZoneFeesModuless || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCustomShippingZoneFeesModuless) {
                // return empty collection
                $this->initCustomShippingZoneFeesModuless();
            } else {
                $collCustomShippingZoneFeesModuless = ChildCustomShippingZoneFeesModulesQuery::create(null, $criteria)
                    ->filterByCustomShippingZoneFees($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomShippingZoneFeesModulessPartial && count($collCustomShippingZoneFeesModuless)) {
                        $this->initCustomShippingZoneFeesModuless(false);

                        foreach ($collCustomShippingZoneFeesModuless as $obj) {
                            if (false == $this->collCustomShippingZoneFeesModuless->contains($obj)) {
                                $this->collCustomShippingZoneFeesModuless->append($obj);
                            }
                        }

                        $this->collCustomShippingZoneFeesModulessPartial = true;
                    }

                    reset($collCustomShippingZoneFeesModuless);

                    return $collCustomShippingZoneFeesModuless;
                }

                if ($partial && $this->collCustomShippingZoneFeesModuless) {
                    foreach ($this->collCustomShippingZoneFeesModuless as $obj) {
                        if ($obj->isNew()) {
                            $collCustomShippingZoneFeesModuless[] = $obj;
                        }
                    }
                }

                $this->collCustomShippingZoneFeesModuless = $collCustomShippingZoneFeesModuless;
                $this->collCustomShippingZoneFeesModulessPartial = false;
            }
        }

        return $this->collCustomShippingZoneFeesModuless;
    }

    /**
     * Sets a collection of CustomShippingZoneFeesModules objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $customShippingZoneFeesModuless A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function setCustomShippingZoneFeesModuless(Collection $customShippingZoneFeesModuless, ConnectionInterface $con = null)
    {
        $customShippingZoneFeesModulessToDelete = $this->getCustomShippingZoneFeesModuless(new Criteria(), $con)->diff($customShippingZoneFeesModuless);


        $this->customShippingZoneFeesModulessScheduledForDeletion = $customShippingZoneFeesModulessToDelete;

        foreach ($customShippingZoneFeesModulessToDelete as $customShippingZoneFeesModulesRemoved) {
            $customShippingZoneFeesModulesRemoved->setCustomShippingZoneFees(null);
        }

        $this->collCustomShippingZoneFeesModuless = null;
        foreach ($customShippingZoneFeesModuless as $customShippingZoneFeesModules) {
            $this->addCustomShippingZoneFeesModules($customShippingZoneFeesModules);
        }

        $this->collCustomShippingZoneFeesModuless = $customShippingZoneFeesModuless;
        $this->collCustomShippingZoneFeesModulessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CustomShippingZoneFeesModules objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CustomShippingZoneFeesModules objects.
     * @throws PropelException
     */
    public function countCustomShippingZoneFeesModuless(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCustomShippingZoneFeesModulessPartial && !$this->isNew();
        if (null === $this->collCustomShippingZoneFeesModuless || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomShippingZoneFeesModuless) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomShippingZoneFeesModuless());
            }

            $query = ChildCustomShippingZoneFeesModulesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomShippingZoneFees($this)
                ->count($con);
        }

        return count($this->collCustomShippingZoneFeesModuless);
    }

    /**
     * Method called to associate a ChildCustomShippingZoneFeesModules object to this object
     * through the ChildCustomShippingZoneFeesModules foreign key attribute.
     *
     * @param    ChildCustomShippingZoneFeesModules $l ChildCustomShippingZoneFeesModules
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFees The current object (for fluent API support)
     */
    public function addCustomShippingZoneFeesModules(ChildCustomShippingZoneFeesModules $l)
    {
        if ($this->collCustomShippingZoneFeesModuless === null) {
            $this->initCustomShippingZoneFeesModuless();
            $this->collCustomShippingZoneFeesModulessPartial = true;
        }

        if (!in_array($l, $this->collCustomShippingZoneFeesModuless->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCustomShippingZoneFeesModules($l);
        }

        return $this;
    }

    /**
     * @param CustomShippingZoneFeesModules $customShippingZoneFeesModules The customShippingZoneFeesModules object to add.
     */
    protected function doAddCustomShippingZoneFeesModules($customShippingZoneFeesModules)
    {
        $this->collCustomShippingZoneFeesModuless[]= $customShippingZoneFeesModules;
        $customShippingZoneFeesModules->setCustomShippingZoneFees($this);
    }

    /**
     * @param  CustomShippingZoneFeesModules $customShippingZoneFeesModules The customShippingZoneFeesModules object to remove.
     * @return ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function removeCustomShippingZoneFeesModules($customShippingZoneFeesModules)
    {
        if ($this->getCustomShippingZoneFeesModuless()->contains($customShippingZoneFeesModules)) {
            $this->collCustomShippingZoneFeesModuless->remove($this->collCustomShippingZoneFeesModuless->search($customShippingZoneFeesModules));
            if (null === $this->customShippingZoneFeesModulessScheduledForDeletion) {
                $this->customShippingZoneFeesModulessScheduledForDeletion = clone $this->collCustomShippingZoneFeesModuless;
                $this->customShippingZoneFeesModulessScheduledForDeletion->clear();
            }
            $this->customShippingZoneFeesModulessScheduledForDeletion[]= clone $customShippingZoneFeesModules;
            $customShippingZoneFeesModules->setCustomShippingZoneFees(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this CustomShippingZoneFees is new, it will return
     * an empty collection; or if this CustomShippingZoneFees has previously
     * been saved, it will retrieve related CustomShippingZoneFeesModuless from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in CustomShippingZoneFees.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return Collection|ChildCustomShippingZoneFeesModules[] List of ChildCustomShippingZoneFeesModules objects
     */
    public function getCustomShippingZoneFeesModulessJoinModule($criteria = null, $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCustomShippingZoneFeesModulesQuery::create(null, $criteria);
        $query->joinWith('Module', $joinBehavior);

        return $this->getCustomShippingZoneFeesModuless($query, $con);
    }

    /**
     * Clears out the collCustomShippingZoneFeesI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCustomShippingZoneFeesI18ns()
     */
    public function clearCustomShippingZoneFeesI18ns()
    {
        $this->collCustomShippingZoneFeesI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCustomShippingZoneFeesI18ns collection loaded partially.
     */
    public function resetPartialCustomShippingZoneFeesI18ns($v = true)
    {
        $this->collCustomShippingZoneFeesI18nsPartial = $v;
    }

    /**
     * Initializes the collCustomShippingZoneFeesI18ns collection.
     *
     * By default this just sets the collCustomShippingZoneFeesI18ns collection to an empty array (like clearcollCustomShippingZoneFeesI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomShippingZoneFeesI18ns($overrideExisting = true)
    {
        if (null !== $this->collCustomShippingZoneFeesI18ns && !$overrideExisting) {
            return;
        }
        $this->collCustomShippingZoneFeesI18ns = new ObjectCollection();
        $this->collCustomShippingZoneFeesI18ns->setModel('\CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n');
    }

    /**
     * Gets an array of ChildCustomShippingZoneFeesI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCustomShippingZoneFees is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildCustomShippingZoneFeesI18n[] List of ChildCustomShippingZoneFeesI18n objects
     * @throws PropelException
     */
    public function getCustomShippingZoneFeesI18ns($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCustomShippingZoneFeesI18nsPartial && !$this->isNew();
        if (null === $this->collCustomShippingZoneFeesI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCustomShippingZoneFeesI18ns) {
                // return empty collection
                $this->initCustomShippingZoneFeesI18ns();
            } else {
                $collCustomShippingZoneFeesI18ns = ChildCustomShippingZoneFeesI18nQuery::create(null, $criteria)
                    ->filterByCustomShippingZoneFees($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomShippingZoneFeesI18nsPartial && count($collCustomShippingZoneFeesI18ns)) {
                        $this->initCustomShippingZoneFeesI18ns(false);

                        foreach ($collCustomShippingZoneFeesI18ns as $obj) {
                            if (false == $this->collCustomShippingZoneFeesI18ns->contains($obj)) {
                                $this->collCustomShippingZoneFeesI18ns->append($obj);
                            }
                        }

                        $this->collCustomShippingZoneFeesI18nsPartial = true;
                    }

                    reset($collCustomShippingZoneFeesI18ns);

                    return $collCustomShippingZoneFeesI18ns;
                }

                if ($partial && $this->collCustomShippingZoneFeesI18ns) {
                    foreach ($this->collCustomShippingZoneFeesI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collCustomShippingZoneFeesI18ns[] = $obj;
                        }
                    }
                }

                $this->collCustomShippingZoneFeesI18ns = $collCustomShippingZoneFeesI18ns;
                $this->collCustomShippingZoneFeesI18nsPartial = false;
            }
        }

        return $this->collCustomShippingZoneFeesI18ns;
    }

    /**
     * Sets a collection of CustomShippingZoneFeesI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $customShippingZoneFeesI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function setCustomShippingZoneFeesI18ns(Collection $customShippingZoneFeesI18ns, ConnectionInterface $con = null)
    {
        $customShippingZoneFeesI18nsToDelete = $this->getCustomShippingZoneFeesI18ns(new Criteria(), $con)->diff($customShippingZoneFeesI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->customShippingZoneFeesI18nsScheduledForDeletion = clone $customShippingZoneFeesI18nsToDelete;

        foreach ($customShippingZoneFeesI18nsToDelete as $customShippingZoneFeesI18nRemoved) {
            $customShippingZoneFeesI18nRemoved->setCustomShippingZoneFees(null);
        }

        $this->collCustomShippingZoneFeesI18ns = null;
        foreach ($customShippingZoneFeesI18ns as $customShippingZoneFeesI18n) {
            $this->addCustomShippingZoneFeesI18n($customShippingZoneFeesI18n);
        }

        $this->collCustomShippingZoneFeesI18ns = $customShippingZoneFeesI18ns;
        $this->collCustomShippingZoneFeesI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CustomShippingZoneFeesI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CustomShippingZoneFeesI18n objects.
     * @throws PropelException
     */
    public function countCustomShippingZoneFeesI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCustomShippingZoneFeesI18nsPartial && !$this->isNew();
        if (null === $this->collCustomShippingZoneFeesI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomShippingZoneFeesI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomShippingZoneFeesI18ns());
            }

            $query = ChildCustomShippingZoneFeesI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomShippingZoneFees($this)
                ->count($con);
        }

        return count($this->collCustomShippingZoneFeesI18ns);
    }

    /**
     * Method called to associate a ChildCustomShippingZoneFeesI18n object to this object
     * through the ChildCustomShippingZoneFeesI18n foreign key attribute.
     *
     * @param    ChildCustomShippingZoneFeesI18n $l ChildCustomShippingZoneFeesI18n
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFees The current object (for fluent API support)
     */
    public function addCustomShippingZoneFeesI18n(ChildCustomShippingZoneFeesI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collCustomShippingZoneFeesI18ns === null) {
            $this->initCustomShippingZoneFeesI18ns();
            $this->collCustomShippingZoneFeesI18nsPartial = true;
        }

        if (!in_array($l, $this->collCustomShippingZoneFeesI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCustomShippingZoneFeesI18n($l);
        }

        return $this;
    }

    /**
     * @param CustomShippingZoneFeesI18n $customShippingZoneFeesI18n The customShippingZoneFeesI18n object to add.
     */
    protected function doAddCustomShippingZoneFeesI18n($customShippingZoneFeesI18n)
    {
        $this->collCustomShippingZoneFeesI18ns[]= $customShippingZoneFeesI18n;
        $customShippingZoneFeesI18n->setCustomShippingZoneFees($this);
    }

    /**
     * @param  CustomShippingZoneFeesI18n $customShippingZoneFeesI18n The customShippingZoneFeesI18n object to remove.
     * @return ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function removeCustomShippingZoneFeesI18n($customShippingZoneFeesI18n)
    {
        if ($this->getCustomShippingZoneFeesI18ns()->contains($customShippingZoneFeesI18n)) {
            $this->collCustomShippingZoneFeesI18ns->remove($this->collCustomShippingZoneFeesI18ns->search($customShippingZoneFeesI18n));
            if (null === $this->customShippingZoneFeesI18nsScheduledForDeletion) {
                $this->customShippingZoneFeesI18nsScheduledForDeletion = clone $this->collCustomShippingZoneFeesI18ns;
                $this->customShippingZoneFeesI18nsScheduledForDeletion->clear();
            }
            $this->customShippingZoneFeesI18nsScheduledForDeletion[]= clone $customShippingZoneFeesI18n;
            $customShippingZoneFeesI18n->setCustomShippingZoneFees(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->fee = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collCustomShippingZoneFeesZips) {
                foreach ($this->collCustomShippingZoneFeesZips as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCustomShippingZoneFeesModuless) {
                foreach ($this->collCustomShippingZoneFeesModuless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCustomShippingZoneFeesI18ns) {
                foreach ($this->collCustomShippingZoneFeesI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collCustomShippingZoneFeesZips = null;
        $this->collCustomShippingZoneFeesModuless = null;
        $this->collCustomShippingZoneFeesI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CustomShippingZoneFeesTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[CustomShippingZoneFeesTableMap::UPDATED_AT] = true;

        return $this;
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildCustomShippingZoneFeesI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collCustomShippingZoneFeesI18ns) {
                foreach ($this->collCustomShippingZoneFeesI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildCustomShippingZoneFeesI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildCustomShippingZoneFeesI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addCustomShippingZoneFeesI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    ChildCustomShippingZoneFees The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildCustomShippingZoneFeesI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collCustomShippingZoneFeesI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collCustomShippingZoneFeesI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildCustomShippingZoneFeesI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [name] column value.
         *
         * @return   string
         */
        public function getName()
        {
        return $this->getCurrentTranslation()->getName();
    }


        /**
         * Set the value of [name] column.
         *
         * @param      string $v new value
         * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }


        /**
         * Get the [description] column value.
         *
         * @return   string
         */
        public function getDescription()
        {
        return $this->getCurrentTranslation()->getDescription();
    }


        /**
         * Set the value of [description] column.
         *
         * @param      string $v new value
         * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
