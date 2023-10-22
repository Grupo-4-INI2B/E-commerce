// // Função para criar cards de adesivos Studio Ghibli
// function criarCardsStudioGhibli() {
//   const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados

//   for (let i = 1; i <= 50; i++) {
//     const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
//     const imagemSrc = `../Produtos_E-commerce/Studio_Ghibli/SG${numero}.png`;

//     const card = document.createElement("div");
//     card.classList.add("product-card");

//     const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
//     cardContent.innerHTML = `
//       <img src="${imagemSrc}" alt="Studio Ghibli">
//       <h2>Studio Ghibli</h2>
//       <p>Studio Ghibli ${numero}</p>
//       <p class="price">R$ 1,00</p>
//       <button type="button" class="btn-buy"><a href='Carrinho.php?operacao=incluir&id_produto=SG${numero}&qntd=1'>Comprar</a></button>
//     `;

//     card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
//     container.appendChild(card);
//   }
// }

  
//   // Função para criar cards de adesivos Demon Slayer
//   function criarCardsDemonSlayer() {
//     const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
//     for (let i = 1; i <= 49; i++) {
//       const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
//       const imagemSrc = `../Produtos_E-commerce/Demon Slayer/DS${numero}.png`;
  
//       const card = document.createElement("div");
//       card.classList.add("product-card");
  
//       const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
//       cardContent.innerHTML = `
//         <img src="${imagemSrc}" alt="Demon Slayer">
//         <h2>Demon Slayer</h2>
//         <p>Demon Slayer ${numero}</p>
//         <p class="price">R$ 1,00</p>
//         <button type="button" class="btn-buy"><a href='Carrinho.php?operacao=incluir&id_produto=DS${numero}&qntd=1'>Comprar</a></button>
//       `;
  
//       card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
//       container.appendChild(card);
//     }
//   }
  
  
//   // Função para criar cards de adesivos Capivaras
//   function criarCardsCapivaras() {
//     const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
//     for (let i = 1; i <= 50; i++) {
//       const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
//       const imagemSrc = `../Produtos_E-commerce/Capivaras/CP${numero}.png`;
  
//       const card = document.createElement("div");
//       card.classList.add("product-card");
  
//       const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
//       cardContent.innerHTML = `
//         <img src="${imagemSrc}" alt="Capivara">
//         <h2>Capivara</h2>
//         <p>Capivara ${numero}</p>
//         <p class="price">R$ 1,00</p>
//         <button type="button" class="btn-buy"><a href='Carrinho.php?operacao=incluir&id_produto=CP${numero}&qntd=1'>Comprar</a></button>
//       `;
  
//       card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
//       container.appendChild(card);
//     }
//   }
  
  
//   // Função para criar cards de adesivos Pokemons
//   function criarCardsPokemons() {
//     const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
//     for (let i = 1; i <= 50; i++) {
//       const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
//       const imagemSrc = `../Produtos_E-commerce/Pokemons/PK${numero}.png`;
  
//       const card = document.createElement("div");
//       card.classList.add("product-card");
  
//       const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
//       cardContent.innerHTML = `
//         <img src="${imagemSrc}" alt="Pokemon">
//         <h2>Pokemon</h2>
//         <p>Pokemon ${numero}</p>
//         <p class="price">R$ 1,00</p>
//         <button type="button" class="btn-buy"><a href='Carrinho.php?operacao=incluir&id_produto=PK${numero}&qntd=1'>Comprar</a></button>
//       `;
  
//       card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
//       container.appendChild(card);
//     }
//   }
  
  
//   // Função para criar cards de adesivos Star Wars
//   function criarCardsStarWars() {
//     const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
//     for (let i = 1; i <= 48; i++) {
//       const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
//       const imagemSrc = `../Produtos_E-commerce/Star Wars/SW${numero}.png`;
  
//       const card = document.createElement("div");
//       card.classList.add("product-card");
  
//       const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
//       cardContent.innerHTML = `
//         <img src="${imagemSrc}" alt="Star Wars">
//         <h2>Star Wars</h2>
//         <p>Star Wars ${numero}</p>
//         <p class="price">R$ 1,00</p>
//         <button type="button" class="btn-buy"><a href='Carrinho.php?operacao=incluir&id_produto=SW${numero}&qntd=1'>Comprar</a></button>
//       `;
  
