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

     // check for validation errors
     $validation_errors = session()->getFlashdata('validation_errors');
     if($validation_errors) {
         $data['validation_errors'] = $validation_errors;
     }

     return view('main', $data);
    }

    public function processar_frm() 
    {
        // form validation
        $validation = $this->validate([
            'nome' => [
                'label' => 'Nome',
                'rules' => 'required|min_length[5]|max_length[200]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'min_length' => 'O campo {field} deve ter no mínimo {param} caracteres.',
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
                ]
            ],
            'cpf' => [
                'label' => 'CPF',
                'rules' => 'max_length[14]',
                'errors' => [
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
                ]
            ],
            'bairro' => [
                'label' => 'Bairro',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'min_length' => 'O campo {field} deve ter no mínimo {param} caracteres.',
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
                ]
            ],
            'telefone' => [
                'label' => 'Telefone',
                'rules' => 'max_length[15]',
                'errors' => [
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
                ]
            ],
            'email' => [
                'label' => 'e-mail',
                'rules' => 'required|max_length[254]|valid_email',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
                    'valid_email' => 'Confira o e-mail . Parece não ser válido.'
                ]
            ],
            'sugestao' => [
                'label' => 'Sugestão',
                'rules' => 'max_length[500]',
                'errors' => [
                    'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
                ]
            ]

        ]);

        if(!$validation) {
            return redirect()->back()->withInput()->with('validation_errors', $this->validator->getErrors());      
       }

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
