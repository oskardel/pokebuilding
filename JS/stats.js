//https://pycosites.com/pkmn/stat.php

const statResults = document.getElementById('stat-results');
const pokemonStat = document.getElementById('select-pokemon');
const natureStat = document.getElementById('select-nature');
const levelStat = document.getElementById('level-pokemon');
const EVSelector = document.querySelectorAll('.ev-selector');
const IVSelector = document.querySelectorAll('.iv-selector');


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

function checkFields() {
    if(pokemonStat.value !== "" && levelStat.value !== "") {
        statResults.innerHTML = "";
        calculateStats();
        statResults.style.display = "block";
    } else{
        //ERROR
    }
}

function calculateStats() {
    fetch(`https://pokeapi.co/api/v2/pokemon/${(pokemonStat.value)}`)
    .then(res => res.json())
    .then(data => {
        const rowTable = document.createElement('tr');
        const infoTable = document.createElement('td');
        infoTable.innerHTML = "Lvl." + levelStat.value + " " + pokemonStat.value.charAt(0).toUpperCase()+pokemonStat.value.slice(1);
        infoTable.colSpan = 7;
        rowTable.appendChild(infoTable);
        statResults.appendChild(rowTable);

        const headerStatString = ["HP", "ATK", "DEF", "Sp.ATK", "Sp.DEF", "SPD"];
        const row2Table = document.createElement('tr');

        for(let j = 0; j < headerStatString.length; j++){
            const headerStat = document.createElement('th');
            headerStat.innerHTML = headerStatString[j];
            row2Table.appendChild(headerStat);
        }
        statResults.appendChild(row2Table);

        if(natureStat.value !== "") {
            console.log("holy shite");
        }

        const statRow = document.createElement('tr');
        for(var i = 0; i < data.stats.length; i++){
            var natureChange = 1;
            if(IVSelector[i].value === "") IVSelector[i].value = 0;
            if(EVSelector[i].value === "") EVSelector[i].value = 0;

            if(i === 0){
                var statArray = Math.floor(0.01 * (2 * data.stats[0].base_stat + parseInt(IVSelector[i].value) + Math.floor(0.25 * parseInt(EVSelector[i].value))) * parseInt(levelStat.value)) + parseInt(levelStat.value) + 10;
            } else{
                var statArray = Math.floor(((0.01 * (2 * data.stats[i].base_stat + parseInt(IVSelector[i].value) + Math.floor(0.25 * parseInt(EVSelector[i].value))) * parseInt(levelStat.value)) + 5) * natureChange);
            }

            const newStat = document.createElement('td');
            newStat.innerHTML = statArray;
            statRow.appendChild(newStat);
        }
        statResults.appendChild(statRow);
    })
}


/* LOAD FOR THE FIRST TIME */
loadAllPokemon();
loadAllNatures();