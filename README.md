# ControlSys - Sistema de Controle de Estoque

> **⚠️ Atenção:** Este projeto é um trabalho em andamento. As funcionalidades descritas estão sendo desenvolvidas e podem conter bugs ou estarem incompletas.

## 📝 Descrição

**ControlSys** é um sistema web para gerenciamento de estoque, desenvolvido em PHP. O objetivo é criar uma ferramenta intuitiva para controlar a entrada e saída de produtos, gerenciar usuários com diferentes níveis de acesso e fornecer um dashboard com informações relevantes.

Atualmente, o sistema conta com a base de autenticação de usuários, permitindo o cadastro, login e recuperação de senha de forma segura.

## ✨ Funcionalidades

### Implementadas
- **Autenticação de Usuários:**
  - Tela de login para acesso ao sistema.
  - Formulário de cadastro de novos usuários.
  - Funcionalidade de "Esqueci minha senha" com envio de e-mail para redefinição.
  - Criptografia de senhas utilizando `PASSWORD_ARGON2ID` para maior segurança.
  - Validação de dados e tratamento de erros (ex: e-mail duplicado, campos vazios).
  - Gerenciamento de sessão de usuário após o login.
- **Estrutura Front-end:**
  - Layout principal com menu de navegação superior.
  - Design responsivo e estilização moderna com CSS e Google Fonts.

### Planejadas
- **Dashboard:** Painel principal com estatísticas e resumos do estoque.
- **Gerenciamento de Produtos (CRUD):**
  - Listagem, cadastro, edição e remoção de produtos.
- **Controle de Acesso:** Restringir páginas e funcionalidades com base no nível de acesso do usuário.
- **Movimentação de Estoque:** Módulos para registrar entrada e saída de itens.

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8+
- **Banco de Dados:** MySQL
- **Frontend:** HTML5, CSS3
- **Containerização:** Docker, Docker Compose
- **Dependências:** PHPMailer

## 🚀 Como Executar com Docker (Recomendado)

A maneira mais simples de executar o projeto é utilizando Docker, que garante um ambiente consistente.

1.  **Pré-requisitos:**
    - Ter o Docker e o Docker Compose instalados.

2.  **Clone o Repositório:**
    ```bash
    git clone [https://github.com/guilhermereis120/controlsys-controle_de_estoque-.git](https://github.com/guilhermereis120/controlsys-controle_de_estoque-.git)
    cd controlsys-controle_de_estoque-
    ```

3.  **Instale as Dependências do Composer:**
    Antes de construir a imagem Docker, é necessário que a pasta `vendor` exista.
    ```bash
    docker run --rm --interactive --tty \
      --volume $PWD:/app \
      composer install --ignore-platform-reqs
    ```

4.  **Inicie os Containers:**
    ```bash
    docker-compose up -d --build
    ```

5.  **Configure o Banco de Dados:**
    - O banco de dados `controleestoque` será criado automaticamente.
    - Acesse o phpMyAdmin em `http://localhost:8081` e execute o seguinte script SQL para criar a tabela de usuários:
      ```sql
      CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Nome VARCHAR(255) NOT NULL,
        Email VARCHAR(255) NOT NULL UNIQUE,
        Senha VARCHAR(255) NOT NULL,
        nivel_acesso INT NOT NULL,
        reset_token VARCHAR(255) DEFAULT NULL,
        reset_token_expires_at DATETIME DEFAULT NULL
      );
      ```

6.  **Acesse o Sistema:**
    - Abra o navegador e acesse `http://localhost:8080`.

## 📂 Estrutura de Pastas

```
PROJETO_CONTROLE_ESTOQUE/
│
├── config/                 # Arquivos de configuração (ex: conexão com BD)
│   └── db/
│       └── conexao_db.php
│
├── public/                 # Pasta pública, acessível pelo navegador
│   ├── css/
│   ├── handlers/           # Scripts que recebem submissões de formulários
│   └── index.php           # Página de login (ponto de entrada)
│
├── src/                    # Código fonte da aplicação
│   ├── Controllers/        # Lógica de negócio
│   ├── Models/             # Interação com o banco de dados
│   ├── Templates/          # Partes reutilizáveis do layout
│   └── auth/               # Scripts de autenticação e segurança
│
├── vendor/                 # Dependências do Composer
│
├── .gitignore
├── composer.json           # Definição de dependências do PHP
├── Dockerfile              # Instruções para construir a imagem da aplicação
└── docker-compose.yml      # Orquestração dos containers (app, db, phpmyadmin)
```