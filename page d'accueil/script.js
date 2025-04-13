document.addEventListener("DOMContentLoaded", function() {
    console.log("BlueHaven is ready!");
    document.addEventListener("DOMContentLoaded", function() {
        console.log("BlueHaven is ready!");
    
        let form = document.querySelector("form");
        let selectProfil = document.getElementById("profil");
    
        form.addEventListener("submit", function(event) {
            let choix = selectProfil.value;
            console.log("Profil sélectionné : " + choix);
            alert("Vous vous connectez en tant que : " + choix);
        });
    });
    
});
