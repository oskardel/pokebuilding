//https://pycosites.com/pkmn/stat.php

const statResults = document.getElementById('stat-results');
const pokemonStat = document.getElementById('select-pokemon');
const natureStat = document.getElementById('select-nature');
const levelStat = document.getElementById('level-pokemon');
const EVSelector = document.querySelectorAll('.ev-selector');
const IVSelector = document.querySelectorAll('.iv-selector');

function checkFields() {
    if(pokemonStat.value !== "" && natureStat.value !== "" && levelStat.value !== "") {
        calculateStats();
    } else{
        //ERROR
    }
}

function calculateStats() {
    fetch(`https://pokeapi.co/api/v2/pokemon/${(pokemonStat.value)}`)
    .then(res => res.json())
    .then(data => {
        
    })
}

function loadAllPokemon() {
    fetch('https://pokeapi.co/api/v2/pokemon?limit=1008')
    .then(response => response.json())
    .then(data => {
        const pokemonList = data.results;
        pokemonList.sort((a, b) => {
            const nameA = a.name;
            const nameB = b.name;
            if (nameA < nameB) {
              return -1;
            }
            if (nameA > nameB) {
              return 1;
            }
            return 0;
        });
        for(let i = 0; i <= 1008; i++) {
            const newOption = document.createElement('option');
            newOption.innerHTML = (pokemonList[i].name).charAt(0).toUpperCase() + pokemonList[i].name.slice(1);
            newOption.value = data.results[i].name;
            pokemonStat.appendChild(newOption);
        }
    })
}

function loadAllNatures() {
    fetch('https://pokeapi.co/api/v2/nature')
    .then(response => response.json())
    .then(data => {
        for(let i = 0; i <= 24; i++) {
            const newOption = document.createElement('option');
            newOption.innerHTML = (data.results[i].name).charAt(0).toUpperCase() + data.results[i].name.slice(1);
            newOption.value = i;
            natureStat.appendChild(newOption);
        }
    })
}

loadAllPokemon();
loadAllNatures();