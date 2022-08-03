<?php
namespace Microblog;

use PDO, Exception;


final class Noticia {
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private int $categoriaId;

    /* Criando uma propriedade do tipo Usuario, ou seja, a parir de uma classe que criamos
    com o objetivo de reutilizar recursos dela */
    
    public Usuario $usuario;

    private PDO $conexao;

    public function __construct()
    {
        /* No momeno que um objeto noticia for instanciado nas paginas,
        aproveitaremos para também instanciar um objeto Usuario e com isso acessar recursso desta classe */
        $this->usuario = new Usuario;

        $this->conexao = $this->usuario->getConexao();
    }






}

