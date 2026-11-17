# 🏆 Desafio do Módulo 4 — Banco de Dados e SQL

> **Módulo:** 4 · Banco de Dados / SQL (MySQL) — tópicos **4.1 a 4.9**, trabalhados nas Aulas 12 a 16
> **Entrega:** repositório próprio no GitHub com script `.sql`, modelo e `README.md`
> **Formato:** um projeto completo — do MER ao relatório final
> **Base:** projeto inédito **Biblioteca da Turma** (não reuse a Loja Byte copiando o material)

Este é o **desafio de encerramento do módulo**: não há conteúdo novo aqui. A ideia é **aplicar tudo**
o que foi visto em SQL — modelar, criar, popular, manipular, relacionar, agregar, otimizar e
apresentar resultados. Se precisar revisar, comece pelos recaps das
[Aulas 13](../Aula13/recap-aula-13.md), [14](../Aula14/recap-aula-14.md),
[15](../Aula15/recap-aula-15.md) e [16](recap-aula-16.md), pelo [script da aula](index.sql) e pelas
[referências oficiais](https://dev.mysql.com/doc/).

> [!TIP]
> Revise também o [desafio de CRUD](../Aula13/desafio.md) e o
> [desafio de JOINs e agregações](../Aula14/desafio.md) — este documento é a versão completa,
> com consultas avançadas e projeto final.

---

## 📜 Regras gerais

### 1. Use apenas o que foi ensinado no módulo

Recursos permitidos: MySQL/SQL com DDL (`CREATE DATABASE`, `CREATE TABLE`, `ALTER TABLE`,
`CREATE INDEX`, `CREATE VIEW`), DML (`INSERT`, `SELECT`, `UPDATE`, `DELETE`), `WHERE`,
`ORDER BY`, `GROUP BY`, `HAVING`, `JOIN` (INNER/LEFT/RIGHT), agregações (`COUNT`, `SUM`, `AVG`,
`MIN`, `MAX`, `COUNT(DISTINCT ...)`), `COALESCE`, `ROUND`, `LIMIT`, subqueries (`IN`, `EXISTS`),
transações (`START TRANSACTION`, `ROLLBACK`, `COMMIT`) e `EXPLAIN`.

> [!WARNING]
> Não use PDO, PHP, HTML/JS, frameworks, triggers ou procedures — isso vem em módulos posteriores
> ou fora do escopo. A entrega é **SQL puro**, executável em MySQL CLI, Workbench, DBeaver ou phpMyAdmin.

### 2. Segurança antes de tudo

- **Nunca** execute `UPDATE` ou `DELETE` sem `WHERE`.
- Antes de alterar/apagar, faça um `SELECT` com o **mesmo `WHERE`**.
- Teste operações perigosas dentro de `START TRANSACTION` … `ROLLBACK`; use `COMMIT` só quando
  tiver certeza. Lembre: **DDL (`CREATE`/`DROP`/`ALTER`) faz commit implícito no MySQL** — transação
  é para os comandos DML.
- Respeite as **FKs**: não apague um registro que ainda tem filhos sem tratar os vínculos.

### 3. Criatividade com responsabilidade

Os nomes, gêneros, cidades e regras abaixo são um **ponto de partida**. Você pode trocar o tema
(ex.: cinema, esportes, clínica), desde que a **estrutura e os conceitos obrigatórios** continuem
presentes. Soluções idênticas às do material ou de colegas serão devolvidas.

### 4. Versionado no GitHub

- Repositório **seu**, com `README.md` explicando o projeto e como executar.
- **Histórico real**: no mínimo um commit por etapa (modelo, DDL, dados, consultas, relatório).
- Envie o link do repositório no prazo combinado em aula.

---

## 🎯 Objetivo

A **Biblioteca da Turma** precisa de um banco de dados para controlar **autores, livros, sócios e
empréstimos**. O dono quer respostas como: quem mais pega livros, quais livros nunca saíram,
quanto se arrecadou em multas, qual cidade mais empresta e como está a média de preço do acervo.
Você vai entregar um script que **cria o banco**, **mantém os dados** e **responde a todas essas
perguntas com SQL** — além de explicar suas escolhas.

---

## 🧩 Modelo de referência (adaptável)

| Tabela | Papel | Colunas sugeridas |
|--------|-------|-------------------|
| `autores` | quem escreve | `id_autor` (PK), `nome`, `pais` |
| `livros` | acervo | `id_livro` (PK), `titulo`, `genero`, `preco` (`DECIMAL`), `id_autor` (FK) |
| `socios` | quem empresta | `id_socio` (PK), `nome`, `cidade`, `desde` |
| `emprestimos` | empréstimo de um livro por um sócio | `id_emprestimo` (PK), `id_socio` (FK), `id_livro` (FK), `data_emprestimo`, `data_devolucao`, `multa` (`DECIMAL`, `DEFAULT 0`) |

**Cardinalidades:** `autores 1:N livros` · `socios 1:N emprestimos` · `livros 1:N emprestimos`.
O relacionamento `socios N:N livros` é resolvido pela tabela `emprestimos`, que guarda o histórico.

> [!NOTE]
> `data_devolucao` pode ficar `NULL` enquanto o livro não foi devolvido. `multa` usa `DECIMAL(10,2)`,
> nunca `VARCHAR` — dinheiro é número.

---

## 📋 Requisitos funcionais

### 1️⃣ Modelagem (4.1 e 4.3)

- Desenhe o **MER** das quatro entidades com atributos, **PK**, **FK** e **cardinalidades**.
- Entregue o desenho como imagem/PDF no repositório **ou** como descrição detalhada no `README.md`.
- Justifique: por que `emprestimos` existe? Por que `preco` e `multa` são `DECIMAL`?

### 2️⃣ DDL e dados de exemplo (4.2 e 4.3)

- Crie `CREATE DATABASE IF NOT EXISTS biblioteca_sql; USE biblioteca_sql;`.
- Crie as quatro tabelas com tipos coerentes, `NOT NULL`, `UNIQUE` quando fizer sentido,
  `DEFAULT` para `multa` e **FKs** declaradas.
- Insira **no mínimo**: 3 autores, 5 livros (um **nunca emprestado**), 4 sócios (um **sem
  empréstimo**) e 5 empréstimos (pelo menos um com `multa > 0` e um com `data_devolucao = NULL`).
- Use `START TRANSACTION`/`ROLLBACK` para testar e `COMMIT` para consolidar os dados-base.

### 3️⃣ CRUD com segurança (4.4)

- **CREATE:** cadastre o sócio **Rafael** (cidade à sua escolha) e o livro **Sapiens** (preço à sua escolha).
- **READ:** liste todos os sócios; liste livros com preço acima de um valor definido por você,
  ordenados do mais caro para o mais barato; liste empréstimos de uma cidade filtrando via `JOIN`.
- **UPDATE:** reajuste o preço de **um** livro. Faça `SELECT` com o mesmo `WHERE` antes e depois.
- **DELETE:** remova o sócio **sem empréstimos** após verificar os vínculos com `SELECT`.
- ⚠️ Teste `UPDATE`/`DELETE` em transação e só use `COMMIT` **depois** de responder às consultas
  de análise (assim os números esperados continuam válidos).
- **Checkpoint:** corrija `UPDATE socios SET cidade = 'Salvador';` para alterar apenas o sócio 2
  e explique em comentário por que `ORDER BY` e `GROUP BY` não resolvem o problema.

### 4️⃣ JOINs (4.5)

Escreva consultas que respondam:

- a) **INNER JOIN** — empréstimos com nome do sócio, título do livro e nome do autor.
- b) **LEFT JOIN** — todos os sócios e seus empréstimos (o sócio sem empréstimo aparece com `NULL`).
- c) Livros **nunca emprestados** (`LEFT JOIN` + `WHERE ... IS NULL`).
- d) **RIGHT JOIN** — preserve a tabela da direita e explique em comentário por que
  `A RIGHT JOIN B` equivale a `B LEFT JOIN A`.
