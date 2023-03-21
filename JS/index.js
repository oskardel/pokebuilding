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
const overlayButton = document.getElementById('overlay');
const pokemonCardDiv = document.getElementById('pokemon-card');
const pokemonBlockCards = document.querySelectorAll('.pokemon-block');

var nameFilter = false;
var typeFilter = false;
var genFilter =  false;

const typeColours = {
	normal: '#A8A77A',
	fire: '#EE8130',
	water: '#6390F0',
	electric: '#F7D02C',
	grass: '#7AC74C',
	ice: '#96D9D6',
	fighting: '#C22E28',
	poison: '#A33EA1',
	ground: '#E2BF65',
	flying: '#A98FF3',
	psychic: '#F95587',
	bug: '#A6B91A',
	rock: '#B6A136',
	ghost: '#735797',
	dragon: '#6F35FC',
	dark: '#705746',
	steel: '#B7B7CE',
	fairy: '#D685AD',
};


/* ADDING ALL POKEMON */
const fetchAllPokemon = async() => {
    for(let i = 1; i <= 1008; i++){
        await loadPokemonInfo(i);
    }
    listenerCard();
}

const loadPokemonInfo = async(id) => {
    const rest = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await rest.json();
    createPokemonCard(data);
}

function createPokemonCard(pokemon) {
    const card = document.createElement('div');
    card.classList.add('pokemon-block');
    card.style.display = "flex";

    const spriteContainer = document.createElement('div');
    spriteContainer.classList.add('img-container');

    const sprite = document.createElement('img');
    sprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemon.id}.png`;
    // CHANGE SRC OF IMAGE TO ADD SHINY IMG
    // const shinySprite = document.createElement('img');
    // shinySprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/${pokemon.id}.png`;

    spriteContainer.appendChild(sprite);

    const pokemonId = document.createElement('p');
    pokemonId.classList.add('pokemon-id');
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
    name.textContent = pokemon.species.name.charAt(0).toUpperCase() + pokemon.species.name.slice(1);
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
function trimZeros(num){ //Shiny id function
    let newNumber = parseInt(num, 10);
    return newNumber;
}

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
            card.style.display = "flex";
        }
    })
})

/* ADD POKEMON CARD ATTRIBUTES */
const pokemonCardName = document.querySelector('.pokemon-card-name');
const pokemonCardId = document.querySelector('.pokemon-card-id');
const pokemonCardGeneration = document.querySelector('.pokemon-card-genera');
const pokemonCardHeight = document.querySelector('.height-info');
const pokemonCardWeight = document.querySelector('.weight-info');
const pokedexEntry = document.querySelector('.pokedex-entry-info');
const pokemonAbilityName1 = document.querySelector('.ability-1-name');
const pokemonAbilityName2 = document.querySelector('.ability-2-name');
const pokemonAbility1 = document.querySelector('.ability-1-info');
const pokemonAbility2 = document.querySelector('.ability-2-info');
const pokemonAbility2Div = document.querySelector('.ability-2');
const pokemonForms = document.getElementById('pokemon-forms');
const pokemonSprite = document.getElementById('default-sprite');
const movesTable = document.getElementById('moves-table');
const pokemonType1 = document.querySelector('.card-type-1');
const pokemonType2 = document.querySelector('.card-type-2');


function getGenrationPokemon(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`)
    .then(response => response.json())
    .then(data => {
        let genVal = data.generation.name;
        let genValAfter = genVal.slice(genVal.indexOf('-') +1).toUpperCase();
        pokemonCardGeneration.innerHTML = "Generation " + genValAfter;
    })
}

function getAttributesPokemon(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then(response => response.json())
    .then(data => {
        let pokemonHeight = data.height.toString();
        var decimalCommaHeight = pokemonHeight.length - 1;
        let pokemonWeight = data.weight.toString();
        var decimalCommaWeight = pokemonWeight.length - 1;

        if(data.height < 10){
            pokemonCardHeight.innerHTML = "0,"+pokemonHeight+" m";
        } else{
            let pokemonHeightDecimal =  pokemonHeight.slice(0, decimalCommaHeight) + "," + pokemonHeight.slice(decimalCommaHeight);
            pokemonCardHeight.innerHTML = pokemonHeightDecimal + " m";
        }

        if(data.weight < 10){
            pokemonCardWeight.innerHTML = "0,"+pokemonWeight+" kg";
        } else{
            let pokemonWeightDecimal =  pokemonWeight.slice(0, decimalCommaWeight) + "," + pokemonWeight.slice(decimalCommaWeight);
            pokemonCardWeight.innerHTML = pokemonWeightDecimal + " kg";
        }
    })
}

function getPokedexEntry(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`)
    .then(response => response.json())
    .then(data => {
        let flavor_text;
        if(data.flavor_text_entries.length !== 0){
            for(var i = 0; i <= 10; i++){
                if(data.flavor_text_entries[i].language.name == "en"){
                    flavor_text = data.flavor_text_entries[i].flavor_text;
                    pokedexEntry.innerHTML = flavor_text;
                    return;
                }
            }
        } else{
            flavor_text = "This Pokémon has no information.";
            pokedexEntry.innerHTML = flavor_text;
        }
    })
}

