# 📘 Recap da Aula 16 — Consultas Avançadas e Projeto Final SQL (Módulos 4.7 a 4.9)

> **Tema da aula:** *SQL: subqueries, EXISTS, otimização básica, cenários de consultas e projeto final*
> **Slides trabalhados:** *1 a 50* (1–31 revisam 4.3–4.6; 32–50 são os conteúdos novos de 4.7–4.9)
> **Módulo:** 4 · Banco de Dados / SQL (MySQL)
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do **desafio do módulo**.

**Objetivo:** fazer perguntas mais complexas aos dados com **subqueries** (`IN`, `EXISTS`),
entender quando usar subquery ou `JOIN`, investigar o desempenho com **`EXPLAIN` e índices**, montar
**relatórios, rankings e cruzamentos** e entregar o **projeto final `escola_sql`** — um sistema
de alunos com modelo relacional, tabelas, dados de exemplo e consultas de acompanhamento.

> [!TIP]
> Os comandos novos da aula estão em **[`index.sql`](index.sql)**.  
> O desafio de encerramento do módulo está em **[`Desafio.md`](Desafio.md)**.

---

## 🗺️ Mapa da Aula

| Slide | Tópico | O que você aprende |
|:-----:|--------|--------------------|
| 1–31 | [Revisão de 4.3–4.6](#-revisão-rápida-43-a-46) | modelagem, CRUD, JOIN e agregações |
| 32 | [Consultas avançadas](#-consultas-avançadas-47) | perguntas dentro de perguntas |
| 33 | [Subquery escalar](#-subquery-escalar) | `WHERE preco > (SELECT AVG(...))` |
| 34 | [IN e NOT IN](#-in-e-not-in) | subquery que devolve vários IDs |
| 35 | [EXISTS / NOT EXISTS](#-exists--not-exists) | subconsulta correlacionada |
| 36 | [Subquery × JOIN](#-subquery-ou-join) | legibilidade, duplicações e plano |
| 37–38 | [Otimização básica](#-otimização-básica) | `EXPLAIN`, índice e três hábitos |
| 39 | [Checkpoint](#-checkpoint-not-exists) | cliente sem pedido sem termos técnicos |
| 40–44 | [Cenários de consultas](#-cenários-de-consultas-48) | relatório, ranking e cruzamento |
| 45–50 | [Projeto final (4.9)](#-projeto-final-49-sistema-de-alunos) | `escola_sql` do zero à entrega |

---

## 🔁 Revisão rápida (4.3 a 4.6)

A primeira parte do deck retoma a **Loja Byte**:

- **4.3 Modelagem:** MER, entidades, atributos, cardinalidades, PK e FK.
- **4.4 CRUD:** `INSERT`/`SELECT`/`UPDATE`/`DELETE`, sempre com `WHERE` e transações.
- **4.5 JOIN:** `INNER` (quem comprou), `LEFT` (quem nunca comprou), `RIGHT` (espelho do LEFT).
- **4.6 Agregações:** `COUNT`, `SUM`, `AVG`, `MIN`/`MAX`, `GROUP BY` e `HAVING`.
- **Checkpoints:** `UPDATE` sem `WHERE`, `ON` comparando colunas erradas e agregação no `WHERE`.

> Se precisar relembrar, veja os recaps da [Aula 13](../Aula13/recap-aula-13.md),
> [Aula 14](../Aula14/recap-aula-14.md) e [Aula 15](../Aula15/recap-aula-15.md).

---

## 🚀 Consultas avançadas (4.7)

### Subquery escalar

Uma consulta **interna** calcula um valor usado pela **externa**:

```sql
SELECT nome, preco
FROM produtos
WHERE preco > (
    SELECT AVG(preco) FROM produtos   -- 337,50
);
-- Resultado: Monitor (950,00)
```

> **Dica:** execute a consulta interna sozinha primeiro. Depois encapsule-a.

### IN e NOT IN

Quando a subquery devolve **vários valores**, use `IN`:

```sql
SELECT nome
FROM clientes
WHERE id_cliente IN (
    SELECT id_cliente FROM pedidos
);
-- Ana, Bruno, Carla (Diego não tem pedidos)
```

- `NOT IN` inverte: traz quem **não** está no conjunto.
- ⚠️ Cuidado: se a subquery retornar `NULL`, `NOT IN` pode devolver **vazio**.

### EXISTS / NOT EXISTS

A subconsulta **correlacionada** usa a linha atual da consulta externa:

```sql
SELECT c.nome
FROM clientes c
WHERE EXISTS (
    SELECT 1
    FROM pedidos p
    WHERE p.id_cliente = c.id_cliente
);
```

- `EXISTS` → verdadeiro se encontrar **pelo menos uma** linha.
- `NOT EXISTS` → encontra clientes **sem** pedidos (equivale ao `LEFT JOIN + IS NULL`).
- O `SELECT 1` é apenas um marcador: o que importa é a **existência**.

### Subquery ou JOIN?

| Abordagem | Quando costuma ser mais clara |
|-----------|-------------------------------|
| Subquery (`IN`) | "quem está nesse conjunto?" |
| `JOIN` + `DISTINCT` | trazer colunas das duas tabelas na saída |

```sql
-- Mesma pergunta, duas escritas
SELECT nome FROM clientes
WHERE id_cliente IN (SELECT id_cliente FROM pedidos);

SELECT DISTINCT c.nome
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente;
```

Compare **clareza**, **duplicações** e **plano de execução** — não existe opção sempre mais rápida.

### Otimização básica

```sql
EXPLAIN
SELECT * FROM pedidos WHERE id_cliente = 1;

CREATE INDEX idx_pedidos_cliente ON pedidos (id_cliente);

EXPLAIN
SELECT * FROM pedidos WHERE id_cliente = 1;
```

Leia o plano: `type`, `key` e `rows`. Compare **antes e depois** do índice.

> [!NOTE]
> Índice não é grátis: acelera leituras, mas ocupa espaço e encarece escritas.

**Três hábitos:** (1) peça só as colunas necessárias, (2) filtre cedo com `WHERE`,
(3) meça com `EXPLAIN` e tempo real em vez de adivinhar.

### 🎯 Checkpoint: NOT EXISTS

```sql
SELECT c.nome
FROM clientes c
WHERE NOT EXISTS (
    SELECT 1 FROM pedidos p
    WHERE p.id_cliente = c.id_cliente
);
```

Por que `p.id_cliente = c.id_cliente`? Porque a subconsulta precisa comparar cada pedido com
**o cliente da linha atual**. Em português: *"mostre o nome do cliente para o qual não existe
nenhum pedido"*.

---

## 🧭 Cenários de consultas (4.8)

| Cenário | O que faz | Ferramentas |
|---------|-----------|-------------|
| **Relatório** | resume dados para decisão | `JOIN` + `SUM` + `GROUP BY` |
| **Ranking** | ordena para achar líderes | `ORDER BY DESC` + `LIMIT` |
| **Cruzamento** | combina várias tabelas | múltiplos `JOIN` + agregação |

### Relatório — gasto por cliente

```sql
SELECT c.nome,
       COALESCE(SUM(i.quantidade * i.preco_unitario), 0) AS total
FROM clientes c
LEFT JOIN pedidos p ON p.id_cliente = c.id_cliente
LEFT JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.id_cliente, c.nome;
-- Bruno 950 | Ana 480 | Carla 80 | Diego 0
```

`LEFT JOIN` é essencial: com `INNER JOIN`, Diego desapareceria do relatório.

### Ranking — produtos mais vendidos

```sql
SELECT p.nome, SUM(i.quantidade) AS unidades
FROM produtos p
JOIN itens_pedido i ON i.id_produto = p.id_produto
GROUP BY p.id_produto, p.nome
ORDER BY unidades DESC, p.nome
LIMIT 3;
```

> Empates existem. Um **segundo critério** de ordenação deixa o ranking previsível.

### Cruzamento — faturamento por estado

```sql
SELECT c.estado,
       COUNT(DISTINCT p.id_pedido) AS pedidos,
       SUM(i.quantidade * i.preco_unitario) AS total
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.estado
ORDER BY total DESC;
-- SP 950 | BA 560
```

`COUNT(DISTINCT p.id_pedido)` evita contar o mesmo pedido várias vezes por causa dos itens.

**Checkpoint:** monte um relatório com nome do cliente, quantidade de pedidos, total gasto,
maior gasto primeiro e **incluindo quem não comprou** — então explique por que `DISTINCT` é preciso.

---

## 🎓 Projeto final (4.9): sistema de alunos

Saímos da Loja Byte e fomos para a **`escola_sql`**: uma escola precisa cadastrar alunos,
disciplinas e matrículas, além de acompanhar notas.

### Modelo — três tabelas

```text
ALUNOS (PK id_aluno, nome, turma)
   │ 1
   │ N
MATRICULAS (PK id_matricula, FK id_aluno, FK id_disciplina, nota)
   │ N
   │ 1
DISCIPLINAS (PK id_disciplina, nome)
```

Um aluno cursa várias disciplinas e uma disciplina tem vários alunos (`N:N`) — a tabela
`matriculas` resolve o relacionamento e guarda a **nota**.

### Implementação e dados de exemplo

```sql
CREATE DATABASE escola_sql;
USE escola_sql;

CREATE TABLE alunos (
    id_aluno INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    turma VARCHAR(20)
);

CREATE TABLE disciplinas (
    id_disciplina INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL
);

CREATE TABLE matriculas (
    id_matricula INT PRIMARY KEY,
    id_aluno INT NOT NULL,
    id_disciplina INT NOT NULL,
    nota DECIMAL(4,2),
    FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno),
    FOREIGN KEY (id_disciplina) REFERENCES disciplinas(id_disciplina)
);

INSERT INTO alunos VALUES
    (1, 'Ana', '1A'), (2, 'Bruno', '1A'), (3, 'Carla', '1B');
INSERT INTO disciplinas VALUES
    (10, 'Banco de Dados'), (20, 'Programacao');
INSERT INTO matriculas VALUES
    (101, 1, 10, 9.0), (102, 1, 20, 8.0),
    (103, 2, 10, 7.0), (104, 3, 20, 9.5);
```

### Consultas de acompanhamento

```sql
-- Média por aluno (nomes em vez de IDs)
SELECT a.nome, ROUND(AVG(m.nota), 2) AS media
FROM alunos a
JOIN matriculas m ON m.id_aluno = a.id_aluno
GROUP BY a.id_aluno, a.nome
ORDER BY media DESC;
-- Carla 9,50 | Ana 8,50 | Bruno 7,00

-- Missão extra: só quem tem média >= 8
SELECT a.nome, ROUND(AVG(m.nota), 2) AS media
FROM alunos a
JOIN matriculas m ON m.id_aluno = a.id_aluno
GROUP BY a.id_aluno, a.nome
HAVING AVG(m.nota) >= 8
ORDER BY media DESC;
```

**Checklist da entrega:** criar as três tabelas · inserir dados de exemplo · listar alunos e
disciplinas · calcular médias · criar ranking de notas · mostrar uma consulta ao vivo explicando
PK, FK, `JOIN` e `GROUP BY` · encontrar alunos sem matrícula (`LEFT JOIN + IS NULL`).

---

## 🧠 Teste seu conhecimento

1. O que uma subquery escalar devolve?
2. Por que tomar cuidado com `NOT IN` quando a subquery tem `NULL`?
3. O que a subconsulta correlacionada do `EXISTS` usa para comparar?
4. `EXISTS` e `JOIN` sempre produzem o mesmo resultado? O que comparar na escolha?
5. O que `EXPLAIN` mostra e o que `CREATE INDEX` muda?
6. Por que usar `COUNT(DISTINCT p.id_pedido)` no cruzamento?
7. Por que o relatório de clientes usa `LEFT JOIN` em vez de `INNER JOIN`?
8. Como encontrar alunos sem matrícula?
9. Por que `matriculas` é necessária se alunos e disciplinas já existem?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. **Um único valor** (uma linha/coluna), como `AVG(preco)`.
2. Porque `NOT IN` com `NULL` pode resultar em **conjunto vazio** — use `NOT EXISTS` ou trate o `NULL`.
3. A **linha atual da consulta externa** (ex.: `c.id_cliente`).
4. Não necessariamente da mesma forma: compare **clareza**, duplicações e **plano de execução**.
5. `EXPLAIN` mostra o **plano estimado** (`type`, `key`, `rows`); o índice pode mudar esse plano.
6. Porque um pedido aparece **uma vez por item**; `DISTINCT` evita contagem duplicada.
7. Para **incluir quem não comprou** (`COALESCE` transforma `NULL` em 0).
8. `SELECT a.nome FROM alunos a LEFT JOIN matriculas m ON m.id_aluno = a.id_aluno WHERE m.id_matricula IS NULL;`
9. Porque o relacionamento é **N:N** e a nota pertence ao par aluno/disciplina — a tabela associativa guarda essa informação.

</details>

---

## 🗺️ Checklist de Estudos

- [ ] Escrever subqueries escalares e com `IN` / `NOT IN`
- [ ] Usar `EXISTS` / `NOT EXISTS` com subconsulta correlacionada
- [ ] Saber quando `JOIN` é mais legível que subquery
- [ ] Usar `EXPLAIN` e criar índice em coluna de FK
- [ ] Evitar `SELECT *` sem motivo e filtrar cedo com `WHERE`
- [ ] Montar relatórios com `LEFT JOIN` + `COALESCE`
- [ ] Criar rankings com `ORDER BY DESC`, segundo critério e `LIMIT`
- [ ] Cruzar dados com múltiplos `JOIN` e `COUNT(DISTINCT ...)`
- [ ] Implementar o projeto `escola_sql` (3 tabelas, PK/FK e dados de exemplo)
- [ ] Calcular médias com `AVG`/`ROUND` e filtrar com `HAVING`

---

## 🔗 Links Úteis

- [MySQL — Subqueries](https://dev.mysql.com/doc/refman/8.0/en/subqueries.html)
- [MySQL — EXISTS / NOT EXISTS](https://dev.mysql.com/doc/refman/8.0/en/exists-and-not-exists-subqueries.html)
- [MySQL — EXPLAIN](https://dev.mysql.com/doc/refman/8.0/en/explain.html)
- [MySQL — CREATE INDEX](https://dev.mysql.com/doc/refman/8.0/en/create-index.html)
- [MySQL — COALESCE](https://dev.mysql.com/doc/refman/8.0/en/comparison-operators.html#function_coalesce)
- [W3Schools — SQL EXISTS](https://www.w3schools.com/sql/sql_exists.asp)
- [W3Schools — SQL TOP / LIMIT](https://www.w3schools.com/sql/sql_top.asp)

---

## 💡 Dicas de ouro

> **Subquery é pergunta dentro de pergunta.** Resolva a interna primeiro.

> **`NOT EXISTS` > `NOT IN`** quando há risco de `NULL` na subquery.

> **Meça, não adivinhe.** `EXPLAIN` antes e depois do índice.

> **`DISTINCT` evita duplicação** quando o JOIN multiplica linhas.

> **Relatório completo = `LEFT JOIN` + `COALESCE`.** Ninguém some do resultado.

> **Projeto pronto é projeto explicado.** Mostre a consulta e justifique PK, FK, JOIN e GROUP BY.

---

*Recap produzido para a turma da Aula 16 — Módulo 4 · Banco de Dados / SQL.*  
*Professor: Luis Felipe Araujo Lima*
