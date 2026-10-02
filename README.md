# Programação de Sistemas — Turma 34

Repositório de apoio da turma 34 da disciplina **Programação de Sistemas**.
Contém os slides (PDF) de cada aula, os exemplos de código em PHP e os **recaps**
de conteúdo das aulas realizadas.

> **Disciplina:** Programação de Sistemas
> **Docente responsável:** Thiago Bastos Cerqueira
> **Duração prevista:** 10 meses · **Carga horária:** 2 horas por aula
> **Público:** turma 34

---

## 📬 Contato

Dúvidas sobre o material, sugestão de melhoria ou proposta de colaboração?

**Luis Felipe Araujo Lima** — responsável pelos recaps e exemplos do repositório

[![LinkedIn](https://img.shields.io/badge/LinkedIn-luis--felipe--304a96228-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/luis-felipe-304a96228/)

[<https://www.linkedin.com/in/luis-felipe-304a96228/>](https://www.linkedin.com/in/luis-felipe-304a96228/)

Issues e pull requests são bem-vindos — use a aba **Issues** para abrir discussões sobre
o conteúdo das aulas.

---

## 🚀 Como Clonar e Utilizar este Repositório

### 1. Pré-requisitos

Para seguir os exemplos, você vai precisar de:

| Ferramenta | Para quê | Download |
|---|---|---|
| **Git** | Clonar o repositório e versionar seu código | <https://git-scm.com/downloads> |
| **PHP 8.0+** | Interpretador que executa os scripts | <https://www.php.net/downloads.php> |
| **VS Code** | Editor de código (recomendado) + extensão **PHP Intelephense** | <https://code.visualstudio.com> |

Verificando se o PHP está instalado:

```bash
php -v
```

### 2. Clonar o repositório

```bash
git clone https://github.com/Felipefsa03/turma-34.git
cd turma-34
```

Se preferir clonar direto do GitHub pelo navegador: botão **Code → Download ZIP**.

### 3. Configurar seu Git

Uma única vez por máquina, para assinar seus commits:

```bash
git config --global user.name "Seu Nome"
git config --global user.email "seu.email@exemplo.com"
```

### 4. Rodar os exemplos

Cada aula tem sua própria pasta com um `index.php`. Abra o terminal dentro da pasta da
aula desejada e escolha entre:

**Navegador (servidor local embutido do PHP):**

```bash
php -S localhost:8000
```

Depois acesse <http://localhost:8000> no navegador. Use `Ctrl + C` no terminal para
encerrar o servidor.

**Terminal (execução direta, mais rápida para scripts):**

```bash
php index.php
```

### 5. Contribuir com o repositório

```bash
git status                      # ver o que mudou
git add .                       # selecionar as alterações
git commit -m "descrição curta" # salvar o snapshot
git push                        # enviar para o GitHub
```

Prefira **commits pequenos e atômicos**, com mensagens claras (ex.: `feat: adiciona
exercício de switch`). Nunca commite senhas, tokens ou dados sensíveis.

---

## 📂 Estrutura do Repositório

```
turma-34/
├── README.md                 # Você está aqui
├── Aula1/                    # Introdução à Programação, Git e PHP
│   ├── Introdução à Programação, Git e PHP.pdf
│   ├── Apresentação COUDE - Luis Felipe.pdf
│   ├── recap-aula-01.md      # Recap de conteúdo da aula
│   └── imagens de apoio/
├── Aula2/                    # Ambiente de Desenvolvimento, Terminal & PHP Local
│   ├── Ambiente de Desenvolvimento e Terminal PHP.pdf
│   ├── index.php             # Exemplos práticos
│   └── recap-aula-02.md
└── Aula3/                    # Fundamentos PHP
    ├── Fundamentos PHP.pdf
    ├── index.php             # Testes de cada tema trabalhado
    └── recap-aula-03.md
```

A organização segue o padrão **`Aula<n>/`**, e dentro de cada pasta:

- 📄 **Arquivos `.pdf`** — os slides apresentados em aula (material de apoio)
- 📝 **`recap-aula-<n>.md`** — o resumo do conteúdo, com links para aprofundar
- 💻 **`index.php`** — exemplos executáveis escritos durante a aula

---

## 📄 Sobre os Arquivos PDF

Os PDFs são os **slides originais de cada aula**. Eles servem como material de consulta
rápida — são o complemento visual do que está escrito nos recaps.

**Importante:** os PDFs são **somente leitura**. Todo o conteúdo que você precisa para
programar está também nos arquivos Markdown (`recap-aula-*.md`), que são editáveis,
fáceis de ler no GitHub e no celular.

| PDF | Aula | Assunto |
|---|---|---|
| `Introdução à Programação, Git e PHP.pdf` | 01 | Programação, sistemas, lógica, fluxogramas e Git |
| `Apresentação COUDE - Luis Felipe.pdf` | 01 | Contextualização do curso e da turma |
| `Ambiente de Desenvolvimento e Terminal PHP.pdf` | 02 | IDE, terminal, CLI e servidor local |
| `Fundamentos PHP.pdf` | 03 | Saída de dados, variáveis, tipos e condicionais |

> 💡 Os slides das próximas aulas serão adicionados a cada encontro, sempre na pasta da
> aula correspondente.

---

## 📖 Ementa do Curso

Desenvolvimento de competências técnicas em lógica de programação, desenvolvimento web e
integração de sistemas, com ênfase em aplicação prática e progressiva. A disciplina
abrange fundamentos de pensamento computacional, versionamento de código com Git,
programação back-end em PHP, modelagem e manipulação de bancos de dados relacionais com
MySQL, desenvolvimento de interfaces com HTML, CSS e JavaScript, consumo e criação de APIs
REST, programação orientada a objetos, padrão de arquitetura MVC e desenvolvimento
profissional com o framework Laravel. A abordagem é *competency-based*, orientada a projetos
reais e alinhada às demandas do mercado de desenvolvimento de software.

### Módulos do Conteúdo Programático

**1 · Introdução** — como sistemas funcionam, lógica de programação e versionamento
```
1.1  O que é programação e como sistemas reais funcionam
1.2  Lógica computacional
     1.2.1  Algoritmos
     1.2.2  Fluxogramas
1.3  Entrada, processamento e saída de dados
1.4  Git e GitHub I
     1.4.1  Configuração inicial
             1.4.1.1  Identidade
             1.4.1.2  Chave SSH
             1.4.1.3  Repositório remoto
     1.4.2  Comandos essenciais (init, clone, add, commit, push, pull)
     1.4.3  Boas práticas de commit
1.5  Introdução ao PHP e ambiente de desenvolvimento
```

**2 · Ambiente de Desenvolvimento** — IDE, terminal e servidor local
```
2.1  IDE
     2.1.1  Configuração
2.2  Terminal
     2.2.1  Navegação
     2.2.2  Execução de scripts PHP via CLI
     2.2.3  Servidor de desenvolvimento do PHP local
     2.2.4  XAMPP (gerenciamento do banco de dados MySQL)
```

**3 · Fundamentos PHP** — a base da linguagem
```
3.1  Saída de dados
3.2  Variáveis, constantes e operadores (aritméticos, relacionais, lógicos)
3.3  Tipos de dados e coerção de tipos
3.4  Entrada de dados
3.5  Estruturas condicionais
     3.5.1  if/else
     3.5.2  switch
     3.5.3  Operador ternário
3.6  Laços de repetição
     3.6.1  while      3.6.2  for      3.6.3  foreach      3.6.4  do-while
3.7  Arrays
     3.7.1  Indexados      3.7.2  Associativos      3.7.3  Multidimensionais
3.8  Funções
     3.8.1  Declaração    3.8.2  Parâmetros    3.8.3  Argumentos
     3.8.4  Retorno       3.8.5  Escopo        3.8.6  Funções anônimas
3.9  Manipulação de strings
3.10 Funções nativas do PHP
3.11 Debugging
3.12 Projeto: Calculadora + sistema de notas com regras reais + menu simples
```

**4 · Banco de Dados** — MySQL, modelagem e consultas
```
4.1  Conceitos de banco de dados relacional
4.2  MySQL
     4.2.1  Configuração      4.2.2  Administração
     4.2.3  CLI                4.2.4  Workbench
4.3  Modelagem
     4.3.1  MER     4.3.2  Entidades     4.3.3  Atributos     4.3.4  Relacionamentos
4.4  CRUD
     4.4.1  Create   4.4.2  Read   4.4.3  Update   4.4.4  Delete
4.5  JOIN
4.6  Funções de agregação
     4.6.1  COUNT    4.6.2  SUM    4.6.3  AVG
     4.6.4  MIN/MAX  4.6.5  GROUP BY    4.6.6  HAVING
4.7  Consultas avançadas
     4.7.1  Subqueries     4.7.2  Consultas aninhadas     4.7.3  Otimização básica
4.8  Cenários de consultas
     4.8.1  Relatórios     4.8.2  Rankings     4.8.3  Cruzamento de dados
4.9  Projeto: Sistema de alunos com banco de dados
```

**5 · Desenvolvimento Web com PHP** — HTTP, PDO, segurança e sessões
```
5.1  Protocolo HTTP
     5.1.1  Ciclo de requisição e respostas    5.1.2  Verbos
     5.1.3  Status codes                      5.1.4  Headers
5.2  Integração back-end ↔ banco de dados
     5.2.1  Arquitetura e responsabilidades
5.3  PDO
     5.3.1  Superglobais → $_GET, $_POST, $_SERVER
     5.3.2  Conexão segura          5.3.3  Prepared statements
     5.3.4  Tratamento de resultados 5.3.5  Tratamento de erros, exceções e debugging
5.4  SQL Injection
     5.4.1  Vulnerabilidades   5.4.2  Vetores de ataque   5.4.3  Prevenção com PDO
5.5  Cookies
     5.5.1  Criação   5.5.2  Leitura   5.5.3  Expiração   5.5.4  Casos de uso
5.6  Sessões
     5.6.1  Gerenciamento de estado   5.6.2  Autenticação   5.6.3  Controle de acesso
5.7  Segurança básica
     5.7.1  Hashing de senhas   5.7.2  HTTPS   5.7.3  CSRF
```

**6 · HTML + CSS** — interfaces semânticas e responsivas
```
6.1  HTML semântico
6.2  Formulários
6.3  Integração com PHP
6.4  CSS
     6.4.1  Seletores     6.4.2  Especificidade
     6.4.3  Box model    6.4.4  Unidades de medida
6.5  Flexbox
6.6  Grid Layout
6.7  Design responsivo e media queries
6.8  Projeto: Interface completa e responsiva para o sistema de alunos
```

**7 · JavaScript** — interatividade no front-end
```
7.1  Variáveis
     7.1.1  Tipos      7.1.2  Hoisting
7.2  Funções
     7.2.1  Arrow functions    7.2.2  Callbacks
7.3  DOM
     7.3.1  Seleção      7.3.2  Manipulação
7.4  Eventos
     7.4.1  Listeners    7.4.2  Propagação    7.4.3  Delegação
7.5  Validação de formulários em tempo real
7.6  Projeto: Formulários inteligentes com feedback visual e validação dinâmica
```

**8 · APIs + Fetch** — comunicação desacoplada
```
8.1  JSON
     8.1.1  Estrutura    8.1.2  Serialização (json_encode)    8.1.3  Deserialização (json_decode)
8.2  API REST em PHP
     8.2.1  Endpoints    8.2.2  Verbos HTTP    8.2.3  Status codes semânticos
8.3  Consumo de API com Fetch API e tratamento de respostas
8.4  Programação assíncrona e tratamento de erros em cadeia
     8.4.1  async/await
8.5  Projeto: Sistema com comunicação desacoplada via API REST
```

**9 · POO + MVC** — arquitetura de software
```
9.1  Classes         9.2  Objetos        9.3  Atributos     9.4  Métodos
9.5  Construtores    9.6  Encapsulamento 9.7  Herança       9.8  Polimorfismo
9.9  Interfaces      9.10 Namespaces    9.11 Autoload PSR-4
9.12 Padrão arquitetural MVC
     9.12.1  Separação de responsabilidades
9.13 Implementação de MVC puro
9.14 Projeto: Refatoração do sistema existente para arquitetura MVC com POO
```

**10 · Git e GitHub II** — colaboração em equipe
```
10.1 Fluxo de trabalho com branches
     10.1.1  Criação    10.1.2  Merge    10.1.3  Conflitos
10.2 Colaboração via Pull Request
```

**11 · Composer** — gerenciamento de dependências
```
11.1 Gerenciamento de dependências
11.2 Autoload PSR-4 e estrutura de pacotes
11.3 Publicação, instalação e atualização via Packagist
```

**12 · Framework — Laravel** — desenvolvimento profissional
```
12.1 Arquitetura do Laravel
      12.1.1  Estrutura de diretórios      12.1.2  Ciclo de vida da requisição
12.2 Migrations
      12.2.1  Versionamento de schema     12.2.2  Criação de tabelas     12.2.3  Rollback
12.3 Rotas
      12.3.1  Web     12.3.2  API     12.3.3  Parâmetros dinâmicos     12.3.4  Agrupamento
12.4 Controllers
      12.4.1  Organização da lógica de negócio      12.4.2  Resource Controllers
12.5 Models e Eloquent ORM
      12.5.1  Relacionamentos   12.5.2  Escopos    12.5.3  Mass assignment
12.6 Blade
      12.6.1  Templates   12.6.2  Layouts   12.6.3  Componentes   12.6.4  Diretivas
12.7 Middleware
      12.7.1  Criação    12.7.2  Registro    12.7.3  Uso para autenticação
      12.7.4  Autorização    12.7.5  Logging
12.8 Auth
      12.8.1  Sistema de autenticação nativo     12.8.2  Proteção de rotas
12.9 Projeto: Sistema completo e funcional desenvolvido em Laravel
```

**13 · Projeto Final** — entrega completa
```
13.1 Autenticação segura com controle de perfis e sessão
13.2 CRUD completo com validação no back-end e front-end
13.3 API REST consumida pelo front-end via Fetch/Async-Await
13.4 Interface responsiva e semântica
13.5 Arquitetura MVC com separação clara de responsabilidades
13.6 Versionamento completo do projeto com Git e GitHub
```

---

## 🎯 Objetivos do Curso

### Geral
Desenvolver competências em lógica de programação e desenvolvimento de sistemas web,
capacitando o aluno a projetar, implementar e integrar aplicações utilizando tecnologias
como PHP, banco de dados, JavaScript e frameworks, por meio de uma abordagem prática e
orientada a projetos.

### Específicos
- Aplicar lógica de programação na resolução de problemas reais utilizando PHP como
  linguagem principal de back-end
- Aprendizagem baseada em projetos (*Project Based Learning*), com desenvolvimento de
  sistemas progressivos ao longo do curso
- Utilizar Git e GitHub como ferramentas de versionamento e colaboração ao longo de todo
  o curso
- Modelar, criar e manipular bancos de dados relacionais com MySQL, utilizando consultas
  avançadas e boas práticas de segurança
- Construir interfaces web semânticas, responsivas e acessíveis com HTML5, CSS3 e JavaScript
- Criar e consumir APIs REST, integrando front-end e back-end de forma desacoplada
- Implementar aplicações orientadas a objetos seguindo o padrão arquitetural MVC
- Desenvolver sistemas profissionais utilizando o framework Laravel, com autenticação,
  middlewares e ORM
- Entregar um projeto final funcional e documentado, simulando um ambiente real de
  desenvolvimento de software

---

## 🧪 Metodologia

O curso é baseado em **aprender fazendo** (*learn by doing*), com aulas expositivas
dialogadas, *live coding*, resolução de problemas em tempo real e *debugging* guiado.
Cada módulo termina com um mini-projeto que consolida as competências adquiridas, e a
avaliação é **contínua e processual**, considerando a evolução ao longo do curso.

O versionamento com Git e GitHub é prática **contínua e obrigatória** em todas as entregas.

---

## 📊 Progresso das Aulas

| Aula | Módulo | Conteúdo | Slides | Recap | Código |
|:----:|:------:|----------|:------:|:-----:|:------:|
| 01 | 1 · Introdução | Programação, sistemas, lógica, fluxogramas e Git | ✅ | [`recap-aula-01.md`](Aula1/recap-aula-01.md) | — |
| 02 | 2 · Ambiente | IDE, terminal, CLI e servidor local | ✅ | [`recap-aula-02.md`](Aula2/recap-aula-02.md) | ✅ |
| 03 | 3 · Fundamentos PHP | Saída de dados, variáveis, tipos e condicionais | ✅ | [`recap-aula-03.md`](Aula3/recap-aula-03.md) | ✅ |
| 04 | 3 · Fundamentos PHP | Laços de repetição, arrays e funções | 🔜 | — | — |

---

## 🔗 Referências Oficiais

Documentação de referência para aprofundar os temas de cada aula:

- **PHP** — <https://www.php.net/manual/pt_BR/>
- **MySQL** — <https://dev.mysql.com/doc/>
- **JavaScript (MDN)** — <https://developer.mozilla.org/pt-BR/docs/Web/JavaScript>
- **Laravel** — <https://laravel.com/docs>
- **Git** — <https://git-scm.com/doc>
- **Composer** — <https://getcomposer.org/doc/>

---

## 📄 Licença e Uso

Material de apoio da disciplina, de uso exclusivo dos alunos da turma 34. Os exemplos de
código foram escritos para fins didáticos e podem ser reutilizados livremente para
estudo.

---

<div align="center">

**Programação de Sistemas · Turma 34**
Feito com dedicate por [Luis Felipe Araujo Lima](https://www.linkedin.com/in/luis-felipe-304a96228/)
para a turma.

</div>