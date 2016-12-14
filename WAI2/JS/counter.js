(function counter() {
    if (sessionStorage.visited == null)
        if (localStorage.counter == null) {
            localStorage.counter = 1;
        } else
            localStorage.counter++;

})();
function displayCounter() {
    var element = document.getElementById("counter");
    element.appendChild(document.createTextNode(localStorage.counter));
}
document.addEventListener("DOMContentLoaded", function () {
    displayCounter();
    sessionStorage.visited = true;

});