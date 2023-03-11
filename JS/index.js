<<<<<<< HEAD
//https://pokeapi.co

function fetchAllPokemon() {
    fetch('https://pokeapi.co/api/v2/pokemon?limit=1015&offset=0')
    .then(response => response.json())
    .then(data => {
        console.log(data)
    })
}

=======
//https://pokeapi.co

function fetchAllPokemon() {
    fetch('https://pokeapi.co/api/v2/pokemon?limit=1015&offset=0')
    .then(response => response.json())
    .then(data => {
        console.log(data)
    })
}

>>>>>>> 45b2088d5e796fb12b4739d81ead5e1bcc5a4347
fetchAllPokemon();