- e) Confira o `ON`: relacione sempre **PK × FK** correspondente (não compare `id_socio` com
  `id_emprestimo`, por exemplo).

### 5️⃣ Agregações (4.6)

- a) Quantos empréstimos existem? (`COUNT(*)`)
- b) Qual o total de multas? (`SUM(multa)`)
- c) Qual o preço médio, o menor e o maior preço do acervo? (`AVG`, `MIN`, `MAX`)
- d) Quantos sócios **distintos** emprestaram? (`COUNT(DISTINCT ...)`)
- e) Total de multas por cidade (`GROUP BY cidade`, `ORDER BY ... DESC`).
- f) Cidades com **mais de 2 empréstimos** use `WHERE` para filtrar por data e `HAVING` para o total.
- ⚠️ Agregação não vai no `WHERE`.

### 6️⃣ Consultas avançadas (4.7)

- a) Livros com preço **acima da média** do acervo (subquery escalar).
- b) Sócios que emprestaram usando **`IN`**; depois o inverso com **`NOT EXISTS`**.
- c) Sócios com empréstimo usando **`EXISTS`** correlacionado — explique em comentário o que
  a subconsulta compara com a linha atual.
- d) Escreva a mesma pergunta de (b) com `JOIN + DISTINCT` e comente qual você acha mais legível.
- e) Rode `EXPLAIN SELECT ... FROM emprestimos WHERE id_socio = ...`, crie um **índice** na FK
  e rode `EXPLAIN` de novo. Registre no `README.md` o que mudou (`type`, `key`, `rows`).
