<?php

namespace App\Models;

use App\Libraries\Database;

class BaseModel
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    /**
     *
     * @param string $sql
     * @param array $where
     * @return \PDO
     */
    protected function select(string $sql, array $where = [])
    {
        $sth = $this->db->prepare($sql);
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $sth->bindValue(':' . $key, $value);
            }
        }
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $table
     * @param array $data
     * @return boolean
     */
    protected function create(string $table, array $data)
    {

        $keys = array_keys($data);
        $sql  = "INSERT INTO {$table}(" . implode(', ', $keys) . ") VALUES (:" . implode(", :", $keys) . ")";
        $sth  = $this->db->prepare($sql);
        foreach ($data as $key => $value) {
            $sth->bindValue(':' . $key, $value);
        }
        return $sth->execute();
    }

    /**
     *
     * @param string $table
     * @param array $data
     * @param array $id
     * @return boolean
     */
    protected function update(string $table, array $data, array $id)
    {
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = $key . " = :" . $key;
        }
        $idKey = array_keys($id);
        $sql   = "UPDATE {$table} SET " . implode(', ', $sets) . " WHERE {$idKey[0]} = :id";
        $sth   = $this->db->prepare($sql);
        $sth->bindValue(':id', $id[$idKey[0]]);
        foreach ($data as $k => $v) {

            $sth->bindValue(':' . $k, $v);
        }
        return $sth->execute() == 1;
    }

    /**
     *
     * @param string $table
     * @param array $id
     * @return boolean
     */
    protected function destroy(string $table, array $id)
    {
        $idKey = array_keys($id);
        $sql   = "DELETE FROM {$table} WHERE {$idKey[0]} = :id";
        $sth   = $this->db->prepare($sql);
        $sth->bindValue(':id', $id[$idKey[0]]);
        return $sth->execute();
    }
}
