<?php

namespace App\Models;

class Grupo extends BaseModel
{
    /**
     *
     * @var string
     */
    public $table = 'grupo';

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * @return type
     */
    public function get()
    {
        $sql = "SELECT id, nome FROM {$this->table}";
        return $this->select($sql);
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function getById(int $id)
    {
        $sql = "SELECT id, nome FROM {$this->table} WHERE id = :id";
        return $this->select($sql, ['id' => $id]);
    }

    /**
     *
     * @param array $data
     * @return type
     */
    public function store(array $data)
    {
        unset($data['id']);
        return  parent::create($this->table, $data);
    }

    /**
     *
     * @param array $data
     * @param int $id
     * @return type
     */
    public function atualiza(array $data, int $id)
    {
        return  parent::update($this->table, $data, ['id' => $id]);
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function delete(int $id)
    {
        return  parent::destroy($this->table, ['id' => $id]);
    }
}
