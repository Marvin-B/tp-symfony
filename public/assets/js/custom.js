// Variables

const colFonce = '#0F323E';
const colClair = '#B1CFDA';
const colUltraClair = '#E0EDF3';
const colTitre = '#2D6776';
const colStrong = '#83B7BF';
const noir = '#000000';
const blanc = '#FFFFFF';

const navbar = document.getElementById("navbar");

function openingMenue(){

    console.log(document.getElementById("menu-opener"));
    if (navbar.classList.contains("open")){
        navbar.classList.remove("open");
    } else{
        navbar.classList.add("open");
    }

    if (document.getElementById("menu-opener").classList.contains("open")){
        document.getElementById("menu-opener").classList.remove("open");
    } else{
        document.getElementById("menu-opener").classList.add("open");
    }
}
