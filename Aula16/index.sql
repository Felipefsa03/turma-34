-- =====================================================
-- AULA 16 — CONSULTAS AVANÇADAS E PROJETO FINAL SQL
-- Professor: Luis Felipe de Araujo
-- Módulo 4 · Banco de Dados / SQL (MySQL)
--
-- PARTE A: Loja Byte — subqueries, EXISTS, EXPLAIN e cenários (4.7 e 4.8)
-- PARTE B: escola_sql — projeto final (4.9)
--
-- Execute em um cliente MySQL. Os DROP TABLE da Parte A recriam
-- apenas as tabelas didáticas loja_byte (use outro banco se quiser preservar dados).
-- =====================================================


-- =====================================================
-- PARTE A — LOJA BYTE (4.7 e 4.8)
-- =====================================================

CREATE DATABASE IF NOT EXISTS loja_byte;
USE loja_byte;

DROP TABLE IF EXISTS itens_pedido;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS produtos;
DROP TABLE IF EXISTS clientes;

CREATE TABLE clientes (
    id_cliente INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    cpf CHAR(11) UNIQUE,
    estado CHAR(2) NOT NULL
);

CREATE TABLE produtos (
    id_produto INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);

CREATE TABLE pedidos (
    id_pedido INT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_pedido DATE NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

CREATE TABLE itens_pedido (
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id_pedido, id_produto),
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);

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


-- -----------------------------------------------------
-- 4.7.1 — SUBQUERY ESCALAR: produtos acima da média
-- -----------------------------------------------------

SELECT AVG(preco) AS preco_medio FROM produtos; -- 337,50

SELECT nome, preco
FROM produtos
WHERE preco > (
    SELECT AVG(preco) FROM produtos
);


-- -----------------------------------------------------
-- 4.7.1 — IN / NOT IN: conjuntos de IDs
-- -----------------------------------------------------

-- Clientes que compraram (Ana, Bruno, Carla)
SELECT nome
FROM clientes
WHERE id_cliente IN (
    SELECT id_cliente FROM pedidos
);

-- Clientes que nunca compraram (Diego)
-- NOT IN pode devolver vazio se a subquery contiver NULL — prefira NOT EXISTS.
SELECT nome
FROM clientes
WHERE id_cliente NOT IN (
    SELECT id_cliente FROM pedidos
);


-- -----------------------------------------------------
-- 4.7.2 — EXISTS / NOT EXISTS (subconsulta correlacionada)
-- -----------------------------------------------------

SELECT c.nome
FROM clientes c
WHERE EXISTS (
    SELECT 1
    FROM pedidos p
    WHERE p.id_cliente = c.id_cliente
);

SELECT c.nome
FROM clientes c
WHERE NOT EXISTS (
    SELECT 1
    FROM pedidos p
    WHERE p.id_cliente = c.id_cliente
);

-- Mesma pergunta com JOIN (a alternativa mais legível quando trazemos colunas)
SELECT DISTINCT c.nome
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente;


-- -----------------------------------------------------
-- 4.7.3 — OTIMIZAÇÃO BÁSICA: EXPLAIN e índice
-- -----------------------------------------------------

EXPLAIN
SELECT id_pedido, id_cliente, data_pedido
FROM pedidos
WHERE id_cliente = 1;

CREATE INDEX idx_pedidos_cliente ON pedidos (id_cliente);

EXPLAIN
SELECT id_pedido, id_cliente, data_pedido
FROM pedidos
WHERE id_cliente = 1;


-- -----------------------------------------------------
-- CHECKPOINT 4.7 — NOT EXISTS bem escrito
-- -----------------------------------------------------

-- Correlação usa p.id_cliente = c.id_cliente (cliente da linha atual).
SELECT c.nome
FROM clientes c
WHERE NOT EXISTS (
    SELECT 1 FROM pedidos p
    WHERE p.id_cliente = c.id_cliente
);


-- -----------------------------------------------------
-- 4.8.1 — RELATÓRIO: gasto por cliente (inclui quem não comprou)
-- -----------------------------------------------------

SELECT c.nome,
       COALESCE(SUM(i.quantidade * i.preco_unitario), 0) AS total_gasto
