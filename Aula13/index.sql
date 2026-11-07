-- DROP DATABASE Turma34;
-- CREATE DATABASE Turma34;
-- USE Turma34;

-- DELETE TABLE IF EXISTS Alunos;

-- CREATE TABLE Alunos (
--     id  int PRIMARY KEY AUTO_INCREMENT,
--     nome VARCHAR(100) NOT NULL,
--     idade INT NOT NULL,
--     email VARCHAR(100) UNIQUE NOT NULL
-- );


-- DROP TABLE `Alunos`;

-- INSERT INTO Alunos (nome, idade, email) VALUES
-- ('Wagner', 42, 'wagner@coude.io'),
-- ('Fernanda', 40, 'fernanda@email.com'),
-- ('Gabriel', 24, 'gabriel@email.com'),
-- ('Robson', 21, 'robson@email.com'),
-- ('Kayo', 17, 'kayo@email.com'),
-- ('Neto', 22, 'neto@email.com'),
-- ('João Silva', 20, 'joao.silva@email.com'),
-- ('Maria Oliveira', 22, 'maria.oliveira@email.com');





-- UPDATE `Alunos` 
-- SET idade = 43;


-- DELETE FROM Alunos ;



-- SELECT * FROM Alunos;



-- =====================================================
-- AULA: BANCOS DE DADOS RELACIONAIS E SQL
-- Professor: Luis Felipe de Araujo
-- Projeto: Loja Byte
-- =====================================================


-- =====================================================
-- 1. CRIANDO O BANCO DE DADOS
-- =====================================================

CREATE DATABASE IF NOT EXISTS loja_byte;

USE loja_byte;


-- =====================================================
-- 2. CRIANDO AS TABELAS
-- =====================================================

-- Tabela de clientes

CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    cpf CHAR(11) UNIQUE,
    estado CHAR(2) NOT NULL
);


-- Tabela de produtos

CREATE TABLE IF NOT EXISTS produtos (
    id_produto INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);


-- Tabela de pedidos

CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido INT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_pedido DATE NOT NULL,

    FOREIGN KEY (id_cliente)
        REFERENCES clientes(id_cliente)
);


-- Tabela de itens dos pedidos

CREATE TABLE IF NOT EXISTS itens_pedido (
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,

    PRIMARY KEY (id_pedido, id_produto),

    FOREIGN KEY (id_pedido)
        REFERENCES pedidos(id_pedido),

    FOREIGN KEY (id_produto)
        REFERENCES produtos(id_produto)
);


-- =====================================================
-- 3. INSERINDO DADOS INICIAIS
-- =====================================================

-- Clientes

INSERT INTO clientes (id_cliente, nome, estado)
VALUES
    (1, 'Ana', 'BA'),
    (2, 'Bruno', 'SP'),
    (3, 'Carla', 'BA'),
    (4, 'Diego', 'RJ');


-- Produtos

INSERT INTO produtos (id_produto, nome, preco)
VALUES
    (10, 'Teclado', 120.00),
    (20, 'Mouse', 80.00),
    (30, 'Monitor', 950.00),
    (40, 'Webcam', 200.00);


-- Pedidos

INSERT INTO pedidos (id_pedido, id_cliente, data_pedido)
VALUES
    (101, 1, '2026-11-02'),
    (102, 2, '2026-11-03'),
    (103, 1, '2026-11-04'),
    (104, 3, '2026-11-04');


-- Itens dos pedidos

INSERT INTO itens_pedido
(id_pedido, id_produto, quantidade, preco_unitario)
VALUES
    (101, 10, 1, 120.00),
    (101, 20, 2, 80.00),
    (102, 30, 1, 950.00),
    (103, 40, 1, 200.00),
    (104, 20, 1, 80.00);


-- =====================================================
-- 4. CRUD - CREATE (INSERT)
-- =====================================================

-- Cadastrando um cliente
-- ROLLBACK desfaz a operação ao final.

START TRANSACTION;

INSERT INTO clientes (id_cliente, nome, estado)
VALUES (5, 'Eva', 'PE');

SELECT * FROM clientes;

ROLLBACK;


-- =====================================================
-- 5. CRUD - READ (SELECT)
-- =====================================================

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


-- Ordenar produtos por preço

SELECT *
FROM produtos
ORDER BY preco DESC;


-- =====================================================
-- 6. CRUD - UPDATE
-- =====================================================

-- Atualizar o preço de um produto

START TRANSACTION;

UPDATE produtos
SET preco = 90.00
WHERE id_produto = 20;

SELECT * FROM produtos;

ROLLBACK;


-- ATENÇÃO!
-- UPDATE sem WHERE altera TODOS os registros.
-- NÃO EXECUTE O EXEMPLO ABAIXO!