- f) Liste três hábitos para consultas melhores (colunas, filtro, medição).

### 7️⃣ Cenários de consultas (4.8)

- **Relatório:** total de multas por sócio, **incluindo quem nunca emprestou**
  (`LEFT JOIN` + `COALESCE(SUM(...), 0)`), ordenado do maior para o menor.
- **Ranking:** top 3 livros mais emprestados (`SUM(quantidade)` ou `COUNT(*)`), com
  `ORDER BY DESC`, **segundo critério de desempate** e `LIMIT 3`.
- **Cruzamento:** por cidade, quantidade de empréstimos (`COUNT(DISTINCT ...)`) e total de multas
  (`JOIN` de três ou quatro tabelas).

### 8️⃣ Projeto final e apresentação (4.9)

O `README.md` do seu repositório deve conter:

- O problema escolhido e o **MER** (imagem ou descrição).
- Como executar: `mysql -u root -p < desafio.sql` (ou passos no Workbench/DBeaver).
- As **perguntas de negócio** respondidas e o que cada consulta retorna.
- Explicação, com suas palavras, de: **PK × FK**, por que usar `JOIN`, por que `GROUP BY`/`HAVING`,
  onde usou transação e o que o `EXPLAIN` mostrou.
- Prints ou a saída das consultas principais (opcional, mas valorizado).

---

## 🧠 Cobertura do módulo (use tudo!)

| Tópico | Onde aparece no desafio |
|--------|-------------------------|
| 4.1 Conceitos de banco relacional | MER, entidades, tabelas e relacionamentos |
| 4.2 MySQL (CLI/Workbench) | criação do banco e execução do script |
| 4.3 Modelagem | MER, PK, FK, cardinalidades, tipos e restrições |
| 4.4 CRUD | `INSERT`, `SELECT`, `UPDATE`, `DELETE`, `WHERE`, transações |
| 4.5 JOIN | INNER, LEFT, RIGHT, `ON` PK × FK, `IS NULL` |
| 4.6 Agregações | `COUNT`, `SUM`, `AVG`, `MIN`, `MAX`, `DISTINCT`, `GROUP BY`, `HAVING` |
| 4.7 Consultas avançadas | subquery escalar, `IN`, `NOT EXISTS`, `EXISTS`, `EXPLAIN`, índice |
| 4.8 Cenários | relatório, ranking com `LIMIT`, cruzamento de dados |
| 4.9 Projeto | sistema completo documentado e versionado |

