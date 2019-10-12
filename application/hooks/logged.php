<?php

function logged() {
    //Instância do CodeIgniter
    $ci = & get_instance();
    //Método atual
    $method = $ci->router->fetch_class().'/'.$ci->router->fetch_method();
    //Métodos protegidos
    $protegidos = ['demografico/index','demografico/inserir','demografico/editar', 'demografico/atualizar','demografico/deletar'];
    
    //Array gerado pelo seu algotitmo de "login" e gravado na SESSION
    $usuario_logado = $ci->session->userdata('usuario_logado');
    if (in_array($method, $protegidos)) {//Verificando se o método é protegido
        if ($usuario_logado['nome_usuario']=='not_autorized') {//Verificando se o usuário está logado
            $ci->session->set_flashdata('alert', 'Autentique-se, por favor!');//Aqui vc tb pode criar um aviso pro usuário saber o motivo do comportamento da aplicação
            Redirect('http://localhost/sistema/');//usuário não logado direciona para a pagina de login
        } 
    }
}
?>
