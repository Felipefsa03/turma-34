# 🏆 Desafio das Aulas 13 e 14 — Loja Byte: do CRUD às Decisões

> **Módulo:** 4 · Banco de Dados / SQL (MySQL) — Aulas 13 (CRUD) e 14 (JOINs + Agregações)
> **Entrega:** arquivo `.sql` (ou repositório GitHub com o script), executável em um cliente MySQL
> **Base:** projeto **Loja Byte** (clientes, produtos, pedidos, itens_pedido)

Este desafio integra as competências das **Aulas 13 e 14**: **CRUD completo** (`INSERT`, `SELECT`, `UPDATE`, `DELETE`) + **JOINs** (INNER/LEFT/RIGHT) + **funções de agregação** (`COUNT`, `SUM`, `AVG`, `MIN`, `MAX`) + **`GROUP BY`** + **`HAVING`** + **`WHERE`**. O objetivo é responder **perguntas de negócio** da Loja Byte de forma segura.

> [!TIP]
> Revise os recaps [`recap-aula-13.md`](recap-aula-13.md) e [`recap-aula-14.md`](recap-aula-14.md), além do [`index.sql`](../Aula13/index.sql).  
> Execute tudo em um cliente MySQL (MySQL CLI, phpMyAdmin, DBeaver, MySQL Workbench).

---

## 🎯 Objetivo

A Loja Byte quer **decisões baseadas em dados**: saber quais clientes compraram, quais nunca compraram, o faturamento por estado, o ticket médio, os produtos mais caros/baratos e os estados que mais faturam. Você deve montar um **script único** que, além de manter os dados (CRUD), responde a essas perguntas com JOINs e agregações.

---

## 📋 Requisitos funcionais

### 1️⃣ Preparação do banco (CRUD base)
- Crie (se não existir) o banco `loja_byte` e selecione-o.
- Crie as tabelas `clientes`, `produtos`, `pedidos`, `itens_pedido` (PK/FK).
- Insira os **dados iniciais** (4 clientes, 4 produtos, 4 pedidos, 5 itens).

### 2️⃣ CREATE — cadastrar novos registros
- Cadastre o cliente **Rafael**, estado **MG**, `id_cliente = 6`.
- Cadastre o produto **Headset**, preço **R$ 150,00**, `id_produto = 50`.
- Teste em `START TRANSACTION` … `ROLLBACK` e consolide com `COMMIT`.

### 3️⃣ READ + JOIN — relacionando tabelas
Escreva consultas que respondam:
- a) Liste **clientes que fizeram pedidos** (INNER JOIN), mostrando `id_pedido`, `nome`, `estado`.
- b) Liste **TODOS os clientes** e seus pedidos (LEFT JOIN). Diego deve aparecer com `NULL`.
- c) Liste **clientes que nunca compraram** (LEFT JOIN + `WHERE p.id_pedido IS NULL`).
- d) Liste todos os clientes preservando a tabela da direita usando **RIGHT JOIN** (mesmo resultado de um LEFT JOIN invertido). Explique em comentário por que os dois existem.

### 4️⃣ Agregações — perguntas de negócio
- a) Quantos **pedidos** existem? (`COUNT(*)`)
- b) Qual o **faturamento total** da loja? (`SUM(quantidade * preco_unitario)`)
- c) Quantos **clientes distintos** compraram? (`COUNT(DISTINCT id_cliente)`)
- d) Qual o **preço médio**, **menor** e **maior** preço dos produtos? (`AVG`, `MIN`, `MAX`)

### 5️⃣ GROUP BY — faturamento por estado
- Liste o **faturamento total por estado** (`JOIN` pedidos + itens + clientes, `GROUP BY estado`, `ORDER BY faturamento DESC`).
- Mostre o resultado esperado: SP = 950, BA = 560.

### 6️⃣ WHERE × HAVING — filtrando no momento certo
- Liste os estados com faturamento **acima de R$ 500**, considerando apenas pedidos a partir de `2026-11-01`. Use `WHERE` para a data e `HAVING` para o valor.

### 7️⃣ UPDATE — alterar o registro certo
- Atualize o preço do **Mouse** (`id_produto = 20`) para **R$ 90,00**.
- Confira com `SELECT` (mesmo `WHERE`) antes e depois. Teste em transação e consolide com `COMMIT`.
- ⚠️ Sem `WHERE` altera tudo.

### 8️⃣ DELETE — remover sem provocar caos
- Remova o cliente **Diego** (`id_cliente = 4`) **apenas se não tiver pedidos** (verifique antes; respeite a FK).
- Confirme com `SELECT` e consolide com `COMMIT`.
- ⚠️ Sem `WHERE` remove tudo.

### 9️⃣ Checkpoint — comando perigoso
- Corrija o comando abaixo para alterar **apenas** o cliente 2 (Bruno) para o estado `SP`:
  ```sql
  UPDATE clientes
  SET estado = 'SP';
  ```
- Explique em comentário por que `ORDER BY` e `GROUP BY` não filtram.

