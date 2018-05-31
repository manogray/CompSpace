<?php

  $target="Usuario.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }
  
  class Usuario{
    public $ID;
    public $Nome;
    public $Nickname;
    public $Email;
    public $Genero;
    public $Nascimento;
    public $Estado;
    public $Cidade;
    public $Universidade;
    public $Curso;
    public $Tipo;
    public $Favoritos;
    public $Perfil;

    public function __construct($ID, $Nome, $Nickname, $Email, $Genero, $Nascimento, $Estado, $Cidade, $Universidade, $Curso, $Tipo, $Favoritos, $Perfil){
      $this->ID = $ID;
      $this->Nome = $Nome;
      $this->Nickname = $Nickname;
      $this->Email = $Email;
      $this->Genero = $Genero;
      $this->Nascimento = $Nascimento;
      $this->Estado = $Estado;
      $this->Cidade = $Cidade;
      $this->Universidade = $Universidade;
      $this->Curso = $Curso;
      $this->Tipo = $Tipo;
      $this->Favoritos = $Favoritos;
      $this->Perfil = $Perfil;
    }
    
    public function altera($campo,$novoValor){
        $this->$campo = $valor;
    }
    
  }

?>