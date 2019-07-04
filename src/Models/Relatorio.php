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
}
