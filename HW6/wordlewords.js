/**
 * This function will query the CS4640 server for a new word.
 *
 * It makes use of AJAX and Promises to await the result.
 */
function queryWord() {
    return new Promise( resolve => {
            // instantiate the object
            var ajax = new XMLHttpRequest();
            // open the request
            ajax.open("GET", "https://cs4640.cs.virginia.edu/api/wordleword.php", true);
            // ask for a specific response
            ajax.responseType = "text";
            // send the request
            ajax.send(null);
            
            // What happens if the load succeeds
            ajax.addEventListener("load", function() {
                // Return the word as the fulfillment of the promise 
                if (this.status == 200) { // worked 
                    resolve(this.response);
                } else {
                    console.log("When trying to get a new word, the server returned an HTTP error code.");
                }
            });
            
            // What happens on error
            ajax.addEventListener("error", function() {
                console.log("When trying to get a new word, the connection to the server failed.");
            });
    });
}

/**
 * This is the function you should call to request a new word.
 * It takes one parameter: a callback function.  This function
 * should take one parameter (the new word) and handle the setup
 * of your new game.  For example if you have a function named
 * setUpNewGame(newWord), then in your event handler for a new
 * game, you should call this function as:
 *     getRandomWord(setUpNewGame);
 * It will wait for the server to provide a new word, then it will
 * call your function, passing in the word, to continue setting up
 * the new game.
 */
async function getRandomWord(callback) {
    var newWord = await queryWord();
    callback(newWord);
}
