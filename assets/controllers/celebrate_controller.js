// assets/controllers/celebrate_controller.js
import { Controller } from '@hotwired/stimulus';
import JSConfetti from 'js-confetti';

export default class extends Controller {
    connect() {
        // on instancie une seule fois
        this.jsConfetti = new JSConfetti();
    }

    // appelé par data-action="mouseover->celebrate#poof"
    poof() {
        this.jsConfetti.addConfetti();
    }
}
