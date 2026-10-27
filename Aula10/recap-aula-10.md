# 📘 Recap da Aula 10 — Arrays, Funções e Projeto Prático

> **Tema da aula:** *Fundamentos do PHP — Arrays, Funções e Projeto Prático*
> **Slides trabalhados:** *Fundamentos do PHP: Arrays, Funções e Projeto Prático*
> **Módulo:** 3 · Fundamentos PHP
> **Público-alvo:** iniciantes, quem faltou e quem quer revisar antes do próximo encontro.

**Objetivo:** dar os primeiros passos com **Banco de Dados** utilizando **SQL** no PHP/MySQL. Aprendemos a criar banco, tabela, inserir dados, consultar e remover — conceitos base para trabalhar com persistência de dados.

> [!TIP]
> Os comandos trabalhados estão em **[`index.txt`](index.txt)**.  
> São comandos SQL para serem executados em um cliente MySQL (phpMyAdmin, MySQL CLI, DBeaver, etc.).

---

## 🗺️ Mapa da Aula

| # | Tópico | O que você aprende |
|:-:|--------|--------------------|
| 1 | [Introdução ao Banco de Dados](#-introdução-ao-banco-de-dados) | Por que salvar dados além de variáveis/arrays |
| 2 | [Criando Banco de Dados](#-criando-banco-de-dados) | `CREATE DATABASE` |
| 3 | [Selecionando o Banco](#-selecionando-o-banco) | `USE` |
| 4 | [Criando Tabelas](#-criando-tabelas) | `CREATE TABLE` e tipos de dados |
| 5 | [Inserindo Dados](#-inserindo-dados) | `INSERT INTO` |
| 6 | [Consultando Dados](#-consultando-dados) | `SELECT` |
| 7 | [Removendo Dados e Estruturas](#-removendo-dados-e-estruturas) | `DELETE`, `DROP` |

---

## 💾 Introdução ao Banco de Dados

Até aqui, trabalhamos com **variáveis** e **arrays**. Esses dados existem apenas **enquanto o script roda**. Quando o programa termina, tudo se perde.

**Banco de Dados** serve para **armazenar, organizar e recuperar** informações de forma **permanente**.

**Vantagens:**
- **Persistência** — dados ficam salvos mesmo após fechar o programa
- **Organização** — informações em tabelas com estrutura definida
- **Consultas rápidas** — filtrar, buscar e relacionar dados
- **Múltiplos acessos** — vários usuários podem acessar ao mesmo tempo

---

## 🛠️ Criando Banco de Dados

```sql
create database Felipe;
```

Com esse comando criamos um banco de dados chamado `Felipe`.  
A convenção varia, mas no MySQL não diferencia maiúsculas/minúsculas na maioria dos casos.

---

## 🎯 Selecionando o Banco

Antes de criar tabelas ou inserir dados, precisamos dizer **em qual banco vamos trabalhar**:

```sql
use Felipe;
```

---

## 🧱 Criando Tabelas

Tabelas são como **planilhas**: possuem **colunas** (campos) e **linhas** (registros).

```sql
create table carros (
    nome char(100),
    ano data,
    placa varchar(16)
);
```

**Tipos utilizados:**
| Tipo | Descrição |
|------|-----------|
| `char(100)` | Texto com tamanho **fixo** (até 100 caracteres) |
| `varchar(16)` | Texto com tamanho **variável** (até 16 caracteres) |
| `date` / `data` | Tipo para armazenar datas (no exemplo foi usado `data`) |

> [!NOTE]
> Em MySQL padrão, o tipo correto para datas é `DATE`. Dependendo da versão/configuração, `data` pode funcionar, mas o ideal é usar `DATE`.

---

## ➕ Inserindo Dados

Para adicionar registros na tabela:

```sql
insert into carros values
('Ford Ka','2014','gvg2132'), 
('Siena','2020','piv1234');
```

- `INSERT INTO carros` — diz em qual tabela vamos inserir
- `VALUES` — lista de valores para **cada coluna** na ordem definida
- Cada parênteses representa **um registro** (linha)

> [!WARNING]
> Os valores devem respeitar **a ordem das colunas** e **os tipos** definidos na tabela.

---

## 🔍 Consultando Dados

Para visualizar os registros:

```sql
select * from Felipe.carros;
select table carros;
```

- `SELECT *` — seleciona **todas** as colunas
- `FROM tabela` — de qual tabela buscar
- Também é possível usar `SELECT * FROM carros;` após o `USE Felipe;`

> [!TIP]
> `*` significa "todos os campos". Em consultas reais, é melhor especificar apenas as colunas necessárias.

---

## 🗑️ Removendo Dados e Estruturas

Existem comandos para **remover dados** ou **remover estruturas inteiras**:

```sql
drop table carros;
delete database Felipe;
```

| Comando | Efeito |
|---------|--------|
| `DROP TABLE nome_tabela` | **Remove a tabela inteira** (estrutura + todos os dados). **Irreversível** |
| `DELETE DATABASE nome_banco` | **Remove o banco de dados inteiro**. **Irreversível** |
| `DELETE FROM tabela WHERE ...` | Remove **apenas registros** específicos (não vimos WHERE nesta aula, mas é o correto para apagar linhas) |

> [!DANGER]
> `DROP` e comandos para deletar banco/tabela **apagam permanentemente**. Sempre tenha certeza antes de executar.

---

## 🧠 Teste seu conhecimento

1. Por que usar banco de dados ao invés de apenas arrays?
2. Qual comando usamos para criar um banco de dados?
3. Para que serve o `USE`?
4. Qual a diferença entre `CHAR` e `VARCHAR`?
5. Como inserimos múltiplos registros com um único `INSERT`?
6. Qual comando exibe todos os dados de uma tabela?
7. Qual a diferença entre `DROP TABLE` e `DELETE FROM`?

<details>
<summary>🔎 Clique para ver as respostas</summary>

1. Porque arrays e variáveis são **voláteis**. O banco garante **persistência** dos dados.
2. `CREATE DATABASE nome_do_banco;`
3. Selecionar qual banco de dados vamos utilizar para criar tabelas, inserir e consultar.
4. `CHAR` tem **tamanho fixo**. `VARCHAR` tem **tamanho variável**, ocupando apenas o necessário.
5. Passando **várias listas de valores** separadas por vírgula após `VALUES`: `VALUES (...), (...), (...);`
6. `SELECT * FROM nome_da_tabela;`
7. `DROP TABLE` remove **a tabela inteira (estrutura + dados)**. `DELETE FROM` remove **apenas os registros**, mantendo a estrutura da tabela (ideal com `WHERE`).

</details>

---

## 🗺️ Checklist de Estudos

- [ ] Entender a importância da persistência de dados
- [ ] Criar um banco com `CREATE DATABASE`
- [ ] Selecionar banco com `USE`
- [ ] Criar tabela com `CREATE TABLE` e definir colunas
- [ ] Inserir dados com `INSERT INTO ... VALUES`
- [ ] Consultar dados com `SELECT * FROM`
- [ ] Diferenciar `DROP TABLE` e `DELETE`
- [ ] Praticar os comandos no MySQL/phpMyAdmin

---

## 🔗 Links Úteis

**Documentação oficial MySQL:**
- [CREATE DATABASE](https://dev.mysql.com/doc/refman/8.0/en/create-database.html)
- [CREATE TABLE](https://dev.mysql.com/doc/refman/8.0/en/create-table.html)
- [INSERT](https://dev.mysql.com/doc/refman/8.0/en/insert.html)
- [SELECT](https://dev.mysql.com/doc/refman/8.0/en/select.html)
- [DROP TABLE](https://dev.mysql.com/doc/refman/8.0/en/drop-table.html)
- [Tipos de dados MySQL](https://dev.mysql.com/doc/refman/8.0/en/data-types.html)

**Para praticar:**
- [W3Schools - SQL Intro](https://www.w3schools.com/sql/sql_intro.asp)
- [W3Schools - SQL CREATE TABLE](https://www.w3schools.com/sql/sql_create_table.asp)
- [W3Schools - SQL INSERT](https://www.w3schools.com/sql/sql_insert.asp)
- [W3Schools - SQL SELECT](https://www.w3schools.com/sql/sql_select.asp)

---

*Recap produzido para a turma da Aula 10 — Módulo 3 · Fundamentos PHP.*  
*Professor: Luis Felipe Araujo Lima*
