<?php

namespace CustomShippingZoneFees\Model\Base;

use \Exception;
use \PDO;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModules as ChildCustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery as ChildCustomShippingZoneFeesModulesQuery;
use CustomShippingZoneFees\Model\Map\CustomShippingZoneFeesModulesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Thelia\Model\Module;

/**
 * Base class that represents a query for the 'custom_shipping_zone_fees_modules' table.
 *
 *
 *
 * @method     ChildCustomShippingZoneFeesModulesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCustomShippingZoneFeesModulesQuery orderByCustomShippingZoneFeesId($order = Criteria::ASC) Order by the custom_shipping_zone_fees_id column
 * @method     ChildCustomShippingZoneFeesModulesQuery orderByModuleId($order = Criteria::ASC) Order by the module_id column
 *
 * @method     ChildCustomShippingZoneFeesModulesQuery groupById() Group by the id column
 * @method     ChildCustomShippingZoneFeesModulesQuery groupByCustomShippingZoneFeesId() Group by the custom_shipping_zone_fees_id column
 * @method     ChildCustomShippingZoneFeesModulesQuery groupByModuleId() Group by the module_id column
 *
 * @method     ChildCustomShippingZoneFeesModulesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesModulesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesModulesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomShippingZoneFeesModulesQuery leftJoinModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Module relation
 * @method     ChildCustomShippingZoneFeesModulesQuery rightJoinModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Module relation
 * @method     ChildCustomShippingZoneFeesModulesQuery innerJoinModule($relationAlias = null) Adds a INNER JOIN clause to the query using the Module relation
 *
 * @method     ChildCustomShippingZoneFeesModulesQuery leftJoinCustomShippingZoneFees($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomShippingZoneFees relation
 * @method     ChildCustomShippingZoneFeesModulesQuery rightJoinCustomShippingZoneFees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomShippingZoneFees relation
 * @method     ChildCustomShippingZoneFeesModulesQuery innerJoinCustomShippingZoneFees($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomShippingZoneFees relation
 *
 * @method     ChildCustomShippingZoneFeesModules findOne(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFeesModules matching the query
 * @method     ChildCustomShippingZoneFeesModules findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFeesModules matching the query, or a new ChildCustomShippingZoneFeesModules object populated from the query conditions when no match is found
 *
 * @method     ChildCustomShippingZoneFeesModules findOneById(int $id) Return the first ChildCustomShippingZoneFeesModules filtered by the id column
 * @method     ChildCustomShippingZoneFeesModules findOneByCustomShippingZoneFeesId(int $custom_shipping_zone_fees_id) Return the first ChildCustomShippingZoneFeesModules filtered by the custom_shipping_zone_fees_id column
 * @method     ChildCustomShippingZoneFeesModules findOneByModuleId(int $module_id) Return the first ChildCustomShippingZoneFeesModules filtered by the module_id column
 *
 * @method     array findById(int $id) Return ChildCustomShippingZoneFeesModules objects filtered by the id column
 * @method     array findByCustomShippingZoneFeesId(int $custom_shipping_zone_fees_id) Return ChildCustomShippingZoneFeesModules objects filtered by the custom_shipping_zone_fees_id column
 * @method     array findByModuleId(int $module_id) Return ChildCustomShippingZoneFeesModules objects filtered by the module_id column
 *
 */
abstract class CustomShippingZoneFeesModulesQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \CustomShippingZoneFees\Model\Base\CustomShippingZoneFeesModulesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\CustomShippingZoneFees\\Model\\CustomShippingZoneFeesModules', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomShippingZoneFeesModulesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomShippingZoneFeesModulesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery) {
            return $criteria;
        }
        $query = new \CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCustomShippingZoneFeesModules|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CustomShippingZoneFeesModulesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomShippingZoneFeesModulesTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildCustomShippingZoneFeesModules A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, CUSTOM_SHIPPING_ZONE_FEES_ID, MODULE_ID FROM custom_shipping_zone_fees_modules WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildCustomShippingZoneFeesModules();
            $obj->hydrate($row);
            CustomShippingZoneFeesModulesTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCustomShippingZoneFeesModules|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the custom_shipping_zone_fees_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomShippingZoneFeesId(1234); // WHERE custom_shipping_zone_fees_id = 1234
     * $query->filterByCustomShippingZoneFeesId(array(12, 34)); // WHERE custom_shipping_zone_fees_id IN (12, 34)
     * $query->filterByCustomShippingZoneFeesId(array('min' => 12)); // WHERE custom_shipping_zone_fees_id > 12
     * </code>
     *
     * @see       filterByCustomShippingZoneFees()
     *
     * @param     mixed $customShippingZoneFeesId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFeesId($customShippingZoneFeesId = null, $comparison = null)
    {
        if (is_array($customShippingZoneFeesId)) {
            $useMinMax = false;
            if (isset($customShippingZoneFeesId['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFeesId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customShippingZoneFeesId['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFeesId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFeesId, $comparison);
    }

    /**
     * Filter the query on the module_id column
     *
     * Example usage:
     * <code>
     * $query->filterByModuleId(1234); // WHERE module_id = 1234
     * $query->filterByModuleId(array(12, 34)); // WHERE module_id IN (12, 34)
     * $query->filterByModuleId(array('min' => 12)); // WHERE module_id > 12
     * </code>
     *
     * @see       filterByModule()
     *
     * @param     mixed $moduleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function filterByModuleId($moduleId = null, $comparison = null)
    {
        if (is_array($moduleId)) {
            $useMinMax = false;
            if (isset($moduleId['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::MODULE_ID, $moduleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($moduleId['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::MODULE_ID, $moduleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::MODULE_ID, $moduleId, $comparison);
    }

    /**
     * Filter the query by a related \Thelia\Model\Module object
     *
     * @param \Thelia\Model\Module|ObjectCollection $module The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function filterByModule($module, $comparison = null)
    {
        if ($module instanceof \Thelia\Model\Module) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesModulesTableMap::MODULE_ID, $module->getId(), $comparison);
        } elseif ($module instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CustomShippingZoneFeesModulesTableMap::MODULE_ID, $module->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByModule() only accepts arguments of type \Thelia\Model\Module or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Module relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function joinModule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Module');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Module');
        }

        return $this;
    }

    /**
     * Use the Module relation Module object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\ModuleQuery A secondary query class using the current class as primary query
     */
    public function useModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Module', '\Thelia\Model\ModuleQuery');
    }

    /**
     * Filter the query by a related \CustomShippingZoneFees\Model\CustomShippingZoneFees object
     *
     * @param \CustomShippingZoneFees\Model\CustomShippingZoneFees|ObjectCollection $customShippingZoneFees The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFees($customShippingZoneFees, $comparison = null)
    {
        if ($customShippingZoneFees instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFees) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesModulesTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFees->getId(), $comparison);
        } elseif ($customShippingZoneFees instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CustomShippingZoneFeesModulesTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFees->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCustomShippingZoneFees() only accepts arguments of type \CustomShippingZoneFees\Model\CustomShippingZoneFees or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomShippingZoneFees relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function joinCustomShippingZoneFees($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomShippingZoneFees');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CustomShippingZoneFees');
        }

        return $this;
    }

    /**
     * Use the CustomShippingZoneFees relation CustomShippingZoneFees object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery A secondary query class using the current class as primary query
     */
    public function useCustomShippingZoneFeesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomShippingZoneFees($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomShippingZoneFees', '\CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCustomShippingZoneFeesModules $customShippingZoneFeesModules Object to remove from the list of results
     *
     * @return ChildCustomShippingZoneFeesModulesQuery The current query, for fluid interface
     */
    public function prune($customShippingZoneFeesModules = null)
    {
        if ($customShippingZoneFeesModules) {
            $this->addUsingAlias(CustomShippingZoneFeesModulesTableMap::ID, $customShippingZoneFeesModules->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the custom_shipping_zone_fees_modules table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesModulesTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CustomShippingZoneFeesModulesTableMap::clearInstancePool();
            CustomShippingZoneFeesModulesTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCustomShippingZoneFeesModules or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCustomShippingZoneFeesModules object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesModulesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomShippingZoneFeesModulesTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CustomShippingZoneFeesModulesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomShippingZoneFeesModulesTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // CustomShippingZoneFeesModulesQuery
