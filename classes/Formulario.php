<?php 

class Formulario{
    private $emailuser;
    private $senhagmail;
    private $nomegmail;
    private $tituloemail;

    public function __construct($emailuser, $senhagmail, $nomegmail, $tituloemail )
    {
        $this->emailuser = $emailuser;
        $this->senhagmail = $senhagmail;
        $this->nomegmail = $nomegmail;
        $this->tituloemail = $tituloemail;
    }

    public function getEmailUser(){
        return $this->emailuser;
    }

    public function getSenhaGmail(){
        return $this->senhagmail;
    }

    public function getNomeGmail(){
        return $this->nomegmail;
    }

    public function getTituloEmail(){
        return $this->tituloemail; 
    }
}

