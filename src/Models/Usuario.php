<?php

namespace App\Models;

class Usuario extends BaseModel
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
        $sql = "SELECT us.id, us.nome, us.email, us.endereco, us.cd_grupo, gr.nome grupo
                FROM usuario us
                INNER JOIN grupo gr
                    ON us.cd_grupo = gr.id";
        return $this->select($sql);
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function getById(int $id)
    {
        $sql = "SELECT us.id, us.nome, us.email, us.endereco, us.cd_grupo, gr.nome grupo
                FROM usuario us
                INNER JOIN grupo gr
                    ON us.cd_grupo = gr.id
                WHERE us.id = :id";
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
        return parent::create('usuario', $data);
    }

    /**
     *
     * @param array $data
     * @param int $id
     * @return type
     */
    public function atualiza(array $data, int $id)
    {
        return parent::update('usuario', $data, ['id' => $id]);
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function delete(int $id)
    {
        return parent::destroy('usuario', ['id' => $id]);
    }
}