---

## 🧠 Conceitos obrigatórios (use todos!)

| Conceito | Onde aparece no desafio |
|----------|-------------------------|
| `INSERT INTO ... VALUES` | cadastro (CREATE) |
| `SELECT` + `WHERE` + `ORDER BY` | consultas (READ) |
| `UPDATE ... SET ... WHERE` | alteração de preço |
| `DELETE FROM ... WHERE` | remoção de cliente |
| `START TRANSACTION` / `ROLLBACK` / `COMMIT` | testes seguros |
| `INNER JOIN` | clientes que compraram |
| `LEFT JOIN` | todos os clientes + nunca compraram |
| `RIGHT JOIN` | preservar tabela da direita |
| `ON` correto (PK × FK) | relacionamento entre tabelas |
| `COUNT`, `SUM`, `AVG`, `MIN`, `MAX` | perguntas de negócio |
| `COUNT(DISTINCT ...)` | clientes distintos |
| `GROUP BY` | faturamento por estado |
| `HAVING` | filtrar grupos |
| `WHERE` antes do `GROUP BY` | filtrar linhas (data) |

---

## 🏁 Como testar

1. Execute o script inteiro em um cliente MySQL.
2. Confirme criação do banco, tabelas e dados iniciais.
3. Confirme cadastro de Rafael (id 6) e Headset (id 50).
4. Confirme as consultas de JOIN (INNER/LEFT/RIGHT) e o cliente que nunca comprou (Diego).
5. Confirme as agregações: 4 pedidos, faturamento R$ 1.510, 3 compradores distintos, preço médio R$ 337,50, min R$ 80, max R$ 950.
6. Confirme faturamento por estado: SP = 950, BA = 560.
7. Confirme o filtro `HAVING` (> R$ 500) com `WHERE` de data.
8. Confirme Mouse a R$ 90,00 e remoção de Diego (se sem pedidos).
9. Confirme que o Checkpoint foi corrigido com `WHERE id_cliente = 2`.

> Dica: rode por blocos e use `ROLLBACK` se algo der errado.

---

## ✅ Critérios de avaliação

- [ ] Script cria banco, tabelas e dados iniciais
- [ ] Usa `INSERT` para Rafael e Headset (com transação)
- [ ] Usa `SELECT` com `WHERE`/`ORDER BY`
- [ ] Usa `INNER JOIN`, `LEFT JOIN` e `RIGHT JOIN` corretamente
- [ ] Identifica clientes que nunca compraram (`IS NULL`)
- [ ] Verifica o `ON` (PK × FK) — não compara colunas erradas
- [ ] Usa `COUNT`, `SUM`, `AVG`, `MIN`, `MAX`
- [ ] Usa `COUNT(DISTINCT id_cliente)`
- [ ] Usa `GROUP BY` para faturamento por estado
- [ ] Usa `WHERE` (data) + `HAVING` (valor) corretamente
- [ ] Usa `UPDATE` com `WHERE` e confere com `SELECT`
- [ ] Usa `DELETE` com `WHERE` e verifica FK
- [ ] Testa com `START TRANSACTION`/`ROLLBACK` e consolida com `COMMIT`
- [ ] Corrige o Checkpoint com `WHERE id_cliente = 2`
- [ ] Explica (em comentário) por que `ORDER BY`/`GROUP BY` não filtram
- [ ] Script roda do início ao fim sem erro fatal

---

## ⭐ Bônus (para ir além)

1. Descubra **quanto cada cliente gastou**, incluindo quem nunca comprou (LEFT JOIN + `COALESCE(SUM(...), 0)`), ordenado por total decrescente.
2. Liste os **estados com mais de 1 cliente** (`GROUP BY estado HAVING COUNT(*) > 1`).
3. Mostre o **ticket médio por pedido** (`AVG` do total de cada pedido).
4. Crie uma **view** `vw_faturamento_estado` com o faturamento por UF.
5. Adicione um `SELECT` final mostrando o **estado final** de todas as tabelas.

---

## 🧩 Dicas

- **`WHERE` filtra linhas, `HAVING` filtra grupos.** Agregação só no `HAVING`.
- **`RIGHT JOIN` = `LEFT JOIN` invertido.** Prefira `LEFT JOIN` + ordem invertida por legibilidade.
- **Verifique o `ON`.** Comparar colunas erradas não dá erro — dá resultado vazio/duplicado.
- **`COUNT(DISTINCT)` para únicos.** Ideal para contar clientes distintos.
- **Teste em transação.** `ROLLBACK` permite errar sem consequência.
- **FK protege integridade.** Apagar cliente com pedidos pode falhar — verifique antes.

---

## 🔓 Gabarito de referência (tente sozinho primeiro!)

