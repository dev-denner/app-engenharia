<?php

namespace App\Models;

class Grupo extends BaseModel
{

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
        $sql = "SELECT id, nome FROM grupo";
        return $this->select($sql);
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function getById(int $id)
    {
        $sql = "SELECT id, nome FROM grupo WHERE id = :id";
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
        return parent::create('grupo', $data);
    }

    /**
     *
     * @param array $data
     * @param int $id
     * @return type
     */
    public function atualiza(array $data, int $id)
    {
        return parent::update('grupo', $data, ['id' => $id]);
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function delete(int $id)
    {
        return parent::destroy('grupo', ['id' => $id]);
    }
}