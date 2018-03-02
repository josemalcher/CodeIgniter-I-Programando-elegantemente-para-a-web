# CodeIgniter I Programando elegantemente para a web

https://www.alura.com.br/curso-online-codeigniter

---

## <a name="indice">Índice</a>

- [Introdução ao Code Igniter](#parte1)   
- [Conectando no Banco de Dados](#parte2)   
- [Helpers](#parte3)   
- [O Padrão MVC](#parte4)   
- [Adicionando usuários](#parte5)   
- [Profiling](#parte6)   
- [Implementando o Login](#parte7)   
- [Logout e FlashData](#parte8)   
- [Adicionando produtos](#parte9)   



---

## <a name="parte1">Introdução ao Code Igniter</a>

- https://codeigniter.com/

---->>> Fiz todos os ajustes iniciais na pasta config e do banco!

#### proj01/application/controllers/Produtos.php
```php
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
```

#### proj01/application/views/produtos/index.php

```php
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-sca le=1">
    <meta name="description" content="Curso CI">
    <meta name="author" content="José Malcher Jr.">

    <title>Site Institucional</title>

    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

</head>
<body>

    <div class="container">

        <h1>Produtos</h1>
        <table class="table">
            <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td><?= $produto["nome"]; ?></td>
                    <td><?= $produto["preco"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>


<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/ie10-viewport-bug-workaround.js')?>"></script>
</body>
</html>
```

[Voltar ao Índice](#indice)

---

## <a name="parte2">Conectando no Banco de Dados</a>

```sql
CREATE TABLE usuario (id INTEGER AUTO_INCREMENT PRIMARY KEY , nome VARCHAR(255), email VARCHAR(255), senha VARCHAR(255));
CREATE TABLE produtos(id INTEGER AUTO_INCREMENT PRIMARY KEY , nome VARCHAR(255), descricao TEXT, preco DECIMAL(10,2), usuario_id INTEGER);

INSERT INTO usuario VALUES (1, 'josemalcher', 'email@josemalcher.net', 'e10adc3949ba59abbe56e057f20f883e');

INSERT INTO produtos VALUES (1, 'Bola de futebol', 'bola de futebol assinada pelo zico', 300, 1);
INSERT INTO produtos VALUES (2, 'HD EXTERNO', 'HD Externo de 500 GB', 400, 1);
INSERT INTO produtos VALUES (3, 'Garrafa Terminca', 'Garrafa Termica Personalizada', 50, 1);
```

```php
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class produtos_model extends CI_Model{

    public function buscaTodos(){
        return $this->db->get("produtos")->result_array();
    }


}
```

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends CI_Controller{

    public function index(){

        $this->load->database();
        $this->load->model('produtos_model');

        $produtos = $this->produtos_model->buscaTodos();

        $dados = array("produtos" => $produtos);

        $this->load->view("produtos/index.php",$dados);
    }

}
```

[Voltar ao Índice](#indice)

---

## <a name="parte3">Helpers</a>

#### \proj01\application\helpers\currency_helper.php

```php
<?php

function numeroEmReais($numero){
    return "R$ " . number_format($numero, 2, ",", ".");
}
```

#### proj01\application\controllers\Produtos.php

```php
$this->load->helper(array('url', 'currency_helper'));
```

#### proj01\application\views\produtos\index.php
```php 

    <td><?= numeroEmReais($produto["preco"]); ?></td>

```

[Voltar ao Índice](#indice)

---

## <a name="parte4">O Padrão MVC</a>


[Voltar ao Índice](#indice)

---

## <a name="parte5">Adicionando usuários</a>

#### proj01/index.php/UsuariosController/novo
```php
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Curso CI">
    <meta name="author" content="José Malcher Jr.">

    <title>Site Institucional</title>

    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

</head>
<body>

    <div class="container">

        <h1>Produtos</h1>
        <table class="table">
            <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td><?= $produto["nome"]; ?></td>
                    <td><?= numeroEmReais($produto["preco"]); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <hr>

        <h1>Cadastro de Usuários</h1>

        <?php 
            echo form_open("UsuariosController/novo");

                echo form_label("Nome:", "nome");
                echo form_input(array(
                    "name"  =>"nome",
                    "id"    =>"nome",
                    "class" =>"form-control",
                    "maxlength"=>"255"
                ));
                echo form_label("Email:", "email");
                echo form_input(array(
                    "name" => "email",
                    "id" => "email",
                    "class" => "form-control",
                    "maxlength" => "255"
                ));
                echo form_label("SENHA:", "senha");
                echo form_password(array(
                    "name" => "senha",
                    "id" => "senha",
                    "class" => "form-control",
                    "maxlength" => "255"
                ));
                echo form_button(array(
                    "class" => "btn btn-primary",
                    "content" => "Cadastrar",
                    "type"  => "submit"
                ));


            echo form_close();
        ?>


    </div>


<script src="<?=base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/ie10-viewport-bug-workaround.js')?>"></script>
</body>
</html>
```

#### proj01\application\controllers\UsuariosController.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsuariosController extends CI_Controller
{

    public function novo()
    { 
        $usuario =  array(
            "nome"  => $this->input->post("nome"),
            "email" => $this->input->post("email"),
            "senha" => md5($this->input->post("senha"))
        );

        $this->load->database();
        $this->load->model('usuarios_model');
        $this->usuarios_model->salvar($usuario); 
        $this->load->view("usuarios/novo");
    }

}
```

#### proj01\application\models\Usuarios_model.php
```php
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{

    public function salvar($usuario)
    {
        $this->db->insert("usuario", $usuario);
    }
}
```

[Voltar ao Índice](#indice)

---

## <a name="parte6">Profiling</a>

#### Habilitar dentro dos controllers

```php
    $this->output->enable_profiler(true); 
```


[Voltar ao Índice](#indice)

---

## <a name="parte7">Implementando o Login</a>


[Voltar ao Índice](#indice)

---

## <a name="parte8">Logout e FlashData</a>


[Voltar ao Índice](#indice)

---

## <a name="parte9">Adicionando produtos</a>


[Voltar ao Índice](#indice)

---