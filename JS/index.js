//https://pokeapi.co

function fetchAllPokemon() {
    fetch('https://pokeapi.co/api/v2/pokemon?limit=1015&offset=0')
    .then(response => response.json())
    .then(data => {
        console.log(data)
    })
}

fetchAllPokemon();