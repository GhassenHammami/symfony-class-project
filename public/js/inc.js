// Fonction utilitaire : affiche une alerte personnalisée
function showWelcomeMessage(message) {
    alert(message);
}

function initAccueilPage() {
    console.log("Page d'accueil chargée.");
    const numberElement = document.getElementById("lucky-number");
    if (numberElement) {
        const text = numberElement.textContent || numberElement.innerText;
        const match = text.match(/\d+/);
        if (match) {
            const number = parseInt(match[0], 10);
            if (number >= 50) {
                numberElement.style.color = "blue";
                numberElement.style.fontWeight = "bold";
            } else {
                numberElement.style.color = "";
                numberElement.style.fontWeight = "";
            }
        }
    }
}
