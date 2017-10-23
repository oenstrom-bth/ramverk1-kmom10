<?php

namespace Oenstrom\Comment;

use \Anax\Database\ActiveRecordModel;

/**
 * An extension of the ActiveRecordModel
 */
class ActiveRecordModelExtender extends ActiveRecordModel
{
    /**
     * Set the database object to use for accessing storage.
     *
     * @param DatabaseQueryBuilder $db as database access object.
     *
     * @return void
     */
    public function __construct($db = null)
    {
        if (!is_null($db)) {
            $this->setDb($db);
        }
    }



    /**
     * Find and return first object found by search criteria and use
     * its data to populate this instance.
     *
     * @param string $column to use in where statement.
     * @param mixed  $value  to use in where statement.
     *
     * @return this
     */
    public function findJoin($column, $value, $condition)
    {
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->join($this->tableName, $condition)
                        ->where("$column = ?")
                        ->execute([$value])
                        ->fetchInto($this);
    }



    /**
     * Find and return all matching a search criteria of
     * for example `id = ?` or `id IN [?, ?]`.
     *
     * @param string $where to use in where statement.
     * @param mixed  $value to use in where statement.
     *
     * @return array of object of this class
     */
    public function findAllWhereOrderBy($where, $value, $orderBy)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->where($where)
                        ->orderBy($orderBy)
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }



    /**
     * Find and return all matching a search criteria of
     * for example `id = ?` or `id IN [?, ?]`.
     *
     * @param string $where to use in where statement.
     * @param mixed  $value to use in where statement.
     *
     * @return array of object of this class
     */
    public function findAllJoinWhere($joinTable, $condition, $where, $value)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->join($joinTable, $condition)
                        ->where($where)
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }
}
