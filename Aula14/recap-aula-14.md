# 📘 Recap da Aula 14 — JOINs e Agregações em SQL

> **Tema da aula:** *Bancos de Dados Relacionais e SQL — Módulo 4.5 (JOIN) e 4.6 (Agregações)*
> **Slides trabalhados:** *21 a 27* (RIGHT JOIN, Checkpoint de JOIN, Agregações, COUNT/SUM, AVG/MIN/MAX, GROUP BY, WHERE × HAVING)
> **Módulo:** 4 · Banco de Dados / SQL (MySQL)
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do próximo encontro.

**Objetivo:** aprender a **relacionar tabelas** com `JOIN` (preservando registros mesmo sem correspondência) e a **responder perguntas de negócio** com funções de agregação (`COUNT`, `SUM`, `AVG`, `MIN`, `MAX`), agrupando resultados com `GROUP BY` e filtrando grupos com `HAVING`.

> [!TIP]
> Os comandos trabalhados estão em **[`index.sql`](../Aula13/index.sql)** (seção 8 em diante — INNER/LEFT/RIGHT JOIN, COUNT, SUM, AVG, MIN/MAX, GROUP BY e HAVING).  
> São comandos SQL para serem executados em um cliente MySQL (MySQL CLI, phpMyAdmin, DBeaver, MySQL Workbench, etc.).

---

## 🗺️ Mapa da Aula

