# 📋 Recap da Aula 01 — Módulo de Nivelamento

## Introdução à Programação, Git e PHP

**Público-alvo:** Para Leigos & Iniciantes  
**Objetivo:** Desmistificar a lógica computacional, o funcionamento dos sistemas e o controle de versão para iniciantes.

---

## 1.1 Conceitos Iniciais — O Que é Programação e Como os Sistemas Funcionam

### Analogia: O Maestro e a Orquestra

Programar é dar instruções **exatas** para o computador executar. Ele é extremamente rápido, mas segue **exatamente** o que foi ordenado — sem interpretação ou criatividade própria.

### Como Sistemas Reais Operam

Um sistema computacional é dividido em três camadas fundamentais:

| Camada | Função | Analogia |
|---|---|---|
| **Front-end** (Visual) | Tela interativa onde o usuário clica e digita | O palco da orquestra |
| **Back-end** (Cérebro) | Servidor que processa dados e regras de negócio | O maestro |
| **Banco de Dados** (Memória) | Onde as informações ficam salvas permanentemente | A partitura arquivada |

### Código de Exemplo (C++)

```cpp
#include <iostream>
using namespace std;

int main() {
    int a = 10;
    int b = 20;
    int sum = a + b;
    cout << "Hello, World!";
    return 0;
}
```

### Pilares da Ciência da Computação

- **Data Structures** (Estruturas de Dados)
- **Algorithms** (Algoritmos)
- **Programming Fundamentals** (Fundamentos de Programação)
- **Logical Thinking** (Pensamento Lógico)

> *"Think. Code. Solve. Succeed."*

---

## 1.2 Pensamento Estruturado — Lógica Computacional e Algoritmos

### O que é um Algoritmo?

Sequência finita de passos **claros e ordenados** para realizar uma tarefa ou resolver um problema.

#### Analogia: Receita de Bolo

Se esquecer de bater os ovos ou pular o forno, a receita falha. No código, a **ordem exata importa**.

### Raciocínio Lógico

Capacidade de quebrar problemas gigantes em **pequenas decisões simples e tratáveis**.

---

## 1.2.2 Visualização de Processos — Fluxogramas

Fluxogramas utilizam **formas geométricas** para mapear visualmente como o código deve tomar decisões **antes** de escrevermos qualquer linha de código.

| Símbolo | Significado | Descrição |
|---|---|---|
| **Oval** | Início / Fim | Marca onde o processo começa e termina |
| **Retângulo** | Ação / Processo | Uma tarefa executada (ex: somar dois números) |
| **Losango** | Decisão | Uma pergunta com caminhos "Sim" ou "Não" |

---

## 1.3 Arquitetura de Dados — O Ciclo Fundamental

Todo sistema opera seguindo o ciclo:

### 1. ENTRADA (INPUT) — Captura de Dados
O sistema recebe informações fornecidas pelo usuário ou sensores.  
**Exemplo:** Digitar e-mail e senha.

### 2. PROCESSAMENTO — Transformação
O código calcula, valida e aplica regras aos dados recebidos.  
**Exemplo:** Checar senha no banco de dados.

### 3. SAÍDA (OUTPUT) — Resultado
Exibição da resposta na tela ou envio para outro sistema.  
**Exemplo:** Abrir tela do usuário.

```
[ENTRADA] → [PROCESSAMENTO] → [SAÍDA]
   (Input)      (Transform)      (Output)
```

---

## 1.4 Controle de Versão com Git e GitHub

### 1.4.1 Conceitos Base — Git vs GitHub

| Conceito | Descrição |
|---|---|
| **Git** (Local) | Programa instalado no computador. Funciona como uma **máquina do tempo**, tirando fotos (snapshots) do projeto para reverter erros a qualquer momento. |
| **GitHub** (Nuvem) | Plataforma na nuvem para guardar projetos Git, compartilhar portfólio e colaborar com programadores do mundo todo. |

### Conceitos Fundamentais do Git

- **Repository** → Repositório
- **Branching** → Ramificação
- **Commit** → Salvamento de snapshot
- **Push** → Enviar para a nuvem
- **Pull** → Puxar da nuvem
- **Merging** → Mesclar ramificações
- **Rebase** → Reorganizar commits
- **Clone** → Clonar repositório

---

### 1.4.1.1 Identidade — Nome & E-mail

Configuração única no terminal para **assinar a autoria** de cada alteração salva no código.

```bash
git config --global user.name "Seu Nome"
git config --global user.email "seu.email@exemplo.com"
```

### 1.4.1.2 Chaves SSH — Passaporte Digital

Conexão **segura e criptografada** entre seu computador e o GitHub, eliminando senhas manuais.

### 1.4.1.3 Repositório — Vínculo Remoto

Conectar a pasta local ao projeto correspondente criado na nuvem do GitHub.

---

### 1.4.2 Comandos Essenciais — O Fluxo Diário do Programador

| Comando | Função |
|---|---|
| `git init` | Inicializa a máquina do tempo do Git dentro da pasta do projeto |
| `git clone` | Baixa uma cópia exata de um repositório existente no GitHub |
| `git add` | Seleciona quais arquivos modificados farão parte do próximo salvamento |
| `git commit` | Cria uma foto (snapshot) permanente das alterações com uma mensagem |
| `git push` | Envia seus commits para a nuvem |
| `git pull` | Puxa as atualizações da nuvem |

---

### 1.4.3 Qualidade de Código — Boas Práticas de Commit

#### ❌ O QUE EVITAR

- Mensagens vagas como "Ajustes" ou "Aàa"
- Salvar um mês inteiro de trabalho em um único commit
- Misturar várias tarefas num único pacote

#### ✅ RECOMENDADO — Commits Atômicos

- Mensagens curtas e diretas sobre a mudança
- Commits pequenos e frequentes a cada avanço
- Histórico fácil de entender e reverter falhas

---

## 📌 Resumo dos Tópicos Cobertos

1. O que é programação e como sistemas reais funcionam
2. Lógica computacional
   - 1.2.1 Algoritmos
   - 1.2.2 Fluxogramas
3. Entrada, processamento e saída de dados
4. Git e GitHub
   - 1.4.1 Configuração inicial
     - Identidade
     - Chave SSH
     - Repositório remoto
   - 1.4.2 Comandos essenciais (`init`, `clone`, `add`, `commit`, `push`, `pull`)

---

## 🔗 Links Úteis

- [Gist com recursos de programação](https://gist.github.com/ronaldomendes/471d9d84b106641349919c4280e17a2a)
- [Gist com materiais de estudo](https://gist.github.com/leocomelli/2545add34e4fec21ec16)

---

*Recap produzido para a turma da Aula 01 do Módulo de Nivelamento.*
