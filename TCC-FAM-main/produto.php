<?php

class Produto {
      
    private string $classificacao;    
    private string $nome;    
    private string $descprod;    
    private string $img_prod;
    
    public function __construct(
                                string $classificacao, 
                                string $nome, 
                                string $descprod, 
                                string $img_prod = "logo.png")
    {
        $this->classificacao = $classificacao;
        $this->nome = $nome;
        $this->descprod = $descprod;
        $this->img_prod = $img_prod;
    }


    /**
     * Get the value of classificacao
     */
    public function getClassificacao(): string
    {
        return $this->classificacao;
    }

    /**
     * Set the value of classificacao
     */
    public function setClassificacao(string $classificacao): self
    {
        $this->classificacao = $classificacao;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descprod
     */
    public function getDescprod(): string
    {
        return $this->descprod;
    }

    /**
     * Set the value of descprod
     */
    public function setDescprod(string $descprod): self
    {
        $this->descprod = $descprod;

        return $this;
    }

    /**
     * Get the value of imagem
     */
    public function getImg_prod(): string
    {
        return $this->img_prod;
    }

    public function getImg_prodDiretorio(): string
    {
        return "../imagens/".$this->img_prod;
    }

    /**
     * Set the value of imagem
     */
    public function setImg_prod(string $img_prod): self
    {
        $this->img_prod = $img_prod;

        return $this;
    }
}
?>