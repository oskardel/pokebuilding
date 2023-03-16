//https://pokeapi.co

/* VARIABLES */
const pokedexContainer = document.getElementById('pokedex-container');
const typeSelector = document.getElementById('search-options-type');
const generationSelector = document.getElementById('search-options-generation');
const nameSelector = document.getElementById('search-options-name');
const typeValue = document.getElementById('search-options-type');
const genValue = document.getElementById('search-options-generation');
const legendaryValue = document.getElementById('legendary-checkbox');
const searchButton = document.getElementById('search-button');

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
    checkLegendaryStatus(pokemon.id);

    card.appendChild(spriteContainer);
    card.appendChild(pokemonId);
    card.appendChild(name);
    card.appendChild(types);

    pokedexContainer.appendChild(card);
}

function checkLegendaryStatus(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`)
    .then(response => response.json())
    .then(data => {
        const pokemonClass = pokedexContainer.children[id - 1];
        if(data.is_legendary == true || data.is_mythical == true){
            pokemonClass.classList.add("legendary");
        }
    })
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
    let varNeGeneration = gen.name.charAt(0).toUpperCase() + gen.name.slice(1);
    newGeneration.innerHTML = varNeGeneration.replace('-', ' ');
    generationSelector.appendChild(newGeneration);
}


/* APPLY ALL THE FILTERS*/
searchButton.addEventListener('click', (e) => {
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    pokemonCards.forEach(card => {
        let isCardVisible = true;

        if(typeValue.value !== "all"){
            if(!card.querySelector('.types').classList.contains(typeValue.value.toLowerCase())){
                isCardVisible = false;
            }
        } 
        if(nameSelector.value !== ""){
            if(!card.querySelector('.name').innerHTML.toLowerCase().includes(nameSelector.value.toLowerCase().replace(/ /g,''))){
                isCardVisible = false;
            }
        }
        if(genValue.value !== "all"){
            if(!card.classList.contains(genValue.value.toLowerCase())){
                isCardVisible = false;
            }
        }
        if(legendaryValue.checked){
            if(!card.classList.contains("legendary")){
                isCardVisible = false;
            }
        }

        if(!isCardVisible){
            card.style.display = "none";
        } else{
            card.style.display = "block";
        }
    })
})

/* LOADING FOR THE FIRST TIME */
fetchAllPokemon();
fetchAllTypes();
fetchAllGenerations();