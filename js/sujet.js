let monIdentifiant = localStorage.getItem("monIdentifiant");
let objet = JSON.parse(monIdentifiant);

let maDate = localStorage.getItem("maDate");
let objetDate = JSON.parse(maDate);

let monLien = localStorage.getItem("monLien");
let objetLien = JSON.parse(monLien);

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

// On crée le contenu de la page uniquement avec du DOM

document.title = objetLien["titre"];

const main = document.createElement("main");
const titre = document.createElement("h1");
const divMain = document.createElement("div");
const divContenu = document.createElement("div");
const divUser = document.createElement("div");
const divCom = document.createElement("div");
const pUser = document.createElement("p");
const pDate = document.createElement("p");
const pMessage = document.createElement("p");
const textarea = document.createElement("textarea");
const btn = document.createElement("input");

document.body.append(main);
main.append(titre);
let titrePage = document.createTextNode(objetLien["titre"]);
titre.append(titrePage);
main.append(divMain);
divMain.classList.add("divMain");
divMain.append(divContenu);
divContenu.classList.add("divContenu");
divContenu.append(divUser);
divUser.classList.add("divUser");
divUser.append(pUser);
pUser.classList.add("pUser");
let addUser = objetLien["nom"] + " " + objetLien["prenom"];
pUser.append(addUser);
divUser.append(pDate);
pDate.classList.add("pDate");
let addDate = objetLien["date"];
pDate.append(addDate);
divContenu.append(pMessage);
pMessage.classList.add("pMessage");
let addMessage = objetLien["message"];
pMessage.append(addMessage);

document.body.append(divCom);
divCom.classList.add("divCom");
divCom.append(textarea);
textarea.placeholder = "Ecrivez votre commentaire ici ..."
divCom.append(btn);
btn.classList.add("btn");
btn.type = "button";
btn.value = "Envoyer";

// JS pour envoyer la value du textarea en commentaire

btn.addEventListener('click', function (e) {
    if (textarea.value === "") {
        e.preventDefault();
    } else {
        let date = new Date();
        let dateNum = date.toLocaleString();
        const divContenuAdd = document.createElement("div");
        const divUserAdd = document.createElement("div");
        const pUserAdd = document.createElement("p");
        const pDateAdd = document.createElement("p");
        const divMessageAdd = document.createElement("div");
        const pMessageAdd = document.createElement("p");
        const addMessage = document.createTextNode(textarea.value);
        divMain.append(divContenuAdd);
        divContenuAdd.classList.add("divContenu");
        divContenuAdd.append(divUserAdd);
        divUserAdd.classList.add("divUser");
        divUserAdd.append(pUserAdd);
        pUserAdd.classList.add("pUser");
        let addpUserAdd = objet["nom"] + " " + objet["prenom"];
        pUserAdd.append(addpUserAdd);
        divUserAdd.append(pDateAdd);
        pDateAdd.classList.add("pDate");
        pDateAdd.append(dateNum);
        divContenuAdd.append(pMessageAdd);
        pMessageAdd.classList.add("pMessage");
        pMessageAdd.append(addMessage);
        textarea.value = "";
    }
});

// JS pour la navbar

const nav = document.querySelector(".navAff");
const navBar = document.querySelector(".navBar");

nav.addEventListener('click', function (e) {
    navBar.classList.toggle("right");
});