| # | Tópico | O que você aprende |
|:-:|--------|--------------------|
| 21 | [RIGHT JOIN: olhando pelo outro lado](#-right-join-olhando-pelo-outro-lado) | preserva a tabela da direita |
| 22 | [Checkpoint: o SQL executa…](#-checkpoint--o-sql-executa) | colunas erradas no `ON` |
| 23 | [Agregações: de dados para decisões](#-agregações-de-dados-para-decisões) | COUNT, SUM, AVG, MIN/MAX |
| 24 | [COUNT e SUM](#-count-e-sum-quantos-e-quanto) | quantos registros e quanto faturamos |
| 25 | [AVG, MIN e MAX](#-avg-min-e-max-lendo-os-extremos) | média, menor e maior preço |
| 26 | [GROUP BY: vendas por estado](#-group-by-vendas-por-estado) | agrupar e somar por UF |
| 27 | [WHERE × HAVING](#-where--having-filtre-no-momento-certo) | filtrar linhas vs filtrar grupos |

---

## 🏪 Projeto-base: Loja Byte (revisão rápida)

Continuamos no projeto **Loja Byte** (clientes, produtos, pedidos, itens_pedido). Dados de referência:

| id_cliente | nome | estado |
|:----------:|------|:------:|
| 1 | Ana | BA |
| 2 | Bruno | SP |
| 3 | Carla | BA |
| 4 | Diego | RJ |

| id_produto | nome | preco |
|:----------:|------|------:|
| 10 | Teclado | 120.00 |
| 20 | Mouse | 80.00 |
| 30 | Monitor | 950.00 |
| 40 | Webcam | 200.00 |

Pedidos: 101 (Ana), 102 (Bruno), 103 (Ana), 104 (Carla). Diego (id 4) **nunca comprou**.

---

## 🔁 Revisão: os JOINs (INNER e LEFT)

Antes do RIGHT JOIN, vimos dois tipos de junção:

### INNER JOIN — só quem tem correspondência

Mostra **clientes que fizeram pedidos** (exclui quem não comprou).

```sql
SELECT
    p.id_pedido,
    c.nome,
    c.estado
FROM clientes c
INNER JOIN pedidos p
    ON c.id_cliente = p.id_cliente
ORDER BY p.id_pedido ASC;
```

### LEFT JOIN — todos da esquerda, com ou sem correspondência

Mostra **TODOS os clientes** e seus pedidos (Diego aparece com `NULL`).

```sql
SELECT
    c.nome,
    p.id_pedido
FROM clientes c
LEFT JOIN pedidos p
    ON c.id_cliente = p.id_cliente;
```

**Encontrar clientes que nunca compraram:**

```sql
SELECT
    c.nome,
    p.id_pedido
FROM clientes c
LEFT JOIN pedidos p
    ON c.id_cliente = p.id_cliente
WHERE p.id_pedido IS NULL;
```

---

## ➡️ RIGHT JOIN: olhando pelo outro lado

Preserva a **tabela da direita**, mesmo quando a esquerda não possui correspondência.

```sql
SELECT c.nome, p.id_pedido
FROM pedidos p
RIGHT JOIN clientes c
  ON p.id_cliente = c.id_cliente;
```

**Mesmo efeito de:**

```sql
SELECT c.nome, p.id_pedido
FROM clientes c
LEFT JOIN pedidos p
  ON c.id_cliente = p.id_cliente;
```

Ou seja: `A RIGHT JOIN B` equivale a `B LEFT JOIN A`. A tabela à **direita** do `RIGHT JOIN` é a que fica "completa".

### ❓ Por que também existe RIGHT JOIN?

Porque nem sempre a ordem das tabelas é a mais natural. Às vezes escrevemos a tabela principal (a que queremos preservar) **depois**, e usar `RIGHT JOIN` evita reescrever a consulta invertendo as tabelas. É uma questão de **legibilidade e conveniência** — os dois produzem o mesmo resultado.

> [!NOTE]
> Na prática, a maioria dos desenvolvedores prefere usar sempre `LEFT JOIN` e apenas **inverter a ordem das tabelas**. O `RIGHT JOIN` existe para dar flexibilidade.

---

## 🎯 Checkpoint — o SQL executa…

O SQL abaixo **roda**, mas o relacionamento compara as colunas erradas.

```sql
SELECT c.nome, p.id_pedido
FROM clientes c
INNER JOIN pedidos p
  ON c.id_cliente = p.id_pedido;
```

**Discussão em duplas:** qual coluna deveria estar no `ON`? O resultado será vazio, duplicado ou correto?

**Resposta:** a coluna correta é `p.id_cliente` (não `p.id_pedido`).

```sql
-- CORRETO
SELECT c.nome, p.id_pedido
FROM clientes c
INNER JOIN pedidos p
  ON c.id_cliente = p.id_cliente;
```

Com `p.id_pedido` no `ON`, o SQL tenta casar `id_cliente` (1, 2, 3, 4) com `id_pedido` (101, 102, 103, 104) — **nenhum casamento**, resultado **vazio**.

> [!WARNING]
> Sempre verifique se o `ON` compara **as mesmas entidades** (chave primária de uma tabela com a chave estrangeira correspondente da outra). Errar o `ON` não dá erro de sintaxe — dá resultado errado (vazio ou duplicado).

---

## 📊 Agregações: de dados para decisões

Agora o SQL responde **perguntas de negócio** — não apenas lista registros.

| Função | Pergunta | Exemplo de uso |
|--------|----------|----------------|
| `COUNT` | Quantos registros? | 4 pedidos |
| `SUM` | Quanto faturamos? | R$ 1.510 |
| `AVG` | Preço médio dos produtos? | R$ 337,50 |
| `MIN` / `MAX` | Menor e maior preço? | 80 / 950 |

**Pergunta de negócio:** o dono da Loja Byte quer saber qual estado mais compra. Precisamos de **JOIN + agregação + GROUP BY**.

---

## 🔢 COUNT e SUM: quantos e quanto?

`COUNT` conta registros; `SUM` acumula valores numéricos.

### COUNT — quantidade de pedidos

```sql
SELECT COUNT(*) AS total_pedidos
FROM pedidos;
```

**Resultado:** 4 pedidos.

### SUM — faturamento total

```sql
SELECT SUM(quantidade * preco_unitario)
  AS faturamento_total
FROM itens_pedido;
```

**Resultado:** R$ 1.510.

### 🔥 Extra

`COUNT(DISTINCT id_cliente)` na tabela `pedidos` retorna **3 compradores** (Ana, Bruno, Carla — Diego nunca comprou).

```sql
SELECT COUNT(DISTINCT id_cliente) AS clientes_com_compras
FROM pedidos;
```

> [!NOTE]
> `COUNT(*)` conta **todas as linhas**. `COUNT(coluna)` conta linhas onde a coluna **não é NULL**. `COUNT(DISTINCT coluna)` conta valores **únicos**.

---

## 📏 AVG, MIN e MAX: lendo os extremos

Uma consulta para descobrir média, menor e maior preço.

```sql
SELECT
  AVG(preco) AS preco_medio,
  MIN(preco) AS menor_preco,
  MAX(preco) AS maior_preco
FROM produtos;
```

**Resultados:**

| preco_medio | menor_preco | maior_preco |
|:-----------:|:-----------:|:-----------:|
| R$ 337,50 | R$ 80,00 | R$ 950,00 |

- `AVG(preco)` → média aritmética dos preços
- `MIN(preco)` → menor preço (Mouse, R$ 80,00)
- `MAX(preco)` → maior preço (Monitor, R$ 950,00)

---

## 🗂️ GROUP BY: vendas por estado

Faça o SQL agrupar os registros e somar o faturamento de cada UF.

```sql
SELECT
    c.estado,
    SUM(i.quantidade * i.preco_unitario)
        AS faturamento
FROM clientes c
JOIN pedidos p
  ON p.id_cliente = c.id_cliente
JOIN itens_pedido i
  ON i.id_pedido = p.id_pedido
GROUP BY c.estado
ORDER BY faturamento DESC;
```

**Faturamento por UF:**

| estado | faturamento |
|:------:|------------:|
| SP | 950 |
| BA | 560 |

- `GROUP BY c.estado` → agrupa as linhas por estado
- `SUM(...)` → soma o faturamento de cada grupo
- `ORDER BY faturamento DESC` → ordena do maior para o menor

> [!IMPORTANT]
> Toda coluna no `SELECT` que **não** está dentro de uma função de agregação deve aparecer no `GROUP BY`.

---

## ⚖️ WHERE × HAVING: filtre no momento certo

`WHERE` filtra **linhas antes** do agrupamento; `HAVING` filtra **grupos depois**.

```text
WHERE  → filtra pedidos por data
   ↓
GROUP BY → agrupa as linhas por estado
   ↓
HAVING → mantém grupos acima de R$ 500
```

```sql
SELECT c.estado,
  SUM(i.quantidade * i.preco_unitario) AS total
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
JOIN itens_pedido i ON i.id_pedido = p.id_pedido
WHERE p.data_pedido >= '2026-11-01'
GROUP BY c.estado
HAVING SUM(i.quantidade * i.preco_unitario) > 500;
```

| Cláusula | Quando filtra | Pode usar agregação? |
|----------|---------------|:--------------------:|
| `WHERE` | **antes** do `GROUP BY` (linhas individuais) | ❌ Não |
| `HAVING` | **depois** do `GROUP BY` (grupos) | ✅ Sim |

> [!WARNING]
> Tentar usar `WHERE SUM(...) > 500` dá erro. Agregações só podem ser filtradas com `HAVING`.

---

## 🧠 Teste seu conhecimento

1. O que o `RIGHT JOIN` preserva?
2. `A RIGHT JOIN B` é equivalente a qual outra escrita?
3. Por que existe o `RIGHT JOIN` se podemos inverter a ordem e usar `LEFT JOIN`?
4. No Checkpoint, qual coluna deveria estar no `ON`?
5. Qual a diferença entre `COUNT(*)` e `COUNT(DISTINCT coluna)`?
6. Para que serve o `GROUP BY`?
7. Qual a diferença entre `WHERE` e `HAVING`?
8. Por que não podemos usar `WHERE SUM(...) > 500`?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. A **tabela da direita** (mesmo sem correspondência na esquerda).
2. `B LEFT JOIN A`.
3. Por **legibilidade/conveniência** — quando a tabela a preservar é escrita por último.
4. `p.id_cliente` (e não `p.id_pedido`).
5. `COUNT(*)` conta **todas as linhas**; `COUNT(DISTINCT coluna)` conta valores **únicos** não nulos.
6. **Agrupar linhas** por uma ou mais colunas para aplicar agregações por grupo.
7. `WHERE` filtra **linhas antes** do agrupamento (sem agregação); `HAVING` filtra **grupos depois** (com agregação).
8. Porque `WHERE` não pode usar funções de agregação — use `HAVING`.

</details>

---

## 🗺️ Checklist de Estudos

- [ ] Entender `INNER JOIN`, `LEFT JOIN` e `RIGHT JOIN`
- [ ] Saber preservar a tabela da direita com `RIGHT JOIN`
- [ ] Converter `RIGHT JOIN` em `LEFT JOIN` invertendo a ordem
- [ ] Verificar se o `ON` compara colunas correspondentes
- [ ] Usar `COUNT`, `SUM`, `AVG`, `MIN`, `MAX`
- [ ] Diferenciar `COUNT(*)`, `COUNT(coluna)` e `COUNT(DISTINCT coluna)`
- [ ] Agrupar resultados com `GROUP BY`
- [ ] Filtrar grupos com `HAVING`
- [ ] Diferenciar `WHERE` (linhas) de `HAVING` (grupos)
- [ ] Responder perguntas de negócio com JOIN + agregação + GROUP BY

---

## 🔗 Links Úteis

**Documentação oficial MySQL:**
- [JOIN](https://dev.mysql.com/doc/refman/8.0/en/join.html)
- [Aggregate Functions (COUNT, SUM, AVG, MIN, MAX)](https://dev.mysql.com/doc/refman/8.0/en/aggregate-functions.html)
- [GROUP BY](https://dev.mysql.com/doc/refman/8.0/en/group-by-handling.html)
- [HAVING](https://dev.mysql.com/doc/refman/8.0/en/select.html)

**Para praticar (W3Schools):**
- [W3Schools — SQL Joins](https://www.w3schools.com/sql/sql_join.asp)
- [W3Schools — SQL LEFT JOIN](https://www.w3schools.com/sql/sql_join_left.asp)
- [W3Schools — SQL RIGHT JOIN](https://www.w3schools.com/sql/sql_join_right.asp)
- [W3Schools — SQL COUNT](https://www.w3schools.com/sql/sql_count.asp)
- [W3Schools — SQL SUM](https://www.w3schools.com/sql/sql_sum.asp)
- [W3Schools — SQL AVG](https://www.w3schools.com/sql/sql_avg.asp)
- [W3Schools — SQL MIN / MAX](https://www.w3schools.com/sql/sql_min_max.asp)
- [W3Schools — SQL GROUP BY](https://www.w3schools.com/sql/sql_groupby.asp)
- [W3Schools — SQL HAVING](https://www.w3schools.com/sql/sql_having.asp)

---

## 💡 Dicas de ouro

> **`RIGHT JOIN` é o espelho do `LEFT JOIN`.** `A RIGHT JOIN B` = `B LEFT JOIN A`.

> **Prefira `LEFT JOIN` + ordem invertida.** Mais comum e mais legível.

> **Verifique o `ON`.** Comparar colunas erradas não dá erro — dá resultado vazio ou duplicado.

> **`WHERE` filtra linhas, `HAVING` filtra grupos.** Agregação só no `HAVING`.

> **`COUNT(DISTINCT)` para únicos.** Ideal para contar clientes distintos que compraram.

> **`GROUP BY` + agregação = resposta de negócio.** É assim que o SQL vira decisão.

---

*Recap produzido para a turma da Aula 14 — Módulo 4 · Banco de Dados / SQL.*  
*Professor: Luis Felipe Araujo Lima*