-- UPDATE produtos
-- SET preco = 90.00;


-- =====================================================
-- 7. CRUD - DELETE
-- =====================================================

-- Excluir um cliente específico

START TRANSACTION;

DELETE FROM clientes
WHERE id_cliente = 4;

SELECT * FROM clientes;

ROLLBACK;


-- ATENÇÃO!
-- DELETE sem WHERE remove TODOS os registros.
-- NÃO EXECUTE O EXEMPLO ABAIXO!

-- DELETE FROM clientes;


-- =====================================================
-- 8. INNER JOIN
-- =====================================================

-- Mostrar clientes que fizeram pedidos









SELECT
    p.id_pedido,
    c.nome,
    c.estado
FROM clientes c
INNER JOIN pedidos p
    ON c.id_cliente = p.id_cliente
ORDER BY p.id_pedido ASC
    ;















-- =====================================================
-- 9. LEFT JOIN
-- =====================================================

-- Mostrar TODOS os clientes e seus pedidos

SELECT
    c.nome,
    p.id_pedido
FROM clientes c
LEFT JOIN pedidos p
    ON c.id_cliente = p.id_cliente;


-- Encontrar clientes que nunca compraram

SELECT
    c.nome,
    p.id_pedido
FROM clientes c
LEFT JOIN pedidos p
    ON c.id_cliente = p.id_cliente
WHERE p.id_pedido IS NULL;


-- =====================================================
-- 10. RIGHT JOIN
-- =====================================================

-- Mostrar todos os clientes, mesmo sem pedidos

SELECT
    c.nome,
    p.id_pedido
FROM pedidos p
RIGHT JOIN clientes c
    ON p.id_cliente = c.id_cliente;


-- =====================================================
-- 11. COUNT - CONTANDO REGISTROS
-- =====================================================

-- Quantidade de clientes

SELECT COUNT(*) AS total_clientes
FROM clientes;


-- Quantidade de pedidos

SELECT COUNT(*) AS total_pedidos
FROM pedidos;


-- Quantidade de clientes diferentes que compraram

SELECT COUNT(DISTINCT id_cliente) AS clientes_com_compras
FROM pedidos;


-- =====================================================
-- 12. SUM - SOMANDO VALORES
-- =====================================================

-- Faturamento total da loja

SELECT
    SUM(quantidade * preco_unitario)
        AS faturamento_total
FROM itens_pedido;


-- =====================================================
-- 13. AVG - CALCULANDO MÉDIAS
-- =====================================================

-- Preço médio dos produtos

SELECT AVG(preco) AS preco_medio
FROM produtos;

 SELECT
  AVG(preco) AS preco_medio,
  MIN(preco) AS menor_preco,
  MAX(preco) AS maior_preco
 FROM produtos;
-- =====================================================
-- 14. MIN E MAX
-- =====================================================

-- Menor e maior preço

SELECT
    MIN(preco) AS menor_preco,
    MAX(preco) AS maior_preco
FROM produtos;


-- =====================================================
-- 15. GROUP BY
-- =====================================================

-- Faturamento total por estado

SELECT
    c.estado,
    SUM(i.quantidade * i.preco_unitario)
        AS faturamento
FROM clientes c
INNER JOIN pedidos p
    ON p.id_cliente = c.id_cliente
INNER JOIN itens_pedido i
    ON i.id_pedido = p.id_pedido
GROUP BY c.estado
ORDER BY faturamento DESC;


-- =====================================================
-- 16. HAVING
-- =====================================================

-- Estados com faturamento acima de R$ 500

SELECT
    c.estado,
    SUM(i.quantidade * i.preco_unitario)
        AS faturamento
FROM clientes c
INNER JOIN pedidos p
    ON p.id_cliente = c.id_cliente
INNER JOIN itens_pedido i
    ON i.id_pedido = p.id_pedido
GROUP BY c.estado
HAVING SUM(i.quantidade * i.preco_unitario) > 500;


-- =====================================================
-- 17. DESAFIO FINAL
-- =====================================================

-- Descobrir quanto cada cliente gastou.
-- Inclui clientes que nunca realizaram pedidos.

SELECT
    c.nome,
    COALESCE(
        SUM(i.quantidade * i.preco_unitario),
        0
    ) AS total_gasto
FROM clientes c
LEFT JOIN pedidos p
    ON p.id_cliente = c.id_cliente
LEFT JOIN itens_pedido i
    ON i.id_pedido = p.id_pedido
GROUP BY c.id_cliente, c.nome
ORDER BY total_gasto DESC;


-- =====================================================
-- FIM DA AULA
-- Professor: Luis Felipe de Araujo
-- =====================================================
