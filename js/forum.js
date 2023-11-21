let monIdentifiant = localStorage.getItem("monIdentifiant");
let objet = JSON.parse(monIdentifiant);

let maDate = localStorage.getItem("maDate");
let objetDate = JSON.parse(maDate);

// On ajoute les infos dans les spans du header

const nom = document.querySelector(".nom");
let addNom = document.createTextNode(objet["nom"]);
nom.append(addNom);

const prenom = document.querySelector(".prenom");
let addPrenom = document.createTextNode(objet["prenom"]);
prenom.append(addPrenom);

const jour = document.querySelector(".jourSem");
let addJour = document.createTextNode(objetDate["jour"]);
jour.append(addJour);

const dateDay = document.querySelector(".dateDay");
let addDateDay = document.createTextNode(objetDate["day"]);
dateDay.append(addDateDay);

const dateMonth = document.querySelector(".dateMonth");
let addDateMonth = document.createTextNode(objetDate["month"]);
dateMonth.append(addDateMonth);

const dateYear = document.querySelector(".dateYear");
let addDateYear = document.createTextNode(objetDate["year"]);
dateYear.append(addDateYear);

const heure = document.querySelector(".heure");
const addHeure = document.createTextNode(objetDate["heure"]);
heure.append(addHeure);

const minute = document.querySelector(".minute");
const addMinute = document.createTextNode(objetDate["minute"]);
const zero = "0";

if (objetDate["minute"] <= 9) {
    minute.append(zero + objetDate["minute"]);
} else {
    minute.append(addMinute);
}

// Evénement click sur les boutons

const btn1 = document.querySelector(".btn1");
const btn2 = document.querySelector(".btn2");
const btn3 = document.querySelector(".btn3");

btn1.addEventListener('click', function (e) {
    window.location.href = "/html/installation.html"
})

btn2.addEventListener('click', function (e) {
    window.location.href = "/html/installationMac.html"
})

btn3.addEventListener('click', function (e) {
    window.location.href = "/html/installation.html"
})