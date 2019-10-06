<?php
class Usuarios_model extends CI_Model{

    public function buscaPorEmailSenha($email, $password){
        $this->db->where('email_usuario', $email);
        $this->db->where('password', $password);
      	$usuario = $this->db->get('users')->row_array();
        return $usuario;
    }

}
