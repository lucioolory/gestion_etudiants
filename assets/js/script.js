document.getElementById("formEtudiant").addEventListener("submit", function(e) {

    let nom = document.querySelector("input[name='nom']").value;
    let prenom = document.querySelector("input[name='prenom']").value;

    if (nom === "" || prenom === "") {
        e.preventDefault(); // bloque l'envoi
        alert("Veuillez remplir tous les champs !");
    }

}); 
