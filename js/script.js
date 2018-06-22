/** JSON
 * Check if the subscription form is fully and correctly filed.
 * @return {Boolean}
 */
function createProfile() {
    var form = document.forms["signup-form"];

    if (!isFilled(form["pseudo"].value) || !isFilled(form["password"].value) 
            || !isFilled(form["country"].value) || !isFilled(form["zip"].value) 
            || !isFilled(form["email"].value)) {
        window.alert("Merci de remplir tous les champs");
        return false;
    } else if (!isValidEmail(form["email"].value)) {
        window.alert("L'adresse e-mail n'est pas valide.");
        return false;
    } else if(!isValidPostalCode(form["zip"].value, form["country"].value)) {
        window.alert("Le code postal n'est pas valide.");
        return false;
    }

    return true;
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