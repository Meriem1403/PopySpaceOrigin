// assets/controllers/autosubmit_controller.js
import { Controller } from "@hotwired/stimulus"

function debounce(fn, wait) {
    let timeout
    return function(...args) {
        clearTimeout(timeout)
        timeout = setTimeout(() => fn.apply(this, args), wait)
    }
}

export default class extends Controller {
    connect() {
        // On crée ici la version « debounced » de la soumission
        this.debouncedSubmit = debounce(this.submit.bind(this), 300)
    }

    // Méthode appelée par l’input :
    submit(event) {
        // si on a un événement, on empêche son comportement par défaut
        if (event) event.preventDefault()
        this.element.requestSubmit()
    }
}
