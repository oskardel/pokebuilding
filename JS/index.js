//https://pokeapi.co

/* VARIABLES */
const pokedexContainer = document.getElementById('pokedex-container');
const typeSelector = document.getElementById('search-options-type');
const generationSelector = document.getElementById('search-options-generation');
const nameSelector = document.getElementById('search-options-name');
const legendaryValue = document.getElementById('legendary-checkbox');
const searchButton = document.getElementById('search-button');
const randomButton = document.getElementById('random-button');
const overlayButton = document.getElementById('overlay');
const pokemonCardDiv = document.getElementById('pokemon-card');
const pokemonBlockCards = document.querySelectorAll('.pokemon-block');
const pokemonItem = document.querySelectorAll('.pokemon-item');
const pokemonItemName = document.querySelectorAll('.pokemon-name');
const loader = document.getElementById('loader');
const overlayLoader = document.getElementById('loader-overlay');
const fetchCounter = document.querySelector('.pokemon-fetch');
const progressLaoder = document.querySelector('.loader-progress');
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
const addButton = document.querySelector('.add-button');
const pokemonTeamImg = document.querySelectorAll('.pokemon-img');
const pokemonTeamType = document.querySelectorAll('.pokemon-types');
const hiddenId = document.getElementById('hidden-id');
var cardHTML = "";

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
    for(let i = 1; i <= 915; i++){
        await loadPokemonInfo(i);
        fetchCounter.innerHTML = Math.floor((100*i)/1008)+"% Pokémon fetched";
        progressLaoder.style.width = Math.floor((100*i)/1008)+"%";
    }
    localStorage.setItem("pokemonCards", pokedexContainer.innerHTML);
    loader.classList.add('hidden');
    overlayLoader.classList.add('hidden');
    listenerCard();
    showImageHover();
}

const loadPokemonInfo = async(id) => {
    const rest = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const pokemon = await rest.json();

    var typeClass = "";
    var typeImage = "";

    for(let i = 0; i < pokemon.types.length; i++) {
        typeClass += pokemon.types[i].type.name;
        typeImage += `<img src="../img/pokemon_types/${pokemon.types[i].type.name}.ico">`
    }
    
    cardHTML = `<div class="pokemon-block" style="display:flex">
    <p class="pokemon-id" style="text-align:center;">${pokemon.id.toString().padStart(3, 0)}</p>
    <p class="name">${pokemon.species.name.toUpperCase()}</p>
    <div class="img-container">
        <img src="${pokemon.sprites.front_default}">
    </div>
    <div class="types ${typeClass}">${typeImage}</div>
    </div>`;

    fetchPokemonGeneration(pokemon.id);

    pokedexContainer.innerHTML += cardHTML;
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
    .then(type => {
        var newType = document.createElement('option');
        newType.value = type.name.charAt(0).toUpperCase() + type.name.slice(1);
        newType.innerHTML = type.name.charAt(0).toUpperCase() + type.name.slice(1);
        typeSelector.appendChild(newType);
    })
}


