# API REST em PHP 7.3.x

API REST desenvolvida à fim de aprender conceitos relacionadas à webservice na linguagem PHP.

Não segue nenhum modelo arquitetural de software, como MVC por exemplo. 

Utilização de conceitos como Repository, Service, Validator e Util.

## Utilização

Alterar o arquivo bootstrap.php na pasta raíz, para configuração dos dados do ambiente.
Criar o banco api e importar o script db.backup


## Características e tecnologias

* PHP 7.3.x
* Modelo REST
* Orientação à Objetos(POO)
* Clean Code
* JSON
* Autoloading de classes
* Namespaces
* PDO
* PostgreSQL
* Bearer Authentication
* Métodos GET, PUT, POST e DELETE

### Rotas

* **GET**

* /usuarios/listar

* /usuarios/listar/{id}

* **DELETE**

* /usuarios/deletar/{id}

* **POST**

* /usuarios/cadastrar

* **PUT**

* /usuarios/atualizar/{id}