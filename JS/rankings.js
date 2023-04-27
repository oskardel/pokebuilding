const teamItem = document.querySelectorAll('.team-item');
const recentButton = document.getElementById('recent-button');
const likedButton = document.getElementById('liked-button');
const pokemonArray = document.querySelectorAll('.team-pokemon-name');

function addVote(teamId, userId) {    
    window.location.href = "rankings.php?t="+teamId+"&v="+userId;
}

recentButton.addEventListener('click', () => {
    window.location.href = "rankings.php?range="+recentButton.value;
})

likedButton.addEventListener('click', () => {
    window.location.href = "rankings.php?range="+likedButton.value;
})

function inputImagePokemon(pokemon) { //AWAIT
    fetch(`https://pokeapi.co/api/v2/pokemon/${(pokemon)}`)
    .then(res => res.json())
    .then(data => {
        console.log(data.name); //INPUT IMAGE HERE
    })
}

for(var i = 0; i <= pokemonArray.length; i++) {
    inputImagePokemon((pokemonArray[i].innerHTML).toLowerCase());
}