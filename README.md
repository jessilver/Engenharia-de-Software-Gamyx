# Projeto - Rede Social de Desenvolvedores De Jogos

## Sumario

- [Informações Acadêmicas](#informacoes-academicas)
- [Sobre o Projeto](#sobre-o-projeto)
- [Video do projeto funcionando](#video-do-projeto-funcionando)
- [Padrôes](#padroes)
- [Tags](#tags)
- [Requisítos do sistema](#requisitos-do-sistema)
- [Planejamentos](#planejamentos)
- [Como Iniciar o Projeto](#como-iniciar-o-projeto)
- [Criar uma Nova Branch para uma Feature](#criar-uma-nova-branch-para-uma-feature)
- [Realizar um Push](#realizar-um-push)
- [Fazendo o Pull Request](#fazendo-o-pull-request)

## Informacoes Academicas
<small>[voltar para o Sumário](#sumario)</small><br>

- Universidade Federal do Tocantins
- Curso de Bacharelado em Ciência da Computação
- Disciplina de Engenharia de Software
- Turma 2024/2
- Professor Dr. Edeilson Milhomem da Silva

### Integrantes
- Arthur Lima Duarte
- Gabriel Fernades Zamora
- Jessé Eliseu Nunes da Silva
- Jonatas de Sousa Madeira

## Sobre o Projeto
<small>[voltar para o Sumário](#sumario)</small><br>

Este projeto foi desenvolvido utilizando XAMPP 3.3.0,PHP, HTML, CSS, Java Script, BOOTSTRAP 4, Git, e GitHub. O objetivo é criar uma aplicação web cuja funcionalidade é [ ... ], seguindo boas práticas de versionamento de código e organização de projetos.

## Tecnologias Utilizadas

- **[XAMPP 3.3.0](https://www.djangoproject.com/start/):** Para execular o PHP.
- **PHP:** Para o backend e lógica da aplicação.
- **HTML:** Estruturação do conteúdo e das páginas web.
- **CSS:** Estilização das páginas web para uma melhor experiência do usuário.
- **Java Script:** (FRONT END) Estilização das páginas web para uma melhor experiência do usuário.
- **[BOOTSTRAP 4](https://getbootstrap.com/docs/4.0/getting-started/introduction/):** Estilização das páginas web para uma melhor experiência do usuário.
- **Git:** Controle de versão do código.
- **GitHub:** Hospedagem do repositório remoto.
- **Gitflow:** Modelo de ramificação para organização do desenvolvimento. 

## Video do projeto funcionando
<small>[voltar para o Sumário](#sumario)</small><br>

...

# Padroes
<small>[voltar para o Sumário](#sumario)</small><br>

## Padrões de Nomeação de Branches (Ramos)
- Funcionalidade nova:
  ```bash
  feat/nome-da-funcionalidade
  ```
- Correção de bug:
  ```bash
  fix/nome-do-bug
  ```
- Melhoria de código:
  ```bash
  refactor/nome-do-refactor
  ```
- Documentação:
  ```bash
  docs/nome-da-documentação
  ```
- Teste:
  ```bash
  test/nome-do-teste
  ```
## Padrões de Commits
- Funcionalidade:
  ```bash
  feat: Descrição curta da funcionalidade
  ```
- Correção de bug:
  ```bash
  fix: Descrição do bug corrigido
  ```
- Refatoração:
  ```bash
  refactor: Descrição da refatoração de código
  ```
- Documentação:
  ```bash
  docs: Descrição da alteração na documentação
  ```
- Teste:
  ```bash
  test: Descrição dos testes adicionados/alterados
  ```
## Padrões de Versionamento (SemVer)
Seguir a [Semantic Versioning (SemVer)](https://semver.org/):

- Major: Alterações incompatíveis com versões anteriores **(1.x.x)**
- Minor: Novas funcionalidades compatíveis com versões anteriores **(0.1.x)**
- Patch: Correções de bugs compatíveis **(0.0.1)**

## Padrões de Revisão de Código (Code Review)
- Cada pull request deve ter pelo menos uma revisão.

## Convenção de Nomeação
- ### camelCase
  - Usado para nomear variáveis e funções.
  - O primeiro termo é minúsculo, e cada palavra subsequente começa com uma letra maiúscula.
  Ex:
  ```php
  <?php
  $valorTotalCompra = 100;
  $nomeDoUsuario = "João";
  
  function calcularTotal($precoUnitario, $quantidade) {
      return $precoUnitario * $quantidade;
  }
  ?>
  ```
- ### PascalCase
  - usado para nomear classes.
  - Cada palavra começa com letra maiúscula, incluindo a primeira.
  Ex:
  ```php
  <?php
  class UsuarioAtivo {
      // código da classe
  }
  ?>
  ```
- ### UPPER_CASE 
  - usado para nomear costantes.
  - O PHP permite definir constantes com a função define ou usando a palavra-chave const.
  Ex:
  ```php
  <?php
  define('TAXA_CONVERSAO', 0.12);
  const MAXIMO_TENTATIVAS = 5;
  
  echo TAXA_CONVERSAO; // Output: 0.12
  ?>
  ```

# Tags
<small>[voltar para o Sumário](#sumario)</small><br>

- R01 --> Requisito funcional número 01
- NF01 --> Requisito não funcional número 01
- P01/01 --> Planejamento número 01, parte 01

# Requisitos do sistema
<small>[voltar para o Sumário](#sumario)</small><br>

## Funcionais
- R01 - Cadastrar
   - O sistema deve permitir que o usuário consiga se cadastrar
- R02 - Entar
   - O sistema deve permitir que o usuário consiga entrar
   
## Não funcionais
- NF01 - Segurança
   - O sistema deve garantir que os dados dos usuários sejam armazenados de forma segura.

# Planejamentos
<small>[voltar para o Sumário](#sumario)</small><br>

# Planejamento de Sprint - Iteração 01

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

## 3. Planejamento do Trabalho

### It. 1:

- Dia 1-2: Finalização do design da interface (Cadastro, Login, Perfil, Visualização).
- Dia 3-4: Desenvolvimento das funcionalidades de Cadastro e Login.
- Dia 5-7: Implementação da lógica de backend e validação para Cadastro e Login.

### It. 2:

- Dia 8-10: Desenvolvimento da funcionalidade de Acesso e Edição de Perfil.
- Dia 11-12: Desenvolvimento da funcionalidade de Visualização de Perfis.
- Dia 13-14: Testes integrados e correção de bugs.

## Iteração 01:

Valor: Criar interações de cadastro, login, acesso ao perfil e visualização do perfil de outros usuários.

## P1/1: Criação de User Stories

### Objetivo:  
Criar User Stories para auxiliar a prototipação do projeto.

### Tarefas:

- [Criar User Stories da tela de login - **Gabriel Fernandes Zamora**](https://trello.com/c/cIQusWVB/12-s-01-bck-01-criar-user-stories-da-tela-de-login)
- [Criar User Stories da tela de cadastro - **Jônatas De Sousa Madeira**](https://trello.com/c/hrh2PH6P/6-s-01-bck-02-criar-user-stories-da-tela-de-cadastro)
- [Criar User Stories da tela de perfil do usuário - **Jesse Eliseu Nunes Da Silva**](https://trello.com/c/5BZ8f5qM/7-s-01-bck-03-criar-user-stories-da-tela-de-perfil-do-usu%C3%A1rio)
- [Criar User Stories da tela de visualizar de perfil de outros usuários - **Arthur Lima Duarte**](https://trello.com/c/osUO3Rlt/8-s-01-bck-04-criar-user-stories-da-tela-de-visualizar-de-perfil-de-outros-usu%C3%A1rios)

## P1/2: Prototipação do projeto.

### Objetivos:  
Criação dos protótipos das telas para auxiliar o desenvolvimento e apresentar para o cliente

### Tarefas:

- [Criar protótipo da tela de login - **Gabriel Fernandes Zamora**](https://trello.com/c/Ip9GwK6n/10-s-02-bck-01-criar-prot%C3%B3tipo-da-tela-de-login)
  ![Login](https://github.com/user-attachments/assets/8c408522-d68f-411f-9814-91ed6aabea8e)
- [Criar protótipo da tela de cadastro - **Jônatas De Sousa Madeira**](https://trello.com/c/Kp6HxBxV/11-s-02-bck-02-criar-prot%C3%B3tipo-da-tela-de-cadastroo)
  ![Singin](https://github.com/user-attachments/assets/a75e88b4-7413-4a30-a021-f71a2ac02ec4)
- [Criar protótipo da tela de perfil do usuário - **Jesse Eliseu Nunes Da Silva**](https://trello.com/c/Tp2EiiqJ/12-s-02-bck-03-criar-prot%C3%B3tipo-da-tela-de-perfil-do-usu%C3%A1rio)
  ![UserProfile](https://github.com/user-attachments/assets/3014d4ff-645b-4ae1-8114-a9f011623615)
- [Criar protótipo da tela de visualizar de perfil de outros usuários - **Arthur Lima Duarte**](https://trello.com/c/tgOBSy8p/13-s-02-bck-04-criar-prot%C3%B3tipo-da-tela-de-visualizar-de-perfil-de-outros-usu%C3%A1rios)
  ![Perfil dos usuarios](https://github.com/user-attachments/assets/df1e91d1-0975-4662-867a-314e33bc7f6c)

# Como Iniciar o Projeto
<small>[voltar para o Sumário](#sumario)</small><br>

**Lembrando que tem um vídeo no final para melhor visualização: [Ir para o vídeo](#video-para-melhor-visualizacao)**

## Configurando o Ambiente

...

## Video para Melhor visualizacao

...

## Criar uma Nova Branch para uma Feature
<small>[voltar para o Sumário](#sumario)</small><br>

### **OBSERVAÇÃO IMPORTANTE!:**

Sempre que mudar de branch, chegar em um novo dia para fazer suas modificações, ou antes de fazer um Pull Request, execute o seguinte comando:
```bash
git merge origin develop
```
Isso é **estremamente importante** para sempre manter seu codigo **atualizado** e **evitar problemas** futuros

Para criar uma nova branch para desenvolver uma feature, siga os passos abaixo:

1. Certifique-se de que está na branch `develop`:
   ```bash
   git checkout develop
   ```

2. Atualize a branch `develop` com as últimas mudanças:
   ```bash
   git pull origin develop
   ```

3. Crie uma nova branch para a `feature` utilizando o padrão de nomenclatura definido:
   ```bash
   git checkout -b Feat/issue-numero-da-issue-descricao-da-issue
   ```

## Realizar um Push
<small>[voltar para o Sumário](#sumario)</small><br>

Após ter realizado as alterações na sua branch, siga os passos para enviar as mudanças ao repositório remoto:

1. Adicione as mudanças ao staging:
   ```bash
   git add .
   ```

2. Faça um commit com uma mensagem clara e descritiva:
   ```bash
   git commit -m "Descrição clara das alterações realizadas"
   ```

3. Envie (push) as mudanças para a sua branch no GitHub:
   ```bash
   git push origin Feat/issue-numero-da-issue-descricao-da-issue
   ```
Exemplo:
   ```bash
   git push origin Feat/issue-01-correcao-de-bugs
   ```

## Fazendo o Pull Request
<small>[voltar para o Sumário](#sumario)</small><br>

1. Na pagina inicial do projeto no Git Hub: Engenharia-de-Software
   - Clique em `Pull requests`

![pullrequest1](https://github.com/user-attachments/assets/42c50623-87b8-470c-8499-68dbb560b337)

2. Na pagina de Pull requests:
   - Clique em `New pull request`

![pullrequest2](https://github.com/user-attachments/assets/eda6e914-b3c1-4e84-8cc6-05a53888cd6a)

3. Selecione a base e troque para `develop`:

![pullrequest3](https://github.com/user-attachments/assets/c8b169d9-326b-4df4-830d-3845154e5623)

4. No campo de pesquisa escreva `develop`:

![pullrequest4](https://github.com/user-attachments/assets/69d101f4-e0fa-420f-9eb2-a4e64c02466d)

5. Clique em `develop`:

![pullrequest5](https://github.com/user-attachments/assets/7a6c62aa-ecfb-4e06-8c6d-d9d7295257cf)

6. Selecione a compare e troque para `sua branch`:

![pullrequest6](https://github.com/user-attachments/assets/7b3d9542-8933-46b4-b8fb-89ebf919d906)

7. No campo de pesquisa procure pela sua branch:

![pullrequest7](https://github.com/user-attachments/assets/cabbf824-e0f0-4dd8-8cb6-ed4d0f1b9397)

8. Clique nela:

![pullrequest8](https://github.com/user-attachments/assets/2b1de95a-e294-418c-bde0-59e1ae37a783)

9. Clique em `Create pull request`:

![pullrequest9](https://github.com/user-attachments/assets/6953ddba-a433-4c9f-a002-6c87046e0ccb)

10. Clique na engrenagem para selecionar um `reviewer`:
   - Essa é a pessoa que vai revisar ser código.

![pullrequest10](https://github.com/user-attachments/assets/98774ed2-a9dc-4b2b-8c5f-dd7c6e6f1e9a)

11. Selecione um reviewer e dps clique fora da caixa de seleção:

![pullrequest11](https://github.com/user-attachments/assets/82ea5234-77cc-4609-9945-da41028ba2be)

12. Por fim, clique em `Create pull request`:

![pullrequest12](https://github.com/user-attachments/assets/46005297-34ac-4a9b-9e7d-4f162403c23b)

## Fluxo de Trabalho com Gitflow

- **Main:** Contém a versão estável e em produção.
- **Develop:** Contém as últimas alterações que serão futuramente incluídas na Master.
- **Feature Branches:** Utilizadas para o desenvolvimento de novas funcionalidades (padrão `Feat/issue-numero-da-issue-descricao-da-issue`).
- **Release Branches:** Preparação das novas versões para produção.
- **Hotfix Branches:** Correções de bugs em produção.

## Contribuição

1. Crie uma branch a partir de `develop` para trabalhar em novas funcionalidades ou correções.
2. Faça commits regulares com mensagens claras.
3. Envie um Pull Request para a branch `develop`.
4. Aguarde a revisão do código antes de fazer o merge.
