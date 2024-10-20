﻿# Projeto - Rede Social de Desenvolvedores De Jogos
# Planejamentos

## Navegação

- [Home](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/README.md)
- [Iterações](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/iteracoes.md)
- [Manual do Projeto](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/manual_do_projeto.md)

## Sumário

- [P1](#planejamento-iteração-01)
- [P2](#planejamento-iteração-02)

# Planejamentos
<small>[voltar para o Sumário](#Sumário)</small><br>

# Planejamento Iteração 01

## Valor da Sprint: 
Entregar funcionalidades básicas de interação de usuário, incluindo cadastro, login, acesso ao perfil e visualização de perfil de outros usuários.

## 1. Backlog da Sprint

### Cadastro de Usuário

Como um novo usuário, quero me cadastrar no sistema para criar uma conta e poder acessar as funcionalidades disponíveis.

Critérios de Aceitação:
- O sistema deve permitir que o usuário insira dados como nome, email e senha.
- O sistema deve validar os dados inseridos e exibir mensagens de erro apropriadas.
- O usuário deve receber uma confirmação de cadastro bem-sucedido.
- Login de Usuário

### Como um usuário registrado, quero fazer login para acessar minha conta.

Critérios de Aceitação:
- O sistema deve permitir que o usuário insira email e senha.
- O sistema deve autenticar o usuário e redirecioná-lo para a página principal ou perfil.
- O sistema deve exibir mensagens de erro para credenciais inválidas.
- Acesso ao Perfil

### Como um usuário autenticado, quero acessar e visualizar meu perfil.

Critérios de Aceitação:
- O usuário deve ser redirecionado para sua página de perfil após o login.
- O perfil deve exibir informações básicas do usuário (nome, email, etc.).
- O usuário deve ter a opção de editar suas informações de perfil.
- Visualização de Perfil de Outros Usuários

### Como um usuário autenticado, quero visualizar o perfil de outros usuários.

Critérios de Aceitação:
- O usuário deve ser capaz de buscar e visualizar perfis de outros usuários.
- O perfil exibido deve mostrar informações públicas do usuário.
- A navegação entre perfis deve ser intuitiva.

## 2. Tarefas

### Cadastro de Usuário

- Tarefa 1: Design da interface de cadastro.
- Tarefa 2: Implementação da lógica de backend para processamento de dados de cadastro.
- Tarefa 3: Implementação da validação de dados de entrada.
- Tarefa 4: Implementação do envio de confirmação de cadastro.

### Login de Usuário

- Tarefa 1: Design da interface de login.
- Tarefa 2: Implementação da lógica de autenticação.
- Tarefa 3: Implementação de mensagens de erro para login.

### Acesso ao Perfil

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação da lógica para exibir informações do perfil.

### Visualização de Perfil de Outros Usuários

- Tarefa 1: Design da interface de visualização de perfil de outros usuários.
- Tarefa 2: Implementação da lógica de busca e visualização de perfis.

# Planejamento Iteração 02

## Valor da Sprint: 
Permitir que o usuário logado possa criar, visualizar, editar e deletar um projeto

## 1. Backlog da Sprint

### Como um usuário logado, quero criar um novo projeto no sistema.

Critérios de Aceitação:
- O sistema deve permitir que o usuário insira dados como nome do projeto, descrição e link do projeto (github ou itch.io).
- O usuário deve receber uma confirmação de criação bem-sucedida.

### Como um usuário logado, quero acessar e visualizar meu projeto.

Critérios de Aceitação:
- O usuário deve ser redirecionado para sua página de visualização do projeto.
- O usuário deve ter a opção de editar as informações do projeto.

### Como um usuário logado, quero editar um projeto existente.

Critérios de Aceitação:
- O usuário deve ser capaz de alterar informações do projeto.
- Confirmação de salvar alterações.
- O usuário deve receber feedback com a confirmação de alteração

### Como um usuário logado, quero deletar um projeto existente.

Critérios de Aceitação:
- O usuário deve ser capaz de deletar um projeto.
- Confirmação de deletar projeto.
- O usuário deve receber feedback com a confirmação de deleção.

## 2. Tarefas

### Criação de projeto

- Tarefa 1: Design da interface de criação do projeto.
- Tarefa 2: Implementação da lógica de backend para processamento de dados.
- Tarefa 3: Implementação do envio da confirmação de criação.

### Acesso ao projeto

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação da lógica para exibir informações do projeto.

### Editar projeto

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação da lógica para exibir informações existentes do projeto.
- Tarefa 3: Implementação da lógica de backend para processamento de dados.
- Tarefa 4: Implementação do envio da confirmação de alterações.

### Deletar projeto

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação do envio da confirmação de deleção.



