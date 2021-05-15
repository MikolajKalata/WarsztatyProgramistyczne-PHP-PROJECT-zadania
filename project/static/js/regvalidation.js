window.onload = function () {
    function validate() {

        var errorMsg = "";
        const regexLetters = /^([a-zżźćńółęąśA-ZŻŹĆĄŚĘŁÓŃ -]){2,30}$/;
        const regexEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        const pass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/;
        const card = /^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/;

        if (!regexLetters.test(document.getElementById("firstname").value)) {
            var errorMsg = errorMsg + "\nNieprawidłowe imię";
        }

        if (!regexLetters.test(document.getElementById("surname").value)) {
            errorMsg = errorMsg + "\nNieprawidłowe nazwisko";
        }

        if(!regexEmail.test(document.getElementById("mail").value)) {
            errorMsg = errorMsg + "\nNieprawidłowy adres e-mail";
        }

        if(!pass.test(document.getElementById("pass").value)) {
            errorMsg = errorMsg + "\nNieprawidłowe hasło";
        }

        if(!(document.getElementById("gender").value == "")) {
            errorMsg = errorMsg + "\nProsimy wybrać płeć";
        }

        if((document.getElementById("cardtype").value == "")) {
            errorMsg = errorMsg + "\nProsimy wybrać rodzaj karty płatniczej";
        }

        if(!card.test(document.getElementById("cardnum").value)) {
            errorMsg = errorMsg + "\nNieprawidły numer karty";
        }

        if(!errorMsg == ""){
            alert(errorMsg);
            return false;
        }
        return true;

    }

};