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

// On ajoute des sujets

const titre = document.querySelector("#titre");
const message = document.querySelector("#message");
const envoi = document.querySelector(".btn");
const table = document.querySelector("tbody");
let i = 1;


envoi.addEventListener('click', function (e) {
    let monSujet = {
        titre: titre.value,
        message: message.value
    }

    if (titre.value === "" || message.value === "") {
        e.preventDefault();
    } else {
        let date = new Date();

        let dateNum = date.toLocaleString();

        const rowTable = document.createElement("tr");
        const titleTable = document.createElement("th");
        const addNumber = document.createTextNode(i);
        const cellTable1 = document.createElement("td");
        const link = document.createElement("a");
        const cellTable2 = document.createElement("td");
        const cellTable3 = document.createElement("td");
        const addCellTitle = document.createTextNode(monSujet["titre"]);

        table.append(rowTable);
        rowTable.append(titleTable);
        titleTable.append(addNumber);
        rowTable.append(cellTable1);
        cellTable1.append(link);
        link.append(addCellTitle);
        link.href = "/html/sujet.html";
        link.classList.add("test");
        rowTable.append(cellTable2);
        cellTable2.append(dateNum);
        rowTable.append(cellTable3);
        cellTable3.append(objet["nom"], " ", objet["prenom"]);

        localStorage.setItem("monSujet" + i, JSON.stringify(monSujet));
        i++;

        titre.value = "";
        message.value = "";

        // On rajoute dans le localStorage les informations en fonction du lien cliqué

        link.addEventListener('click', function (e) {
            let monLien = {
                titre: monSujet["titre"],
                message: monSujet["message"],
                date: dateNum,
                nom: objet["nom"],
                prenom: objet["prenom"]
            };

            localStorage.setItem("monLien", JSON.stringify(monLien));
        })
    }
});

// JS pour la navbar

const nav = document.querySelector(".navAff");
const navBar = document.querySelector(".navBar");

nav.addEventListener('click', function (e) {
    navBar.classList.toggle("right");
});