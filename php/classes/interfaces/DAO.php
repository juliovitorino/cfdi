<?php


/**
 * DAO - Métodos obrigatórios de acesso a dados
 */
interface DAO
{
	
	public function insert($dto);
	public function delete($dto);
	public function load($dto);
	public function loadPK($id);
	public function update($dto);
	public function getDTO($resultset);
	public function listAll();
	public function listPagina($sql, $pag, $qtde);

}
?>