const teamItem = document.querySelectorAll('.team-item');
const recentButton = document.getElementById('recent-button');
const likedButton = document.getElementById('liked-button');
const pokemonArray = document.querySelectorAll('.team-pokemon-name');
const pokemonItem = document.querySelectorAll('.team-pokemon');
const overlayButton = document.querySelector('.overlay');
const deleteBox = document.querySelector('.delete-box');
const yesButton = document.getElementById('yes-button');
const noButton = document.getElementById('no-button');

function addVote(teamId, userId) {    
    window.location.href = "rankings.php?t="+teamId+"&v="+userId;
}

function sureDelete(teamDelete) {
    overlayButton.classList.add('active');
    deleteBox.classList.add('active');

    yesButton.addEventListener('click', (e)=> {
        window.location.href = "rankings.php?del=true&teamdel="+teamDelete;
    })
}

noButton.addEventListener('click', (e)=> {
    overlayButton.classList.remove('active');
    deleteBox.classList.remove('active');
})

overlayButton.addEventListener('click', (e) => {
    if(overlayButton.classList.contains('active')){
        overlayButton.classList.remove('active');
        deleteBox.classList.remove('active');
    }
})

recentButton.addEventListener('click', () => {
    window.location.href = "rankings.php?range="+recentButton.value;
})

likedButton.addEventListener('click', () => {
    window.location.href = "rankings.php?range="+likedButton.value;
})

const inputImagePokemon = async(pokemon, index) => {
    const rest = await fetch(`https://pokeapi.co/api/v2/pokemon/${(pokemon)}`);
    const data = await rest.json();
    
    const pokeImage = document.createElement('img');
    pokeImage.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${data.id}.png`;
    pokemonItem[index].appendChild(pokeImage);
    //INPUT IMAGE HERE
}

const loadPokemonImages = async() => {
    for(var i = 0; i < pokemonArray.length; i++) {
        await inputImagePokemon((pokemonArray[i].innerHTML).toLowerCase(), i);
    }
}

loadPokemonImages();