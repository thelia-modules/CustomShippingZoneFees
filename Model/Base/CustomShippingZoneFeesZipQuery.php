<?php

namespace CustomShippingZoneFees\Model\Base;

use \Exception;
use \PDO;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZip as ChildCustomShippingZoneFeesZip;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery as ChildCustomShippingZoneFeesZipQuery;
use CustomShippingZoneFees\Model\Map\CustomShippingZoneFeesZipTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Thelia\Model\Country;

/**
 * Base class that represents a query for the 'custom_shipping_zone_fees_zip' table.
 *
 *
 *
 * @method     ChildCustomShippingZoneFeesZipQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCustomShippingZoneFeesZipQuery orderByCustomShippingZoneFeesId($order = Criteria::ASC) Order by the custom_shipping_zone_fees_id column
 * @method     ChildCustomShippingZoneFeesZipQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method     ChildCustomShippingZoneFeesZipQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 *
 * @method     ChildCustomShippingZoneFeesZipQuery groupById() Group by the id column
 * @method     ChildCustomShippingZoneFeesZipQuery groupByCustomShippingZoneFeesId() Group by the custom_shipping_zone_fees_id column
 * @method     ChildCustomShippingZoneFeesZipQuery groupByCountryId() Group by the country_id column
 * @method     ChildCustomShippingZoneFeesZipQuery groupByZipCode() Group by the zip_code column
 *
 * @method     ChildCustomShippingZoneFeesZipQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesZipQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomShippingZoneFeesZipQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomShippingZoneFeesZipQuery leftJoinCustomShippingZoneFees($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomShippingZoneFees relation
 * @method     ChildCustomShippingZoneFeesZipQuery rightJoinCustomShippingZoneFees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomShippingZoneFees relation
 * @method     ChildCustomShippingZoneFeesZipQuery innerJoinCustomShippingZoneFees($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomShippingZoneFees relation
 *
 * @method     ChildCustomShippingZoneFeesZipQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildCustomShippingZoneFeesZipQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildCustomShippingZoneFeesZipQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildCustomShippingZoneFeesZip findOne(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFeesZip matching the query
 * @method     ChildCustomShippingZoneFeesZip findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomShippingZoneFeesZip matching the query, or a new ChildCustomShippingZoneFeesZip object populated from the query conditions when no match is found
 *
 * @method     ChildCustomShippingZoneFeesZip findOneById(int $id) Return the first ChildCustomShippingZoneFeesZip filtered by the id column
 * @method     ChildCustomShippingZoneFeesZip findOneByCustomShippingZoneFeesId(int $custom_shipping_zone_fees_id) Return the first ChildCustomShippingZoneFeesZip filtered by the custom_shipping_zone_fees_id column
 * @method     ChildCustomShippingZoneFeesZip findOneByCountryId(int $country_id) Return the first ChildCustomShippingZoneFeesZip filtered by the country_id column
 * @method     ChildCustomShippingZoneFeesZip findOneByZipCode(string $zip_code) Return the first ChildCustomShippingZoneFeesZip filtered by the zip_code column
 *
 * @method     array findById(int $id) Return ChildCustomShippingZoneFeesZip objects filtered by the id column
 * @method     array findByCustomShippingZoneFeesId(int $custom_shipping_zone_fees_id) Return ChildCustomShippingZoneFeesZip objects filtered by the custom_shipping_zone_fees_id column
 * @method     array findByCountryId(int $country_id) Return ChildCustomShippingZoneFeesZip objects filtered by the country_id column
 * @method     array findByZipCode(string $zip_code) Return ChildCustomShippingZoneFeesZip objects filtered by the zip_code column
 *
 */
abstract class CustomShippingZoneFeesZipQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \CustomShippingZoneFees\Model\Base\CustomShippingZoneFeesZipQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\CustomShippingZoneFees\\Model\\CustomShippingZoneFeesZip', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomShippingZoneFeesZipQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomShippingZoneFeesZipQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery) {
            return $criteria;
        }
        $query = new \CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery();
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
     * @return ChildCustomShippingZoneFeesZip|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CustomShippingZoneFeesZipTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomShippingZoneFeesZipTableMap::DATABASE_NAME);
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
     * @return   ChildCustomShippingZoneFeesZip A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, CUSTOM_SHIPPING_ZONE_FEES_ID, COUNTRY_ID, ZIP_CODE FROM custom_shipping_zone_fees_zip WHERE ID = :p0';
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
            $obj = new ChildCustomShippingZoneFeesZip();
            $obj->hydrate($row);
            CustomShippingZoneFeesZipTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCustomShippingZoneFeesZip|array|mixed the result, formatted by the current formatter
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
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::ID, $id, $comparison);
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
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFeesId($customShippingZoneFeesId = null, $comparison = null)
    {
        if (is_array($customShippingZoneFeesId)) {
            $useMinMax = false;
            if (isset($customShippingZoneFeesId['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFeesId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customShippingZoneFeesId['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFeesId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFeesId, $comparison);
    }

    /**
     * Filter the query on the country_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryId(1234); // WHERE country_id = 1234
     * $query->filterByCountryId(array(12, 34)); // WHERE country_id IN (12, 34)
     * $query->filterByCountryId(array('min' => 12)); // WHERE country_id > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::COUNTRY_ID, $countryId, $comparison);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%'); // WHERE zip_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterByZipCode($zipCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zipCode)) {
                $zipCode = str_replace('*', '%', $zipCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::ZIP_CODE, $zipCode, $comparison);
    }

    /**
     * Filter the query by a related \CustomShippingZoneFees\Model\CustomShippingZoneFees object
     *
     * @param \CustomShippingZoneFees\Model\CustomShippingZoneFees|ObjectCollection $customShippingZoneFees The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterByCustomShippingZoneFees($customShippingZoneFees, $comparison = null)
    {
        if ($customShippingZoneFees instanceof \CustomShippingZoneFees\Model\CustomShippingZoneFees) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesZipTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFees->getId(), $comparison);
        } elseif ($customShippingZoneFees instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CustomShippingZoneFeesZipTableMap::CUSTOM_SHIPPING_ZONE_FEES_ID, $customShippingZoneFees->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
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
     * Filter the query by a related \Thelia\Model\Country object
     *
     * @param \Thelia\Model\Country|ObjectCollection $country The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof \Thelia\Model\Country) {
            return $this
                ->addUsingAlias(CustomShippingZoneFeesZipTableMap::COUNTRY_ID, $country->getId(), $comparison);
        } elseif ($country instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CustomShippingZoneFeesZipTableMap::COUNTRY_ID, $country->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \Thelia\Model\Country or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\Thelia\Model\CountryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCustomShippingZoneFeesZip $customShippingZoneFeesZip Object to remove from the list of results
     *
     * @return ChildCustomShippingZoneFeesZipQuery The current query, for fluid interface
     */
    public function prune($customShippingZoneFeesZip = null)
    {
        if ($customShippingZoneFeesZip) {
            $this->addUsingAlias(CustomShippingZoneFeesZipTableMap::ID, $customShippingZoneFeesZip->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the custom_shipping_zone_fees_zip table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesZipTableMap::DATABASE_NAME);
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
            CustomShippingZoneFeesZipTableMap::clearInstancePool();
            CustomShippingZoneFeesZipTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildCustomShippingZoneFeesZip or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildCustomShippingZoneFeesZip object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomShippingZoneFeesZipTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomShippingZoneFeesZipTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CustomShippingZoneFeesZipTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomShippingZoneFeesZipTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // CustomShippingZoneFeesZipQuery
