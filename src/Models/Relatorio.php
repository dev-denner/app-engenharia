<?php

namespace App\Models;

class Relatorio extends BaseModel
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function arrecadacaoAtual()
    {
        $sql = "SELECT
                    us.nome usuario,
                    plastico + metal + papel + vidro + oleo pontuacao
                FROM pontuacao po
                INNER JOIN usuario us
                    ON po.cd_usuario = us.id
                WHERE po.status = 1";
        $relatorio = $this->select($sql);
        $return = [];
        foreach ($relatorio as $value) {
            $return['usuario'][] = $value['usuario'];
            $return['pontuacao'][] = $value['pontuacao'];
        }
        return $return;
    }

    public function arrecadacaoTotal()
    {
        $sql = "SELECT
                    us.nome usuario,
                    SUM(plastico + metal + papel + vidro + oleo) pontuacao
                FROM pontuacao po
                INNER JOIN usuario us
                    ON po.cd_usuario = us.id
                GROUP BY us.nome";
        $relatorio = $this->select($sql);
        $return = [];
        foreach ($relatorio as $value) {
            $return['usuario'][] = $value['usuario'];
            $return['pontuacao'][] = $value['pontuacao'];
        }
        return $return;
    }

    public function valorRecebido()
    {
        $sql = "SELECT
                    us.nome usuario,
                    SUM(fe.valor) valor
                FROM fechamento fe
                INNER JOIN pontuacao po
                    ON fe.cd_pontuacao = po.id
                INNER JOIN usuario us
                    ON po.cd_usuario = us.id
                GROUP BY us.nome";
        $relatorio = $this->select($sql);
        $return = [];
        foreach ($relatorio as $value) {
            $return['usuario'][] = $value['usuario'];
            $return['valor'][] = $value['valor'];
        }
        return $return;
    }

    public function arrecadacaoAtualByUsuario($id)
    {
        $sql = "SELECT
                    plastico,
                    metal,
                    papel,
                    vidro,
                    oleo
                FROM pontuacao po
                INNER JOIN usuario us
                    ON po.cd_usuario = us.id
                    AND us.id = :id
                WHERE po.status = 1";
        $relatorio = $this->select($sql, ['id' => $id]);
        $relatorio = $relatorio[0];
        $return = [];
        $return['labels'] = ['Plástico', 'Metal', 'Papel', 'Vidro', 'Óleo'];
        $return['values'] =
            [
                $relatorio['plastico'],
                $relatorio['metal'],
                $relatorio['papel'],
                $relatorio['vidro'],
                $relatorio['oleo']
            ];
        return $return;
    }

    public function arrecadacaoTotalByUsuario($id)
    {
        $sql = "SELECT
                    SUM(plastico) plastico,
                    SUM(metal) metal,
                    SUM(papel) papel,
                    SUM(vidro) vidro,
                    SUM(oleo) oleo
                FROM pontuacao po
                INNER JOIN usuario us
                    ON po.cd_usuario = us.id
                    AND us.id = :id
                GROUP BY us.id";
        $relatorio = $this->select($sql, ['id' => $id]);
        $relatorio = $relatorio[0];
        $return = [];
        $return['labels'] = ['Plástico', 'Metal', 'Papel', 'Vidro', 'Óleo'];
        $return['values'] =
            [
                $relatorio['plastico'],
                $relatorio['metal'],
                $relatorio['papel'],
                $relatorio['vidro'],
                $relatorio['oleo']
            ];
        return $return;
    }

    public function valorRecebidoByUsuario($id)
    {
        $sql = 'SELECT
                    UPPER(DATE_FORMAT(fe.data_fechamento, "%M - %Y")) dataf,
                    SUM(fe.valor) valor
                FROM fechamento fe
                INNER JOIN pontuacao po
                    ON fe.cd_pontuacao = po.id
                INNER JOIN usuario us
                    ON po.cd_usuario = us.id
                   AND us.id = :id
                GROUP BY fe.data_fechamento
                ORDER BY fe.data_fechamento';
        $relatorio = $this->select($sql, ['id' => $id]);
        $return = [];
        foreach ($relatorio as $value) {
            $return['data'][] = $value['dataf'];
            $return['values'][] = $value['valor'];
        }
        return $return;
    }
}
