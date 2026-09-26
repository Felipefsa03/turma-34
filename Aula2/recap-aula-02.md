# 📋 Recap da Aula 02 — Módulo de Prática

## Ambiente de Desenvolvimento, Terminal & PHP Local

**Público-alvo:** Para Leigos & Iniciantes  
**Objetivo:** Configurar as ferramentas de trabalho, dominar comandos essenciais e rodar seu primeiro servidor local.

---

## 1.5 Recapitulação — O que é o PHP e Qual Seu Papel?

### Analogia: O Cozinheiro no Bastidor

O cliente faz o pedido no cardápio (**Navegador**). O PHP é o **cozinheiro** que pega os ingredientes do estoque (**Banco de Dados**) e entrega o prato pronto (**HTML**).

- **Executado no Servidor:** O código nunca fica visível para o usuário final.
- **Gera HTML Dinâmico:** Respostas personalizadas para cada usuário logado.

### Fluxo de Requisição

```
[Navegador] → Request → [Servidor PHP] → Response → [Navegador]
```

---

## 2. Ambiente de Desenvolvimento — A Oficina do Programador

Três pilares fundamentais:

| Ferramenta | Função | Analogia |
|---|---|---|
| **IDE (Editor)** | Onde você escreve, formata e organiza os arquivos de código com autocompletar e ajuda visual | A oficina completa |
| **Terminal (CLI)** | Central de comandos diretos para mandar o computador executar rotinas e scripts sem cliques | O painel do piloto |
| **Interpretador PHP** | O motor instalado no sistema que lê e transforma o texto do arquivo em ações reais | O motor do carro |

---

## 2.1 IDE (Editor de Código)

### O que é uma IDE e Por Que Usar?

#### Analogia: Bloco de Notas vs Oficina Completa

Escrever código no bloco de notas é como construir um móvel usando apenas uma faca de cozinha. A IDE oferece **serras elétricas e réguas a laser**.

### Vantagens de Usar uma IDE

- ✓ **Highlight de Sintaxe:** Colore comandos para identificar erros num relance
- ✓ **Autocompletar:** Sugere funções e variáveis enquanto você digita
- ✓ **Integrado ao Git:** Permite salvar versões diretamente pela tela

### 2.1.1 Configuração Prática — VS Code para PHP

| PASSO | Ação |
|---|---|
| **1** | **Download & Instalação** — Instalar o Visual Studio Code (gratuito e padrão da indústria em desenvolvimento web) |
| **2** | **Extensão PHP Intelephense** — Adiciona inteligência de código, detecção de falhas de sintaxe e autocompletar avançado |
| **3** | **Ajustes de Auto-Save** — Ativar o salvamento automático para evitar perder alterações durante testes rápidos |

---

## 2.2 Terminal (Linha de Comando)

### Desmistificando a Tela Preta

#### Analogia: O Piloto de Avião

A interface visual com mouse é como botões para passageiros. O terminal é o **painel do piloto**: comandos de texto diretos e sem intermediários.

### Por Que Usar o Terminal?

- **Rápido & Leve:** Executa tarefas repetitivas em milissegundos
- **Universal:** Servidores reais na nuvem raramente possuem interface visual com mouse

### 2.2.1 Navegação Básica — Comandos Essenciais

| Comando | Função | Descrição |
|---|---|---|
| `pwd` | Onde estou? | Mostra o caminho da pasta atual no seu computador |
| `ls` / `dir` | O que tem aqui? | Lista todos os arquivos e pastas no diretório atual |
| `cd pasta` | Entrar na pasta | Navega para dentro da pasta especificada |
| `cd ..` | Voltar | Sobe um nível para a pasta pai |

---

### 2.2.2 Executando Código — Scripts PHP via CLI

**CLI (Command Line Interface):** Executar o arquivo PHP diretamente pelo terminal sem precisar abrir o navegador web.

**Uso Prático:** Ideal para scripts de automação, testes rápidos de lógica e pequenos utilitários.

```bash
$ php index.php
// Saída do programa impresso na tela:
Olá, Mundo! Primeira aula de PHP
```

---

### 2.2.3 Servidor Local — Servidor Integrado do PHP

