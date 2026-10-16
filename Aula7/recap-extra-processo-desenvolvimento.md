# 🧭 Recap da Aula Extra — Antes de Codar: Como Pensar um Software

> **Tema da aula:** *Engenharia de Software — do problema à solução*
> **Slides trabalhados:** 01 a 17 → requisitos, decisões, arquitetura, planejamento e validação
> **Módulo:** Engenharia de Software (aula extra)
> **Público-alvo:** iniciantes e quem quer entender **o que construir — e por quê** antes de abrir o editor.

**Objetivo:** mostrar que **programar começa muito antes do código**. Boas decisões nascem do entendimento do problema, não da escolha da linguagem. Código é **consequência** — não ponto de partida.

> [!IMPORTANT]
> **Pergunta central:** *como saber o que construir — e por quê?*
> Código **implementa decisões**; boas decisões começam com **contexto**.

---

## 🗺️ Mapa da Aula

| # | Tópico | Ideia central | Slide |
|:-:|--------|---------------|:-----:|
| 01 | ⚠️ [O erro de começar pelo código](#-01-o-erro-de-começar-pelo-código) | linguagem não é o problema | 01 |
| 02 | 🛣️ [O caminho do problema até a entrega](#-02-o-caminho-do-problema-até-a-entrega) | 6 fases do processo | 02 |
| 03 | 🔎 [1. Entenda o problema](#-03-1-entenda-o-problema) | contexto e dor real | 03 |
| 04 | 📋 [2. Transforme a dor em requisitos](#-04-2-transforme-a-dor-em-requisitos) | funcionais, não funcionais e restrições | 04 |
| 05 | ✂️ [3. Delimite o MVP](#-05-3-delimite-o-mvp) | o indispensável, agora | 05 |
| 06 | 🚶 [4. Desenhe a jornada do usuário](#-06-4-desenhe-a-jornada-do-usuário) | fluxos, exceções e alternativas | 06 |
| 07 | 🏗️ [5. Comece com uma arquitetura simples](#-07-5-comece-com-uma-arquitetura-simples) | o desenho mínimo viável | 07 |
| 08 | ⚖️ [6. Decisões técnicas têm trade-offs](#-08-6-decisões-técnicas-têm-trade-offs) | toda escolha tem um custo | 08 |
| 09 | 🗓️ [7. Planeje a implementação](#-09-7-planeje-a-implementação) | entregas pequenas e verificáveis | 09 |
| 10 | 🔗 [8. Como o planejamento guia o código](#-10-8-como-o-planejamento-guia-o-código) | de requisito a teste | 10 |
| 11 | 🧪 [9. Testar não é a última etapa](#-11-9-testar-não-é-a-última-etapa) | qualidade desde o início | 11 |
| 12 | 📈 [10. O sistema cresce — e agora?](#-12-10-o-sistema-cresce--e-agora) | métricas, não moda | 12 |
| 13 | 🗄️ [11. Evolua a persistência com evidências](#-13-11-evolua-a-persistência-com-evidências) | cada camada tem custo | 13 |
| 14 | 🛡️ [12. Resiliência e disponibilidade](#-14-12-resiliência-e-disponibilidade) | replicação tem preço | 14 |
| 15 | 🔁 [13. Ciclo de decisão em produção](#-15-13-ciclo-de-decisão-em-produção) | medir antes de mudar | 15 |
| 16 | 🍽️ [Atividade prática](#-16-atividade-prática--15-minutos) | cantina com pedidos antecipados | 16 |
| 17 | 💬 [Perguntas para a turma](#-17-perguntas-para-a-turma) | antes da linguagem, o contexto | 17 |

> [!TIP]
> Os slides originais estão em **[`Antes de Codar - Processo de Desenvolvimento de Software.pdf`](Antes%20de%20Codar%20-%20Processo%20de%20Desenvolvimento%20de%20Software.pdf)** nesta pasta.

---

## ⚠️ 01. O erro de começar pelo código

> *"Vou usar Java, React e PostgreSQL."* — **Mas qual problema resolvemos?**

- **Código é implementação**; o desenvolvimento começa com **entendimento**.
- **Uma decisão inicial ruim** pode orientar **meses de retrabalho**.

```text
   ❌ Começar pela tecnologia         ✅ Começar pelo problema
   ┌──────────────────────┐          ┌──────────────────────┐
   │  «Vou usar React»    │          │  Quem sente a dor?   │
   │  ...e depois vejo    │          │  O que precisa       │
   │  qual problema tem   │          │  melhorar?           │
   └──────────────────────┘          └──────────┬───────────┘
                                                 ▼
                                      ┌──────────────────────┐
                                      │  Aí sim: tecnologia  │
                                      └──────────────────────┘
```

> [!WARNING]
> Escolher ferramenta **antes** de entender o problema é o atalho mais rápido para construir a coisa **errada** — muito bem feita.

---

## 🛣️ 02. O caminho do problema até a entrega

Seis fases encadeadas:

```text
 01 Descobrir   →  02 Definir   →  03 Projetar
 Contexto,         Escopo e        Fluxos, dados
 usuários          requisitos      e arquitetura
 e dor real
       │                │                │
       ▼                ▼                ▼
 04 Planejar    →  05 Construir  →  06 Aprender
 Prioridades,      Código,          Medição,
 tarefas           testes e         feedback
 e riscos          integração       e evolução
```

| Fase | Pergunta-chave | Entregável |
|:----:|----------------|------------|
| **01 Descobrir** | Quem usa e qual é a dor? | contexto e usuários |
| **02 Definir** | O que **precisa** ser feito? | escopo e requisitos |
| **03 Projetar** | Como vai funcionar? | fluxos, dados e arquitetura |
| **04 Planejar** | O que fazer primeiro? | prioridades, tarefas e riscos |
| **05 Construir** | Está funcionando? | código, testes e integração |
| **06 Aprender** | Deu certo? | medição, feedback e evolução |

> [!NOTE]
> O processo **não é uma linha reta**: as fases se repetem a cada nova informação. É mais um **ciclo** do que uma escada.

---

## 🔎 03. 1. Entenda o problema

Antes de qualquer linha de código, responda:

- **Quem é afetado?** O que essa pessoa tenta fazer?
- Qual situação atual gera **perda de tempo, erro ou custo**?
- Como essa pessoa **resolve isso hoje**?
- Qual **resultado concreto** demonstraria **sucesso**?

> [!IMPORTANT]
> Não existe "sistema bom" em abstrato. Só existe sistema bom **para um problema específico**, de **um usuário específico**.

---

## 📋 04. 2. Transforme a dor em requisitos

Três famílias de requisitos:

| Tipo | Pergunta | Exemplos |
|------|----------|----------|
| **Funcionais** | *O que* o sistema deve fazer? | cadastrar, pedir, pagar |
| **Não funcionais** | *Como* deve funcionar? | segurança, desempenho, disponibilidade |
| **Restrições** | Quais são os limites? | prazo, orçamento, equipe, legislação, sistemas legados |

```text
        ┌─────────────────┐
        │  FUNCIONAIS     │  "O sistema DEVE ..."
        │  (o que faz)    │  cadastrar / pedir / pagar
        └─────────────────┘
        ┌─────────────────┐
        │ NÃO FUNCIONAIS  │  "O sistema deve ser ..."
        │  (como faz)     │  seguro / rápido / disponível
        └─────────────────┘
        ┌─────────────────┐
        │  RESTRIÇÕES     │  "Só podemos ..."
        │  (limites)      │  prazo / verba / lei / legado
        └─────────────────┘
```

> [!TIP]
> Requisito **funcional** diz *"o quê"*; requisito **não funcional** diz *"o quão bem"*. Os dois são igualmente importantes.

---

## ✂️ 05. 3. Delimite o MVP

**MVP** = *Minimum Viable Product* (produto mínimo viável) — o menor conjunto que **resolve a dor principal**.

- Liste o **indispensável** para resolver a dor principal.
- Separe **"precisa agora"** de **"pode vir depois"**.
- Escreva **o que está fora do escopo** (isso evita surpresas).
- Evite construir funcionalidades **sem validar valor**.

```text
   ┌──────────────────────────────────────────────┐
   │                   MVP                         │
   │  ┌────────┐ ┌────────┐ ┌────────┐             │
   │  │ entrar │ │ pedir  │ │  pagar │             │
   │  └────────┘ └────────┘ └────────┘             │
   └──────────────────────────────────────────────┘
   ┌──────────────────────────────────────────────┐
   │              FORA DO ESCOPO (agora)           │
   │  relatórios · cupom · gamificação · chat      │
   └──────────────────────────────────────────────┘
```

> [!WARNING]
> "Vou já fazer tudo" é o caminho mais curto para **nunca entregar nada**. Defina o escopo **antes** de codar.

---

## 🚶 06. 4. Desenhe a jornada do usuário

**Exemplo:** escolher produto → criar pedido → pagar → acompanhar status.

- Identifique **decisões, exceções e caminhos alternativos**.
- O que acontece **se o pagamento falhar**? E **se a rede cair**?
- **Fluxos bem descritos viram casos de teste.**

```text
  escolher produto → criar pedido → pagar ──sucesso──► acompanhar status
                                        │
                                        └─falha──► avisar usuário
                                                   e permitir repetir
```

> [!IMPORTANT]
> O **caminho feliz** é fácil. O valor está em mapear **o que dá errado** — exceções viram requisitos e testes.

---

## 🏗️ 07. 5. Comece com uma arquitetura simples

**Desenho inicial:** componentes **suficientes para o problema atual**.

```text
   ┌────────────┐      ┌──────────────┐      ┌──────────────┐
   │  Cliente   │─────►│  Aplicação   │─────►│    Dados     │
   │ (tela/API) │◄─────│  (regras)    │◄─────│ (persistência)│
   └────────────┘      └──────────────┘      └──────────────┘
```

| Fazer agora | Evitar agora |
|-------------|--------------|
| desenho mínimo que funciona | "arquitetura do futuro" |
| separar responsabilidades | microsserviços prematuros |
| 3–4 componentes claros | camadas sem exigência real |

> [!TIP]
> Slide **07** usa o *exemplo do ZIP · System Design*: comece **simples** e evolua **com evidências**, não com suposições.

---

## ⚖️ 08. 6. Decisões técnicas têm trade-offs

Toda escolha tem **benefício e custo**. Não existe bala de prata.

| Decisão | O que está em jogo |
|---------|--------------------|
| **Banco de dados** | consistência, consultas, custo e operação |
| **API e integração** | contrato, autenticação, erros e **idempotência** |
| **Síncrono ou assíncrono** | resposta imediata × desacoplamento |
| **Monólito ou serviços** | simplicidade × autonomia e complexidade |
| **Hospedagem** | escala, manutenção e custo |
| **Observabilidade** | logs, métricas e rastreamento |

```text
              Toda decisão é um pêndulo
        simplicidade ◄──────────────► flexibilidade
           (fácil hoje)              (escala amanhã)
                      você escolhe o ponto
```

> [!NOTE]
> **Trade-off** = você **ganha** de um lado e **paga** do outro. Decidir é escolher **qual custo** você aceita.

---

## 🗓️ 09. 7. Planeje a implementação

- Divida funcionalidades em **entregas pequenas e verificáveis**.
- Defina **critérios de aceite antes** de desenvolver.
- Mapeie **dependências**: banco, endpoints, telas e integrações.
- **Versione** decisões importantes e **registre riscos**.

```text
  Funcionalidade grande
  ├── Entrega 1  →  verificável  ✔
  ├── Entrega 2  →  verificável  ✔
  └── Entrega 3  →  verificável  ✔
```

> [!IMPORTANT]
> "Pronto" precisa ser **objetivo**. Escreva o **critério de aceite** antes: *"está pronto quando o usuário consegue pagar e recebe a confirmação"*.

---

## 🔗 10. 8. Como o planejamento guia o código

Cada artefato do planejamento vira uma parte do código:

| Artefato | Define |
|----------|--------|
| **Requisito** | o comportamento esperado |
| **Fluxo** | estados, exceções e regras |
| **Modelo de dados** | entidades e relações |
| **Contrato de API** | entradas, saídas e erros |
| **Critério de aceite** | quando está pronto |
| **Teste** | comprova o comportamento |

```text
  Requisito → Fluxo → Modelo de dados → Contrato de API
                     → Critério de aceite → Teste
```

> [!TIP]
> Quando o requisito é claro, o código **quase se escreve sozinho**. O retrabalho nasce da **ambiguidade**.

---

## 🧪 11. 9. Testar não é a última etapa

Testar **acompanha** o desenvolvimento — não é um passo final.

| Nível | O que verifica |
|-------|----------------|
| **Unidade** | regras e comportamentos **isolados** |
| **Integração** | **comunicação** entre componentes |
| **Ponta a ponta** | a **jornada completa** do usuário |
| **Segurança, falhas e desempenho** | conforme o **risco** do sistema |

```text
  unidade ──► integração ──► ponta a ponta ──► segurança / carga
   (1 parte)   (partes juntas)  (usuário real)    (sob risco)
```

> [!WARNING]
> Deixar os testes "para o final" costuma significar **não testar**. Quanto mais tarde o erro é encontrado, **mais caro** ele fica.

---

## 📈 12. 10. O sistema cresce — e agora?

> **Não escale por moda:** observe **métricas** e identifique o **gargalo**.

```text
   ❌ «Todo mundo usa Kubernetes...»      ✅ «A latência subiu 3x
      ...vamos usar também»                  no horário de pico»
```

*(Slide do bloco **EXEMPLO DO ZIP · System Design**.)*

> [!IMPORTANT]
> Escalar sem medir é **apostar**. Primeiro **meça**, depois identifique **onde** está o gargalo, e só então **decida**.

---

## 🗄️ 13. 11. Evolua a persistência com evidências

> **Cada nova camada** adiciona **benefícios, custos e novos modos de falha**.

```text
   arquivo  →  banco relacional  →  cache  →  fila/replicação
     ▲              ▲                 ▲            ▲
   simples       transações        velocidade   resiliência
   porém pouco   e integridade     porém mais    porém mais
   escalável                      complexidade  operação
```

*(Slide do bloco **EXEMPLO DO ZIP · System Design**.)*

> [!NOTE]
> Evoluir a persistência é **resolver um problema comprovado** — não antecipar problemas imaginários.

---

## 🛡️ 14. 12. Resiliência e disponibilidade

> **Replicação** exige pensar em **consistência, failover e operação**.

```text
       ┌─────────────┐        ┌─────────────┐
       │  Réplica A  │◄──────►│  Réplica B  │
       └──────┬──────┘        └──────┬──────┘
              │   e se A cair?        │
              └────── failover ──────┘
              (quem manda? os dados batem?)
```

*(Slide do bloco **EXEMPLO DO ZIP · System Design**.)*

| Ganho | Preço |
|-------|-------|
| disponibilidade | consistência a gerenciar |
| tolerância a falhas | complexidade de operação |
| escala de leitura | sincronização entre nós |

> [!WARNING]
> Replicar **não é de graça**: introduz **consistência eventual**, eleição de líder e muito mais operação.

---

## 🔁 15. 13. Ciclo de decisão em produção

```text
  Sintoma → Medir → Formular hipótese → Testar → Decidir
      ▲                                              │
      └──────────────────────────────────────────────┘
```

- Exemplo: **lentidão não significa automaticamente** "precisa de microsserviços".
- Observe **latência, erros, volume e uso de recursos**.
- Faça a **menor mudança** que resolva o **problema comprovado**.

> [!TIP]
> "Sintoma" é o que o usuário sente. **Hipótese** é a sua explicação. Só a **medição** diz quem está certo.

---

## 🍽️ 16. Atividade prática · 15 minutos

**Cenário:** uma **cantina** precisa receber **pedidos antecipados**.

| Etapa | O que entregar |
|-------|----------------|
| **Descoberta** | Quem usa? Qual a dor? Qual o objetivo? |
| **Requisitos** | **3 funcionais** + **2 não funcionais** |
| **Fluxo** | Desenhe pedido, pagamento e **falhas** |
| **Arquitetura** | Desenhe **cliente, API, aplicação e dados** |
| **Entrega** | Defina o **MVP** e **3 critérios de aceite** |

```text
  ┌─────────┐   pedido   ┌──────────┐   paga   ┌────────┐
  │ Cliente │ ─────────► │  App/API │ ───────► │ Dados  │
  └─────────┘ ◄───────── └──────────┘ ◄─────── └────────┘
                 status        │ falha?
                               └─► avisar e permitir repetir
```

> [!NOTE]
> Se você consegue responder às 5 colunas da tabela em 15 minutos, você entendeu o espírito da aula.

---

## 💬 17. Perguntas para a turma

1. **Qual decisão você tomaria antes de escolher a linguagem?**
2. **O que você precisaria descobrir para justificar essa escolha?**

> [!IMPORTANT]
> Lembre-se: **código implementa decisões; boas decisões começam com contexto.**

---

## ✅ O que aprendemos hoje

```text
┌───────────────────────────────────────────────────────────┐
│                          APRENDEMOS                        │
├───────────────────────────────────────────────────────────┤
│ • Desenvolvimento começa pelo PROBLEMA, não pela tech      │
│ • 6 fases: Descobrir → Definir → Projetar → Planejar       │
│            → Construir → Aprender                          │
│ • Requisitos funcionais, não funcionais e restrições       │
│ • MVP: o indispensável, agora                             │
│ • Jornada do usuário inclui exceções e falhas              │
│ • Toda decisão técnica tem TRADE-OFFS                      │
│ • Testar acompanha o desenvolvimento (não é o final)       │
│ • Escalar com MÉTRICAS, não com moda                       │
└───────────────────────────────────────────────────────────┘
```

---

## 🧠 Teste seu conhecimento

1. Por que começar pela escolha da linguagem é um erro?
2. Quais são as **6 fases** do caminho do problema até a entrega?
3. Qual a diferença entre requisito **funcional** e **não funcional**?
4. Dê um exemplo de **restrição** de um projeto.
5. O que é **MVP**? Por que delimitar o escopo ajuda?
6. Por que mapear as **falhas** no fluxo (ex.: pagamento que falha) é importante?
7. O que significa dizer que **decisões técnicas têm trade-offs**?
8. Por que **testar não é a última etapa**?
9. O que fazer quando o sistema **cresce e fica lento**?
10. Qual é o **ciclo de decisão em produção**?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. Porque você decide **como** resolver antes de saber **o que** resolver — pode construir a coisa errada, muito bem feita.
2. **Descobrir → Definir → Projetar → Planejar → Construir → Aprender.**
3. **Funcional** diz *o que* o sistema faz (cadastrar, pagar); **não funcional** diz *como* ele deve se comportar (segurança, desempenho, disponibilidade).
4. Prazo, orçamento, tamanho da equipe, legislação, integração com sistemas legados.
5. **Minimum Viable Product** — o menor conjunto que resolve a dor principal. Delimitar evita construir sem validar valor.
6. Porque o **caminho feliz** é fácil; o valor está em tratar exceções, que viram requisitos e casos de teste.
7. Que toda escolha **ganha** de um lado e **paga** do outro (ex.: simplicidade × flexibilidade). Decide-se qual custo aceitar.
8. Porque deixar para o final costuma significar **não testar**, e o erro descoberto tarde é mais **caro** de corrigir.
9. **Medir primeiro** (latência, erros, volume, recursos), identificar o **gargalo** e fazer a **menor mudança** que resolva.
10. **Sintoma → medir → formular hipótese → testar → decidir.**

</details>

---

## 🗺️ Checklist de Estudos

### 🔴 Imprescindível — Aula Extra

- [ ] Explicar por que o desenvolvimento começa pelo **problema**
- [ ] Listar as **6 fases** do processo
- [ ] Diferenciar requisitos **funcionais** e **não funcionais**
- [ ] Reconhecer **restrições** de um projeto
- [ ] Definir **MVP** e separar "agora" de "depois"
- [ ] Desenhar a **jornada do usuário** incluindo falhas
- [ ] Desenhar uma **arquitetura simples**
- [ ] Dar exemplos de **trade-offs** técnicos
- [ ] Escrever **critérios de aceite** antes de codar
- [ ] Entender os níveis de **teste**
- [ ] Decidir com base em **métricas**, não em moda

### 🟢 Próximos passos

- [ ] Aplicar em um projeto real: definir requisitos e MVP **antes** de codar
- [ ] Voltar ao **3.6 Laços** na prática → [`recap-aula-07.md`](recap-aula-07.md)
- [ ] Avançar em **3.7 Arrays** e **3.8 Funções**

---

## 🔗 Links úteis

**Leituras e referências:**
- [Manifesto Ágil](https://agilemanifesto.org/iso/ptbr/manifesto.html) — valores que orientam o processo
- [Scrum Guide](https://scrumguides.org/) — um framework de processo
- [The Twelve-Factor App](https://12factor.net/pt_br/) — boas práticas de aplicações
- [Martin Fowler — System Design](https://martinfowler.com/architecture/) — arquitetura e trade-offs
- [Google SRE Book](https://sre.google/sre-book/table-of-contents/) — disponibilidade, resiliência e operação

**Vídeos no YouTube:**
- [**Engenharia de Software — requisitos e levantamento**](https://www.youtube.com/watch?v=5l7Yb8kJZ0Q) — descobrir e definir
- [**MVP: o que é e como fazer**](https://www.youtube.com/watch?v=7Z5x1kY9MNs) — escopo enxuto
- [**Trade-offs de arquitetura**](https://www.youtube.com/watch?v=5l7Yb8kJZ0Q) — decisões técnicas na prática

---

## 💡 Dicas de ouro

> **Entenda antes de codar.** A linguagem é o *como*; o problema é o *porquê*.

> **Requisito funcional × não funcional.** Um diz *o quê*; o outro diz *o quão bem*.

> **MVP não é "sistema meia-boca".** É o **mínimo que resolve de verdade**.

> **Fluxos incluem exceções.** O caminho feliz é fácil; o valor está no que dá errado.

> **Toda decisão é um trade-off.** Pergunte sempre: *o que eu ganho e o que eu pago?*

> **Meça antes de mudar.** Escalar sem evidência é apostar.

> **Código implementa decisões.** Boas decisões começam com **contexto**.

---

*Recap produzido para a turma da Aula Extra — Engenharia de Software.*
*Professor: Luis Felipe Araujo Lima*
