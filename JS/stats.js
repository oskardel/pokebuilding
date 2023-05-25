const statResults = document.getElementById('stat-results');
const pokemonStat = document.getElementById('select-pokemon');
const natureStat = document.getElementById('select-nature');
const levelStat = document.getElementById('level-pokemon');
const EVSelector = document.querySelectorAll('.ev-selector');
const IVSelector = document.querySelectorAll('.iv-selector');
const errorMessage = document.getElementById('error-message');


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
    fetch('https://pokeapi.co/api/v2/nature/?offset=0&limit=25')
    .then(response => response.json())
    .then(data => {
        for(let i = 0; i <= data.count; i++) {
            const newOption = document.createElement('option');
            newOption.innerHTML = (data.results[i].name).charAt(0).toUpperCase() + data.results[i].name.slice(1);
            newOption.value = i;
            natureStat.appendChild(newOption);
        }
    })
}

const checkFields = () => {
    if(pokemonStat.value !== "" && levelStat.value !== "" && natureStat.value !== "") {
        errorMessage.innerHTML = "";
        statResults.innerHTML = "";
        calculateStats();
        statResults.style.display = "block";
    } else{
        statResults.innerHTML = "";
        const errorMessage = document.getElementById('error-message');
        errorMessage.innerHTML = "Please, fill in all the fields";
    }
}

const checkNature = async(nature, pokemonStats) => {
    const rest = await fetch(`https://pokeapi.co/api/v2/nature/${nature}`);
    const data = await rest.json();

    const headerStatString = ["HP", "ATK", "DEF", "Sp.ATK", "Sp.DEF", "SPD"];
    const row2Table = document.querySelector('.header-stats')
    
    for(let j = 0; j < headerStatString.length; j++){
        const headerStat = document.createElement('th');
        if(data.decreased_stat !== null) {
            const increasedStat = (data.increased_stat.url.slice(-2)).replace("/", "");
            const decreasedStat = (data.decreased_stat.url.slice(-2)).replace("/", "");
            if(j === (increasedStat-1)){
                headerStat.innerHTML = headerStatString[j] + "+";
                headerStat.classList.add("increase");
                headerStat.classList.add(j+1);
            } else{
                if(j === (decreasedStat-1)) {
                    headerStat.innerHTML = headerStatString[j] + "-";
                    headerStat.classList.add("decrease");
                    headerStat.classList.add(j+1);
                }
                else{
                    headerStat.innerHTML = headerStatString[j];
                }
            }
        } else{
            headerStat.innerHTML = headerStatString[j];
        }
        
        row2Table.appendChild(headerStat);
    }
    statResults.appendChild(row2Table);
    
    addStatsPokemon(pokemonStats);
}

const addStatsPokemon = (data) => {
    const statRow = document.createElement('tr');
    const increaseStat = document.querySelector('.increase');
    const decreaseStat = document.querySelector('.decrease');

    for(var i = 0; i < data.stats.length; i++){
        let natureChange = 1;
        if(IVSelector[i].value === "") IVSelector[i].value = 0;
        if(EVSelector[i].value === "") EVSelector[i].value = 0;

        if(natureStat.value != 0 && natureStat.value != 6 && natureStat.value != 12 && natureStat.value != 18 && natureStat.value != 24){
            if(increaseStat.classList.contains(i+1)){
                natureChange = 1.1;
            }
            if(decreaseStat.classList.contains(i+1)){
                natureChange = 0.9;
            }
        }

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
        const rowTable = document.createElement('tr');
        const infoTable = document.createElement('td');
        infoTable.innerHTML = "Lvl." + levelStat.value + " " + pokemonStat.value.charAt(0).toUpperCase()+pokemonStat.value.slice(1);
        infoTable.colSpan = 7;
        infoTable.classList.add('poke-name');
        rowTable.appendChild(infoTable);
        statResults.appendChild(rowTable);

        const row2Table = document.createElement('tr');
        row2Table.classList.add("header-stats");
        statResults.appendChild(row2Table);

        checkNature(parseInt(natureStat.value)+1, data);
    })
}


/* LOAD FOR THE FIRST TIME */
loadAllPokemon();
loadAllNatures();