# 🏆 Desafio da Aula 13 — CRUD na Loja Byte

> **Módulo:** 4 · Banco de Dados / SQL (MySQL) — Aula 13 (Módulo 4.4 · CRUD)
> **Entrega:** arquivo `.sql` (ou repositório GitHub com o script), executável em um cliente MySQL
> **Base:** projeto **Loja Byte** (clientes, produtos, pedidos, itens_pedido)

Este desafio fixa as competências da Aula 13: **CREATE (`INSERT`)**, **READ (`SELECT`)**, **UPDATE** e **DELETE**, sempre com **`WHERE`**, **transações** (`START TRANSACTION`/`ROLLBACK`/`COMMIT`) e **boas práticas** (conferir com `SELECT` antes de alterar/apagar).

> [!TIP]
> Revise o [`recap-aula-13.md`](recap-aula-13.md) e o [`index.sql`](index.sql) antes de começar.  
> Execute tudo em um cliente MySQL (MySQL CLI, phpMyAdmin, DBeaver, MySQL Workbench).

---

## 🎯 Objetivo

A Loja Byte precisa de um **script de manutenção** que cadastre novos clientes/produtos, consulte informações, atualize preços e remova registros — **sem provocar caos** (sem alterar/apagar tudo por engano). Tudo deve ser testado em transação e, ao final, consolidado com `COMMIT`.

---

## 📋 Requisitos funcionais

### 1️⃣ Preparação do banco
- Crie (se não existir) o banco `loja_byte` e selecione-o (`USE`).
- Crie as tabelas `clientes`, `produtos`, `pedidos` e `itens_pedido` com as chaves primárias e estrangeiras (FK) vistas em aula.
- Insira os **dados iniciais** (4 clientes, 4 produtos, 4 pedidos, 5 itens).

### 2️⃣ CREATE — cadastrar novos registros
- Cadastre o cliente **Rafael**, estado **MG**, com `id_cliente = 6`.
- Cadastre o produto **Headset**, preço **R$ 150,00**, com `id_produto = 50`.
- Teste a inserção dentro de `START TRANSACTION` … `ROLLBACK`, confirmando com `SELECT` antes de consolidar.

### 3️⃣ READ — consultar informações
Escreva consultas que respondam:
- a) Liste **todos os clientes**.
- b) Liste apenas clientes do estado **BA**, ordenados por nome.
- c) Liste produtos com preço **acima de R$ 100**, ordenados por preço decrescente.
- d) Liste os pedidos do cliente de `id_cliente = 1` (Ana), mostrando `id_pedido` e `data_pedido`.

### 4️⃣ UPDATE — alterar o registro certo
- Atualize o preço do produto **Mouse** (`id_produto = 20`) para **R$ 90,00**.
- **Antes** de atualizar, faça um `SELECT` com o **mesmo `WHERE`** para conferir.
- Teste em transação (`START TRANSACTION` … `ROLLBACK`) e, ao final, consolide com `COMMIT`.
- ⚠️ **Não** execute `UPDATE` sem `WHERE`.

### 5️⃣ DELETE — remover sem provocar caos
- Remova o cliente **Diego** (`id_cliente = 4`), **apenas se ele não tiver pedidos** (verifique antes).
- Teste em transação e confirme com `SELECT` que o registro sumiu (e que os demais permanecem).
- ⚠️ **Não** execute `DELETE` sem `WHERE`.

### 6️⃣ Checkpoint — comando perigoso
- Corrija o comando abaixo para que altere **apenas** o cliente 2 (Bruno) para o estado `SP`:
  ```sql
  UPDATE clientes
  SET estado = 'SP';
  ```
- Explique, em comentário no script, **por que** `ORDER BY` e `GROUP BY` não resolvem esse problema.

---

## 🧠 Conceitos obrigatórios (use todos!)

| Conceito | Onde aparece no desafio |
|----------|-------------------------|
| `CREATE DATABASE` / `USE` | preparação do banco |
| `CREATE TABLE` + PK/FK | estrutura das tabelas |
| `INSERT INTO ... VALUES` | cadastro de cliente/produto |
| `SELECT` + `WHERE` + `ORDER BY` | consultas |
| `UPDATE ... SET ... WHERE` | alteração de preço |
| `DELETE FROM ... WHERE` | remoção de cliente |
| `START TRANSACTION` / `ROLLBACK` / `COMMIT` | testes seguros |
| Conferência com `SELECT` antes de UPDATE/DELETE | boa prática |

---

## 🏁 Como testar

