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

    public function inserir():void {
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, destaque, usuario_id, cateoria_id)
        VALUES(:titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :cateoria_id)";
            try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindParam(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindParam(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindParam(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(":destaque", $this->destaque, PDO::PARAM_STR);
            $consulta->bindParam(":categoria_id", $this->categoria_Id, PDO::PARAM_INT);
            

            /* Aqui, primeiro chamamos o Getter de ID a partir do objeto/classe de Usuario. 
            E só depois atribuimos ele ao parâmentro :usuario_id usando para isso o bindValue. 
            Obs: bindParam pode ser usado, mas há riscos de erro devido a forma com oele é executado pelo PHP.
            Por isso, recomenda-se o uso do bindValue em situações como essa.  */

            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            $consulta->execute();

            } catch (Exception $erro) {
                die("Erro: ". $erro->getMessage());
            }
    }







    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo)
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    public function getTexto(): string
    {
        return $this->texto;
    }


    public function setTexto(string $texto)
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


    public function getResumo(): string
    {
        return $this->resumo;
    }


    public function setResumo(string $resumo)
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem)
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }

    public function getDestaque(): string
    {
        return $this->destaque;
    }


    public function setDestaque(string $destaque)
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }


    public function setCategoriaId(int $categoriaId)
    {
        $this->categoriaId = filter_var($categoriaId, FILTER_SANITIZE_NUMBER_INT);

        return $this;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        return $this;
    }
}

