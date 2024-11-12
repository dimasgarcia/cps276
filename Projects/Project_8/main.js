"use strict";


let nameManager = {};


nameManager.init = function() {
    const addNameBtn = document.querySelector('#addName');
    const getNamesBtn = document.querySelector('#getNames');
    const clearNamesBtn = document.querySelector('#clearNames');

    if (addNameBtn && getNamesBtn && clearNamesBtn) {
        addNameBtn.addEventListener('click', nameManager.addName);
        getNamesBtn.addEventListener('click', nameManager.displayNames);
        clearNamesBtn.addEventListener('click', nameManager.clearNames);
    } else {
        console.error('One or more buttons not found.');
    }
}


nameManager.addName = function() {
    const nameInput = document.querySelector('#flname');
    const messageBox = document.querySelector('#displayNames');

    if (!nameInput || !messageBox) {
        console.error('Name input or message box not found.');
        return;
    }

    const nameValue = nameInput.value.trim();

    if (nameValue === "") {
        messageBox.innerHTML = "<p class='text-danger'>You must enter a name</p>";
        return;
    }

    let data = { name: nameValue };
    data = JSON.stringify(data);

    Util.sendRequest('addName.php', function(res) {
        let json;
        try {
            json = JSON.parse(res.responseText);
        } catch (e) {
            console.error("Error parsing JSON response:", e);
            return;
        }

        if (json.masterstatus === 'success') {
            messageBox.innerHTML = "<p class='text-success'>Name has been added</p>";
            nameInput.value = ""; 
        } else {
            messageBox.innerHTML = `<p class='text-danger'>${json.msg}</p>`;
        }
    }, data);
}


nameManager.displayNames = function() {
    const messageBox = document.querySelector('#displayNames');

    if (!messageBox) {
        console.error('Display box not found.');
        return;
    }

    Util.sendRequest('displayNames.php', function(res) {
        let json;
        try {
            json = JSON.parse(res.responseText);
        } catch (e) {
            console.error("Error parsing JSON response:", e);
            return;
        }

        if (json.masterstatus === 'success') {
            messageBox.innerHTML = json.names;
        } else {
            messageBox.innerHTML = `<p class='text-danger'>${json.msg}</p>`;
        }
    });
}


nameManager.clearNames = function() {
    const messageBox = document.querySelector('#displayNames');

    if (!messageBox) {
        console.error('Display box not found.');
        return;
    }

    Util.sendRequest('clearNames.php', function(res) {
        let json;
        try {
            json = JSON.parse(res.responseText);
        } catch (e) {
            console.error("Error parsing JSON response:", e);
            return;
        }

        if (json.masterstatus === 'success') {
            messageBox.innerHTML = "<p class='text-success'>All names were deleted</p>";
        } else {
            messageBox.innerHTML = `<p class='text-danger'>${json.msg}</p>`;
        }
    });
}


nameManager.init();
