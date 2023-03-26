/* VARIABLES */
const teamImages = document.querySelectorAll('.team-pokemon-img');
const pokemonNames = document.querySelectorAll('.team-pokemon-name');

function getPokemonName() {
    for(var i = 0; i <=pokemonNames.length; i++){
        if(pokemonNames[i].innerHTML === ""){
            // teamImages[i].src = "../img/nopokemon.png";
        } else{
            getTeamImages((pokemonNames[i].innerHTML).toLowerCase().replace(" ", "-"), i);
        }
    }
}

function getTeamImages(name, index) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${name}`)
    .then(response => response.json())
    .then(data => {
        teamImages[index].src = data.sprites.front_default;
    })
}

function editTeam() {
    
}

/* LOAD FOR THE FIRST TIME */
getPokemonName();