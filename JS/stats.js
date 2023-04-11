//https://pycosites.com/pkmn/stat.php

const statResults = document.getElementById('stat-results');
const pokemonStat = document.getElementById('select-pokemon');
const natureStat = document.getElementById('select-nature');
const levelStat = document.getElementById('level-pokemon');
const EVSelector = document.querySelectorAll('.ev-selector');
const IVSelector = document.querySelectorAll('.iv-selector');


// const createHeaderStats = async(headerStatString) => {
//     const row2Table = document.createElement('tr');
//     row2Table.classList.add("header-stats");

//     for(let j = 0; j < headerStatString.length; j++){
//         const headerStat = document.createElement('th');
//         headerStat.innerHTML = headerStatString[j];
//         row2Table.appendChild(headerStat);
//     }
//     statResults.appendChild(row2Table);
// }

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

const checkFields = () => {
    if(pokemonStat.value !== "" && levelStat.value !== "") {
        statResults.innerHTML = "";
        calculateStats();
        statResults.style.display = "block";
    } else{
        //ERROR
    }
}

const checkNature = async(nature) => {
    const rest = await fetch(`https://pokeapi.co/api/v2/nature/${nature}`);
    const data = await rest.json();
    
    var headerStatString = ["HP", "ATK", "DEF", "Sp.ATK", "Sp.DEF", "SPD"];
    if(data.decreased_stat !== null) {
        const increasedStat = (data.increased_stat.url.slice(-2)).replace("/", "");
        const decreasedStat = (data.decreased_stat.url.slice(-2)).replace("/", "");
        var TDstats = document.querySelector('header-stats').children;
        TDstats.item(decreasedStat) //CONTINUAR (INDEX PARA CAMBIAR EN EL HTML)

    }
}

const addStatsPokemon = (data) => {
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
}

function calculateStats() {
    fetch(`https://pokeapi.co/api/v2/pokemon/${(pokemonStat.value)}`)
    .then(res => res.json())
    .then(data => {
        const headerStatString = ["HP", "ATK", "DEF", "Sp.ATK", "Sp.DEF", "SPD"];

        const rowTable = document.createElement('tr');
        const infoTable = document.createElement('td');
        infoTable.innerHTML = "Lvl." + levelStat.value + " " + pokemonStat.value.charAt(0).toUpperCase()+pokemonStat.value.slice(1);
        infoTable.colSpan = 7;
        rowTable.appendChild(infoTable);
        statResults.appendChild(rowTable);

        const row2Table = document.createElement('tr');
        row2Table.classList.add("header-stats");

        for(let j = 0; j < headerStatString.length; j++){
            const headerStat = document.createElement('th');
            headerStat.innerHTML = headerStatString[j];
            row2Table.appendChild(headerStat);
        }
        statResults.appendChild(row2Table);

        if(natureStat.value != "") {
            checkNature(parseInt(natureStat.value)+1);
        }
        
        addStatsPokemon(data);
    })
}


/* LOAD FOR THE FIRST TIME */
loadAllPokemon();
loadAllNatures();