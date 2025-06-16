# Sistema de Gestão de Livros

## Desenvolvido por:
- RGM 37701568 - RICARDO AUGUSTO MATIAS DA LUZ
- RGM 39483380 - ANDRÉ AUGUSTINHO DA COSTA

## Descrição
Sistema web para gestão de livros com autenticação de usuários e controle de acesso.

## Requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Apache ou outro servidor web
- Bootstrap 5.1.3

## Instalação

1. Importar o arquivo `bd_livros.sql` ou usar `criar_banco.php` para criar o banco de dados e as tabelas
2. Configurar as credenciais do banco de dados no arquivo `config.php` se necessário
3. Acessar o sistema através do navegador em:
   - http://localhost/aula/trab2/login.php

## Passos para Importar o Banco

1. Acesse o phpMyAdmin (http://localhost/phpmyadmin)
2. Clique em "Importar"
3. Selecione o arquivo `bd_livros.sql`
4. Clique em "Executar"

Ou use o script `criar_banco.php`:
1. Acesse http://localhost/aula/trab2/criar_banco.php
2. O script criará o banco e as tabelas automaticamente

## Como Usar

1. Acesse o sistema através do navegador em:
```
http://localhost/aula/trab2/login.php
```

2. Faça login com um dos usuários de teste

3. Após o login, você poderá:
   - Visualizar livros cadastrados
   - Cadastrar novos livros
   - Editar seus próprios livros
   - Excluir seus próprios livros
   - Usuários com privilégios podem cadastrar novos usuários

## Funcionalidades

- Autenticação de usuários com sistema de privilégios
- Cadastro de novos usuários (apenas para usuários com privilégios)
- Cadastro de livros (título, autor, descrição e ano de publicação)
- Listagem dos livros cadastrados
- Edição de livros (apenas próprios livros)
- Exclusão de livros (apenas próprios livros)
- Interface responsiva com Bootstrap 5
- Sistema de sessões para controle de acesso
- Validação de dados em formulários
- Proteção contra acesso não autorizado

## Segurança

- Senhas são armazenadas com hash
- Uso de prepared statements para prevenir SQL injection
- Proteção contra CSRF em formulários
- Sessões seguras com verificação de estado
- Validação de dados de entrada
- Proteção contra acesso direto a arquivos restritos

## Estrutura do Projeto

```
aula/trab2/
├── config.php          # Configurações do sistema
├── login.php          # Login
├── cadastro.php       # Cadastro de usuários
├── logout.php         # Logout
├── livros.php         # Lista de livros
├── novo_livro.php     # Cadastro de livros
├── editar_livro.php   # Edição de livros
├── excluir_livro.php  # Exclusão de livros
├── bd_livros.sql      # Script SQL
├── criar_banco.php    # Script para criar banco
└── README.md          # Documentação
```

## Usuários de Teste

- Administradores (privilegio = 1):
  - rick (senha: 123)
  - dezin (senha: 123)

- Usuário comum (privilegio = 0):
  - user (senha: 123)

## Estrutura do Projeto

- `config.php`: Configurações do sistema e conexão com o banco de dados
- `login.php`: Página de login
- `cadastro.php`: Página de cadastro de novos usuários
- `livros.php`: Página principal com listagem de livros
- `novo_livro.php`: Formulário para cadastro de novos livros
- `editar_livro.php`: Formulário para edição de livros
- `excluir_livro.php`: Script para exclusão de livros
- `logout.php`: Script para encerrar sessão
- `bd_livros.sql`: Script SQL para criação do banco de dados

## Segurança

- Senhas são armazenadas criptografadas usando `password_hash()`
- Uso de prepared statements para prevenir SQL injection
- Validação de dados nos formulários
- Proteção contra acesso não autorizado às páginas restritas
- Uso de sessões para controle de autenticação
