//https://pokeapi.co

/* VARIABLES */
const pokedexContainer = document.getElementById('pokedex-container');
const typeSelector = document.getElementById('search-options-type');
const generationSelector = document.getElementById('search-options-generation');
const nameSelector = document.getElementById('search-options-name');
const typeValue = document.getElementById('search-options-type').value;
const genValue = document.getElementById('search-options-generation').value;

var nameFilter = false;
var typeFilter = false;
var genFilter =  false;


/* ADDING ALL POKEMON */
const fetchAllPokemon = async() => {
    for(let i = 1; i <= 1008; i++){
        await loadPokemonInfo(i);
    }
}

const loadPokemonInfo = async(id) => {
    const rest = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await rest.json();
    createPokemonCard(data);
}

function createPokemonCard(pokemon) {
    const card = document.createElement('div');
    card.classList.add('pokemon-block');
    card.style.display = "block";

    const spriteContainer = document.createElement('div');
    spriteContainer.classList.add('img-container');

    const sprite = document.createElement('img');
    sprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemon.id}.png`;

    spriteContainer.appendChild(sprite);

    const pokemonId = document.createElement('p');
    pokemonId.textContent = `${pokemon.id.toString().padStart(3, 0)}`;
    
    const types = document.createElement('div');
    types.classList.add('types');
    types.classList.add(`${pokemon.types[0].type.name}`);
    const imgType1 = document.createElement('img');
    imgType1.src = `../img/pokemon_types/${pokemon.types[0].type.name}.ico`;
    types.appendChild(imgType1);
    if(pokemon.types[1] != null){
        types.classList.add(`${pokemon.types[1].type.name}`);
        const imgType2 = document.createElement('img');
        imgType2.src = `../img/pokemon_types/${pokemon.types[1].type.name}.ico`;
        types.appendChild(imgType2);
    }

    const name = document.createElement('p');
    name.classList.add('name');
    name.textContent = pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1);
    fetchPokemonGeneration(pokemon.id);

    card.appendChild(spriteContainer);
    card.appendChild(pokemonId);
    card.appendChild(name);
    card.appendChild(types);

    pokedexContainer.appendChild(card);
}


/* ADDING ALL TYPES */
function fetchAllTypes() {
    for(let i = 1; i <= 18; i++){
        loadPokemonTypes(i);
    }
}

function loadPokemonTypes(id) {
    fetch(`https://pokeapi.co/api/v2/type/${id}`)
    .then(response => response.json())
    .then(data => {
        createTypeSelector(data);
    })
}

function createTypeSelector(type) {
    var newType = document.createElement('option');
    newType.value = type.name.charAt(0).toUpperCase() + type.name.slice(1);
    newType.innerHTML = type.name.charAt(0).toUpperCase() + type.name.slice(1);
    typeSelector.appendChild(newType);
}


/* ADDING ALL GENERATIONS*/
function fetchPokemonGeneration(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`)
    .then(response => response.json())
    .then(data => {
        const pokemonClass = pokedexContainer.children[id - 1];
        pokemonClass.classList.add(data.generation.name);
    })
}

function fetchAllGenerations() {
    for(let i = 1; i <= 9; i++){
        loadPokemonGenerations(i);
    }
}

function loadPokemonGenerations(id) {
    fetch(`https://pokeapi.co/api/v2/generation/${id}`)
    .then(response => response.json())
    .then(data => {
        createGenerationSelector(data);
    })
}

function createGenerationSelector(gen) {
    var newGeneration = document.createElement('option');
    newGeneration.value = gen.name.charAt(0).toUpperCase() + gen.name.slice(1);
    newGeneration.innerHTML = gen.name.charAt(0).toUpperCase() + gen.name.slice(1);
    generationSelector.appendChild(newGeneration);
}


