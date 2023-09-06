CREATE TABLE tbl_cliente(
    id_usuario serial PRIMARY KEY,
    usuario varchar(30) NOT NULL,
    email varchar(30) NOT NULL,
    senha varchar(30) NOT NULL,
    telefone varchar(20),
    pedido int not null,
);

CREATE TABLE tbl_pedido(
    id_pedido serial PRIMARY KEY,
    vlr_total float NOT NULL, /*Valor total do pedido*/
    produto int not null,
    cliente int not null,
);

CREATE TABLE tbl_produtos(
    id_produto serial PRIMARY KEY,
    nome varchar(10) NOT NULL,
    vlr float NOT NULL,
    categoria varchar(10) NOT NULL, /*filme, anime e etc*/
    qnt int,
    tipo varchar(10) NOT NULL /*BUTTON OU STICKER*/
);

ALTER TABLE tbl_cliente ADD CONSTRAINT pedido FOREIGN KEY (pedido) REFERENCES tbl_pedido(id_pedido);

ALTER TABLE tbl_pedido ADD CONSTRAINT produto FOREIGN KEY (produto) REFERENCES tbl_produtos(id_produto);
ALTER TABLE tbl_pedido ADD CONSTRAINT cliente FOREIGN KEY (cliente) REFERENCES tbl_cliente(id_usuario);

