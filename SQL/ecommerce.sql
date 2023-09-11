/*Criação de tabelas*/

    CREATE TABLE tbl_cliente(
        id_cliente integer PRIMARY KEY,
        nome_cliente text NOT NULL,
        email varchar(30) NOT NULL,
        senha varchar(30) NOT NULL,
        telefone varchar(20) NOT NULL
    );

    CREATE TABLE tbl_pedido(
        id_pedido integer PRIMARY KEY,
        vlr_total float NOT NULL, /*Valor total do pedido*/
        produto varchar NOT NULL,
        cliente integer NOT NULL
    );

    CREATE TABLE tbl_produto(
        id_produto varchar PRIMARY KEY,
        nome_produto text NOT NULL,
        descricao text NOT NULL, 
        vlr float NOT NULL,
        exluido varchar(10),
        dta_exclusao timestamp,
        id_visual varchar(50),
        custo numeric(10, 2),
        margem_lucro numeric(10, 2),
        imagem varchar(50)
    );

    ALTER TABLE tbl_pedido ADD CONSTRAINT produto FOREIGN KEY (produto) REFERENCES tbl_produtos(id_produto);
    ALTER TABLE tbl_pedido ADD CONSTRAINT cliente FOREIGN KEY (cliente) REFERENCES tbl_cliente(id_cliente);

/*Inserção de dados*/

    INSERT INTO tbl_cliente VALUES 
        (1, 'João', 'a@h.com', '123', '123'), 
        (2, 'Maria', 'b@h.com', '456', '456'), 
        (3, 'José', 'c@h.com', '789', '789'); 
    INSERT INTO tbl_pedido VALUES 
        (1, 100.0, '10wa', 1), 
        (2, 100.0, '20wa', 2), 
        (3, 100.0, '30wa', 3);
    INSERT INTO tbl_produto VALUES 
        ('10wa', 'Produto 1', 'Produto 1', 100.0, 'N', null, null, null, null, null), 
        ('20wa', 'Produto 2', 'Produto 2', 100.0, 'N', null, null, null, null, null), 
        ('30wa', 'Produto 3', 'Produto 3', 100.0, 'N', null, null, null, null, null);

/*Consulta de dados*/

    /*Consultas simples*/
        SELECT * FROM tbl_cliente;
        SELECT * FROM tbl_pedido;
        SELECT * FROM tbl_produto;

    /*Consultas com filtros*/
        SELECT * FROM tbl_cliente WHERE id_cliente = 1;
        SELECT * FROM tbl_pedido WHERE id_pedido = 1;
        SELECT * FROM tbl_produto WHERE id_produto = '10wa';
    
    /*Consultas com ordenação*/
        SELECT * FROM tbl_cliente ORDER BY nome_cliente;
        SELECT * FROM tbl_pedido ORDER BY vlr_total;
        SELECT * FROM tbl_produto ORDER BY nome;

    /*Consultas com agrupamento*/
        SELECT * FROM tbl_cliente GROUP BY nome_cliente;
        SELECT * FROM tbl_pedido GROUP BY vlr_total;
        SELECT * FROM tbl_produto GROUP BY nome;
    
    /*Consultas com junção*/
        SELECT * FROM tbl_cliente INNER JOIN tbl_pedido ON tbl_cliente.id_cliente = tbl_pedido.cliente;
        SELECT * FROM tbl_pedido INNER JOIN tbl_produto ON tbl_pedido.produto = tbl_produto.id_produto;
        SELECT * FROM tbl_cliente INNER JOIN tbl_produto ON tbl_cliente.id_cliente = tbl_produto.id_produto;
    
    /*Consultas com junção e agrupamento*/  
        SELECT * FROM tbl_cliente INNER JOIN tbl_pedido ON tbl_cliente.id_cliente = tbl_pedido.cliente GROUP BY nome_cliente;
        SELECT * FROM tbl_pedido INNER JOIN tbl_produto ON tbl_pedido.produto = tbl_produto.id_produto GROUP BY vlr_total;
        SELECT * FROM tbl_cliente INNER JOIN tbl_produto ON tbl_cliente.id_cliente = tbl_produto.id_produto GROUP BY nome;

    /*Consultas com junção e ordenação*/
        SELECT * FROM tbl_cliente INNER JOIN tbl_pedido ON tbl_cliente.id_cliente = tbl_pedido.cliente ORDER BY nome_cliente;
        SELECT * FROM tbl_pedido INNER JOIN tbl_produto ON tbl_pedido.produto = tbl_produto.id_produto ORDER BY vlr_total;
        SELECT * FROM tbl_cliente INNER JOIN tbl_produto ON tbl_cliente.id_cliente = tbl_produto.id_produto ORDER BY nome;

    /*Consultas com junção, agrupamento e ordenação*/
        SELECT * FROM tbl_cliente INNER JOIN tbl_pedido ON tbl_cliente.id_cliente = tbl_pedido.cliente GROUP BY nome_cliente ORDER BY nome_cliente;
        SELECT * FROM tbl_pedido INNER JOIN tbl_produto ON tbl_pedido.produto = tbl_produto.id_produto GROUP BY vlr_total ORDER BY vlr_total;
        SELECT * FROM tbl_cliente INNER JOIN tbl_produto ON tbl_cliente.id_cliente = tbl_produto.id_produto GROUP BY nome ORDER BY nome;          