---

## 🏁 Como testar

1. Execute o script inteiro em um cliente MySQL e confirme que as quatro tabelas foram criadas.
2. Confirme os dados iniciais (mínimo: 3 autores, 5 livros, 4 sócios, 5 empréstimos).
3. Rode as consultas **antes** de consolidar `UPDATE`/`DELETE`: compare com os valores de referência
   do gabarito (se você usou os dados sugeridos).
4. Teste `UPDATE`/`DELETE` com `ROLLBACK`, depois com `COMMIT`.
5. Confirme que o comando perigoso do Checkpoint foi corrigido com `WHERE id_socio = 2`.
6. Rode `EXPLAIN` antes e depois do `CREATE INDEX` e anote a diferença.
7. Verifique se o `README.md` responde todas as perguntas da etapa 8.

> Dica: rode por blocos. Se algo der errado, `ROLLBACK` — e nunca execute um script que você não leu.

---

## ✅ Critérios de avaliação

- [ ] MER entregue com entidades, atributos, PK/FK e cardinalidades
- [ ] Banco e tabelas criados com tipos coerentes e FKs declaradas
- [ ] Dados de exemplo completos (inclui sócio sem empréstimo e livro nunca emprestado)
- [ ] `INSERT`, `SELECT`, `UPDATE`, `DELETE` com `WHERE` e transações
- [ ] `SELECT` de conferência antes de `UPDATE`/`DELETE`
- [ ] `INNER`, `LEFT` e `RIGHT JOIN` com `ON` correto (PK × FK)
- [ ] `COUNT`, `SUM`, `AVG`, `MIN`, `MAX` e `COUNT(DISTINCT ...)`
- [ ] `GROUP BY` e `HAVING` usados no momento certo (`WHERE` filtra linhas)
- [ ] Subquery escalar, `IN`, `EXISTS`/`NOT EXISTS` e `JOIN + DISTINCT`
- [ ] `EXPLAIN` antes/depois de `CREATE INDEX`, com registro no README
- [ ] Relatório com `COALESCE`, ranking com `LIMIT` e cruzamento com `COUNT(DISTINCT)`
- [ ] Checkpoint corrigido com `WHERE id_socio = 2` e explicação sobre `ORDER BY`/`GROUP BY`
- [ ] Repositório no GitHub com `README.md` e **mais de um commit**
- [ ] Script roda do início ao fim sem erro fatal

---

## ⭐ Bônus (para ir além)

1. Crie a **view** `vw_relatorio_socios` com o relatório de multas por sócio.
2. Encontre livros acima da média **usando subquery** e depois **usando uma subquery derivada com `GROUP BY`/`HAVING`**.
3. Compare `NOT IN` e `NOT EXISTS` quando a subquery retorna `NULL` — explique a diferença.
4. Acrescente um segundo critério de ordenação no ranking e mostre como ele muda empates.
5. Escreva uma consulta com `INNER JOIN` de **quatro tabelas** e desenhe o caminho do JOIN no MER.

---

## 🧩 Dicas

- **`WHERE` é cinto de segurança:** sem ele, `UPDATE`/`DELETE` atingem todas as linhas.
- **Verifique FKs antes de apagar:** um sócio com empréstimos não pode ser removido sem tratar os filhos.
- **`ON` compara PK com FK:** erro de coluna não dá erro de sintaxe — dá resultado vazio ou duplicado.
- **`WHERE` filtra linhas, `HAVING` filtra grupos:** agregação só no `HAVING`.
- **`LEFT JOIN + COALESCE` = relatório completo:** ninguém desaparece por falta de relacionamento.
- **`DISTINCT` evita duplicação** quando um JOIN multiplica linhas.
- **Documente o que você aprendeu:** explicar a consulta é metade da avaliação.

