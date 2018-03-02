<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

    public function autenticar()
    {
        $this->output->enable_profiler(true);
        $this->load->model("usuarios_model");
        $email = $this->input->post("email");
        $senha = md5($this->input->post("senha"));
        $usuario = $this->usuarios_model->buscaPorEmailSenha($email,$senha);

        if($usuario){
            //$this->session->set_userdata(array("usuario_logado" => $usuario));
            $this->session->set_userdata("usuario_logado" , $usuario);
            $dados = array("mensagem"=> "Login com sucesso");
        }else{
            $dados = array("mensagem" => "usuário ou senha incorretos!");
        }

        $this->load->view("login/autenticar", $dados);


    }

}