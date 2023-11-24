const nomEl = document.querySelector('#nom');
const prenomEl = document.querySelector('#prenom');
const emailEl = document.querySelector('#email');
const passwordEl = document.querySelector('#password');
const confirmPasswordEl = document.querySelector('#confirmPassword');

const form = document.querySelector('#register');

// constante pour vérifier les différents champs

const isRequired = value => value === '' ? false : true;

const isBetween = (length, min, max) => length < min || length > max ? false : true;

const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const isPasswordSecure = (password) => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#^+\-\[\]])[A-Za-z\d#^+\-\[\]]{8,}$/;
    return re.test(password);
};

const showError = (input, message) => {
    // prends l'élément form-field
    const formField = input.parentElement;
    // ajoute la classe error
    formField.classList.remove('success');
    formField.classList.add('erreur');

    // montre le message d'erreur
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {
    // prends l'élément form-field
    const formField = input.parentElement;

    // enlève la classe error
    formField.classList.remove('erreur');
    formField.classList.add('success');

    // cache le message d'erreur
    const error = formField.querySelector('small');
    error.textContent = '';
};

// constante pour vérifier l'éligibité du nom

const checkNom = () => {
    // ajout d'un booléen et d'un minimum / maximum
    let valid = false;

    const min = 3,
        max = 20;

    const nom = nomEl.value.trim();

    if (!isRequired(nom)) {
        showError(nomEl, 'Vous devez saisir votre nom.');
    } else if (!isBetween(nom.length, min, max)) {
        showError(nomEl, `Votre nom doit contenir entre ${min} et ${max} caractères.`);
    } else if (/\d/.test(nom)) {
        showError(nomEl, 'Votre nom ne doit pas contenir de chiffres.');
    } else {
        showSuccess(nomEl);
        valid = true;
    }
    return valid;
};

// constante pour vérifier l'éligibilité du prénom

const checkPrenom = () => {
    // ajout d'un booléen et d'un minimum / maximum
    let valid = false;

    const min = 3,
        max = 20;

    const prenom = prenomEl.value.trim();

    if (!isRequired(prenom)) {
        showError(prenomEl, 'Vous devez saisir votre prénom.');
    } else if (!isBetween(prenom.length, min, max)) {
        showError(prenomEl, `Votre prénom doit contenir entre ${min} et ${max} caractères.`);
    } else if (/\d/.test(prenom)) {
        showError(prenomEl, 'Votre prénom ne doit pas contenir de chiffres.');
    } else {
        showSuccess(prenomEl);
        valid = true;
    }
    return valid;
};

// constante pour vérifier l'email

const checkEmail = () => {

    let valid = false;

    const email = emailEl.value.trim();

    if (!isRequired(email)) {
        showError(emailEl, 'Vous devez fournir un e-mail.');
    } else if (!isEmailValid(email)) {
        showError(emailEl, "L'e-mail n'est pas valide.");
    } else {
        showSuccess(emailEl);
        valid = true;
    }
    return valid;
};

// constante pour vérifier le mot de passe

const checkPassword = () => {

    let valid = false;

    const max = 20;

    const password = passwordEl.value.trim();

    if (!isRequired(password)) {
        showError(passwordEl, 'Le mot de passe ne peut pas être vide.');
    } else if (!isPasswordSecure(password)) {
        showError(passwordEl, `Le mot de passe doit au moins contenir 8 caractères qui inclus au moins 1 lettre minuscule, 1 lettre majuscule, 1 nombre, et 1 caractère spécial comme (#+-^[]) et doit au maximum contenir ${max} caractères.`);
    } else {
        showSuccess(passwordEl);
        valid = true;
    }
    return valid;
};

// constante pour vérifier que les mots de passes correspondent

const checkConfirmPassword = () => {

    let valid = false;

    const confirmPassword = confirmPasswordEl.value.trim();

    const password = passwordEl.value.trim();

    if (!isRequired(confirmPassword)) {
        showError(confirmPasswordEl, 'Entrez de nouveau votre mot de passe.');
    } else if (password !== confirmPassword) {
        showError(confirmPasswordEl, 'Les mots de passes ne correspondent pas.');
    } else {
        showSuccess(confirmPasswordEl);
        valid = true;
    }
    return valid;
};

//  ajout d'un événement pour prévenir l'envoi du formulaire

form.addEventListener('submit', function (e) {
    // check la validité des champs
    let isNomValid = checkNom(),
        isPrenomValid = checkPrenom(),
        isEmailValid = checkEmail(),
        isPasswordValid = checkPassword(),
        isConfirmPasswordValid = checkConfirmPassword();

    let isFormValid = isNomValid &&
        isPrenomValid &&
        isEmailValid &&
        isPasswordValid &&
        isConfirmPasswordValid;

    // préviens l'envoi du formulaire si il y a une erreur
    if (isFormValid === true) {
        let monNom = document.querySelector("#nom");
        let monPrenom = document.querySelector("#prenom");
        let monMail = document.querySelector("#email");
        let monMdp = document.querySelector("#password");

        let monIdentifiant = {
            nom: monNom.value,
            prenom: monPrenom.value,
            mail: monMail.value,
            mdp: monMdp.value
        };
    } else {
        e.preventDefault();
    }
}, true);

// ajout d'un timer à l'événement input qui va suivre

const debounce = (fn, delay = 300) => {
    let timeoutId;
    return (...args) => {
        // annule le précédent timer
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // setup un nouveau timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

// ajout d'un événement qui confirme ou non la validité du champ à chaque input

form.addEventListener('input', debounce(function (e) {
    switch (e.target.id) {
        case 'nom':
            checkNom();
            break;
        case 'prenom':
            checkPrenom();
            break;
        case 'email':
            checkEmail();
            break;
        case 'password':
            checkPassword();
            break;
        case 'confirmPassword':
            checkConfirmPassword();
            break;
    }
}));

//*****************************************************************************//
//* ajout des événements pour afficher ou masquer les forms register ou login *//
//*****************************************************************************//

let btn1 = document.querySelector(".regLogBtn1");
let btn2 = document.querySelector(".regLogBtn2");
let formReg = document.querySelector(".register");
let formLog = document.querySelector(".login");

btn1.addEventListener('click', function (e) {
    formReg.classList.toggle("hidden");
    formReg.classList.toggle("block");
    formLog.classList.add("hidden");
    formLog.classList.remove("block");
})

btn2.addEventListener('click', function (e) {
    formLog.classList.toggle("hidden");
    formLog.classList.toggle("block");
    formReg.classList.add("hidden");
    formReg.classList.remove("block");
});

//***********************************************************//
//*************Javascript pour la modal de Login*************//
//***********************************************************//

const emailLog = document.querySelector("#emailLog");
emailLog.value = objet["mail"];

const mdp = document.querySelector("#passwordLog");
mdp.value = objet["mdp"];

const log = document.querySelector("#login");

const showErrorLog = (input, message) => {
    // prends l'élément form-field
    const formField = input.parentElement;
    // ajoute la classe error
    formField.classList.remove('success');
    formField.classList.add('erreur');

    // montre le message d'erreur
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccessLog = (input) => {
    // prends l'élément form-field
    const formField = input.parentElement;

    // enlève la classe error
    formField.classList.remove('erreur');
    formField.classList.add('success');

    // cache le message d'erreur
    const error = formField.querySelector('small');
    error.textContent = '';
};