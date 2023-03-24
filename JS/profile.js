/* VARIABLES */
const teamImages = document.querySelectorAll('.team-pokemon-img');
const pokemonNames = document.querySelectorAll('.team-pokemon-name');

function getPokemonName() {
    for(var i = 0; i <=pokemonNames.length; i++){
        if(pokemonNames[i].innerHTML === ""){
            // teamImages[i].src = "../img/nopokemon.png";
        } else{
            getTeamImages((pokemonNames[i].innerHTML).replace(" ", "-"), i);
        }
    }
}

function getTeamImages(name, index) {
    fetch(`https://pokeapi.co/api/v2/pokemon/${name}`)
    .then(response => response.json())
    .then(data => {
        if(data.id < 650) {
            teamImages[index].src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/${data.id}.gif`;
        } else{
            teamImages[index].src = data.sprites.front_default;
        }
    })
}

/* LOAD FOR THE FIRST TIME */
getPokemonName();