function getPokemonAbility(id) { //This function will only get the ability name (not the description)
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then(response => response.json())
    .then(data => {
        getAbilityInfo1(data.abilities[0].ability.name);
        pokemonAbilityName1.innerHTML = (data.abilities[0].ability.name).charAt(0).toUpperCase() + (data.abilities[0].ability.name).slice(1);
        if(data.abilities.length > 1){
            getAbilityInfo2(data.abilities[1].ability.name);
            pokemonAbilityName2.innerHTML = (data.abilities[1].ability.name).charAt(0).toUpperCase() + (data.abilities[1].ability.name).slice(1);
            pokemonAbility2Div.style.display = "block";
        } else{
            pokemonAbility2Div.style.display = "none";
        }
    })
}

function getAbilityInfo1(ability) {
    fetch(`https://pokeapi.co/api/v2/ability/${ability}`)
    .then(response => response.json())
    .then(data => {
        if(data.effect_entries.length >= 1){
            for(var i = 0; i <= data.effect_entries.length; i++){
                if(data.effect_entries[i].language.name == "en"){
                    pokemonAbility1.innerHTML = data.effect_entries[i].short_effect;
                    return;
                }
            }
        } else{
            pokemonAbility1.innerHTML = "No effect data";
        }
    })
}

function getAbilityInfo2(ability) {
    fetch(`https://pokeapi.co/api/v2/ability/${ability}`)
    .then(response => response.json())
    .then(data => {
        if(data.effect_entries.length > 1){
            for(var i = 0; i <= data.effect_entries.length; i++){
                if(data.effect_entries[i].language.name == "en"){
                    pokemonAbility2.innerHTML = data.effect_entries[i].short_effect;
                    return;
                }
            }
        } else{
            pokemonAbility2.innerHTML = "No effect data";
        }
    })
}

function getPokemonForms(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`)
    .then(response => response.json())
    .then(data => {
        pokemonForms.options.length = 0;
        for(let i = 0; i < data.varieties.length; i++){
            var newForm = document.createElement('option');
            newForm.value = data.varieties[i].pokemon.name;
            if(i == 0){
                newForm.innerHTML = "Default";
            } else{
                newForm.innerHTML = (data.varieties[i].pokemon.name.split('-')[1]).charAt(0).toUpperCase() + (data.varieties[i].pokemon.name.split('-')[1]).slice(1);
            }
            pokemonForms.appendChild(newForm);
        }
        var shinyForm = document.createElement('option');
        shinyForm.value = "shiny";
        shinyForm.innerHTML = "Shiny";
        pokemonForms.appendChild(shinyForm);
    })
}

function getPokemonStats(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then(response => response.json())
    .then(data => {
        const statsArray = document.querySelectorAll('.stat');
        const progressArray = document.querySelectorAll('.progress');
        
        for(var i = 0; i < data.stats.length; i++){
            statsArray[i].innerHTML = data.stats[i].base_stat;
            progressArray[i].style.width = data.stats[i].base_stat+"px";
        }
    })
}

function getPokemonMoves(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then(response => response.json())
    .then(data => {
        movesTable.innerHTML = "";
        // The moveset header is created
        const headerTable = document.createElement('thead');
        const headerTR = document.createElement('tr');
        const nameHeader = document.createElement('th');
        nameHeader.innerHTML = "Name";
        const typeHeader = document.createElement('th');
        typeHeader.innerHTML = "Type";
        const categoryHeader = document.createElement('th');
        categoryHeader.innerHTML = "Cat.";
        const powerHeader = document.createElement('th');
        powerHeader.innerHTML = "Power";
        const accurancyHeader = document.createElement('th');
        accurancyHeader.innerHTML = "Acc.";
        const ppHeader = document.createElement('th');
        ppHeader.innerHTML = "PP";
        headerTR.appendChild(nameHeader);
        headerTR.appendChild(typeHeader);
        headerTR.appendChild(categoryHeader);
        headerTR.appendChild(powerHeader);
        headerTR.appendChild(accurancyHeader);
        headerTR.appendChild(ppHeader);
        headerTable.appendChild(headerTR);
        movesTable.appendChild(headerTable);

        for(var i = 0; i < data.moves.length; i++){
            createMove(data.moves[i].move.name);
        }
    })
}

function createMove(move) {
    fetch(`https://pokeapi.co/api/v2/move/${move}`)
    .then(response => response.json())
    .then(move => {
        const newMove = document.createElement('tr');
        const nameMove = document.createElement('td');
        nameMove.innerHTML = move.name.charAt(0).toUpperCase() + move.name.slice(1);
        const typeMove = document.createElement('td');
        typeMove.innerHTML = move.type.name.charAt(0).toUpperCase() + move.type.name.slice(1);
        const categoryMove = document.createElement('td');
        if(move.damage_class.name === "physical"){
            categoryMove.innerHTML = "Phs.";
        } else{
            if(move.damage_class.name === "special"){
                categoryMove.innerHTML = "Sp."; 
            } else{
                categoryMove.innerHTML = "St."
            }
        }
        const powerMove = document.createElement('td');
        if(move.power === null){
            powerMove.innerHTML = "-";
        } else{
            powerMove.innerHTML = move.power;
        }
        const accuracyMove = document.createElement('td');
        if(move.accuracy === null){
            accuracyMove.innerHTML = "-";
        } else{
            accuracyMove.innerHTML = move.accuracy;
        }
        const ppMove = document.createElement('td');
        if(move.accurancy === null){
            ppMove.innerHTML = "-";
        } else{
            ppMove.innerHTML = move.pp;
        }
        newMove.appendChild(nameMove);
        newMove.appendChild(typeMove);
        newMove.appendChild(categoryMove);
        newMove.appendChild(powerMove);
        newMove.appendChild(accuracyMove);
        newMove.appendChild(ppMove);
        movesTable.appendChild(newMove);
    })
}

