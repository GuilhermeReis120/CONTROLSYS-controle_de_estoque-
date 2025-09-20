# ControlSys - Sistema de Controle de Estoque

> **⚠️ Atenção:** Este projeto é um trabalho em andamento. As funcionalidades descritas estão sendo desenvolvidas e podem conter bugs ou estarem incompletas.

## 📝 Descrição

**ControlSys** é um sistema web para gerenciamento de estoque, desenvolvido em PHP. O objetivo é criar uma ferramenta intuitiva para controlar a entrada e saída de produtos, gerenciar usuários com diferentes níveis de acesso e fornecer um dashboard com informações relevantes.

Atualmente, o sistema conta com a base de autenticação de usuários, permitindo o cadastro e login de forma segura.

## ✨ Funcionalidades

### Implementadas
- **Autenticação de Usuários:**
  - Tela de login para acesso ao sistema.
  - Formulário de cadastro de novos usuários.
  - Criptografia de senhas utilizando `PASSWORD_ARGON2ID` para maior segurança.
  - Validação de dados e tratamento de erros (ex: e-mail duplicado, campos vazios).
  - Gerenciamento de sessão de usuário após o login.
- **Estrutura Front-end:**
  - Layout principal com menu lateral (sidebar) para navegação.
  - Design responsivo e estilização moderna com CSS e Google Fonts.

### Planejadas
- **Dashboard:** Painel principal com estatísticas e resumos do estoque.
- **Gerenciamento de Produtos (CRUD):**
  - Listagem de todos os produtos.
  - Cadastro de novos produtos.
  - Edição de informações de produtos existentes.
  - Remoção de produtos.
- **Controle de Acesso:** Restringir páginas e funcionalidades com base no nível de acesso do usuário.
- **Movimentação de Estoque:** Módulos para registrar entrada e saída de itens.

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8+
- **Banco de Dados:** MySQL
- **Frontend:** HTML5, CSS3
- **Servidor Local (Ambiente de Desenvolvimento):** XAMPP

## 🚀 Como Executar o Projeto

1.  **Pré-requisitos:**
    - Ter um ambiente de servidor local como XAMPP, WAMP ou Laragon instalado.
    - Ter o Git instalado (opcional, para clonar o projeto).

2.  **Clone o Repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/seu-repositorio.git](https://github.com/seu-usuario/seu-repositorio.git)
    ```
    Ou simplesmente baixe e extraia os arquivos na pasta `htdocs` do seu XAMPP.

3.  **Configure o Banco de Dados:**
    - Abra o `phpMyAdmin` (ou outro cliente MySQL).
    - Crie um novo banco de dados chamado `controleestoque`.
    - Execute o seguinte script SQL para criar a tabela de usuários:
      ```sql
      CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Nome VARCHAR(255) NOT NULL,
        Email VARCHAR(255) NOT NULL UNIQUE,
        Senha VARCHAR(255) NOT NULL,
        acesso INT NOT NULL
      );
      ```

4.  **Verifique a Conexão:**
    - O arquivo de conexão `config/db/conexao_db.php` está configurado para um ambiente XAMPP padrão (usuário `root`, sem senha). Se suas credenciais forem diferentes, atualize este arquivo.

5.  **Acesse o Sistema:**
    - Inicie os módulos Apache e MySQL no seu painel XAMPP.
    - Abra o navegador e acesse `http://localhost/NOME_DA_PASTA_DO_PROJETO/public/`.

## 📂 Estrutura de Pastas