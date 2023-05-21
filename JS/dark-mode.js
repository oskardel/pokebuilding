if(localStorage.getItem('darkMode')===null) {
    localStorage.setItem('darkMode', "false");
}

const dropMenu = document.querySelector('.drop-menu-wrap');
const themeCheck = document.querySelector('.body');

function switchAppearance() {
    if(localStorage.getItem('darkMode')==="true"){
        localStorage.setItem('darkMode', "false");
        themeCheck.classList.remove('dark-theme');
        themeCheck.classList.add('light-theme');
    } else{
        localStorage.setItem('darkMode', "true");
        themeCheck.classList.remove('light-theme');
        themeCheck.classList.add('dark-theme');
    }
}

function toggleMenu() {
    dropMenu.classList.toggle('open');
}

function checkStartTheme() {
    if(localStorage.getItem('darkMode')==="false"){
        themeCheck.classList.remove('dark-theme');
        themeCheck.classList.add('light-theme');
    } else{
        themeCheck.classList.remove('light-theme');
        themeCheck.classList.add('dark-theme');
    }
}

checkStartTheme();