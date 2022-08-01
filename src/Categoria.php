<?php
namespace Microblog;
use PDO, Exception;
require_once "../inc/cabecalho-admin.php";


final class Categoria{
    private int $id;
    private string $nome;

    public function __construct()
{
    $this->conexao = Banco::conecta();      
}

public function listar():array {
    $sql = "SELECT id, nome FROM categorias ORDER BY nome";

    try {
        $consulta = $this->conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro){
        die("Erro: ". $erro->getMessage());
    }
    return $resultado;
    }



































public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    }



}