//       card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
//       container.appendChild(card);
//     }
//   }
  
  
//   // Função para criar cards de adesivos Van Gogh
//   function criarCardsVanGogh() {
//     const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
//     for (let i = 1; i <= 40; i++) {
//       const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
//       const imagemSrc = `../Produtos_E-commerce/Van Gogh/VG${numero}.png`;
  
//       const card = document.createElement("div");
//       card.classList.add("product-card");
  
//       const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
//       cardContent.innerHTML = `
//         <img src="${imagemSrc}" alt="Van Gogh">
//         <h2>Van Gogh</h2>
//         <p>Van Gogh ${numero}</p>
//         <p class="price">R$ 1,00</p>
//         <button type="button" class="btn-buy"><a href='Carrinho.php?operacao=incluir&id_produto=VG${numero}&qntd=1'>Comprar</a></button>
//       `;
  
//       card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
//       container.appendChild(card);
//     }
//   }
  
//   // Função para criar cards de adesivos para o Resto em ordem alfabética
//   function criarCardsHarryPotter() {
//     const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
//     for (let i = 1; i <= 50; i++) {
//       const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
//       const imagemSrc = `../Produtos_E-commerce/Harry Potter/HP${numero}.png`;
  
//       const card = document.createElement("div");
//       card.classList.add("product-card");
  
//       const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
//       cardContent.innerHTML = `
//         <img src="${imagemSrc}" alt="Harry Potter">
//         <h2>Harry Potter</h2>
//         <p>Harry Potter ${numero}</p>
//         <p class="price">R$ 1,00</p>
//         <button type="button" class="btn-buy"><a href='Carrinho.php?operacao=incluir&id_produto=HP${numero}&qntd=1'>Comprar</a></button>
//       `;
  
//       card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
// //       container.appendChild(card);
//     }  }
//         const checkbox_todos = document.getElementById('todos');
//         const checkbox_pokemons = document.getElementById('pokemons');
//         const checkbox_studio_ghibli = document.getElementById('studio_ghibli');
//         const checkbox_harry_potter = document.getElementById('harry_potter');

//         checkbox_cti.addEventListener('change', function() {
//             filterProducts();
//         });

//         checkbox_info.addEventListener('change', function() {
//             filterProducts();
//         });

//         checkbox_mec.addEventListener('change', function() {
//             filterProducts();
//         });
//         checkbox_eletro.addEventListener('change', function() {
//             filterProducts();
//         });

// function Buscar() {
//     const Todos = checkbox_todos.checked;
//     const Pokemons = checkbox_pokemons.checked;
//     const Studio_Ghibli = checkbox_studio_ghibli.checked;
//     const Harry_potter = checkbox_harry_potter.checked;

//   let exiteflitros = false;
//       if (Todos && categoria == 'Todos') {
//           showProduct = true;
//           hasFilters = true;
//       }

//       else if (Pokemons && categoria == 'Pokemons') {
//           showProduct = true;
//           hasFilters = true;
//       }

//       else if (Studio_Ghibli ) {
//           showProduct = true;
//           hasFilters = true;
//       }
//       else if (Harry_potter) {
//           showProduct = true;
//           hasFilters = true;
//       }

//       if (showProduct) {
//           product.style.display = 'block';
//       } else {
//           product.style.display = 'none';
//       }
//   };

  // Chama as funções para criar os cards de produtos quando a página é carregada
  // window.addEventListener("load", () => {
  //   criarCardsDemonSlayer();
  //   criarCardsPokemons();
  //   criarCardsStarWars();
  //   criarCardsStudioGhibli();
  //   criarCardsHarryPotter();
  //   criarCardsCapivaras();
  //   criarCardsVanGogh();
  // });
    var bar = Array();
    var barrios = document.getElementById("categorias");
    function categoria(valor){//Pega o valor do check

        if(document.getElementById(valor).checked == true){//Se ta ligado agrega o valor
            bar.push(valor);        
        }else{//Se desliga apaga o valor do array
            let index = bar.indexOf(valor);
        if (index !== -1) bar.splice(index, 1);
        }
    }

    function send(){
        var juntar = "";
        let cant = bar.length;
        //Criar um string com o dados do array
        for(i = 0; i < cant - 1; i++){
            juntar = juntar + bar[i] + "_";
        }

        //Deixa o ultimo elemento fora para evitar um _ demais ao final do String
        juntar = juntar + bar[cant -1];

        barrios.value = juntar;
        document.getElementById("filtro").submit();
    }
    