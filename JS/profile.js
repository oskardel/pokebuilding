/* VARIABLES */
const teamImages = document.querySelectorAll('.team-pokemon-img');
const pokemonNames = document.querySelectorAll('.team-pokemon-name');
const editButton = document.querySelectorAll('.edit-team');

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

editButton.forEach(button => {
    button.addEventListener('click', () => {
        var divTeam = button.parentElement.querySelectorAll('.team-pokemon-name');
        var divName = button.parentElement.querySelector('.team-name').innerHTML;
        var idTeam = document.querySelector('.team-id');
        var pokemonHREF = "?";
        for(let i = 0; i < 6; i++) {
            if(divTeam[i].innerHTML !== "") {
                if(i === 0){
                    pokemonHREF += "p" +(i+1)+ "=" + divTeam[i].innerHTML.toLowerCase().replace(" ", "-");
                } else{
                    pokemonHREF += "&p" +(i+1)+ "=" + divTeam[i].innerHTML.toLowerCase().replace(" ", "-");
                }
            }
        }
        window.location.href = "createTeams.php" + pokemonHREF + "&n=" + divName + "&id="+ idTeam.innerHTML +"&edit=false";
    })
})

/* LOAD FOR THE FIRST TIME */
getPokemonName();