1. Execute o script inteiro em um cliente MySQL.
2. Confirme que o banco `loja_byte` e as 4 tabelas existem.
3. Confirme que os dados iniciais foram inseridos.
4. Confirme que Rafael (id 6) e Headset (id 50) foram cadastrados.
5. Confirme que o Mouse passou a custar R$ 90,00 após o `COMMIT`.
6. Confirme que Diego (id 4) foi removido (se não tinha pedidos).
7. Confirme que os demais clientes/produtos permanecem intactos.

> Dica: rode os comandos **um por um** (ou por blocos) para ver o efeito de cada etapa. Em caso de erro, use `ROLLBACK`.

---

## ✅ Critérios de avaliação

- [ ] Script cria banco, tabelas e dados iniciais sem erro
- [ ] Usa `INSERT` para cadastrar Rafael e Headset
- [ ] Usa `SELECT` com `WHERE` e `ORDER BY` nas consultas
- [ ] Usa `UPDATE` com `WHERE` e confere com `SELECT` antes
- [ ] Usa `DELETE` com `WHERE` e verifica vínculos de FK
- [ ] Testa comandos perigosos em `START TRANSACTION` + `ROLLBACK`
- [ ] Consolida com `COMMIT` ao final
- [ ] Corrige o comando perigoso do Checkpoint com `WHERE id_cliente = 2`
- [ ] Explica (em comentário) por que `ORDER BY`/`GROUP BY` não filtram
- [ ] Script roda do início ao fim sem erro fatal

---

## ⭐ Bônus (para ir além)

1. Adicione um **novo pedido** (id 105) do cliente Rafael, com um item (Headset, qtd 1).
2. Atualize o estado de **todos os clientes da BA** para `BA` (sem mudança) — mas escreva o `WHERE` corretamente e explique por que isso é seguro.
3. Crie uma **view** `vw_clientes_ba` que liste clientes da Bahia.
4. Adicione um `SELECT` final mostrando o **estado final** de todas as tabelas.

---

## 🧩 Dicas

- **Entrada é sempre validada pelo `WHERE`.** Sem ele, UPDATE/DELETE afetam tudo.
- **Teste em transação.** `START TRANSACTION` + `ROLLBACK` permite errar sem consequência.
- **FK protege integridade.** Tentar apagar cliente com pedidos falha — verifique antes.
- **`COMMIT` confirma, `ROLLBACK` desfaz.** Escolha com cuidado.
- Quebre o script em blocos e teste cada um antes de juntar.

---

## 🔓 Gabarito de referência (tente sozinho primeiro!)

```sql
-- =====================================================
-- DESAFIO AULA 13 — CRUD NA LOJA BYTE
-- =====================================================

-- 1. Preparação do banco
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

-- 2. CREATE — cadastrar novos registros
START TRANSACTION;
INSERT INTO clientes (id_cliente, nome, estado) VALUES (6, 'Rafael', 'MG');
INSERT INTO produtos (id_produto, nome, preco) VALUES (50, 'Headset', 150.00);
SELECT * FROM clientes WHERE id_cliente = 6;
SELECT * FROM produtos WHERE id_produto = 50;
COMMIT;

-- 3. READ — consultas
SELECT * FROM clientes;
SELECT nome, estado FROM clientes WHERE estado = 'BA' ORDER BY nome;
SELECT nome, preco FROM produtos WHERE preco > 100 ORDER BY preco DESC;
SELECT id_pedido, data_pedido FROM pedidos WHERE id_cliente = 1;

-- 4. UPDATE — alterar o registro certo
START TRANSACTION;
SELECT * FROM produtos WHERE id_produto = 20;   -- conferência
UPDATE produtos SET preco = 90.00 WHERE id_produto = 20;
SELECT nome, preco FROM produtos WHERE id_produto = 20;
COMMIT;

-- 5. DELETE — remover sem provocar caos
-- Diego (id 4) não tem pedidos, então pode ser removido.
START TRANSACTION;
SELECT * FROM pedidos WHERE id_cliente = 4;     -- verifica vínculos
DELETE FROM clientes WHERE id_cliente = 4;
SELECT * FROM clientes WHERE id_cliente = 4;     -- deve vir vazio
COMMIT;

-- 6. Checkpoint — comando perigoso corrigido
-- O comando original alterava TODOS os clientes.
-- ORDER BY só ordena resultado (em SELECT) e GROUP BY agrupa linhas —
-- nenhum dos dois FILTRA. Quem filtra é o WHERE.
UPDATE clientes
SET estado = 'SP'
WHERE id_cliente = 2;
```

---

*Desafio da Aula 13 — Módulo 4 · Banco de Dados / SQL.*  
*Professor: Luis Felipe Araujo Lima*
