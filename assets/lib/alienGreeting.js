export default function alienGreeting(message = "👽 Bienvenue sur Popyverse !", showAlert = true) {
    if (showAlert) {
        alert(message);
    } else {
        console.log(message);
    }
}
