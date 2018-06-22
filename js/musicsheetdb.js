$('document').ready(function () {
    login();
});

// Récupère le fichier JSON contenant les données des partitions à afficher
function login() {
    var xhr;
    try {
        xhr = new ActiveXObject('Msxml2.XMLHTTP');
    } catch (e) {
        try {
            xhr = new ActiveXObject('Microsoft.XMLHTTP');
        } catch (e2) {
            try {
                xhr = new XMLHttpRequest();
            } catch (e3) {
                xhr = false;
            }
        }
    }

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                generateGrid(JSON.parse(xhr.responseText));
            } else {
                window.alert("Error code " + xhr.status);
            }
        }
    };
    xhr.open("GET", "./json/musicsheet.json", true);
    xhr.send(null);
}

// Génère une grille contenant les partitions à partir du JSON
function generateGrid(json) {
    for (var i = 0; i < json.length; i++) {
        var name = json[i].name;
        var array = json[i].array;
        
        var mainDiv = document.createElement("div");
        mainDiv.className = "row";
        
        var titleDiv = document.createElement("div");
        titleDiv.innerHTML = "<h2>" + name + "</h2>";
        mainDiv.appendChild(titleDiv);
        
        generateDiv(array, mainDiv);
        
        document.getElementById("grid").appendChild(mainDiv);
    }
}

// Génère les divs correspondant aux partitions contenus dans array sous forme de JSON
function generateDiv(array, mainDiv) {
    for (var i = 0; i < array.length; i++) {
        var columnDiv = document.createElement("div");
        columnDiv.className = "col-md-3 thumbnail";
        mainDiv.appendChild(columnDiv);

        var link = document.createElement('a');
        link.href = array[i].url;
        columnDiv.appendChild(link);

        var img = document.createElement("img");
        img.className = "border border-dark center";
        img.src = array[i].url;
        img.alt = array[i].name;
        link.appendChild(img);

        var textDiv = document.createElement("div");
        textDiv.className = "caption text-center";
        textDiv.innerHTML = "<p><b>" + array[i].author + " - " + array[i].name + "</b></p>";
        link.appendChild(textDiv);
    }
}