---

## 🚀 Entrega (Git & GitHub)

```bash
git init                                   # se ainda não existir repositório
git add .
git commit -m "feat: modelo MER e DDL da biblioteca"
# ... continue commitando em etapas: dados, consultas, relatório, README ...
git branch -M main
git remote add origin <url-do-seu-repositorio>
git push -u origin main
```

Envie o link do repositório (ou do commit final) ao professor até a data combinada em aula.

---

## 🔓 Gabarito de referência (tente sozinho primeiro!)

```sql
-- =====================================================
-- DESAFIO DO MÓDULO 4 — BIBLIOTECA DA TURMA
-- Execute as consultas de análise ANTES dos UPDATE/DELETE finais.
-- =====================================================

CREATE DATABASE IF NOT EXISTS biblioteca_sql;
USE biblioteca_sql;

DROP TABLE IF EXISTS emprestimos;
DROP TABLE IF EXISTS livros;
DROP TABLE IF EXISTS socios;
DROP TABLE IF EXISTS autores;

CREATE TABLE autores (
    id_autor INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    pais VARCHAR(80)
);

CREATE TABLE livros (
    id_livro INT PRIMARY KEY,
    titulo VARCHAR(120) NOT NULL,
    genero VARCHAR(60),
    preco DECIMAL(10,2) NOT NULL,
    id_autor INT NOT NULL,
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor)
);

CREATE TABLE socios (
    id_socio INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    cidade VARCHAR(80) NOT NULL,
    desde DATE,
    UNIQUE (nome, cidade)
);

CREATE TABLE emprestimos (
    id_emprestimo INT PRIMARY KEY,
    id_socio INT NOT NULL,
    id_livro INT NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE NULL,
    multa DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    FOREIGN KEY (id_socio) REFERENCES socios(id_socio),
    FOREIGN KEY (id_livro) REFERENCES livros(id_livro)
);

-- Dados de exemplo -----------------------------------
INSERT INTO autores (id_autor, nome, pais) VALUES
    (1, 'Machado de Assis', 'Brasil'),
    (2, 'Ursula Le Guin', 'Estados Unidos'),
    (3, 'Octavia Butler', 'Estados Unidos');

INSERT INTO livros (id_livro, titulo, genero, preco, id_autor) VALUES
    (10, 'Dom Casmurro', 'Romance', 60.00, 1),
    (11, 'Memorias Postumas', 'Romance', 55.00, 1),
    (12, 'A Mao Esquerda das Trevas', 'Ficcao', 90.00, 2),
    (13, 'O Disconforto', 'Ficcao', 80.00, 3),
    (14, 'Contos', 'Contos', 45.00, 1); -- livro nunca emprestado

INSERT INTO socios (id_socio, nome, cidade, desde) VALUES
    (1, 'Ana', 'Salvador', '2026-01-10'),
    (2, 'Bruno', 'Sao Paulo', '2026-02-15'),
    (3, 'Carla', 'Salvador', '2026-03-20'),
    (4, 'Diego', 'Rio de Janeiro', '2026-04-05'); -- sem emprestimos

INSERT INTO emprestimos
    (id_emprestimo, id_socio, id_livro, data_emprestimo, data_devolucao, multa)
VALUES
    (101, 1, 10, '2026-11-01', '2026-11-08', 0.00),
    (102, 2, 12, '2026-11-02', '2026-11-12', 15.00),
    (103, 1, 13, '2026-11-03', NULL,        0.00),
    (104, 3, 10, '2026-11-05', '2026-11-10', 5.00),
    (105, 2, 11, '2026-11-06', NULL,        0.00);

-- 3. CRUD ---------------------------------------------
-- CREATE (com transação; troque ROLLBACK por COMMIT para manter os registros)
START TRANSACTION;
INSERT INTO socios (id_socio, nome, cidade, desde)
VALUES (5, 'Rafael', 'Belo Horizonte', '2026-11-10');
INSERT INTO livros (id_livro, titulo, genero, preco, id_autor)
VALUES (15, 'Sapiens', 'Historia', 100.00, 2);
SELECT * FROM socios WHERE id_socio = 5;
SELECT * FROM livros WHERE id_livro = 15;
ROLLBACK; -- se confirmar com COMMIT, a média de preços e os rankings mudam

-- READ
SELECT id_socio, nome, cidade FROM socios;
SELECT titulo, preco FROM livros WHERE preco > 60 ORDER BY preco DESC;
SELECT s.nome, l.titulo, e.data_emprestimo
FROM emprestimos e
JOIN socios s ON s.id_socio = e.id_socio
JOIN livros l ON l.id_livro = e.id_livro
WHERE s.cidade = 'Salvador'
ORDER BY e.data_emprestimo;

-- 4. JOINs --------------------------------------------
-- a) INNER JOIN de quatro tabelas
SELECT e.id_emprestimo, s.nome AS socio, l.titulo, a.nome AS autor
FROM emprestimos e
JOIN socios s   ON s.id_socio = e.id_socio
JOIN livros l   ON l.id_livro = e.id_livro
JOIN autores a  ON a.id_autor = l.id_autor
ORDER BY e.id_emprestimo;

-- b) Todos os sócios e seus empréstimos
SELECT s.nome, e.id_emprestimo
FROM socios s
LEFT JOIN emprestimos e ON e.id_socio = s.id_socio
ORDER BY s.nome;

-- c) Livros nunca emprestados
SELECT l.titulo
FROM livros l
LEFT JOIN emprestimos e ON e.id_livro = l.id_livro
WHERE e.id_emprestimo IS NULL;
-- Contos

-- d) RIGHT JOIN = LEFT JOIN invertido
SELECT s.nome, e.id_emprestimo
FROM emprestimos e
RIGHT JOIN socios s ON e.id_socio = s.id_socio;
-- Mesmo resultado de: socios s LEFT JOIN emprestimos e ON e.id_socio = s.id_socio

-- 5. Agregações ---------------------------------------
SELECT COUNT(*) AS total_emprestimos FROM emprestimos;              -- 5
SELECT SUM(multa) AS total_multas FROM emprestimos;                 -- 20.00
SELECT COUNT(DISTINCT id_socio) AS socios_que_emprestaram
FROM emprestimos;                                                   -- 3

SELECT AVG(preco) AS preco_medio,
       MIN(preco) AS menor_preco,
       MAX(preco) AS maior_preco
FROM livros;                                                        -- 66.00 / 45 / 90

SELECT s.cidade, SUM(e.multa) AS total_multas
FROM socios s
JOIN emprestimos e ON e.id_socio = s.id_socio
GROUP BY s.cidade
ORDER BY total_multas DESC;
-- Sao Paulo 15.00 | Salvador 5.00 (Rio de Janeiro não aparece: sem empréstimos)

-- WHERE filtra linhas (data); HAVING filtra grupos (total de multas)
SELECT s.cidade, SUM(e.multa) AS total_multas
FROM socios s
JOIN emprestimos e ON e.id_socio = s.id_socio
WHERE e.data_emprestimo >= '2026-11-01'
GROUP BY s.cidade
HAVING SUM(e.multa) > 0;

-- 6. Consultas avançadas ------------------------------
-- a) Subquery escalar: acima da média (66.00)
SELECT titulo, preco
FROM livros
WHERE preco > (SELECT AVG(preco) FROM livros);
-- A Mao Esquerda das Trevas (90) | O Disconforto (80)

-- b) IN e NOT EXISTS
SELECT nome FROM socios
WHERE id_socio IN (SELECT id_socio FROM emprestimos);
-- Ana, Bruno, Carla

SELECT nome FROM socios s
WHERE NOT EXISTS (
    SELECT 1 FROM emprestimos e
    WHERE e.id_socio = s.id_socio
);
-- Diego (a subquery usa o sócio da linha atual: correlacionada)

-- c) EXISTS correlacionado
SELECT nome FROM socios s
WHERE EXISTS (
    SELECT 1 FROM emprestimos e
    WHERE e.id_socio = s.id_socio
);

-- d) Mesma pergunta com JOIN + DISTINCT
SELECT DISTINCT s.nome
FROM socios s
JOIN emprestimos e ON e.id_socio = s.id_socio;

-- e) EXPLAIN antes e depois do índice
EXPLAIN
SELECT id_emprestimo FROM emprestimos WHERE id_socio = 1;

CREATE INDEX idx_emprestimos_socio ON emprestimos (id_socio);

EXPLAIN
SELECT id_emprestimo FROM emprestimos WHERE id_socio = 1;

-- 7. Cenários -----------------------------------------
-- Relatório: multas por sócio, inclusive quem não emprestou
SELECT s.nome,
       COALESCE(SUM(e.multa), 0) AS total_multas
FROM socios s
LEFT JOIN emprestimos e ON e.id_socio = s.id_socio
GROUP BY s.id_socio, s.nome
ORDER BY total_multas DESC;
-- Bruno 15 | Carla 5 | Ana 0 | Diego 0

-- Ranking: top 3 livros mais emprestados (com desempate previsível)
SELECT l.titulo, COUNT(*) AS emprestimos
FROM livros l
JOIN emprestimos e ON e.id_livro = l.id_livro
GROUP BY l.id_livro, l.titulo
ORDER BY emprestimos DESC, l.titulo
LIMIT 3;
-- Dom Casmurro 2 | A Mao Esquerda das Trevas 1 | Memorias Postumas 1

-- Cruzamento: empréstimos e multas por cidade
SELECT s.cidade,
       COUNT(DISTINCT e.id_emprestimo) AS emprestimos,
       SUM(e.multa) AS total_multas
FROM socios s
JOIN emprestimos e ON e.id_socio = s.id_socio
GROUP BY s.cidade
ORDER BY total_multas DESC;
-- Salvador 3 / 5.00 | Sao Paulo 2 / 15.00

-- Bônus: view do relatório
CREATE VIEW vw_relatorio_socios AS
SELECT s.nome, COALESCE(SUM(e.multa), 0) AS total_multas
FROM socios s
LEFT JOIN emprestimos e ON e.id_socio = s.id_socio
GROUP BY s.id_socio, s.nome;

-- 3. UPDATE e DELETE — só agora, com transação ---------
START TRANSACTION;
SELECT titulo, preco FROM livros WHERE id_livro = 12;   -- conferência
UPDATE livros SET preco = 85.00 WHERE id_livro = 12;
SELECT titulo, preco FROM livros WHERE id_livro = 12;   -- confirmação
COMMIT;

START TRANSACTION;
SELECT * FROM emprestimos WHERE id_socio = 4;           -- vazio: sem vínculos
DELETE FROM socios WHERE id_socio = 4;
SELECT * FROM socios WHERE id_socio = 4;                -- vazio: removido
COMMIT;

-- Checkpoint corrigido
-- ORDER BY só ordena; GROUP BY agrupa. Nenhum dos dois filtra.
-- Quem filtra é o WHERE:
UPDATE socios
SET cidade = 'Salvador'
WHERE id_socio = 2;
```

---

*Desafio do Módulo 4 — Banco de Dados / SQL (Aula 16).*  
*Professor: Luis Felipe Araujo Lima*
