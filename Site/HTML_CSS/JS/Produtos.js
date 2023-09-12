// Função para criar cards de adesivos Studio Ghibli
function criarCardsStudioGhibli() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 50; i++) {
      const numero = i < 10 ? `0${i}` : `${i}`;
      const imagemSrc = `../Produtos E-commerce/Studio Ghibli/SG${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      card.innerHTML = `
        <img src="${imagemSrc}" alt="Studio Ghibli">
        <h2>Studio Ghibli</h2>
        <p>Studio Ghibli<br>${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="submit" class="btn-buy">Comprar</button>
      `;
  
      container.appendChild(card);
    }
  }
  
  // Função para criar cards de adesivos Demon Slayer
  function criarCardsDemonSlayer() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 49; i++) {
      const numero = i < 10 ? `0${i}` : `${i}`;
      const imagemSrc = `../Produtos E-commerce/Demon Slayer/DS${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      card.innerHTML = `
        <img src="${imagemSrc}" alt="Demon Slayer">
        <h2>Demon Slayer</h2>
        <p>Demon Slayer<br>${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="submit" class="btn-buy">Comprar</button>
      `;
  
      container.appendChild(card);
    }
  }
  
  // Função para criar cards de adesivos Capivaras
  function criarCardsCapivaras() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 50; i++) {
      const numero = i < 10 ? `0${i}` : `${i}`;
      const imagemSrc = `../Produtos E-commerce/Capivaras/CP${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      card.innerHTML = `
        <img src="${imagemSrc}" alt="Capivaras">
        <h2>Capivaras</h2>
        <p>Capivaras<br>${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="submit" class="btn-buy">Comprar</button>
      `;
  
      container.appendChild(card);
    }
  }
  
  // Função para criar cards de adesivos Pokemons
  function criarCardsPokemons() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 50; i++) {
      const numero = i < 10 ? `0${i}` : `${i}`;
      const imagemSrc = `../Produtos E-commerce/Pokemons/PK${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      card.innerHTML = `
        <img src="${imagemSrc}" alt="Pokemons">
        <h2>Pokemons</h2>
        <p>Pokemons<br>${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="submit" class="btn-buy">Comprar</button>
      `;
  
      container.appendChild(card);
    }
  }
  
  // Função para criar cards de adesivos Star Wars
  function criarCardsStarWars() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 48; i++) {
      const numero = i < 10 ? `0${i}` : `${i}`;
      const imagemSrc = `../Produtos E-commerce/Star Wars/SW${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      card.innerHTML = `
        <img src="${imagemSrc}" alt="Star Wars">
        <h2>Star Wars</h2>
        <p>Star Wars<br>${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="submit" class="btn-buy">Comprar</button>
      `;
  
      container.appendChild(card);
    }
  }
  
  // Função para criar cards de adesivos Van Gogh
  function criarCardsVanGogh() {
    const container = document.querySelector(".container"); // Obtém o elemento onde os cards serão adicionados
  
    for (let i = 1; i <= 40; i++) {
      const numero = i < 10 ? `0${i}` : `${i}`;
      const imagemSrc = `../Produtos E-commerce/Van Gogh/VG${numero}.png`;
  
      const card = document.createElement("div");
      card.classList.add("product-card");
  
      card.innerHTML = `
        <img src="${imagemSrc}" alt="Van Gogh">
        <h2>Van Gogh</h2>
        <p>Van Gogh<br>${numero}</p>
        <p class="price">R$ 1,00</p>
        <button type="submit" class="btn-buy">Comprar</button>
      `;
  
      container.appendChild(card);
    }
  }
  
  // Função para criar cards de adesivos para o Resto em ordem alfabética
  function criarCardsResto() {
    // Adicione as funções para os outros tipos de adesivos aqui
  }
  
  // Chama as funções para criar os cards de produtos quando a página é carregada
  window.addEventListener("load", () => {
    criarCardsStudioGhibli();
    criarCardsDemonSlayer();
    criarCardsCapivaras();
    criarCardsPokemons();
    criarCardsStarWars();
    criarCardsVanGogh();
    criarCardsResto();
  });
  