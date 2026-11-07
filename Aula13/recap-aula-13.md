# 📘 Recap da Aula 13 — CRUD com SQL (MySQL)

> **Tema da aula:** *Bancos de Dados Relacionais e SQL — Módulo 4.4 · CRUD*
> **Slides trabalhados:** *12 a 16* (CREATE, READ, UPDATE, DELETE e Checkpoint)
> **Módulo:** 4 · Banco de Dados / SQL (MySQL)
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do próximo encontro.

**Objetivo:** dominar as quatro operações do **CRUD** (`CREATE`, `READ`, `UPDATE`, `DELETE`) no MySQL, sempre com **segurança**: uso correto do `WHERE`, testes dentro de **transações** (`START TRANSACTION` / `ROLLBACK`) e boas práticas para não alterar ou apagar dados por engano.

> [!TIP]
> Os comandos trabalhados estão em **[`index.sql`](index.sql)**.  
> São comandos SQL para serem executados em um cliente MySQL (MySQL CLI, phpMyAdmin, DBeaver, MySQL Workbench, etc.).

---

## 🗺️ Mapa da Aula

| # | Tópico | O que você aprende |
|:-:|--------|--------------------|
| 12 | [CREATE: inserindo um cliente](#-create-inserindo-um-cliente) | `INSERT INTO` cria uma nova linha |
| 13 | [READ: consultando com SELECT](#-read-consultando-com-select) | escolher colunas, filtrar e ordenar |
| 14 | [UPDATE: alterando o registro certo](#-update-alterando-o-registro-certo) | `WHERE` como proteção contra alterações em massa |
| 15 | [DELETE: removendo sem provocar caos](#-delete-removendo-sem-provocar-caos) | `DELETE FROM` + `WHERE` e perigos reais |
| 16 | [Checkpoint: um comando perigoso](#-checkpoint--um-comando-perigoso) | o que falta para atualizar uma única pessoa |

---

## 🏪 Projeto-base: Loja Byte

Toda a aula gira em torno de um projeto didático chamado **Loja Byte**, com quatro tabelas relacionadas:

| Tabela | Papel |
|--------|-------|
| `clientes` | pessoas que compram (`id_cliente`, `nome`, `cpf`, `estado`) |
| `produtos` | itens à venda (`id_produto`, `nome`, `preco`) |
| `pedidos` | compras feitas (`id_pedido`, `id_cliente`, `data_pedido`) |
| `itens_pedido` | itens de cada pedido (`id_pedido`, `id_produto`, `quantidade`, `preco_unitario`) |

> [!NOTE]
> Antes de praticar o CRUD, o banco e as tabelas são criados e populados com dados iniciais (clientes Ana, Bruno, Carla, Diego; produtos Teclado, Mouse, Monitor, Webcam; pedidos e itens). O script completo está em **[`index.sql`](index.sql)** (seções 1 a 3).

**Dados iniciais de referência:**

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

---

## ➕ CREATE: inserindo um cliente

`INSERT INTO` cria uma **nova linha** na tabela.

```sql
START TRANSACTION;

INSERT INTO clientes
  (id_cliente, nome, estado)
VALUES (5, 'Eva', 'PE');

SELECT * FROM clientes
WHERE id_cliente = 5;

ROLLBACK;
```

**Depois do INSERT:**

| id_cliente | nome | estado |
|:----------:|------|:------:|
| 5 | Eva | PE |

- `ID 5` aparece no `SELECT`
- O `ROLLBACK` **desfaz** a inserção ao final (a tabela volta ao estado anterior)

**Anatomia:**

```text
INSERT INTO tabela (coluna1, coluna2, ...)
VALUES (valor1, valor2, ...);
```

- Liste as **colunas** entre parênteses após o nome da tabela
- Os **valores** devem respeitar a **ordem** das colunas e os **tipos** definidos
- Cada par de parênteses representa **um registro** (linha)

> [!TIP]
> Sempre teste inserções dentro de uma **transação** (`START TRANSACTION` … `ROLLBACK`). Assim você confirma o resultado com um `SELECT` antes de tornar a mudança permanente com `COMMIT`.

---

## 🔍 READ: consultando com SELECT

Escolha colunas, filtre registros e defina a **ordem de exibição**.

```sql
SELECT nome, estado
FROM clientes
WHERE estado = 'BA'
ORDER BY nome;
```

**Resultado:**

| nome | estado |
|------|:------:|
| Ana | BA |
| Carla | BA |

**Peças do comando:**

| Cláusula | Para que serve |
|----------|----------------|
| `SELECT colunas` | quais colunas exibir (`*` = todas) |
| `FROM tabela` | de onde buscar os dados |
| `WHERE condição` | filtra as linhas retornadas |
| `ORDER BY coluna` | define a ordem (use `DESC` para decrescente) |

**Exemplos da aula:**

```sql
-- Consultar todos os clientes
SELECT * FROM clientes;

-- Consultar apenas clientes da Bahia
SELECT nome, estado
FROM clientes
WHERE estado = 'BA';

-- Consultar produtos acima de R$ 100
SELECT nome, preco
FROM produtos
WHERE preco > 100;

-- Ordenar produtos por preço (decrescente)
SELECT *
FROM produtos
ORDER BY preco DESC;
```

> [!TIP]
> Em consultas reais, evite `SELECT *`: especifique apenas as colunas necessárias. Isso deixa o código mais claro e mais rápido.

---

## ✏️ UPDATE: alterando o registro certo

`WHERE` é a sua **proteção contra alterações em massa**.

```sql
START TRANSACTION;

UPDATE produtos
SET preco = 90.00
WHERE id_produto = 20;

SELECT nome, preco FROM produtos
WHERE id_produto = 20;

ROLLBACK;
```

**Anatomia:**

```text
UPDATE tabela
SET coluna = novo_valor
WHERE condição;
```

- `SET` define o novo valor
- `WHERE` define **quais linhas** serão afetadas

### ⚠️ CUIDADO: SEM WHERE

```sql
-- NÃO EXECUTE! (exemplo perigoso)
UPDATE produtos SET preco = 90.00;
```

É SQL válido, mas alteraria **TODOS** os produtos. O reajuste do Mouse virou promoção para a loja inteira.

### ✅ Boa prática

Faça um `SELECT` com o **mesmo `WHERE`** antes de atualizar:

```sql
-- 1º: confira o que será alterado
SELECT * FROM produtos WHERE id_produto = 20;

-- 2º: atualize
UPDATE produtos SET preco = 90.00 WHERE id_produto = 20;

-- 3º: confirme
SELECT * FROM produtos WHERE id_produto = 20;
```

> [!WARNING]
> Sem `WHERE`, o `UPDATE` atinge **todas as linhas** da tabela. Sempre revise o `WHERE` antes de executar.

---

## 🗑️ DELETE: removendo sem provocar caos

`DELETE FROM` exclui linhas; `WHERE` define **exatamente quais**.

```sql
START TRANSACTION;

DELETE FROM clientes
WHERE id_cliente = 4;

SELECT * FROM clientes
WHERE id_cliente = 4;

ROLLBACK;
```

**Anatomia:**

```text
DELETE FROM tabela
WHERE condição;
```

### ⚠️ PERIGO REAL

```sql
-- NÃO EXECUTE! (exemplo perigoso)
DELETE FROM clientes;
```

Sem `WHERE`, o comando tenta excluir **todas as linhas**. Restrições de **chave estrangeira (FK)** podem bloquear a operação (ex.: um cliente com pedidos não pode ser apagado sem apagar os pedidos antes).

### 🛡️ Regra de ouro

Verifique os IDs, revise os vínculos e teste em transação. `ROLLBACK` só ajuda **antes do `COMMIT`**.

> [!DANGER]
> `DELETE` sem `WHERE` remove **todas as linhas**. `DROP TABLE`/`DROP DATABASE` removem a estrutura inteira e são **irreversíveis**. Sempre tenha certeza antes de executar.

---

## 🎯 Checkpoint — um comando perigoso

O SQL abaixo **roda**. Mas o objetivo era alterar apenas o cliente 2.

```sql
UPDATE clientes
SET estado = 'SP';
```

**Pergunta para a turma:** o que falta para atualizar uma única pessoa?

- A) `ORDER BY id_cliente`
- B) `WHERE id_cliente = 2`
- C) `GROUP BY estado`

**Resposta correta: B) `WHERE id_cliente = 2`.**

O comando correto seria:

```sql
UPDATE clientes
SET estado = 'SP'
WHERE id_cliente = 2;
```

> [!IMPORTANT]
> `ORDER BY` só **ordena o resultado** (em `SELECT`) e `GROUP BY` **agrupa** linhas — nenhum dos dois **filtra**. Quem filtra é o `WHERE`.

---

## 🧠 Teste seu conhecimento

1. Para que serve o `INSERT INTO`?
2. Qual cláusula filtra as linhas retornadas por um `SELECT`?
3. Por que devemos evitar `UPDATE` sem `WHERE`?
4. Qual a diferença entre `DELETE FROM tabela` e `DELETE FROM tabela WHERE ...`?
5. Por que usar `START TRANSACTION` + `ROLLBACK` ao testar comandos perigosos?
6. Qual opção faltava no Checkpoint para atualizar apenas o cliente 2?
7. O que uma restrição de chave estrangeira (FK) pode fazer ao tentar apagar um cliente com pedidos?
8. Qual a diferença entre `COMMIT` e `ROLLBACK`?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. **Criar uma nova linha (registro)** em uma tabela.
2. **`WHERE`** — define a condição de filtro.
3. Porque alteraria **todas as linhas** da tabela, não apenas o registro desejado.
4. Sem `WHERE`, remove **todas as linhas**; com `WHERE`, remove **apenas as linhas que atendem à condição**.
5. Para **testar o efeito** do comando e poder **desfazer** com `ROLLBACK` antes de tornar permanente com `COMMIT`.
6. **`WHERE id_cliente = 2`**.
7. Pode **bloquear a operação** (erro de violação de FK), pois existem pedidos vinculados ao cliente.
8. **`COMMIT`** torna as alterações **permanentes**; **`ROLLBACK`** **desfaz** as alterações feitas na transação.

</details>

---

## 🗺️ Checklist de Estudos

- [ ] Entender o conceito de **CRUD** (Create, Read, Update, Delete)
- [ ] Criar banco e tabelas do projeto **Loja Byte**
- [ ] Inserir dados com `INSERT INTO ... VALUES`
- [ ] Consultar dados com `SELECT`, `WHERE` e `ORDER BY`
- [ ] Atualizar registros com `UPDATE ... SET ... WHERE`
- [ ] Remover registros com `DELETE FROM ... WHERE`
- [ ] Sempre testar comandos perigosos em `START TRANSACTION` + `ROLLBACK`
- [ ] Lembrar que sem `WHERE` o `UPDATE`/`DELETE` afeta **todas as linhas**
- [ ] Conferir vínculos de **chave estrangeira** antes de apagar
- [ ] Diferenciar `COMMIT` de `ROLLBACK`

---

## 🔗 Links Úteis

**Documentação oficial MySQL:**
- [INSERT](https://dev.mysql.com/doc/refman/8.0/en/insert.html)
- [SELECT](https://dev.mysql.com/doc/refman/8.0/en/select.html)
- [UPDATE](https://dev.mysql.com/doc/refman/8.0/en/update.html)
- [DELETE](https://dev.mysql.com/doc/refman/8.0/en/delete.html)
- [START TRANSACTION / COMMIT / ROLLBACK](https://dev.mysql.com/doc/refman/8.0/en/commit.html)
- [Foreign Keys (chaves estrangeiras)](https://dev.mysql.com/doc/refman/8.0/en/create-table-foreign-keys.html)

**Para praticar (W3Schools):**
- [W3Schools — SQL INSERT INTO](https://www.w3schools.com/sql/sql_insert.asp)
- [W3Schools — SQL SELECT](https://www.w3schools.com/sql/sql_select.asp)
- [W3Schools — SQL UPDATE](https://www.w3schools.com/sql/sql_update.asp)
- [W3Schools — SQL DELETE](https://www.w3schools.com/sql/sql_delete.asp)
- [W3Schools — SQL WHERE](https://www.w3schools.com/sql/sql_where.asp)
- [W3Schools — SQL ORDER BY](https://www.w3schools.com/sql/sql_orderby.asp)

---

## 💡 Dicas de ouro

> **`WHERE` é seu cinto de segurança.** Antes de `UPDATE` ou `DELETE`, rode um `SELECT` com o mesmo `WHERE`.

> **Teste em transação.** `START TRANSACTION` + `ROLLBACK` permite errar sem consequência.

> **`ROLLBACK` só ajuda antes do `COMMIT`.** Depois do `COMMIT`, a mudança é permanente.

> **Sem `WHERE` = massa.** `UPDATE`/`DELETE` sem `WHERE` afeta todas as linhas.

> **FK protege integridade.** Apagar um cliente com pedidos pode falhar — revise os vínculos.

> **`COMMIT` confirma, `ROLLBACK` desfaz.** Escolha com cuidado.

---

*Recap produzido para a turma da Aula 13 — Módulo 4 · Banco de Dados / SQL.*  
*Professor: Luis Felipe Araujo Lima*
