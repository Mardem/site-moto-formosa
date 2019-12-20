$(document).ready(function () {

    let page = window.location;
    createId(page); // Verify if exists uuid on localStorage, if not exists create a uuid
    loadValue();    // Load value from api and set in local cart
});