FROM clientes c
LEFT JOIN pedidos p ON p.id_cliente = c.id_cliente
LEFT JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.id_cliente, c.nome
ORDER BY total_gasto DESC;
-- Bruno 950 | Ana 480 | Carla 80 | Diego 0


-- -----------------------------------------------------
-- 4.8.2 — RANKING: produtos mais vendidos (top 3)
-- -----------------------------------------------------

SELECT p.nome, SUM(i.quantidade) AS unidades
FROM produtos p
JOIN itens_pedido i ON i.id_produto = p.id_produto
GROUP BY p.id_produto, p.nome
ORDER BY unidades DESC, p.nome
LIMIT 3;


-- -----------------------------------------------------
-- 4.8.3 — CRUZAMENTO: faturamento por estado
-- -----------------------------------------------------

SELECT c.estado,
       COUNT(DISTINCT p.id_pedido) AS pedidos,
       SUM(i.quantidade * i.preco_unitario) AS total
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
JOIN itens_pedido i ON i.id_pedido = p.id_pedido
GROUP BY c.estado
ORDER BY total DESC;
-- SP 950 | BA 560


-- -----------------------------------------------------
-- CHECKPOINT 4.8 — agregação vai no HAVING, nunca no WHERE
-- -----------------------------------------------------

-- ERRADO: WHERE COUNT(*) > 5
SELECT c.estado, COUNT(*) AS total
FROM clientes c
JOIN pedidos p ON p.id_cliente = c.id_cliente
GROUP BY c.estado
HAVING COUNT(*) > 5;


-- =====================================================
-- PARTE B — PROJETO FINAL: escola_sql (4.9)
-- =====================================================

DROP DATABASE IF EXISTS escola_sql;
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

INSERT INTO alunos (id_aluno, nome, turma) VALUES
    (1, 'Ana', '1A'), (2, 'Bruno', '1A'), (3, 'Carla', '1B');

INSERT INTO disciplinas (id_disciplina, nome) VALUES
    (10, 'Banco de Dados'), (20, 'Programacao');

INSERT INTO matriculas (id_matricula, id_aluno, id_disciplina, nota) VALUES
    (101, 1, 10, 9.0), (102, 1, 20, 8.0),
    (103, 2, 10, 7.0), (104, 3, 20, 9.5);

-- Listagem com nomes em vez de IDs
SELECT a.nome, d.nome AS disciplina, m.nota
FROM matriculas m
JOIN alunos a ON a.id_aluno = m.id_aluno
JOIN disciplinas d ON d.id_disciplina = m.id_disciplina
ORDER BY a.nome, d.nome;

-- Média por aluno
SELECT a.nome, ROUND(AVG(m.nota), 2) AS media
FROM alunos a
JOIN matriculas m ON m.id_aluno = a.id_aluno
GROUP BY a.id_aluno, a.nome
ORDER BY media DESC;
-- Carla 9,50 | Ana 8,50 | Bruno 7,00

-- Missão extra: média >= 8 (HAVING filtra grupos)
SELECT a.nome, ROUND(AVG(m.nota), 2) AS media
FROM alunos a
JOIN matriculas m ON m.id_aluno = a.id_aluno
GROUP BY a.id_aluno, a.nome
HAVING AVG(m.nota) >= 8
ORDER BY media DESC;

-- Ranking de notas
SELECT a.nome, d.nome AS disciplina, m.nota
FROM matriculas m
JOIN alunos a ON a.id_aluno = m.id_aluno
JOIN disciplinas d ON d.id_disciplina = m.id_disciplina
ORDER BY m.nota DESC
LIMIT 3;

-- Extra: alunos sem matrícula
SELECT a.nome
FROM alunos a
LEFT JOIN matriculas m ON m.id_aluno = a.id_aluno
WHERE m.id_matricula IS NULL;

-- Extra: alunos acima da média geral (subquery escalar)
SELECT a.nome, ROUND(AVG(m.nota), 2) AS media
FROM alunos a
JOIN matriculas m ON m.id_aluno = a.id_aluno
GROUP BY a.id_aluno, a.nome
HAVING AVG(m.nota) > (SELECT AVG(nota) FROM matriculas)
ORDER BY media DESC;

-- =====================================================
-- FIM DA AULA
-- Professor: Luis Felipe de Araujo
-- =====================================================