/* APPLY ALL THE FILTERS*/
// ALL THREE FILTERS NEED TO WORK TOGETHER (BE ABLE TO HIDE AND SHOW CARDS)
nameSelector.addEventListener('input', (e) =>{
    const pokemonSearchName = e.target.value.toLowerCase().replace(/ /g,'');
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    pokemonCards.forEach(card =>{
        if(pokemonSearchName != ""){
            if(card.querySelector('.name').innerHTML.toLowerCase().includes(pokemonSearchName)) {
                if(typeFilter || genFilter){ //Si hay un filtro activado
                    if(typeFilter){ //Si es el de tipos
                        if(card.classList.contains('typefilter')){ //Si la carta tiene la clase de tipos activala
                            card.style.display = "block";
                            card.classList.add('namefilter');
                            nameFilter = true;
                        } else{ //Si no la tiene no la actives
                            card.style.display = "none";
                        }
                    } 
                    if(genFilter) { 
                        if(card.classList.contains('genfilter')){ //Si la carta tiene la clase de generaciones activala
                            card.style.display = "block";
                            card.classList.add('namefilter');
                            nameFilter = true;
                        } else{ //Si no la tiene no la actives
                            card.style.display = "none";
                        }
                    }    
                } else{ //Si no tiene filtros, activa la carta directamente
                    card.style.display = "block";
                    card.classList.add('namefilter');
                    nameFilter = true;
                }
            } else{ //Si no coincide con el nombre, no actives la carta
                card.style.display = "none";
                card.classList.remove('namefilter');
            }
        } else{ //Si no hay nombre, activa todas las cartas
            card.style.display = "block";
            card.classList.remove('namefilter');
            nameFilter = false;
        }
    });
})

typeSelector.addEventListener('input', (e) => {
    const typeChanged = e.target.value;
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    pokemonCards.forEach(card =>{
        if(typeChanged.toLowerCase() != "all"){
            if(card.querySelector('.types').classList.contains(typeChanged.toLowerCase())){
                if(nameFilter || genFilter){ //Si hay un filtro activado
                    if(nameFilter){ //Si es el de nombre
                        if(card.classList.contains('namefilter')){ //Si la carta tiene la clase de tipos activala
                            card.style.display = "block";
                            card.classList.add('typefilter');
                            typeFilter = true;
                        } else{ //Si no la tiene no la actives
                            card.style.display = "none";
                        }
                    } 
                    if(genFilter){ 
                        if(card.classList.contains('genfilter')){ //Si la carta tiene la clase de generaciones activala
                            card.style.display = "block";
                            card.classList.add('typefilter');
                            typeFilter = true;
                        } else{ //Si no la tiene no la actives
                            card.style.display = "none";
                        }
                    }    
                } else{ //Si no tiene filtros, activa la carta directamente
                    card.style.display = "block";
                    card.classList.add('typefilter');
                    typeFilter = true;
                }
            } else{ //Si no coincide con el nombre, no actives la carta
                card.style.display = "none";
                card.classList.remove('typefilter');
                
            }
        } else{ //Si no hay nombre, activa todas las cartas
            card.style.display = "block";
            card.classList.remove('typefilter');
            typeFilter = false;
        }
    });
})

generationSelector.addEventListener('input', (e) => {
    const genChanged = e.target.value;
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    pokemonCards.forEach(card =>{
        if(genChanged.toLowerCase() != "all"){
            if(card.classList.contains(genChanged.toLowerCase())){
                if(nameFilter || typeFilter){ //Si hay un filtro activado
                    if(nameFilter){ //Si es el de nombre
                        if(card.classList.contains('namefilter')){ //Si la carta tiene la clase de tipos activala
                            card.style.display = "block";
                            card.classList.add('genfilter');
                            genFilter = true;
                        } else{ //Si no la tiene no la actives
                            card.style.display = "none";
                        }
                    } 
                    if(typeFilter){ 
                        if(card.classList.contains('typefilter')){ //Si la carta tiene la clase de generaciones activala
                            card.style.display = "block";
                            card.classList.add('genfilter');
                            genFilter = true;
                        } else{ //Si no la tiene no la actives
                            card.style.display = "none";
                        }
                    }    
                } else{ //Si no tiene filtros, activa la carta directamente
                    card.style.display = "block";
                    card.classList.add('genfilter');
                    genFilter = true;
                }
            } else{ //Si no coincide con el nombre, no actives la carta
                card.style.display = "none";
                card.classList.remove('genfilter');
                
            }
        } else{ //Si no hay nombre, activa todas las cartas
            card.style.display = "block";
            card.classList.remove('genfilter');
            genFilter = false;
        }
    });
})

//FALLA AL CAMBIAR DE GENERACIÓN (CUANDO YA HAY TIPO SELECCIONADO)


/* LOADING FOR THE FIRST TIME */
fetchAllPokemon();
fetchAllTypes();
fetchAllGenerations();