O PHP possui um **servidor embutido de desenvolvimento** que dispensa instalações complexas para testar páginas no navegador.

#### O Comando Mágico:

```bash
php -S localhost:8000
```

#### Como Acessar:

1. Abra o terminal na pasta do projeto
2. Rode o comando `php -S localhost:8000`
3. Abra o navegador e acesse `http://localhost:8000`

---

### Visão Geral — O Fluxo Completo de Trabalho

```
┌─────────────────────────────────────────────┐
│  PASSO 1: Criar o Código                     │
│  Escrever o script no VS Code e salvar       │
│  como index.php                              │
├─────────────────────────────────────────────┤
│  PASSO 2: Subir o Servidor                   │
│  Iniciar o servidor local com o comando      │
│  "php -S localhost:8000"                     │
├─────────────────────────────────────────────┤
│  PASSO 3: Ver no Navegador                   │
│  Visualizar o resultado em localhost:8000    │
└─────────────────────────────────────────────┘
```

---

## 📌 Resumo dos Tópicos Cobertos

1. Introdução ao PHP e seu papel no sistema (analogia do cozinheiro)
2. Ambiente de Desenvolvimento
   - 2.1 IDE (Visual Studio Code)
     - 2.1.1 Configuração (extensões, auto-save)
   - 2.2 Terminal
     - 2.2.1 Navegação (`pwd`, `ls`, `cd`, `cd ..`)
     - 2.2.2 Execução de scripts PHP via CLI (`php index.php`)
     - 2.2.3 Servidor de desenvolvimento local (`php -S localhost:8000`)
   - 2.2.4 XAMPP (gerenciamento do banco de dados MySQL) — *Opcional*

---

## 🔗 Links Úteis

- [Downloads do PHP](https://www.php.net/downloads.php) — Link oficial para download do PHP
- [Manual de instalação do PHP](https://www.youtube.com/watch?v=KdY63NHMAqU) — Tutorial de instalação
- [Curso de Linux/Terminal](https://www.youtube.com/watch?v=6nN2EglOqCM&list=PLHz_AreHm4dlIXleu20uwPWFOSswqLYbV) — Domine o terminal Linux
- [Introdução ao PHP / Pré-requisito](https://www.youtube.com/watch?v=TfsO0BGvGn0&list=PLHz_AreHm4dlFPrCXCmd5g92860x_Pbr_) — Curso introdutório de PHP

---

## 🗺️ Roadmap de Estudos — Checklist de Revisão

### ✅ O que é imprescindível revisar das aulas passadas:

#### Módulo de Nivelamento (Aula 01)
- [ ] **Lógica Computacional** — Entender o que é um algoritmo e como funciona um fluxograma
- [ ] **Ciclo Entrada/Processamento/Saída** — Saber identificar cada etapa em qualquer sistema
- [ ] **Git Básico** — Domínio dos comandos `init`, `clone`, `add`, `commit`, `push`, `pull`
- [ ] **Configuração do Git** — Nome, e-mail e Chave SSH configurados
- [ ] **Boas Práticas de Commit** — Commits atômicos com mensagens claras

#### Módulo de Prática (Aula 02)
- [ ] **IDE (VS Code)** — Instalada com a extensão PHP Intelephense e Auto-Save ativo
- [ ] **Terminal** — Saber navegar com `pwd`, `ls`, `cd`, `cd ..`
- [ ] **Execução PHP via CLI** — Conseguir rodar `php arquivo.php` no terminal
- [ ] **Servidor Local** — Saber iniciar com `php -S localhost:8000` e acessar no navegador
- [ ] **Fluxo de Trabalho Completo** — Do código ao navegador sem errar o caminho

### 📋 Próximos Passos (Pré-requisitos para próximas aulas)
- [ ] **XAMPP** (opcional) — Instalar para gerenciamento do MySQL
- [ ] **Sintaxe do PHP** — Variáveis, tipos de dados e operadores matemáticos (próxima aula)
- [ ] **Revisão dos conceitos de Git** — Para começar a usar com PHP ativamente

---

*Recap produzido para a turma da Aula 02 do Módulo de Prática.*