function getPokemonTypes(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then(response => response.json())
    .then(data => {
        pokemonType1.innerHTML = "";
        pokemonType2.innerHTML = "";
        pokemonType1.innerHTML = (data.types[0].type.name).toUpperCase();
        let color1 = data.types[0].type.name;
        pokemonType1.style.backgroundColor = typeColours[color1];
        if(data.types.length > 1){
            pokemonType2.innerHTML = (data.types[1].type.name).toUpperCase();
            let color2 = data.types[1].type.name;
            pokemonType2.style.backgroundColor = typeColours[color2];
        }
    })
}

/* ADEMÁS, AÑADIR MENÚ DE FORMAS (POR EJEMPLO FORMAS DEOXYS) */
function listenerCard(){
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    pokemonCards.forEach(card => {
        card.addEventListener('click', (e) =>{
            let pokemonId = trimZeros(card.querySelector('.pokemon-id').innerHTML);
            pokemonSprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemonId}.png`;//show the default sprite
            pokemonCardName.innerHTML = card.querySelector('.name').innerHTML; //pokemon card name
            pokemonCardId.innerHTML = card.querySelector('.pokemon-id').innerHTML; //pokemon card id
            getGenrationPokemon(pokemonId); //pokemon card generation
            getAttributesPokemon(pokemonId); //pokemon card weight & height
            getPokedexEntry(pokemonId); //card pokdex entry
            getPokemonAbility(pokemonId); //changes the ability and ability information
            getPokemonForms(pokemonId); //all the pokemon forms are created
            getPokemonStats(pokemonId); //puts all the base stats on the card (not counting other forms of the same pokemon)
            getPokemonMoves(pokemonId); //creates a table with all the moves the pokmeon learns
            getPokemonTypes(pokemonId); //changes the starting type
            
            pokemonCardDiv.classList.add('active');
            overlayButton.classList.add('active');
            pokemonCardDiv.style.display = "block";
            overlayButton.style.display = "block";

            changeForms(pokemonId);
        })
    })
}

function changeForms(id) { /* FINISH FUNCTION (WHEN FORM CHANGE, CHANGE SPRITE, NAME AND STATS) */
    pokemonForms.addEventListener('change', (e) => {
        
    })
}

// SHOW OR HIDE POKEMON CARD INFO
overlayButton.addEventListener('click', (e) => {
    if(overlayButton.classList.contains('active')){
        overlayButton.classList.remove('active');
        pokemonCardDiv.classList.remove('active');
    }
})

/* LOADING FOR THE FIRST TIME */
fetchAllPokemon();
fetchAllTypes();
fetchAllGenerations();