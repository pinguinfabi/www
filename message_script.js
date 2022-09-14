// Get the message from the url
// Its the string between the ?c= and the &
// If there is no & in the url the message goes to the end of the url

// Get the url
var url = window.location.href;

// Error messages
const error_messages = {
    "emailorpass": "The email or password are incorrect.",
    "dberr": "Failed to connect to the Database.",
    "log": "You are now logged in",
    "reg": "You are now registered.\n Please log in to access our content",
    "emailused": "This email has alredy been used.\nPlease use a different email.",
    "nopass": "Please enter a correct password.",
    "samepass": "Please make sure that both passwords are the same.",
    "validemail": "Please use an email that exists.",
    "nameused": "Please use an other username.",
    "norights": "YOU HAVE NO RIGHTS TO CALL THAT PAGE!!!"
}

// Check if there is an ?e= in the url
if (url.indexOf("?e=") > -1) {

    // Split out the code
    var code = url.split('?e=')[1];
    code = code.split('&')[0];

    // Check if there is a message
    if (code) {
        var message = error_messages[code];
    }

    console.log(message);

    document.getElementById("output_message").innerHTML = "<div id='error_message_inner'></div>";
    document.getElementById("error_message_inner").innerText = message;
}

document.getElementById("output_message").addEventListener("click", function() {

    // Remove the error message
    document.getElementById("output_message").style.animation = "animation_close_error 0.5s";

    // Remove the error message after the animation is done
    setTimeout(function() {

        // Remove the error message
        document.getElementById("output_message").style.display = "none";

    }, 500);

});