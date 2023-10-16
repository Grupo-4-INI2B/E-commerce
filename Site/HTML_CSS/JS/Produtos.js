// Função para criar cards de adesivos Studio Ghibli
function criarCardsStudioGhibli() {
  const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados

  for (let i = 1; i <= 50; i++) {
    const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
    const imagemSrc = `../Produtos_E-commerce/Studio_Ghibli/SG${numero}.png`;

    const card = document.createElement("div");
    card.classList.add("product-card");

    const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
    cardContent.innerHTML = `
      <img src="${imagemSrc}" alt="Studio Ghibli">
      <h2>Studio Ghibli</h2>
      <p>Studio Ghibli ${numero}</p>
      <p class="price">R$ 1,00</p>
      <button type="button" class="btn-buy">Comprar</button>
    `;

    card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
    container.appendChild(card);
  }
}

  
  // Função para criar cards de adesivos Demon Slayer
  function criarCardsDemonSlayer() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 49; i++) {
      const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
      const imagemSrc = `../Produtos_E-commerce/Demon Slayer/DS${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
      cardContent.innerHTML = `
        <img src="${imagemSrc}" alt="Demon Slayer">
        <h2>Demon Slayer</h2>
        <p>Demon Slayer ${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="button" class="btn-buy">Comprar</button>
      `;
  
      card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
      container.appendChild(card);
    }
  }
  
  
  // Função para criar cards de adesivos Capivaras
  function criarCardsCapivaras() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 50; i++) {
      const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
      const imagemSrc = `../Produtos_E-commerce/Capivaras/CP${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
      cardContent.innerHTML = `
        <img src="${imagemSrc}" alt="Capivara">
        <h2>Capivara</h2>
        <p>Capivara ${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="button" class="btn-buy">Comprar</button>
      `;
  
      card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
      container.appendChild(card);
    }
  }
  
  
  // Função para criar cards de adesivos Pokemons
  function criarCardsPokemons() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 50; i++) {
      const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
      const imagemSrc = `../Produtos_E-commerce/Pokemons/PK${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
      cardContent.innerHTML = `
        <img src="${imagemSrc}" alt="Pokemon">
        <h2>Pokemon</h2>
        <p>Pokemon ${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="button" class="btn-buy">Comprar</button>
      `;
  
      card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
      container.appendChild(card);
    }
  }
  
  
  // Função para criar cards de adesivos Star Wars
  function criarCardsStarWars() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 48; i++) {
      const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
      const imagemSrc = `../Produtos_E-commerce/Star Wars/SW${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
      cardContent.innerHTML = `
        <img src="${imagemSrc}" alt="Star Wars">
        <h2>Star Wars</h2>
        <p>Star Wars ${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="button" class="btn-buy">Comprar</button>
      `;
  
      card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
      container.appendChild(card);
    }
  }
  
  
  // Função para criar cards de adesivos Van Gogh
  function criarCardsVanGogh() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 40; i++) {
      const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
      const imagemSrc = `../Produtos_E-commerce/Van Gogh/VG${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
      cardContent.innerHTML = `
        <img src="${imagemSrc}" alt="Van Gogh">
        <h2>Van Gogh</h2>
        <p>Van Gogh ${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="button" class="btn-buy">Comprar</button>
      `;
  
      card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
      container.appendChild(card);
    }
  }
  
  // Função para criar cards de adesivos para o Resto em ordem alfabética
  function criarCardsHarryPotter() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 50; i++) {
      const numero = i.toString().padStart(2, '0'); // Use padStart para garantir que haja dois dígitos no número.
      const imagemSrc = `../Produtos_E-commerce/Harry Potter/HP${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      const cardContent = document.createElement("div"); // Crie um elemento para o conteúdo do cartão.
      cardContent.innerHTML = `
        <img src="${imagemSrc}" alt="Harry Potter">
        <h2>Harry Potter</h2>
        <p>Harry Potter ${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="button" class="btn-buy">Comprar</button>
      `;
  
      card.appendChild(cardContent); // Adicione o conteúdo ao cartão.
      container.appendChild(card);
    }  }
    function Buscar(){
      
    }
  
  // Chama as funções para criar os cards de produtos quando a página é carregada
  window.addEventListener("load", () => {
    criarCardsDemonSlayer();
    criarCardsPokemons();
    criarCardsStarWars();
    criarCardsStudioGhibli();
    criarCardsHarryPotter();
    criarCardsCapivaras();
    criarCardsVanGogh();
  });
  