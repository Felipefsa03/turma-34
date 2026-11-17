# 📘 Recap da Aula 15 — Modelagem e Consolidação SQL (Módulos 4.3 a 4.6)

> **Tema da aula:** *Bancos de Dados Relacionais e SQL — da modelagem às consultas que resolvem problemas reais*
> **Slides trabalhados:** *1 a 31* (deck completo: modelagem, CRUD, JOIN, agregações e missão final)
> **Módulo:** 4 · Banco de Dados / SQL (MySQL)
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do próximo encontro.

**Objetivo:** fechar o bloco **4.3 a 4.6** com uma visão integrada: desenhar o modelo relacional
(**MER**, entidades, atributos, PK/FK e cardinalidades), manipular registros com **CRUD seguro**,
conectar tabelas com **JOIN** e transformar dados em indicadores com **agregações**. A aula termina
com a missão: um **ranking de quanto cada cliente gastou**, incluindo quem nunca comprou.

> [!TIP]
> Os comandos da prática estão em **[`../Aula13/index.sql`](../Aula13/index.sql)**.
> Execute em um cliente MySQL (CLI, Workbench, DBeaver ou phpMyAdmin).

---

## 🗺️ Mapa da Aula

| Slide | Tópico | O que você aprende |
|:-----:|--------|--------------------|
| 1–3 | [Abertura e o laboratório](#-abertura-e-o-laboratório-loja-byte) | a jornada da aula e o projeto Loja Byte |
| 4–9 | [Modelagem (4.3)](#-modelagem-43-desenhar-antes-de-programar) | MER, entidades, atributos, cardinalidade, PK e FK |
| 10–16 | [CRUD (4.4)](#-crud-44-as-quatro-operações) | INSERT, SELECT, UPDATE, DELETE com `WHERE` e transações |
| 17–22 | [JOIN (4.5)](#-join-45-conectando-as-peças) | INNER, LEFT, RIGHT e o `ON` correto |
| 23–28 | [Agregações (4.6)](#-agregações-46-de-dados-para-decisões) | COUNT, SUM, AVG, MIN/MAX, GROUP BY e HAVING |
| 29–31 | [Missão final](#-missão-final-ranking-de-gasto-por-cliente) | relatório completo com LEFT JOIN + COALESCE |

---

## 🏪 Abertura e o laboratório: Loja Byte

A aula é uma **jornada única**: entender → praticar → testar → explicar.

| Etapa | Tema | Tempo |
|:-----:|------|:-----:|
| 01 | Modelagem — organizar antes de codificar | 25 min |
| 02 | CRUD — criar, consultar, atualizar e excluir | 30 min |
| 03 | JOIN — conectar tabelas e informações | 25 min |
| 04 | Agregações — transformar dados em indicadores | 25 min |
| 05 | Desafio final — construir um relatório real | 15 min |

O projeto-base é a **Loja Byte**, um e-commerce fictício com quatro tabelas:

| Tabela | Papel | Dados iniciais |
|--------|-------|----------------|
| `clientes` | quem compra | Ana (BA), Bruno (SP), Carla (BA), Diego (RJ) |
| `produtos` | o que se vende | Teclado 120, Mouse 80, Monitor 950, Webcam 200 |
| `pedidos` | cada compra | 101 (Ana), 102 (Bruno), 103 (Ana), 104 (Carla) |
| `itens_pedido` | o conteúdo da compra | produto, quantidade e preço unitário |

> [!NOTE]
> Analogia do dia: **apps de delivery** também conectam pessoas, produtos e pedidos sem repetir
> tudo em uma única tabela. É exatamente o que o modelo relacional faz.

---

## 🧩 Modelagem (4.3): desenhar antes de programar

### MER — Modelo Entidade-Relacionamento

O MER mostra **entidades e relacionamentos** antes da criação das tabelas:

```text
CLIENTES (PK id_cliente, nome, cpf, estado)
    │ 1
    │
    │ N
PEDIDOS (PK id_pedido, FK id_cliente, data_pedido)
    │ 1
    │
    │ N
ITENS_PEDIDO (FK id_pedido, FK id_produto, quantidade, preco_unitario)
    │ N
    │
    │ 1
PRODUTOS (PK id_produto, nome, preco)
```

- **Entidade** = o conceito sobre o qual guardamos dados (Cliente, Produto, Pedido, ItemPedido).
  Atributos como `preco` ou `data_entrega` **não** são entidades.
- **Atributo** = nome + tipo + restrições. `cpf` é `CHAR(11)` (identificador com zeros à esquerda),
  `preco` é `DECIMAL(10,2)` (valor monetário), `estado` é `CHAR(2)` (UF).
- **Cardinalidade** = quantas ocorrências se associam: `1:1` (conta ↔ perfil), `1:N`
  (cliente → vários pedidos), `N:N` (pedidos ↔ produtos, resolvida pela tabela `itens_pedido`).

### PK e FK — a ponte entre as tabelas

- **PK** (`PRIMARY KEY`) identifica cada linha de forma única: `id_cliente`, `id_pedido`.
- **FK** (`FOREIGN KEY`) referencia a PK de outra tabela e protege a integridade: um pedido
  não pode apontar para um cliente inexistente.

```sql
CREATE TABLE pedidos (
    id_pedido INT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_pedido DATE NOT NULL,
    FOREIGN KEY (id_cliente)
        REFERENCES clientes(id_cliente)
);
```

### 🎯 Checkpoint de modelagem

1. Qual campo é a melhor PK de `pedidos`? **B) `id_pedido`** — `nome_cliente` pode repetir e
   `valor_total` pode mudar.
2. Como modelar Pedidos ↔ Produtos (`N:N`)? **A) tabela intermediária** (`itens_pedido`).

---

## 💾 CRUD (4.4): as quatro operações

| Operação | Comando | Ação |
|:--------:|---------|------|
| **C**reate | `INSERT INTO` | adicionar linha |
| **R**ead | `SELECT` | consultar |
| **U**pdate | `UPDATE` | alterar |
| **D**elete | `DELETE FROM` | remover |

### CREATE — com transação

```sql
START TRANSACTION;

INSERT INTO clientes (id_cliente, nome, estado)
VALUES (5, 'Eva', 'PE');

SELECT * FROM clientes WHERE id_cliente = 5;

ROLLBACK; -- Eva aparece no SELECT, mas a inserção é desfeita
```

**Missão de 60 segundos:** cadastrar Rafael (id 6, MG), testar com `SELECT` e reverter com
`ROLLBACK`.

### READ — escolher colunas, filtrar e ordenar

```sql
SELECT nome, estado
FROM clientes
WHERE estado = 'BA'
ORDER BY nome;
-- Ana | Carla

-- Desafio: produtos acima de R$ 100
SELECT nome, preco FROM produtos WHERE preco > 100;
```

### UPDATE e DELETE — `WHERE` é o cinto de segurança

```sql
START TRANSACTION;

-- 1º confira, 2º atualize, 3º confirme
SELECT nome, preco FROM produtos WHERE id_produto = 20;
UPDATE produtos SET preco = 90.00 WHERE id_produto = 20;
SELECT nome, preco FROM produtos WHERE id_produto = 20;

ROLLBACK; -- troque por COMMIT para tornar permanente
```

> [!DANGER]
> `UPDATE produtos SET preco = 90.00;` e `DELETE FROM clientes;` são SQL válidos, mas afetam
> **todas as linhas**. Em `DELETE`, uma FK pode bloquear a exclusão de um cliente com pedidos.

**Checkpoint perigoso:** `UPDATE clientes SET estado = 'SP';` alteraria todo mundo. O correto é
`UPDATE clientes SET estado = 'SP' WHERE id_cliente = 2;` — `ORDER BY` ordena e `GROUP BY` agrupa;
**quem filtra é o `WHERE`**.

---

## 🔗 JOIN (4.5): conectando as peças

Se `pedidos` guarda só `id_cliente`, como descobrir o **nome** de quem fez o pedido 101?
Juntando as tabelas pela chave:

| Tipo | O que entra no resultado |
|------|--------------------------|
| `INNER JOIN` | só linhas com correspondência nas duas tabelas |
| `LEFT JOIN` | **todas** as linhas da esquerda, mesmo sem correspondência |
| `RIGHT JOIN` | **todas** as linhas da direita (`A RIGHT JOIN B` = `B LEFT JOIN A`) |

```sql
-- Quem comprou (Ana aparece 2×: pedidos 101 e 103; Diego não aparece)
SELECT c.nome, p.id_pedido
FROM clientes c
INNER JOIN pedidos p ON c.id_cliente = p.id_cliente
ORDER BY p.id_pedido;

-- Quem ainda não comprou: LEFT JOIN + IS NULL
SELECT c.nome, p.id_pedido
FROM clientes c
LEFT JOIN pedidos p ON c.id_cliente = p.id_cliente
WHERE p.id_pedido IS NULL; -- Diego | NULL
```

> [!WARNING]
> **Checkpoint:** `ON c.id_cliente = p.id_pedido` compara coisas diferentes (1–4 com 101–104)
> e devolve resultado **vazio** — sem erro de sintaxe. O correto é `ON c.id_cliente = p.id_cliente`.

**Caso de negócio:** marketing quer um cupom para clientes cadastrados que nunca compraram →
`LEFT JOIN ... WHERE p.id_pedido IS NULL`.

---

## 📊 Agregações (4.6): de dados para decisões

| Função | Pergunta | Resultado na Loja Byte |
|--------|----------|------------------------|
| `COUNT(*)` | quantos pedidos? | 4 |
| `SUM(quantidade * preco_unitario)` | quanto faturamos? | R$ 1.510 |
| `AVG(preco)` | preço médio? | R$ 337,50 |
| `MIN` / `MAX` | menor / maior preço? | 80 / 950 |

```sql
SELECT COUNT(*) AS total_pedidos FROM pedidos;

SELECT COUNT(DISTINCT id_cliente) AS compradores
FROM pedidos; -- 3: Ana, Bruno e Carla

SELECT AVG(preco) AS preco_medio,
       MIN(preco) AS menor_preco,
       MAX(preco) AS maior_preco
FROM produtos;
```

### GROUP BY — faturamento por UF

```sql
SELECT c.estado,
       SUM(i.quantidade * i.preco_unitario) AS faturamento
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.estado
ORDER BY faturamento DESC;
-- SP 950 | BA 560
```

Toda coluna do `SELECT` que **não** estiver dentro de agregação precisa aparecer no `GROUP BY`.

### WHERE × HAVING

```text
WHERE (linhas: data ≥ 2026-11-01)
   ↓
GROUP BY (agrupa por estado)
   ↓
HAVING (grupos: total > 500)
```

```sql
SELECT c.estado, SUM(i.quantidade * i.preco_unitario) AS total
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
JOIN itens_pedido i ON i.id_pedido = p.id_pedido
WHERE p.data_pedido >= '2026-11-01'
GROUP BY c.estado
HAVING SUM(i.quantidade * i.preco_unitario) > 500;
```

> [!WARNING]
> **Checkpoint:** `WHERE COUNT(*) > 5` dá erro — agregação não vai no `WHERE`. Correção:
> `GROUP BY c.estado HAVING COUNT(*) > 5`.

---

## 🎯 Missão final: ranking de gasto por cliente

O dono quer **todos os clientes**, inclusive quem nunca comprou, com R$ 0 no lugar de `NULL`.

```sql
SELECT c.nome,
       COALESCE(SUM(i.quantidade * i.preco_unitario), 0) AS total_gasto
FROM clientes c
LEFT JOIN pedidos p ON p.id_cliente = c.id_cliente
LEFT JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.id_cliente, c.nome
ORDER BY total_gasto DESC;
```

| Cliente | Total gasto |
|---------|------------:|
| Bruno | R$ 950 |
| Ana | R$ 480 |
| Carla | R$ 80 |
| Diego | R$ 0 |

**Por que `COALESCE`?** o `SUM` de quem não tem itens é `NULL`; `COALESCE(NULL, 0)` devolve zero.
**Por que `LEFT JOIN`?** um `INNER JOIN` excluiria Diego do ranking.

---

## 🧠 Teste seu conhecimento

1. O que um MER mostra antes da criação das tabelas?
2. Por que `cpf` deve ser `CHAR(11)` e não `INT`?
3. Qual a diferença entre PK e FK?
4. Como modelar um relacionamento `N:N` entre pedidos e produtos?
5. Por que testar `INSERT`, `UPDATE` e `DELETE` com `START TRANSACTION` + `ROLLBACK`?
6. O que falta em `UPDATE clientes SET estado = 'SP';` para alterar só o cliente 2?
7. Por que Ana aparece duas vezes no `INNER JOIN` e Diego não aparece?
8. Qual a diferença entre `WHERE` e `HAVING`?
9. Para que serve `COALESCE` na missão final?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. **Entidades, atributos e relacionamentos** (com suas cardinalidades).
2. Porque é um **identificador**, não uma quantidade: texto preserva os **zeros à esquerda**.
3. A **PK** identifica a linha; a **FK** referencia a PK de outra tabela e protege a integridade.
4. Com uma **tabela intermediária** (`itens_pedido`) que vira duas relações 1:N.
5. Para ver o efeito e poder **desfazer** (`ROLLBACK`) antes do `COMMIT`.
6. **`WHERE id_cliente = 2`** — `ORDER BY`/`GROUP BY` não filtram.
7. Ana tem **dois pedidos** (101 e 103); Diego **não tem pedido**, então o `INNER JOIN` o exclui.
8. `WHERE` filtra **linhas antes** do agrupamento; `HAVING` filtra **grupos depois** (aceita agregação).
9. Converte o `NULL` de quem não comprou em **0** para o ranking.

</details>

---

## 🗺️ Checklist de Estudos

- [ ] Desenhar o MER da Loja Byte (4 entidades e cardinalidades)
- [ ] Diferenciar entidade, atributo, PK e FK
- [ ] Usar tipos coerentes (`DECIMAL` para dinheiro, `CHAR` para identificadores)
- [ ] Executar CRUD com `WHERE` e transações (`ROLLBACK`/`COMMIT`)
- [ ] Conferir com `SELECT` antes de `UPDATE`/`DELETE`
- [ ] Usar `INNER`, `LEFT` e `RIGHT JOIN` e conferir o `ON` (PK × FK)
- [ ] Encontrar clientes sem pedidos com `LEFT JOIN + IS NULL`
- [ ] Aplicar `COUNT`, `SUM`, `AVG`, `MIN`, `MAX` e `COUNT(DISTINCT)`
- [ ] Agrupar com `GROUP BY` e filtrar grupos com `HAVING`
- [ ] Montar o ranking final com `LEFT JOIN`, `COALESCE` e `ORDER BY DESC`

---

## 🔗 Links Úteis

- [Documentação MySQL — CREATE TABLE](https://dev.mysql.com/doc/refman/8.0/en/create-table.html)
- [Documentação MySQL — FOREIGN KEY](https://dev.mysql.com/doc/refman/8.0/en/create-table-foreign-keys.html)
- [Documentação MySQL — JOIN](https://dev.mysql.com/doc/refman/8.0/en/join.html)
- [Documentação MySQL — Aggregate Functions](https://dev.mysql.com/doc/refman/8.0/en/aggregate-functions.html)
- [Documentação MySQL — GROUP BY](https://dev.mysql.com/doc/refman/8.0/en/group-by-handling.html)
- [W3Schools — SQL Joins](https://www.w3schools.com/sql/sql_join.asp)
- [W3Schools — SQL GROUP BY / HAVING](https://www.w3schools.com/sql/sql_groupby.asp)

---

## 💡 Dicas de ouro

> **Modele antes de codificar.** Um MER de 5 minutos evita horas de `ALTER TABLE`.

> **`WHERE` é cinto de segurança.** Sem ele, `UPDATE`/`DELETE` atingem todas as linhas.

> **`ON` compara PK com FK.** Errar a coluna não dá erro — dá resultado vazio ou duplicado.

> **`WHERE` filtra linhas, `HAVING` filtra grupos.** Agregação só no `HAVING`.

> **`LEFT JOIN + COALESCE` = relatório completo.** Inclui quem não tem registros relacionados.

---

*Recap produzido para a turma da Aula 15 — Módulo 4 · Banco de Dados / SQL.*  
*Professor: Luis Felipe Araujo Lima*
