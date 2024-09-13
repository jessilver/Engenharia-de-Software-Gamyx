# Projeto - Rede Social de Desenvolvedores De Jogos
# Manual do Projeto

## Navegação

- [Home](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/README.md)
- [Iterações](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/iteracoes.md)
- [Planejementos](https://github.com/jessilver/Engenharia-de-Software-Gamyx/blob/docs/readme/planejamentos.md)

## Sumário
- [Padrões](#Padrões)
- [Tags](#tags)
- [Como Iniciar o Projeto](#como-iniciar-o-projeto)
- [Como conectar com o banco de dados](#Como-conectar-com-o-banco-de-dados)
- [Criar uma Nova Branch para uma Feature](#criar-uma-nova-branch-para-uma-feature)
- [Realizar um Push](#realizar-um-push)
- [Fazendo o Pull Request](#fazendo-o-pull-request)

# Padrões
<small>[voltar para o Sumário](#Sumário)</small><br>

## Padrões de Nomeação de Branches
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
<small>[voltar para o Sumário](#Sumário)</small><br>

- R1 --> Requisito funcional número 01
- NF1 --> Requisito não funcional número 01
- P1/1 --> Planejamento número 01, parte 01

# Como Iniciar o Projeto
<small>[voltar para o Sumário](#Sumário)</small><br>

**Lembrando que tem um vídeo no final para melhor visualização: [Ir para o vídeo](#video-para-melhor-visualizacao)**

## Configurando o Ambiente

1. **Certifique-se que o Git instalado:**

   - No seu cmd execute o seguinte coamndo:
   ```bash
     git --version
   ```
   - Se não estiver instaldo: [Git](https://git-scm.com/downloads)

2. **Instalando XAMPP**
Se já estiver com XAMPP instalado, pule para: [Iniciando o XAMPP](#Iniciando-o-XAMPP)

- Clique em [Download XAMPP](https://www.apachefriends.org/pt_br/index.html) e faça o download e instale o XAMPP.

3. **Iniciando o XAMPP**
Sempre que for rodar o proejto é obrigatotório serguir a instrução abaixo, caso contrário o projeto não ira rodar!
- Após instalado, na barra de perquisa do seu computador perquise por XAMPP e abra o aplicativo
- Com o Painel de Controle aberto, clique no botão de **Start** dos módulos de Apache e MySQL
![image](https://github.com/user-attachments/assets/f814c75a-1c83-4182-884f-d9792c834ea4)


4. **Importando repositório**

- Abra seu gerenciador de arquivos e clique no seu disco local.<br>
![image](https://github.com/user-attachments/assets/bf563192-8981-4380-946a-715b98761d3d)
- Localize a pasta **xampp** e clique nela.<br>
![image](https://github.com/user-attachments/assets/b88014c6-3ca0-4f53-a4ca-ca8dc62b5641)
- Localize a pasta **htdocs** e clique nela.<br>
![image](https://github.com/user-attachments/assets/b384c7e7-3ea6-4336-b485-e92f58e19e59)
- Pode apagar todes esses arquivos, são apenas para exemplo de uso.<br>
![image](https://github.com/user-attachments/assets/16a39baa-d73b-4069-8b76-031facc1acc7)
- Clique com o botão direito e selecione a opção **Abrir no terminal**, com terminal aberto digite o comando: code .
- Execute o comando, ele vai abrir o VS Code já com a pasta aberta.<br>
![image](https://github.com/user-attachments/assets/87922f41-19cc-460c-aeaf-5a1a1384351b)
- Aperte Ctrl+j para abrir o terminal do vse abra o Git Bash.<br>
![image](https://github.com/user-attachments/assets/86e6801b-5ce9-4355-ac23-65bd4e01dba8)
- Execute o seguinte código para clonar o repositório github na sua pasta.
 ```bash
   git clone https://github.com/jessilver/Engenharia-de-Software-Gamyx.git
 ```
- Já pode fechar tudo e iniciar seu projeto

# Como conectar com o banco de dados

1. Abra o aplicativo do xamppe em seguida na opção **admin** do MySQL
![image](https://github.com/user-attachments/assets/53fffc93-523e-47ed-b30b-4869b0d9e3d5)

2. Com o phpMyAdmin aberto, clique em tema e selecione bootstrap (OPCIONAL)
![image](https://github.com/user-attachments/assets/0729295b-5ce2-47f0-98d1-fc58c7f6b12e)

## Video para Melhor visualizacao

...

## Criar uma Nova Branch
<small>[voltar para o Sumário](#Sumário)</small><br>

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

3. Crie uma nova branch utilizando o padrão de nomenclatura definido: [Padrões de Nomeação de Branchea](#Padrões-de-Nomeação-de-Branches)
   ```bash
   git checkout -b nome-da-branch
   ```

## Realizar um Push
<small>[voltar para o Sumário](#Sumário)</small><br>

Após ter realizado as alterações na sua branch, siga os passos para enviar as mudanças ao repositório remoto:

1. Adicione as mudanças ao staging:
   ```bash
   git add .
   ```

2. Faça um commit com uma mensagem clara e descritiva, utilizando o padrão de nomenclatura definido: [Padrões de Commits](#Padrões-de-Commits)
   ```bash
   git commit -m "nome-do-commit"
   ```

3. Envie (push) as mudanças para a sua branch no GitHub:
   ```bash
   git push origin nome-da-sua-branch
   ```
Exemplo:
   ```bash
   git push origin feat/cadastro-de-usuario
   ```

## Fazendo o Pull Request
<small>[voltar para o Sumário](#Sumário)</small><br>

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

