<?php

namespace App\Models;

class Pontuacao extends BaseModel
{
    /**
     *
     * @var string
     */
    public $table = 'pontuacao';

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
        $sql = 'SELECT
                    po.id,
                    us.nome usuario,
                    gr.nome grupo,
                    po.plastico,
                    po.metal,
                    po.vidro,
                    po.papel,
                    po.oleo
                FROM pontuacao po
                INNER JOIN usuario us
                          ON po.cd_usuario = us.id
                INNER JOIN grupo gr
                          ON us.cd_grupo = gr.id
                WHERE po.status = 1';
        return $this->select($sql);
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function getById(int $id)
    {
        $sql = 'SELECT * FROM pontuacao WHERE id = :id';
        return $this->select($sql, ['id' => $id]);
    }

    public function setUsuariosInPontuacao()
    {

        $sql = "SELECT  us.id, po.status, COUNT(po.status) qtd
                      FROM usuario us
                      LEFT JOIN pontuacao po
                        ON us.id = po.cd_usuario
                      GROUP BY us.id, po.status
                      ORDER BY us.id, po.status";

        $pontuacao = $this->select($sql);

        $dados = [];
        foreach ($pontuacao as $ponto) {
            $dados[$ponto['id']] = [
                'status' => $ponto['status'],
                'qtd'    => $ponto['qtd']
            ];
        }
        foreach ($dados as $key => $value) {
            if ($value['status'] != 1) {
                $data = [
                    'cd_usuario' => $key,
                    'plastico'   => 0,
                    'metal'      => 0,
                    'papel'      => 0,
                    'vidro'      => 0,
                    'oleo'       => 0,
                    'status'     => 1,
                ];
                $this->store($data);
            }
        }
        return;
    }

    /**
     *
     * @param array $data
     * @return type
     */
    public function store(array $data)
    {
        unset($data['id']);
        return parent::create('pontuacao', $data);
    }

    /**
     *
     * @param array $data
     * @param int $id
     * @return type
     */
    public function atualiza(array $data, int $id)
    {
        $atual             = $this->getById($id);
        $atual             = $atual[0];
        $atual['plastico'] += str_replace(',', '.', $data['plastico']);
        $atual['metal']    += str_replace(',', '.', $data['metal']);
        $atual['papel']    += str_replace(',', '.', $data['papel']);
        $atual['vidro']    += str_replace(',', '.', $data['vidro']);
        $atual['oleo']     += str_replace(',', '.', $data['oleo']);

        return parent::update('pontuacao', $atual, ['id' => $id]);
    }
}
