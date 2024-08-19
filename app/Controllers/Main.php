<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function index()
    {

     // check if there is an active session
     if(session()->has('id')) {
        return redirect()->to('/admin');
    }

     // main page
     $data = [];

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
                    'valid_email' => 'Confira o e-mail. Parece não ser válido.'
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

    public function login() 
    {
        // check if there is an active session
        if(session()->has('id')) {
            return redirect()->to('/admin');
        }

        $data = [];

        // check for validation errors
        $validation_errors = session()->getFlashData('validation_errors');
        if($validation_errors) {
            $data['validation_errors'] = $validation_errors;
        }

        // check for login errors
        $login_error = session()->getFlashdata('login_error');
        if($login_error) {
            $data['login_error'] = $login_error;
        }
 
        return view('login_frm', $data);
    }

    public function login_submit() 
    {
        // form validation
        $validation = $this->validate(
            // validation rules
            [
                'text_usuario' => 'required',
                'text_senha' => 'required',
            ],
            // validation errors 
            [
                'text_usuario' => [
                    'required' => 'O campo usuário é obrigatório'
                ],
                'text_senha' => [
                    'required' => 'O campo senha é obrigatório'
                ],
            ]
    );

    if(!$validation) {
        return redirect()->to('login')->withInput()->with('validation_errors', $this->validator->getErrors());
    }
        
        // check if login is valid
        $usuario = $this->request->getPost('text_usuario');
        $senha = $this->request->getPost('text_senha');

        $users_model = new UsersModel();
        $users_data = $users_model->where('usuario', $usuario)->first();

        // if usuário is not found
        if(!$users_data) {
            return redirect()->to('login')->withInput()->with('login_error', 'Usuário ou senha inválidos.');
        }

        // var_dump($users_data->senha);
        // die();

        // if senha is not valid
        if(!password_verify($senha, $users_data->senha)) {
            return redirect()->to('login')->withInput()->with('login_error', 'Usuário ou senha inválidos.');
        }

        // var_dump($users_data->senha);
        // die();

        // login is valid
        $session_data = [
            'id' => $users_data->id,
            'usuario' => $users_data->usuario
        ];
        session()->set($session_data);

        // redirect to home page
        return redirect()->to('/admin');
        
    }

    public function logout() 
    {
        // destroy session
        session()->destroy();

        // redirect to main page
        return redirect()->to('/login');
    }

    public function admin() 
    {
        $data = [];

        $usuarios_model = new UsuariosModel();
        $data['usuarios'] = $usuarios_model->findAll();
        $data['datatables'] = true;
 
        return view('admin', $data);
    }

    // public function search()
    // {
    //     $data = [];

    //     // get search items
    //     $search_term = $this->request->getPost('text_search');

    //     // load usuários from database and the search term
    //     $usuarios_model = new UsuariosModel();
    //     $data['usuarios'] = $usuarios_model->where('id', session()->id)->like('nome', $search_term)->findAll();
    //     $data['datatables'] = true;

    //     return view('admin', $data);
    // }

    public function usuario_details($enc_id) 
    {
        // decrypt usuario id
        $usuario_id = decrypt($enc_id);
        if(!$usuario_id) {
            return redirect()->to('/');
        }

        // load usuario data
        $usuarios_model = new UsuariosModel();
        $usuario_data = $usuarios_model->where('id', $usuario_id)->first();
        if(!$usuario_data) {
            return redirect()->to('/');
        }

        // display usuario
        $data['usuario'] = $usuario_data;

        return view('usuario_details', $data);
    }

    public function create_pdf_report()
    {
       // get usuarios
        $usuarios_model = new UsuariosModel();
        $usuarios = $usuarios_model->findAll();
         
        // generate PDF file
        $pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P'
        ]);

        // set starting coordinates
        $x = 50;    // horizontal
        $y = 50;    // vertical
        $html = "";

        // logo and app name
        $html .= '<div style="position: absolute; left: ' . $x . 'px; top: ' . $y . 'px;">';
        $html .= '<img src="assets/images/logo_32.png">';
        $html .= '</div>';
        $html .= '<h2 style="position: absolute; left: ' . ($x + 50) . 'px; top: ' . ($y - 10) . 'px;">' . APP_NAME . '</h2>';

        // separator
        $y += 50;
        $html .= '<div style="position: absolute; left: ' . $x . 'px; top: ' . $y . 'px; width: 700px; height: 1px; background-color: rgb(200,200,200);"></div>';

        // report title
        $y += 20;
        $html .= '<h3 style="position: absolute; left: ' . $x . 'px; top: ' . $y . 'px; width: 700px; text-align: center;">REPORT DE DADOS DE ' . date('d-m-Y') . '</h4>';

        // -----------------------------------------------------------
        // table cidadãos
        $y += 50;

        $html .= '
            <div style="position: absolute; left: ' . ($x + 90) . 'px; top: ' . $y . 'px; width: 500px;">
                <table style="border: 1px solid black; border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 60%; border: 1px solid black; text-align: left;">Cidadão</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($usuarios as $usuario) {
            $html .=
                '<tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;">' . $usuario->nome . 
                        '<p>CPF: ' . $usuario->cpf . '</p>
                        <p>Bairro: ' . $usuario->bairro . '</p>
                        <p>Telefone: ' . $usuario->telefone . '</p>
                        <p>e-mail: ' . $usuario->email . '</p>
                        <p>Opção: ' . $usuario->opcao . '</p>
                        <p>Sugestão: ' . $usuario->sugestao . '</p>
                    </td>
                </tr>';
            $y += 25;
        }

        $html .= '
            </tbody>
            </table>
            </div>';

        
        $pdf->WriteHTML($html);

        $pdf->Output();

        exit();
    }

}