```sql
-- =====================================================
-- DESAFIO AULAS 13 E 14 — LOJA BYTE
-- =====================================================

CREATE DATABASE IF NOT EXISTS loja_byte;
USE loja_byte;

CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    cpf CHAR(11) UNIQUE,
    estado CHAR(2) NOT NULL
);

CREATE TABLE IF NOT EXISTS produtos (
    id_produto INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido INT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_pedido DATE NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

CREATE TABLE IF NOT EXISTS itens_pedido (
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id_pedido, id_produto),
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);

-- Dados iniciais
INSERT INTO clientes (id_cliente, nome, estado) VALUES
    (1, 'Ana', 'BA'), (2, 'Bruno', 'SP'),
    (3, 'Carla', 'BA'), (4, 'Diego', 'RJ');

INSERT INTO produtos (id_produto, nome, preco) VALUES
    (10, 'Teclado', 120.00), (20, 'Mouse', 80.00),
    (30, 'Monitor', 950.00), (40, 'Webcam', 200.00);

INSERT INTO pedidos (id_pedido, id_cliente, data_pedido) VALUES
    (101, 1, '2026-11-02'), (102, 2, '2026-11-03'),
    (103, 1, '2026-11-04'), (104, 3, '2026-11-04');

INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco_unitario) VALUES
    (101, 10, 1, 120.00), (101, 20, 2, 80.00),
    (102, 30, 1, 950.00), (103, 40, 1, 200.00),
    (104, 20, 1, 80.00);

-- 2. CREATE
START TRANSACTION;
INSERT INTO clientes (id_cliente, nome, estado) VALUES (6, 'Rafael', 'MG');
INSERT INTO produtos (id_produto, nome, preco) VALUES (50, 'Headset', 150.00);
SELECT * FROM clientes WHERE id_cliente = 6;
SELECT * FROM produtos WHERE id_produto = 50;
COMMIT;

-- 3. READ + JOIN
-- a) clientes que fizeram pedidos
SELECT p.id_pedido, c.nome, c.estado
FROM clientes c
INNER JOIN pedidos p ON c.id_cliente = p.id_cliente
ORDER BY p.id_pedido ASC;

-- b) todos os clientes e seus pedidos
SELECT c.nome, p.id_pedido
FROM clientes c
LEFT JOIN pedidos p ON c.id_cliente = p.id_cliente;

-- c) clientes que nunca compraram
SELECT c.nome, p.id_pedido
FROM clientes c
LEFT JOIN pedidos p ON c.id_cliente = p.id_cliente
WHERE p.id_pedido IS NULL;

-- d) RIGHT JOIN (preserva a tabela da direita = clientes)
SELECT c.nome, p.id_pedido
FROM pedidos p
RIGHT JOIN clientes c ON p.id_cliente = c.id_cliente;
-- Existe por conveniência/legibilidade: A RIGHT JOIN B = B LEFT JOIN A.

-- 4. Agregações
SELECT COUNT(*) AS total_pedidos FROM pedidos;
SELECT SUM(quantidade * preco_unitario) AS faturamento_total FROM itens_pedido;
SELECT COUNT(DISTINCT id_cliente) AS clientes_com_compras FROM pedidos;

SELECT AVG(preco) AS preco_medio,
       MIN(preco) AS menor_preco,
       MAX(preco) AS maior_preco
FROM produtos;

-- 5. GROUP BY — faturamento por estado
SELECT c.estado,
       SUM(i.quantidade * i.preco_unitario) AS faturamento
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.estado
ORDER BY faturamento DESC;

-- 6. WHERE x HAVING
SELECT c.estado,
       SUM(i.quantidade * i.preco_unitario) AS total
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
JOIN itens_pedido i ON i.id_pedido = p.id_pedido
WHERE p.data_pedido >= '2026-11-01'
GROUP BY c.estado
HAVING SUM(i.quantidade * i.preco_unitario) > 500;

-- 7. UPDATE
START TRANSACTION;
SELECT * FROM produtos WHERE id_produto = 20;
UPDATE produtos SET preco = 90.00 WHERE id_produto = 20;
SELECT nome, preco FROM produtos WHERE id_produto = 20;
COMMIT;

-- 8. DELETE
START TRANSACTION;
SELECT * FROM pedidos WHERE id_cliente = 4;
DELETE FROM clientes WHERE id_cliente = 4;
SELECT * FROM clientes WHERE id_cliente = 4;
COMMIT;

-- 9. Checkpoint corrigido
-- ORDER BY só ordena resultado e GROUP BY agrupa linhas — nenhum FILTRA.
-- Quem filtra é o WHERE.
UPDATE clientes
SET estado = 'SP'
WHERE id_cliente = 2;

-- Bônus: quanto cada cliente gastou (incluindo quem nunca comprou)
SELECT c.nome,
       COALESCE(SUM(i.quantidade * i.preco_unitario), 0) AS total_gasto
FROM clientes c
LEFT JOIN pedidos p ON p.id_cliente = c.id_cliente
LEFT JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.id_cliente, c.nome
ORDER BY total_gasto DESC;
```

---

*Desafio das Aulas 13 e 14 — Módulo 4 · Banco de Dados / SQL.*  
*Professor: Luis Felipe Araujo Lima*