/* ADDING ALL GENERATIONS*/
function fetchPokemonGeneration(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`)
    .then(response => response.json())
    .then(data => {
        const pokemonClass = pokedexContainer.children[id - 1];
        pokemonClass.classList.add(data.generation.name);
        if(data.is_legendary == true || data.is_mythical == true){
            pokemonClass.classList.add("legendary");
        }
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
    .then(gen => {
        if(gen.id === 9){
            var newGeneration = document.createElement('option');
            newGeneration.value = "Generation-ix";
            newGeneration.innerHTML = "Paldea";
            generationSelector.appendChild(newGeneration);
        }else{
            var newGeneration = document.createElement('option');
            newGeneration.value = gen.name.charAt(0).toUpperCase() + gen.name.slice(1);
            newGeneration.innerHTML = gen.main_region.name.charAt(0).toUpperCase() + gen.main_region.name.slice(1);
            generationSelector.appendChild(newGeneration);
        }
    })
}

/* APPLY ALL THE FILTERS*/
function trimZeros(num) {
    let newNumber = parseInt(num, 10);
    return newNumber;
}

searchButton.addEventListener('click', (e) => {
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    pokemonCards.forEach(card => {
        let isCardVisible = true;

        if(typeSelector.value !== "all"){
            if(!card.querySelector('.types').classList.contains(typeSelector.value.toLowerCase())){
                isCardVisible = false;
            }
        } 
        if(nameSelector.value !== ""){
            if(!card.querySelector('.name').innerHTML.toLowerCase().includes(nameSelector.value.toLowerCase().replace(/ /g,''))){
                isCardVisible = false;
            }
        }
        if(generationSelector.value !== "all"){
            if(!card.classList.contains(generationSelector.value.toLowerCase())){
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
function getGenrationPokemon(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`)
    .then(response => response.json())
    .then(data => {
        pokemonForms.options.length = 0;
        if(data.varieties.length <= 1) {
            pokemonForms.style.display = "none";
        } else{
            pokemonForms.style.display = "flex";
            for(let i = 0; i < data.varieties.length; i++){
                var newForm = document.createElement('option');
                newForm.value = data.varieties[i].pokemon.name;
                if(i == 0){
                    newForm.innerHTML = "Default";
                } else{
                    newForm.innerHTML = (data.varieties[i].pokemon.name.split('-')[1]).charAt(0).toUpperCase() + (data.varieties[i].pokemon.name).substring((data.varieties[i].pokemon.name).indexOf('-') + 1).slice(1);
                }
                pokemonForms.appendChild(newForm);
            }
        }

        let genVal = data.generation.name;
        let genValAfter = genVal.slice(genVal.indexOf('-') +1).toUpperCase();
        pokemonCardGeneration.innerHTML = "Generation " + genValAfter;

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

function getAttributesPokemon(id) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then(response => response.json())
    .then(data => {
        pokemonType1.innerHTML = (data.types[0].type.name).toUpperCase();
        let color1 = data.types[0].type.name;
        pokemonType1.style.backgroundColor = typeColours[color1];
        if(data.types.length > 1){
            pokemonType2.style.display = "block";
            pokemonType2.innerHTML = (data.types[1].type.name).toUpperCase();
            let color2 = data.types[1].type.name;
            pokemonType2.style.backgroundColor = typeColours[color2];
        } else{
            pokemonType2.innerHTML = "";
            pokemonType2.style.display = "none";
        }

        const statsArray = document.querySelectorAll('.stat');
        const progressArray = document.querySelectorAll('.progress');
        
        for(var i = 0; i < data.stats.length; i++){
            statsArray[i].innerHTML = data.stats[i].base_stat;
            progressArray[i].style.width = data.stats[i].base_stat+"px";
        }

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

        getAbilityInfo(data.abilities[0].ability.name, pokemonAbility1);
        pokemonAbilityName1.innerHTML = (data.abilities[0].ability.name).charAt(0).toUpperCase() + (data.abilities[0].ability.name).slice(1);
        if(data.abilities.length > 1){
            getAbilityInfo(data.abilities[1].ability.name, pokemonAbility2);
            pokemonAbilityName2.innerHTML = (data.abilities[1].ability.name).charAt(0).toUpperCase() + (data.abilities[1].ability.name).slice(1);
            pokemonAbility2Div.style.display = "block";
        } else{
            pokemonAbility2Div.style.display = "none";
        }
    })
}

function getAbilityInfo(ability, index) {
    fetch(`https://pokeapi.co/api/v2/ability/${ability}`)
    .then(response => response.json())
    .then(data => {
        if(data.effect_entries.length >= 1){
            for(var i = 0; i <= data.effect_entries.length; i++){
                if(data.effect_entries[i].language.name == "en"){
                    index.innerHTML = data.effect_entries[i].short_effect;
                    return;
                }
            }
        } else{
            index.innerHTML = "No effect data";
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
            accuracyMove.innerHTML = move.accuracy+"%";
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

function listenerCard() {
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    pokemonCards.forEach(card => {
        card.addEventListener('click', () =>{
            var pokemonId = trimZeros(card.querySelector('.pokemon-id').innerHTML);
            pokemonSprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemonId}.png`;
            hiddenId.innerHTML = pokemonId;
            pokemonCardName.innerHTML = card.querySelector('.name').innerHTML;
            pokemonCardId.innerHTML = card.querySelector('.pokemon-id').innerHTML;
            getAttributesPokemon(pokemonId); //fetching from /pokemon-species API
            getGenrationPokemon(pokemonId); //fetching from /pokemon API
            getPokemonMoves(pokemonId); //creates a table with all the moves the pokmeon learns
            
            pokemonCardDiv.classList.add('active');
            overlayButton.classList.add('active');
            pokemonCardDiv.style.display = "block";
            overlayButton.style.display = "block";
        })
    })
}

/* EVENT LISTENER TO CHANGE FORMS OF THE POKEMON */
pokemonForms.addEventListener('change', () => {
    var pokemonId = hiddenId.innerHTML;
    if(pokemonForms.value === "shiny" || pokemonForms.value === pokemonForms.options[0].value){
        if(pokemonForms.value === "shiny"){
            pokemonSprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/${pokemonId}.png`;
        } else{
            pokemonSprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemonId}.png`;
        }
        getAttributesPokemon(pokemonId);
        getPokemonMoves(pokemonId);
        pokemonCardName.innerHTML = (pokemonForms.options[0].value.charAt(0).toUpperCase()) + (pokemonForms.options[0].value).slice(1);
    } else{
        getFormSprite(pokemonForms.value);
    }
})

function getFormSprite(namePokemon) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${namePokemon}`)
    .then(response => response.json())
    .then(data => {
        const formId = data.id;
        pokemonCardName.innerHTML = data.name;
        pokemonSprite.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${formId}.png`;
        if(data.moves.length > 1){
            getPokemonMoves(formId);
        }
        getAttributesPokemon(formId);
        pokemonCardName.innerHTML = ((pokemonForms.value.charAt(0).toUpperCase()) + (pokemonForms.value).slice(1));
    })
}

/* ADD POKEMON TO THE TEAM */
addButton.addEventListener('click', () => {
    var cardImage = document.getElementById('default-sprite').src;
    for(let i = 0; i < pokemonTeamImg.length; i++){
        if(pokemonTeamImg[i].classList.contains('nopokemon')){
            pokemonTeamImg[i].src = cardImage;
            pokemonTeamImg[i].classList.remove('nopokemon');
            pokemonItemName[i].innerHTML = pokemonCardName.innerHTML.charAt(0) + pokemonCardName.innerHTML.slice(1).toLowerCase();
            pokemonTeamType[i].querySelector('.pokemon-type-1').innerHTML = pokemonType1.innerHTML;
            if(pokemonType2.innerHTML != ""){
                pokemonTeamType[i].querySelector('.pokemon-type-2').innerHTML = pokemonType2.innerHTML;
            }
            overlayButton.classList.remove('active');
            pokemonCardDiv.classList.remove('active');
            pokemonSprite.src = "";
            return;
        }
    }
})

function getRandomPokemonName(id, index) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then(response => response.json())
    .then(data => {
        pokemonItemName[index].innerHTML = (data.name.charAt(0).toUpperCase()) + data.name.slice(1);
        pokemonTeamType[index].querySelector('.pokemon-type-1').innerHTML = data.types[0].type.name.toUpperCase();
        if(data.types.length > 1){
            pokemonTeamType[index].querySelector('.pokemon-type-2').innerHTML = data.types[1].type.name.toUpperCase();
        }
    })
}

/* FULL RANDOM TEAM */
randomButton.addEventListener('click', () => {
    for(var j = 0; j < 6; j++){
        pokemonTeamType[j].querySelector('.pokemon-type-1').innerHTML = "";
        pokemonTeamType[j].querySelector('.pokemon-type-2').innerHTML = "";
    }
    for(var i = 0; i < 6; i++){
        var randNumber = Math.floor(Math.random()*1008 +1);
        getRandomPokemonName(randNumber, i);
        pokemonTeamImg[i].src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${randNumber}.png`;
        pokemonTeamImg[i].classList.remove('nopokemon');
    }
})

/* REMOVE POKEMON FROM THE TEAM SELECTION */
pokemonItem.forEach(pokemon => {
    pokemon.addEventListener('click', () => {
        pokemon.querySelector('.pokemon-img').src = "../img/nopokemon.png";
        pokemon.querySelector('.pokemon-name').innerHTML = "";
        pokemon.querySelector('.pokemon-img').classList.add('nopokemon');
        pokemon.querySelector('.pokemon-type-1').innerHTML = "";
        pokemon.querySelector('.pokemon-type-2').innerHTML = "";
    })
})

// SHOW OR HIDE POKEMON CARD INFO
overlayButton.addEventListener('click', (e) => {
    if(overlayButton.classList.contains('active')){
        overlayButton.classList.remove('active');
        pokemonCardDiv.classList.remove('active');
        pokemonSprite.src = "";
    }
})

/* REDIRECTS YOU TO THE THE SAME PAGE (ADDS TO THE LINK THE POKEMON NAMES) */
const submitTeam = document.getElementById('save-team');
submitTeam.addEventListener('click', () => {
    var hrefName = "";
    var teamName = document.querySelector('.save-team-name').value;
    for(var i = 0; i < 6; i++) {
        if(!pokemonTeamImg[i].classList.contains('nopokemon')){
            if(hrefName != ""){
                hrefName += `&p`+(i+1)+`=`+(pokemonItemName[i].innerHTML).toLowerCase();
            } else{
                hrefName += `p`+(i+1)+`=`+(pokemonItemName[i].innerHTML).toLowerCase();
            }
        }
    }

    if(hrefName == ""){
        document.querySelector('.error-team-name').innerHTML = "Add at least one Pokémon";
    } else{
        const teamId = document.querySelector('.team-id');
        if(teamName === ""){
            document.querySelector('.error-team-name').innerHTML = "Team name cannot be blank";
        } else{
            if(window.location.href.indexOf("edit") > -1){ 
                window.location.href = 'createTeams.php?'+hrefName+'&n='+teamName+'&id='+teamId.innerHTML+'&edit=true';
            } else{
                window.location.href = `createTeams.php?${hrefName}&n=${teamName}`;
            }
        }
    }
})

function getSpriteEditTeam(namePokemon, imageSrc) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${namePokemon}`)
    .then(response => response.json())
    .then(data => {
        imageSrc.querySelector('.pokemon-img').src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${data.id}.png`;
        imageSrc.querySelector('.pokemon-img').classList.remove('nopokemon');
        const typesSelector = imageSrc.querySelector('.pokemon-types');
        typesSelector.querySelector('.pokemon-type-1').innerHTML = (data.types[0].type.name).toUpperCase();
        if(data.types.length > 1) {
            typesSelector.querySelector('.pokemon-type-2').innerHTML = (data.types[1].type.name).toUpperCase();
        }
    })
}

/* LOADING FOR THE FIRST TIME */
pokemonItem.forEach(name => {
    if(name.querySelector('.pokemon-name').innerHTML !== "") {
        var pokeNameHTML = (name.querySelector('.pokemon-name').innerHTML).toLowerCase().replace(" ", "-");
        getSpriteEditTeam(pokeNameHTML, name);
    }
})

function showImageHover() {
    const pokemonCards = document.querySelectorAll('.pokemon-block');
    const imageHover = document.querySelector('.pokemon-image-hover');
    pokemonCards.forEach(card => {
        card.addEventListener('mouseover', () => {
            if(card.querySelector('.pokemon-id').innerHTML > 905){
                imageHover.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${trimZeros(card.querySelector('.pokemon-id').innerHTML)}.png`;
            } else{
                imageHover.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/home/${trimZeros(card.querySelector('.pokemon-id').innerHTML)}.png`;
            }
        })
        card.addEventListener('mouseout', () => {
            imageHover.src = "";
        })
    })
}


var savedPokemonData = localStorage.getItem("pokemonCards");
fetchAllTypes();
fetchAllGenerations();

if(savedPokemonData) {
    pokedexContainer.innerHTML = savedPokemonData;
    loader.classList.add('hidden');
    overlayLoader.classList.add('hidden');
    listenerCard();
    showImageHover();
} else{
    fetchAllPokemon();
}