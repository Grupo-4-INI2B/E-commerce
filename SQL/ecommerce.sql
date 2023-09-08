CREATE TABLE tbl_cliente(
    id_usuario serial PRIMARY KEY,
    nome_usuario varchar(30) NOT NULL,
    email varchar(30) NOT NULL,
    senha varchar(30) NOT NULL,
    telefone varchar(20) NOT NULL,
    pedidos serial NOT NULL,
);

CREATE TABLE tbl_pedido(
    id_pedido serial PRIMARY KEY,
    vlr_total float NOT NULL, /*Valor total do pedido*/
    produto int NOT NULL,
    cliente int NOT NULL,
);

CREATE TABLE tbl_produtos(
    id_produto serial PRIMARY KEY,
    nome text(10) NOT NULL,
    descricao text(100) NOT NULL, 
    vlr float NOT NULL,
    exluido varchar(10),
    dta_exclusao timestamp,
    id_visual varchar(50),
    custo numeric(10, 2),
    margem_lucro numeric(10, 2),
    imagem varchar(50)
);

ALTER TABLE tbl_cliente ADD CONSTRAINT pedido FOREIGN KEY (pedido) REFERENCES tbl_pedido(id_pedido);

ALTER TABLE tbl_pedido ADD CONSTRAINT produto FOREIGN KEY (produto) REFERENCES tbl_produtos(id_produto);
ALTER TABLE tbl_pedido ADD CONSTRAINT cliente FOREIGN KEY (cliente) REFERENCES tbl_cliente(id_usuario);

