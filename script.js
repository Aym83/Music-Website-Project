/** Tests **/
/**var email = "cooperdrummer@gmail.com";
if(isEmail(email)) {
    window.alert("Il s'agit bien d'un email");
} else {
    window.alert("BOUHHHHHH !");
}
var zip = "22222222";
var country = "dz";
if(isValidPostalCode(zip,country)) {
    window.alert("Bon ZIP");
} else {
    window.alert("BOUHHHHHH !");
}**/


/** JSON
 * Check if the subscription form is fully and correctly filed.
 * @return {Boolean}
 */
function createProfile() {
    var form = document.forms["signup_form"];

    if (!isFilled(form["first_name"].value) || !isFilled(form["last_name"].value)
        || !isFilled(form["alias"].value) || !isFilled(form["email"].value)) {
        window.alert("Please fill every field.");
        return false;
    } else if (!isValidEmail(form["email"].value)) {
        window.alert("The email address is not correct.");
        return false;
    } else if(!isValidPostalCode(form["zip"].value, form["country"].value)) {
        window.alert("The ZIP code is not correct.");
        return false;
    }

    var profile = {
        //snap: form["snap"].value,
        first_name: form["first_name"].value,
        last_name: form["last_name"].value,
        alias: form["alias"].value,
        email: form["email"].value,
        country: form["country"].value,
        zip: form["zip"].value,
        music_genre: form["music_genre"].value,
        played_instru: form["played_instru"].value,
        action: "profile"
    };
    //printProfile(profile);
    verif(JSON.stringify(profile));
    return false;
}

function printProfile(profile) {
    var content = document.getElementById("profile");
    var div = document.createElement("div");
    content.appendChild(div);
    div.innerHTML = "First name: " + profile.first_name + "Last Name: " + profile.last_name + "<br>" +
                    "Alias: " + profile.alias + "<br>" + 
                    "Email: " + profile.email + "<br>" +
                    "Country: " + profile.country + "; ZIP: " + profile.zip + "<br>" +
                    "Music genre: " + profile.music_genre + "; played instru: " + profile.played_instru;
}


/** Check if a field is filled
 * 
 * @param {text} value
 * @return {Boolean}
 */
function isFilled(value) {
    if (value.length !== 0) {
        return true;
    }
    return false;
}

/** Check if a mail is correct (shape of toto@hotmail.com)
 * 
 * @param {String} email
 * @return True if email is correct, False otherwise
 */
function isValidEmail(email) {
    var mailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return mailPattern.test(String(email).toLowerCase());
}

/** Check if a ZIP code is correct
 * 
 * @param {number} postalCode
 * @param {text} countryCode
 * @return {undefined}
 */
function isValidPostalCode(postalCode, countryCode) {
    switch (countryCode) {
        case "FR":
            postalCodeRegex = /^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/;
            break;
        case "US":
            postalCodeRegex = /^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/;
            break;
        case "CA":
            postalCodeRegex = /^([A-Z][0-9][A-Z])\s*([0-9][A-Z][0-9])$/;
            break;        
        default:
            postalCodeRegex = /^(?:[A-Z0-9]+([- ]?[A-Z0-9]+)*)?$/;
    }
    return postalCodeRegex.test(postalCode);
}


function verif(value) {
    var socket = null;
    try {
        // Connexion vers un serveur HTTP
        // prennant en charge le protocole WebSocket ("ws://").
        socket = new WebSocket("ws://172.16.207.228:8080/WSTP1/actions");

    } catch (exception) {
        console.error(exception);
    }

    // Récupération des erreurs.
    // Si la connexion ne s'établie pas,
    // l'erreur sera émise ici.
    socket.onerror = function (error) {
        console.error(error);
    };

    // Lorsque la connexion est établie.
    socket.onopen = function (event) {
        console.log("Connexion établie.");

        // Lorsque la connexion se termine.
        this.onclose = function (event) {
            console.log("Connexion terminée.");
        };

        this.send(value);
    };
}