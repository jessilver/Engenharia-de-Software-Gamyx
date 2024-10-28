# Projeto - Rede Social de Desenvolvedores De Jogos
# Iterações

## Navegação

- [Home](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/README.md)
- [Manual do Projeto](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/manual_do_projeto.md)
- [Planejamentos](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/planejamentos.md)

## Sumário

- [Iteração 01](#Iteração-01)
  - [feat/cadastro-de-usuario](#Cadastro-de-Usuário)
  - [feat/login-de-usuario](#Login-de-Usuário)
  - [feat/acesso-ao-perfil](#Acesso-ao-Perfil)
  - [feat/vizualizar-perfil-de-outros-usuarios](#Visualização-de-Perfil-de-Outros-Usuários)
  - [adicionais-it1](#Adicionais-it1)
- [Iteração 02](#Iteração-02)
  - [feat/cadastro-de-projeto](#Cadastro-de-Projeto)
  - [feat/aceaso-ao-projeto](#Acesso-ao-projeto)
  - [feat/editar-projeto](#Editar-projeto)
  - [feat/deletar-projeto](#Deletar-projeto)
  - [adicionais-it2](#Adicionais-it2)
- [Iteração 03](#Iteração-03)
  - [feat/avaliacao-do-projeto](#Avaliacao-do-Projeto)
  - [feat/adicionar-amizade](#Adicionar-amizade)
  - [feat/feed-inicial](#feed-inicial)
  - [feat/filtro-pesquisa-projeto](#Filtro-Pesquisa-Prrojeto)
  - [adicionais-it3](#Adicionais-it3)

# Iteração 01
<small>[voltar para o Sumário](#Sumário)</small><br>

## Valor: 
Entregar funcionalidades básicas de interação de usuário, incluindo cadastro, login, acesso ao perfil e visualização de perfil de outros usuários.

## Features:

# Cadastro de Usuário
<small>[voltar para o Sumário](#Sumário)</small><br>


## Responsável:
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

## Responsável:
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

## Responsável:
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

## Responsável:
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

# Adicionais it1
<small>[voltar para o Sumário](#Sumário)</small><br>

## Jônatas De Sousa Madeira
- **Create**: Cria um novo usuário na tabela.
  
## Arthur Lima Duarte
- **Read**: Faz uma pesquisa no banco por usuário.

## Jessé Eliseu Nunes Da Silva
- **Update**: Editar perfil de usuário.
- Configuração do banco de dados.

# Iteração 02
<small>[voltar para o Sumário](#Sumário)</small><br>

## Valor: 
Permitir que o usuário logado possa criar, visualizar, editar e deletar um projeto

## Features:

# Cadastro de Projeto
<small>[voltar para o Sumário](#Sumário)</small><br>


## Responsável:
Jônatas De Sousa Madeira

```bash
feat/cadastro-de-usuario
```

## User Story:

### Como um usuário logado, quero criar um novo projeto no sistema.

Critérios de Aceitação:
- O sistema deve permitir que o usuário insira dados como nome do projeto, descrição e link do projeto (github ou itch.io).
- O usuário deve receber uma confirmação de criação bem-sucedida.

## Template:

![CadastrarProjeto](https://github.com/user-attachments/assets/8b3db6e3-2667-4173-8709-21c8d630ca56)

## Tarefas:

- Tarefa 1: Design da interface de criação do projeto.
- Tarefa 2: Implementação da lógica de backend para processamento de dados.
- Tarefa 3: Implementação do envio da confirmação de criação.

# Acesso ao projeto
<small>[voltar para o Sumário](#Sumário)</small><br>

## Responsável:
Arthur Lima Duarte

```bash
feat/view-project
```

## User Story:

### Como um usuário logado, quero acessar e visualizar meu projeto.

Critérios de Aceitação:
- O usuário deve ser redirecionado para sua página de visualização do projeto.
- O usuário deve ter a opção de editar as informações do projeto.

## Template:

![VisualizarProjeto](https://github.com/user-attachments/assets/76fa98cd-6026-4100-b8ee-6b93179474e0)

## Tarefas:

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação da lógica para exibir informações do projeto.

# Editar projeto
<small>[voltar para o Sumário](#Sumário)</small><br>

## Responsável:
Jessé Eliseu Nunes Da Silva

```bash
feat/edit-project
```

## User Story:

### Como um usuário logado, quero editar um projeto existente.

Critérios de Aceitação:
- O usuário deve ser capaz de alterar informações do projeto.
- Confirmação de salvar alterações.
- O usuário deve receber feedback com a confirmação de alteração

## Template:

![EditarProjeto](https://github.com/user-attachments/assets/c57868aa-724c-4b7c-9cb1-b1dcce01b216)

## Tarefas:

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação da lógica para exibir informações existentes do projeto.
- Tarefa 3: Implementação da lógica de backend para processamento de dados.
- Tarefa 4: Implementação do envio da confirmação de alterações.

# Deletar projeto
<small>[voltar para o Sumário](#Sumário)</small><br>

## Responsável:
Gabriel Fernandes Zamora

```bash
feat/login-do-usuario
```

## User Story:

### Como um usuário logado, quero deletar um projeto existente.

Critérios de Aceitação:
- O usuário deve ser capaz de deletar um projeto.
- Confirmação de deletar projeto.
- O usuário deve receber feedback com a confirmação de deleção.

## Template:


## Tarefas:

- Tarefa 1: Design da interface de perfil.
- Tarefa 2: Implementação do envio da confirmação de deleção.

# Adicionais it2
<small>[voltar para o Sumário](#Sumário)</small><br>
  
## Gabriel Fernandes Zamora
- **Menu**: Implementação da barra de menu lateral

![MenuLateral](https://github.com/user-attachments/assets/e53a8ef4-444b-48ff-94d2-31aede58ae09)

![exemplo](https://github.com/user-attachments/assets/84968a81-992d-4e82-b3d5-e8342c8fc94a)

# Iteração 03
<small>[voltar para o Sumário](#Sumário)</small><br>

## Valor: 
Permitir que o usuário tenha acceso ao feed mais filtros de pesquisa de projetos e adicionar amizades

## Features:

# Avaliacao do Projeto
<small>[voltar para o Sumário](#Sumário)</small><br>


## Responsável:
Gabriel Fernandes Zamora

```bash
feat/avaliacao-do-projeto
```

## User Story:

### Como um usuário logado, quero avaliar um projeto

Critérios de Aceitação:
- O sistema deve permitir que o usuário visualize e avalie um projeto.

## Template:

## Tarefas:

- Tarefa 1: Design da interface de avaliação do projeto.
- Tarefa 2: Implementação da lógica de backend para processamento de dados.

# Adicionar Amizade
<small>[voltar para o Sumário](#Sumário)</small><br>

## Responsável:
Jessé Eliseu Nunes Da Silva

```bash
feat/adicionar-amizade
```

## User Story:

### Como um usuário logado, quero acessar quero adicionar uma novo amizade.

Critérios de Aceitação:
- O usuário deve poder adicionar uma nova amizade.

## Template:


## Tarefas:

- Tarefa 1: Design da interface de adiconar uma amizade.
- Tarefa 2: Implementação da lógica de backend para processamento de dados.

# Feed inicial
<small>[voltar para o Sumário](#Sumário)</small><br>

## Responsável:
Jônatas De Sousa Madeira

```bash
feat/feed-inicial
```

## User Story:

### Como um usuário logado, quero ter accesso ao feed.

Critérios de Aceitação:
- O usuário deve ser capaz de visualizar os projetos no feed.

## Template:


## Tarefas:

- Tarefa 1: Design da interface.
- Tarefa 2: Implementação da lógica para exibir informações dos projetos.

# Filtro Pesquisa Projeto
<small>[voltar para o Sumário](#Sumário)</small><br>

## Responsável:
Arthur Lima Duarte

```bash
feat/filtro-pesquisa-projeto
```

## User Story:

### Como um usuário logado, quero ter filtro para procurar determinados tipos de projetos.

Critérios de Aceitação:
- O usuário deve ser capaz de filtrar projetos.

## Template:


## Tarefas:

- Tarefa 1: Design da interface.
- Tarefa 2: Implementação da logica backend para processamento de dados.

