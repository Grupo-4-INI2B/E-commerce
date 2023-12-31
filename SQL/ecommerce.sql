/*Criação de tabelas*/

    CREATE TABLE tbl_usuario (
        id_usuario integer PRIMARY KEY NOT NULL,
        nome_usuario text NOT NULL,
        email varchar(30) NOT NULL,
        telefone varchar(20) NOT NULL,
        senha varchar(30) NOT NULL,
        adm boolean NOT NULL, /*Se o usuário é administrador ou não*/
        excluido boolean NOT NULL, /*Exlusão lógica*/
        dta_exclusao timestamp
    );
	
    CREATE TABLE tbl_pedido (
        id_pedido integer PRIMARY KEY NOT NULL, 
        status varchar(100) NOT NULL, 
        dta_pedido timestamp NOT NULL, 
        usuario integer NOT NULL, 
        produto integer NOT NULL,
        qntd integer NOT NULL
    );

    CREATE TABLE tbl_carrinho (
        qntd integer NOT NULL,
        produto integer NOT NULL,
        usuario integer NOT NULL   
    );

    CREATE TABLE tbl_produto (
        id_produto integer PRIMARY KEY NOT NULL,
        nome_produto text NOT NULL,
        descricao text NOT NULL, 
        vlr float NOT NULL, /*Valor do produto*/
		qntd int NOT NULL,
        excluido boolean NOT NULL,
        dta_exclusao timestamp,
        id_visual varchar(50),
        custo numeric(10, 2),
        margem_lucro numeric(10, 2),
        icms numeric(10, 2)  
    );

/*Criação de chaves estrangeiras*/

    ALTER TABLE tbl_pedido ADD CONSTRAINT usuario FOREIGN KEY (usuario) REFERENCES tbl_usuario(id_usuario);
    ALTER TABLE tbl_pedido ADD CONSTRAINT produto FOREIGN KEY (produto) REFERENCES tbl_produto(id_produto);
    ALTER TABLE tbl_pedido ADD CONSTRAINT qntd FOREIGN KEY (qntd) REFERENCES tbl_carrinho(qntd);
    ALTER TABLE tbl_carrinho ADD CONSTRAINT produto FOREIGN KEY (produto) REFERENCES tbl_produto(id_produto);
    ALTER TABLE tbl_carrinho ADD CONSTRAINT usuario FOREIGN KEY (usuario) REFERENCES tbl_usuario(id_usuario);


/*Inserção de dados*/

    INSERT INTO tbl_usuario(id_usuario, nome_usuario, email, telefone, senha, adm, excluido) VALUES 
        (1, 'João', 'a@w.com', '123456789', '123456', FALSE, FALSE),
        (2, 'Maria', 'b@w.com', '1234567810', '12456', FALSE, FALSE),
        (3, 'José', 'c@w.com', '1234567811', '12356' , FALSE, FALSE),
        (4, 'Pedro', 'd@w.com', '1234567812', '12346', FALSE, FALSE),
        (5, 'Paulo', 'e@w.com', '1234567813', '12345', FALSE, FALSE);
		
    INSERT INTO tbl_pedido VALUES 
        (1, 'Aguardando pagamento', '2020-10-10 10:10:10', 1),
        (2, 'Aguardando pagamento', '2020-10-10 10:10:10', 2),
        (3, 'Aguardando pagamento', '2020-10-10 10:10:10', 3),
        (4, 'Aguardando pagamento', '2020-10-10 10:10:10', 4),
        (5, 'Aguardando pagamento', '2020-10-10 10:10:10', 5);
		
    INSERT INTO tbl_compraTmp VALUES 
        ('123456789', 1),
        ('1234567810', 2),
        ('1234567811', 3),
        ('1234567812', 4),
        ('1234567813', 5);
		
    INSERT INTO tbl_produto (id_produto, nome_produto, descricao, vlr, exluido, qntd) VALUES 
        ('123456789', 'Produto 1', 'Descrição do produto 1', 100.00, FALSE, 4),
        ('1234567810', 'Produto 2', 'Descrição do produto 2', 200.00, FALSE, 5),
        ('1234567811', 'Produto 3', 'Descrição do produto 3', 300.00, FALSE, 5),
        ('1234567812', 'Produto 4', 'Descrição do produto 4', 400.00, FALSE, 10),
        ('1234567813', 'Produto 5', 'Descrição do produto 5', 500.00, FALSE, 50);
		
	INSERT INTO tbl_carrinho VALUES 
		(1, '123456789', 1),
		(2, '1234567810', 2),
		(3, '1234567811', 3),
		(4, '1234567812', 4),
		(5, '1234567813', 5);
		
/*Consulta de dados*/

    /*Consultas simples*/
        SELECT * FROM tbl_usuario;
        SELECT * FROM tbl_pedido;
        SELECT * FROM tbl_compraTmp;
        SELECT * FROM tbl_carrinho;
        SELECT * FROM tbl_produto;

    /*Consultas com filtros*/
        SELECT * FROM tbl_usuario WHERE id_usuario = 1;
        SELECT * FROM tbl_pedido WHERE id_pedido = 1;
        SELECT * FROM tbl_compraTmp WHERE sessao = '123456789';
        SELECT * FROM tbl_carrinho WHERE produto = '123456789';
        SELECT * FROM tbl_produto WHERE id_produto = '123456789';
    
    /*Consultas com joins*/ 
        SELECT * FROM tbl_usuario INNER JOIN tbl_pedido ON tbl_usuario.id_usuario = tbl_pedido.usuario;
        SELECT * FROM tbl_pedido INNER JOIN tbl_compraTmp ON tbl_pedido.id_pedido = tbl_compraTmp.pedido;
        SELECT * FROM tbl_compraTmp INNER JOIN tbl_carrinho ON tbl_compraTmp.pedido = tbl_carrinho.pedido;
        SELECT * FROM tbl_carrinho INNER JOIN tbl_produto ON tbl_carrinho.produto = tbl_produto.id_produto;
        