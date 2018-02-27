<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends CI_Controller{

    public function index(){

        $produtos = array();

        $bola = array("nome" => "BOla de Futebol", "descricao"=> "Bola de futebol assinada pelo zico", "preco"=>300);
        $hd = array(  "nome" => "HD Externo",      "descricao" => "HD Externo de 500 GB ",             "preco" => 500);

        array_push($produtos, $bola, $hd);

        $dados = array("produtos" => $produtos);

        $this->load->view("produtos/index.php",$dados);
    }

}