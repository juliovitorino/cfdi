<?php

/**
* MySqlKinghostUsuarioComplementoDAO - Implementação DAO
*/

require_once 'usuarioComplementoDTO.php';
require_once 'usuarioComplementoDAO.php';
require_once 'DmlSqlUsuarioComplemento.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioComplementoDAO implements UsuarioComplementoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }

    public function load($dto)  {   }
    public function listAll()   {   }

    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usuario
                            ,$dto->nomeReceitaFederal
                            ,$dto->website
                            ,$dto->facebook
                            ,$dto->instagram
                            ,$dto->pinterest
                            ,$dto->skype
                            ,$dto->twitter
                            ,$dto->facetime
                            ,$dto->img1
                            ,$dto->img2
                            ,$dto->img3
                            ,$dto->descricaoLivre
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }
    
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    public function listUsuarioComplementoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlTipoEmpreendimento::SELECT . 'WHERE `' . DmlSqlCampanhaPublicidade::USCO_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

    public function countUsuarioComplementoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioComplemento::USCO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

    public function listUsuarioComplementoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioComplemento::SELECT 
        . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

    public function listPagina($sql, $pag, $qtde)
    {
        $retorno = array();
        $final = $pag * $qtde - $qtde;
        $sql = $sql . " LIMIT $final, $qtde" ;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query($sql );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_STATUS);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$status
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function insert($dto) 
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_usuario
                            ,$dto->nomeReceitaFederal
                            ,$dto->website
                            ,$dto->facebook
                            ,$dto->instagram
                            ,$dto->pinterest
                            ,$dto->skype
                            ,$dto->twitter
                            ,$dto->facetime
                            ,$dto->img1
                            ,$dto->img2
                            ,$dto->img3
                            ,$dto->descricaoLivre
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset em DTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioComplementoDTO();
        $retorno->id = (int) $resultset[DmlSqlUsuarioComplemento::USCO_ID];
        $retorno->id_usuario = (int) $resultset[DmlSqlUsuarioComplemento::USUA_ID];
        $retorno->nomeReceitaFederal = $resultset[DmlSqlUsuarioComplemento::USCO_NM_RECEITA_FEDERAL];
        $retorno->website = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_WEBSITE];
        $retorno->facebook = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_FACEBOOK];
        $retorno->instagram = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_INSTAGRAM];
        $retorno->pinterest = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_PINTEREST];
        $retorno->skype = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_SKYPE];
        $retorno->twitter = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_TWITTER];
        $retorno->facetime = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_FACETIME];
        $retorno->img1 = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG1];
        $retorno->img2 = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG2];
        $retorno->img3 = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG3];
        $retorno->descricaoLivre = $resultset[DmlSqlUsuarioComplemento::USCO_TX_DESC_LIVRE];
        $retorno->status = $resultset[DmlSqlUsuarioComplemento::USCO_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioComplemento::USCO_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioComplemento::USCO_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

}
?>




