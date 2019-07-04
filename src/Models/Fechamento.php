<?php

namespace App\Models;

class Fechamento extends BaseModel
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
        $sql = 'SELECT
                    fe.id,
                    us.nome usuario,
                    fe.valor,
                    fe.data_fechamento,
                    po.plastico + po.metal + po.papel + po.vidro + po.oleo pontuacao
                FROM fechamento fe
                INNER JOIN pontuacao po
                    ON fe.cd_pontuacao = po.id
                   AND po.status = 0
                INNER JOIN usuario us
                    ON po.cd_usuario = us.id';
        return $this->select($sql);
    }

    public function getTotalKg()
    {
        $sql = 'SELECT
                    SUM(plastico + metal + papel + vidro + oleo) total
                FROM pontuacao
                WHERE status = 1';
        return $this->select($sql);
    }

    /**
     *
     * @return type
     */
    public function store($valor)
    {
        $sql = 'SELECT
                    id, plastico + metal + papel + vidro + oleo pontuacao
                FROM pontuacao
                WHERE status = 1
                  AND plastico + metal + papel + vidro + oleo > 0';

        $pontuacao = $this->select($sql);
        $total = $this->getTotalKg()[0];
        $data = [];
        foreach ($pontuacao as $ponto) {
            $data = [
                'cd_pontuacao' => $ponto['id'],
                'valor' => round(($ponto['pontuacao'] / $total['total']) *  $valor['valor'], 2),
            ];

            if (!parent::create('fechamento', $data)) {
                return false;
            }
            if (!parent::update('pontuacao', ['status' => 0], ['id' => $ponto['id']])) {
                return false;
            }
        }
        return true;
    }
}
