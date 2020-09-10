<?php

namespace CustomShippingZoneFees\Model\Base;

use \Exception;
use \PDO;
use CustomShippingZoneFees\Model\CustomShippingZoneFees as ChildCustomShippingZoneFees;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery as ChildCustomShippingZoneFeesI18nQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery as ChildCustomShippingZoneFeesQuery;
use CustomShippingZoneFees\Model\Map\CustomShippingZoneFeesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'custom_shipping_zone_fees' table.
 *
 *
 *
 * @method     ChildCustomShippingZoneFeesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCustomShippingZoneFeesQuery orderByFee($order = Criteria::ASC) Order by the fee column
 * @method     ChildCustomShippingZoneFeesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCustomShippingZoneFeesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCustomShippingZoneFeesQuery groupById() Group by the id column
 * @method     ChildCustomShippingZoneFeesQuery groupByFee() Group by the fee column
 * @method     ChildCustomShippingZoneFeesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCustomShippingZoneFeesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCustomShippingZoneFeesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomShippingZoneFeesQuery leftJoinCustomShippingZoneFeesZip($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomShippingZoneFeesZip relation
 * @method     ChildCustomShippingZoneFeesQuery rightJoinCustomShippingZoneFeesZip($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomShippingZoneFeesZip relation
 * @method     ChildCustomShippingZoneFeesQuery innerJoinCustomShippingZoneFeesZip($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomShippingZoneFeesZip relation
 *
 * @method     ChildCustomShippingZoneFeesQuery leftJoinCustomShippingZoneFeesModules($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomShippingZoneFeesModules relation
 * @method     ChildCustomShippingZoneFeesQuery rightJoinCustomShippingZoneFeesModules($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomShippingZoneFeesModules relation
 * @method     ChildCustomShippingZoneFeesQuery innerJoinCustomShippingZoneFeesModules($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomShippingZoneFeesModules relation
 *
 * @method     ChildCustomShippingZoneFeesQuery leftJoinCustomShippingZoneFeesI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomShippingZoneFeesI18n relation
 * @method     ChildCustomShippingZoneFeesQuery rightJoinCustomShippingZoneFeesI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomShippingZoneFeesI18n relation
 * @method     ChildCustomShippingZoneFeesQuery innerJoinCustomShippingZoneFeesI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomShippingZoneFeesI18n relation
 *
 * @method     ChildCustomShippingZoneFees findOne(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFees matching the query
 * @method     ChildCustomShippingZoneFees findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFees matching the query, or a new ChildCustomShippingZoneFees object populated from the query conditions when no match is found
 *
 * @method     ChildCustomShippingZoneFees findOneById(int $id) Return the first ChildCustomShippingZoneFees filtered by the id column
 * @method     ChildCustomShippingZoneFees findOneByFee(double $fee) Return the first ChildCustomShippingZoneFees filtered by the fee column
 * @method     ChildCustomShippingZoneFees findOneByCreatedAt(string $created_at) Return the first ChildCustomShippingZoneFees filtered by the created_at column
 * @method     ChildCustomShippingZoneFees findOneByUpdatedAt(string $updated_at) Return the first ChildCustomShippingZoneFees filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildCustomShippingZoneFees objects filtered by the id column
 * @method     array findByFee(double $fee) Return ChildCustomShippingZoneFees objects filtered by the fee column
 * @method     array findByCreatedAt(string $created_at) Return ChildCustomShippingZoneFees objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildCustomShippingZoneFees objects filtered by the updated_at column
 *
 */
abstract class CustomShippingZoneFeesQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \CustomShippingZoneFees\Model\Base\CustomShippingZoneFeesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\CustomShippingZoneFees\\Model\\CustomShippingZoneFees', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomShippingZoneFeesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomShippingZoneFeesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery) {
            return $criteria;
        }
        $query = new \CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery();
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
     * @return ChildCustomShippingZoneFees|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CustomShippingZoneFeesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomShippingZoneFeesTableMap::DATABASE_NAME);
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
     * @return   ChildCustomShippingZoneFees A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, FEE, CREATED_AT, UPDATED_AT FROM custom_shipping_zone_fees WHERE ID = :p0';
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
            $obj = new ChildCustomShippingZoneFees();
            $obj->hydrate($row);
            CustomShippingZoneFeesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCustomShippingZoneFees|array|mixed the result, formatted by the current formatter
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
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the fee column
     *
     * Example usage:
     * <code>
     * $query->filterByFee(1234); // WHERE fee = 1234
     * $query->filterByFee(array(12, 34)); // WHERE fee IN (12, 34)
     * $query->filterByFee(array('min' => 12)); // WHERE fee > 12
     * </code>
     *
     * @param     mixed $fee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByFee($fee = null, $comparison = null)
    {
        if (is_array($fee)) {
            $useMinMax = false;
            if (isset($fee['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::FEE, $fee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fee['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::FEE, $fee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::FEE, $fee, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \CustomShippingZoneFees\Model\CustomShippingZoneFeesZip object
     *
     * @param \CustomShippingZoneFees\Model\CustomShippingZoneFeesZip|ObjectCollection $customShippingZoneFeesZip  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFeesZip($customShippingZoneFeesZip, $comparison = null)
    {
        if ($customShippingZoneFeesZip instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFeesZip) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $customShippingZoneFeesZip->getCustomShippingZoneFeesId(), $comparison);
        } elseif ($customShippingZoneFeesZip instanceof ObjectCollection) {
            return $this
                ->useCustomShippingZoneFeesZipQuery()
                ->filterByPrimaryKeys($customShippingZoneFeesZip->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCustomShippingZoneFeesZip() only accepts arguments of type \CustomShippingZoneFees\Model\CustomShippingZoneFeesZip or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomShippingZoneFeesZip relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function joinCustomShippingZoneFeesZip($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomShippingZoneFeesZip');

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
            $this->addJoinObject($join, 'CustomShippingZoneFeesZip');
        }

        return $this;
    }

    /**
     * Use the CustomShippingZoneFeesZip relation CustomShippingZoneFeesZip object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery A secondary query class using the current class as primary query
     */
    public function useCustomShippingZoneFeesZipQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomShippingZoneFeesZip($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomShippingZoneFeesZip', '\CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery');
    }

    /**
     * Filter the query by a related \CustomShippingZoneFees\Model\CustomShippingZoneFeesModules object
     *
     * @param \CustomShippingZoneFees\Model\CustomShippingZoneFeesModules|ObjectCollection $customShippingZoneFeesModules  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFeesModules($customShippingZoneFeesModules, $comparison = null)
    {
        if ($customShippingZoneFeesModules instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFeesModules) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $customShippingZoneFeesModules->getCustomShippingZoneFeesId(), $comparison);
        } elseif ($customShippingZoneFeesModules instanceof ObjectCollection) {
            return $this
                ->useCustomShippingZoneFeesModulesQuery()
                ->filterByPrimaryKeys($customShippingZoneFeesModules->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCustomShippingZoneFeesModules() only accepts arguments of type \CustomShippingZoneFees\Model\CustomShippingZoneFeesModules or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomShippingZoneFeesModules relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function joinCustomShippingZoneFeesModules($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomShippingZoneFeesModules');

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
            $this->addJoinObject($join, 'CustomShippingZoneFeesModules');
        }

        return $this;
    }

    /**
     * Use the CustomShippingZoneFeesModules relation CustomShippingZoneFeesModules object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery A secondary query class using the current class as primary query
     */
    public function useCustomShippingZoneFeesModulesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomShippingZoneFeesModules($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomShippingZoneFeesModules', '\CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery');
    }

    /**
     * Filter the query by a related \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n object
     *
     * @param \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n|ObjectCollection $customShippingZoneFeesI18n  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFeesI18n($customShippingZoneFeesI18n, $comparison = null)
    {
        if ($customShippingZoneFeesI18n instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $customShippingZoneFeesI18n->getId(), $comparison);
        } elseif ($customShippingZoneFeesI18n instanceof ObjectCollection) {
            return $this
                ->useCustomShippingZoneFeesI18nQuery()
                ->filterByPrimaryKeys($customShippingZoneFeesI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCustomShippingZoneFeesI18n() only accepts arguments of type \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomShippingZoneFeesI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function joinCustomShippingZoneFeesI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomShippingZoneFeesI18n');

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
            $this->addJoinObject($join, 'CustomShippingZoneFeesI18n');
        }

        return $this;
    }

    /**
     * Use the CustomShippingZoneFeesI18n relation CustomShippingZoneFeesI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery A secondary query class using the current class as primary query
     */
    public function useCustomShippingZoneFeesI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCustomShippingZoneFeesI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomShippingZoneFeesI18n', '\CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCustomShippingZoneFees $customShippingZoneFees Object to remove from the list of results
     *
     * @return ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function prune($customShippingZoneFees = null)
    {
        if ($customShippingZoneFees) {
            $this->addUsingAlias(CustomShippingZoneFeesTableMap::ID, $customShippingZoneFees->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the custom_shipping_zone_fees table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesTableMap::DATABASE_NAME);
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
            CustomShippingZoneFeesTableMap::clearInstancePool();
            CustomShippingZoneFeesTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCustomShippingZoneFees or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCustomShippingZoneFees object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomShippingZoneFeesTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CustomShippingZoneFeesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomShippingZoneFeesTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CustomShippingZoneFeesTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CustomShippingZoneFeesTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CustomShippingZoneFeesTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CustomShippingZoneFeesTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CustomShippingZoneFeesTableMap::CREATED_AT);
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'CustomShippingZoneFeesI18n';

        return $this
            ->joinCustomShippingZoneFeesI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildCustomShippingZoneFeesQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('CustomShippingZoneFeesI18n');
        $this->with['CustomShippingZoneFeesI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildCustomShippingZoneFeesI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomShippingZoneFeesI18n', '\CustomShippingZoneFees\Model\CustomShippingZoneFeesI18nQuery');
    }

} // CustomShippingZoneFeesQuery
