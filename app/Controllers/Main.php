<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function index()
    {
         // main page
     $data = [];

     return view('main', $data);
    }

    public function processar_frm() 
    {
        // get form data
        $nome = $this->request->getPost('nome');
        $cpf = $this->request->getPost('cpf');
        $bairro = $this->request->getPost('bairro');
        $telefone = $this->request->getPost('telefone');
        $email = $this->request->getPost('email');
        $opcao = $this->request->getPost('opcao');
        $sugestao = $this->request->getPost('sugestao');


        // save data
        $usuarios_model = new UsuariosModel();
        $usuarios_model->insert([
            'nome' => $nome,
            'cpf' => $cpf,
            'bairro' => $bairro,
            'telefone' => $telefone,
            'email' => $email,
            'opcao' => $opcao,
            'sugestao' => $sugestao
        ]);

        // redirect to home page
        return redirect()->to('/');
    }
}
