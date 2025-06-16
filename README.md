# Sistema de Gestão de Livros

Um sistema web para gerenciamento de livros com autenticação de usuários.

## Funcionalidades

- Cadastro de novos usuários
- Login e logout de usuários
- Cadastro de livros (título, autor, descrição e ano de publicação)
- Listagem dos livros cadastrados
- Edição de livros
- Exclusão de livros
- Proteção de páginas restritas (apenas para usuários logados)

## Requisitos

- PHP 7.4 ou superior
- MySQL/MariaDB
- Servidor web (Apache/Nginx)

## Instalação

1. Importar o arquivo `bd_livros.sql` para criar o banco de dados e as tabelas
2. Configurar as credenciais do banco de dados no arquivo `config.php` se necessário
3. Acessar o sistema através do navegador

## Usuários de Teste

- Administradores:
  - rick (senha: rick123)
  - dezin (senha: dezin123)

- Usuário comum:
  - user (senha: user123)

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
