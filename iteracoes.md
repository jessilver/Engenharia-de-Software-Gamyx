# Projeto - Rede Social de Desenvolvedores De Jogos
# Iterações

## Navegação

- [Home](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/README.md)
- [Manual do Projeto](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/manual_do_projeto.md)
- [Planejementos](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/planejamentos.md)

## Sumário

- [Iteração 01](#Iteração-01)
  - [feat/cadastro-de-usuario](#Cadastro-de-Usuário)
  - [feat/login-de-usuario](#Login-de-Usuário)
  - [feat/acesso-ao-perfil](#Acesso-ao-Perfil)
  - [feat/vizualizar-perfil-de-outros-usuarios](#Visualização-de-Perfil-de-Outros-Usuários)
  - [adicionais](#Adicionais)

# Iteração 01
<small>[voltar para o Sumário](#Sumário)</small><br>

## Valor: 
Entregar funcionalidades básicas de interação de usuário, incluindo cadastro, login, acesso ao perfil e visualização de perfil de outros usuários.

## Features:

# Cadastro de Usuário
<small>[voltar para o Sumário](#Sumário)</small><br>


## Resposável:
Jônatas De Sousa Madeira

```bash
feat/cadastro-de-usuario
```

## User Story:

### Como um novo usuário, quero me cadastrar no sistema para criar uma conta e poder acessar as funcionalidades disponíveis.

Critérios de Aceitação:
- O sistema deve permitir que o usuário insira dados como nome, email e senha.
- O sistema deve validar os dados inseridos e exibir mensagens de erro apropriadas.
- O usuário deve receber uma confirmação de cadastro bem-sucedido.

## Template:

![Singin](https://github.com/user-attachments/assets/a75e88b4-7413-4a30-a021-f71a2ac02ec4)

## Tarefas:

- Tarefa 1: Design da interface de cadastro.
- Tarefa 2: Implementação da lógica de backend para processamento de dados de cadastro.
- Tarefa 3: Implementação da validação de dados de entrada.
- Tarefa 4: Implementação do envio de confirmação de cadastro.

# Login de Usuário
<small>[voltar para o Sumário](#Sumário)</small><br>

## Resposável:
Gabriel Fernandes Zamora

```bash
feat/login-de-usuario
```

## User Story:

### Como um usuário registrado, quero fazer login para acessar minha conta.

Critérios de Aceitação:
- O sistema deve permitir que o usuário insira email e senha.
- O sistema deve autenticar o usuário e redirecioná-lo para a página principal ou perfil.
- O sistema deve exibir mensagens de erro para credenciais inválidas.
- Acesso ao Perfil

## Template:

![Login](https://github.com/user-attachments/assets/8c408522-d68f-411f-9814-91ed6aabea8e)

## Tarefas:

- Tarefa 1: Design da interface de login.
- Tarefa 2: Implementação da lógica de autenticação.
- Tarefa 3: Implementação de mensagens de erro para login.

# Acesso ao Perfil
<small>[voltar para o Sumário](#Sumário)</small><br>

## Resposável:
Jessé Eliseu Nunes Da Silva

```bash
feat/acesso-ao-perfil
```

## User Story:

### Como um usuário autenticado, quero acessar e visualizar meu perfil.

Critérios de Aceitação:
- O usuário deve ser redirecionado para sua página de perfil após o login.
- O perfil deve exibir informações básicas do usuário (nome, email, etc.).
- O usuário deve ter a opção de editar suas informações de perfil.
- Visualização de Perfil de Outros Usuários

## Template:

![UserProfile](https://github.com/user-attachments/assets/3014d4ff-645b-4ae1-8114-a9f011623615)

## Tarefas:

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação da lógica para exibir informações do perfil.

# Visualização de Perfil de Outros Usuários
<small>[voltar para o Sumário](#Sumário)</small><br>

## Resposável:
Arthur Lima Duarte

```bash
feat/vizualizar-perfil-de-outros-usuarios
```

## User Story:

### Como um usuário autenticado, quero visualizar o perfil de outros usuários.

Critérios de Aceitação:
- O usuário deve ser capaz de buscar e visualizar perfis de outros usuários.
- O perfil exibido deve mostrar informações públicas do usuário.
- A navegação entre perfis deve ser intuitiva.

## Template:

![Perfil dos usuarios](https://github.com/user-attachments/assets/df1e91d1-0975-4662-867a-314e33bc7f6c)

## Tarefas:

- Tarefa 1: Design da interface de visualização de perfil de outros usuários.
- Tarefa 2: Implementação da lógica de busca e visualização de perfis.

# Adicionais
## Jônatas De Sousa Madeira
- **Create**: Cria um novo usuário na tabela.
  
## Arthur Lima Duarte
- **Read**: Faz uma pesquisa no banco por usuário.

## Jessé Eliseu Nunes Da Silva
- **Update**: Editar perfil de usuário.
- Configuração do banco de dados.

## Gabriel Fernandes Zamora
- **Delete**: Deletar perfil de usuário.


