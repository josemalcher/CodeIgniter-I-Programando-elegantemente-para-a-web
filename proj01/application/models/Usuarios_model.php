<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{

    public function salvar($usuario)
    {
        $this->db->insert("usuario", $usuario);
        
        
    }


}