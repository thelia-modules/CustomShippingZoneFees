<?php

namespace CustomShippingZoneFees\Model\Base;

use \Exception;
use \PDO;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n as ChildCustomShippingZoneFeesI18n;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery as ChildCustomShippingZoneFeesI18nQuery;
use CustomShippingZoneFees\Model\Map\CustomShippingZoneFeesI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'custom_shipping_zone_fees_i18n' table.
 *
 *
 *
 * @method     ChildCustomShippingZoneFeesI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCustomShippingZoneFeesI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildCustomShippingZoneFeesI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCustomShippingZoneFeesI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildCustomShippingZoneFeesI18nQuery groupById() Group by the id column
 * @method     ChildCustomShippingZoneFeesI18nQuery groupByLocale() Group by the locale column
 * @method     ChildCustomShippingZoneFeesI18nQuery groupByName() Group by the name column
 * @method     ChildCustomShippingZoneFeesI18nQuery groupByDescription() Group by the description column
 *
 * @method     ChildCustomShippingZoneFeesI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomShippingZoneFeesI18nQuery leftJoinCustomShippingZoneFees($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomShippingZoneFees relation
 * @method     ChildCustomShippingZoneFeesI18nQuery rightJoinCustomShippingZoneFees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomShippingZoneFees relation
 * @method     ChildCustomShippingZoneFeesI18nQuery innerJoinCustomShippingZoneFees($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomShippingZoneFees relation
 *
 * @method     ChildCustomShippingZoneFeesI18n findOne(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFeesI18n matching the query
 * @method     ChildCustomShippingZoneFeesI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFeesI18n matching the query, or a new ChildCustomShippingZoneFeesI18n object populated from the query conditions when no match is found
 *
 * @method     ChildCustomShippingZoneFeesI18n findOneById(int $id) Return the first ChildCustomShippingZoneFeesI18n filtered by the id column
 * @method     ChildCustomShippingZoneFeesI18n findOneByLocale(string $locale) Return the first ChildCustomShippingZoneFeesI18n filtered by the locale column
 * @method     ChildCustomShippingZoneFeesI18n findOneByName(string $name) Return the first ChildCustomShippingZoneFeesI18n filtered by the name column
 * @method     ChildCustomShippingZoneFeesI18n findOneByDescription(string $description) Return the first ChildCustomShippingZoneFeesI18n filtered by the description column
 *
 * @method     array findById(int $id) Return ChildCustomShippingZoneFeesI18n objects filtered by the id column
 * @method     array findByLocale(string $locale) Return ChildCustomShippingZoneFeesI18n objects filtered by the locale column
 * @method     array findByName(string $name) Return ChildCustomShippingZoneFeesI18n objects filtered by the name column
 * @method     array findByDescription(string $description) Return ChildCustomShippingZoneFeesI18n objects filtered by the description column
 *
 */
abstract class CustomShippingZoneFeesI18nQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \CustomShippingZoneFees\Model\Base\CustomShippingZoneFeesI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\CustomShippingZoneFees\\Model\\CustomShippingZoneFeesI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomShippingZoneFeesI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomShippingZoneFeesI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery) {
            return $criteria;
        }
        $query = new \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCustomShippingZoneFeesI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CustomShippingZoneFeesI18nTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomShippingZoneFeesI18nTableMap::DATABASE_NAME);
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
     * @return   ChildCustomShippingZoneFeesI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, LOCALE, NAME, DESCRIPTION FROM custom_shipping_zone_fees_i18n WHERE ID = :p0 AND LOCALE = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildCustomShippingZoneFeesI18n();
            $obj->hydrate($row);
            CustomShippingZoneFeesI18nTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildCustomShippingZoneFeesI18n|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CustomShippingZoneFeesI18nTableMap::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CustomShippingZoneFeesI18nTableMap::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByCustomShippingZoneFees()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesI18nTableMap::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \CustomShippingZoneFees\Model\CustomShippingZoneFees object
     *
     * @param \CustomShippingZoneFees\Model\CustomShippingZoneFees|ObjectCollection $customShippingZoneFees The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFees($customShippingZoneFees, $comparison = null)
    {
        if ($customShippingZoneFees instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFees) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesI18nTableMap::ID, $customShippingZoneFees->getId(), $comparison);
        } elseif ($customShippingZoneFees instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CustomShippingZoneFeesI18nTableMap::ID, $customShippingZoneFees->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function joinCustomShippingZoneFees($relationAlias = null, $joinType = 'LEFT JOIN')
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
    public function useCustomShippingZoneFeesQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCustomShippingZoneFees($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomShippingZoneFees', '\CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCustomShippingZoneFeesI18n $customShippingZoneFeesI18n Object to remove from the list of results
     *
     * @return ChildCustomShippingZoneFeesI18nQuery The current query, for fluid interface
     */
    public function prune($customShippingZoneFeesI18n = null)
    {
        if ($customShippingZoneFeesI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CustomShippingZoneFeesI18nTableMap::ID), $customShippingZoneFeesI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CustomShippingZoneFeesI18nTableMap::LOCALE), $customShippingZoneFeesI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the custom_shipping_zone_fees_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesI18nTableMap::DATABASE_NAME);
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
            CustomShippingZoneFeesI18nTableMap::clearInstancePool();
            CustomShippingZoneFeesI18nTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCustomShippingZoneFeesI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCustomShippingZoneFeesI18n object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomShippingZoneFeesI18nTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CustomShippingZoneFeesI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomShippingZoneFeesI18nTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // CustomShippingZoneFeesI18nQuery
