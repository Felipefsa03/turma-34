CREATE DATABASE loja_byte;

USE loja_byte;

--CAMPO 1
CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(300) NOT NULL,
    estado CHAR(2) NOT NULL
);

CREATE TABLE produtos (
    id_produto INT PRIMARY KEY AUTO_INCREMENT,
    nomeproduto VARCHAR(100) NOT NULL,
    valor VARCHAR(10000) NOT NULL
);

CREATE TABLE pedidos (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    cliente_id INT,
    pedido VARCHAR(1000),
    data_pedido DATE NOT NULL,
    valorpedido VARCHAR(10000),
    CONSTRAINT fk_pedidos_clientes FOREIGN KEY (cliente_id) REFERENCES clientes (id)
);

CREATE TABLE itens_pedido (
    nomeitem VARCHAR(1000) NOT NULL,
    valoritem VARCHAR(10000) NOT NULL
);

INSERT INTO
    clientes (nome, email, estado)
VALUES (
        'Robson',
        'robson@junior',
        'BA'
    ),
    (
        'wagner',
        'wagner@coude',
        'BA'
    ),
    (
        'filipe',
        'filipe67@gmail.com',
        'BA'
    ),
    (
        'gabriel',
        'gabriel@gmail.com',
        'BA'
    );

INSERT INTO
    produtos (nomeproduto, valor)
VALUES ('notebook', 'R$1000'),
    ('celular', 'R$2000'),
    ('garrafas', 'R$50'),
    ('5 canetas', 'R$20');

INSERT INTO
    pedidos (
        pedido,
        valorpedido,
        data_pedido,
    )
VALUES (
        'notebook',
        'R$1000',
        '2026-11-12'
    ),
    (
        'notebook',
        'R$1000',
        '2026-11-12'
    ),
    (
        '5 canetas',
        'R$20',
        '2026-11-12'
    ),
    (
        '5 canetas',
        'R$20',
        '2026-11-11'
    );

INSERT INTO
    itens_pedido (nomeitem, valoritem, pedido_id)
VALUES ('notebook', 'R$1000', 1),
    ('notebook', 'R$1000', 2),
    ('5 canetas', 'R$20', 3),
    ('5 canetas', 'R$20', 4);

-- CAMPO 2

ALTER TABLE itens_pedido
ADD COLUMN pedido_id INT,
ADD COLUMN produto_id INT;

ALTER TABLE itens_pedido
ADD CONSTRAINT fk_itens_pedidos FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido);

ALTER TABLE itens_pedido
ADD CONSTRAINT fk_itens_produtos FOREIGN KEY (produto_id) REFERENCES produtos (id_produto);

INSERT INTO
    clientes (
        id,
        nome,
        email,
        estado
    )
VALUES (
        6,
        'Rafael',
        'rafael@gmail.com',
        'MG'
    );

INSERT INTO
    produtos (
        id_produto,
        nomeproduto,
        valor
    )
VALUES (50, 'Headset', 'R$150')

COMMIT

-- CAMPO 2.5

DROP TABLE clientes

DROP TABLE pedidos

-- campo 3

SELECT 
c.nome, 
c.estado,
p.id_pedido
FROM clientes c
INNER JOIN pedidos p
ON c.id = p.id_pedido;



