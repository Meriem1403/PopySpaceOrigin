import { Controller } from '@hotwired/stimulus';
import { Datepicker } from 'flowbite-datepicker';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    datepicker;

    connect() {
        // On force en text pour pouvoir injecter le datepicker
        this.element.type = 'text';

        this.datepicker = new Datepicker(this.element, {
            format: 'yyyy-mm-dd',    // ISO, facile à stocker en BDD
            autohide: true,
            // Si on est dans une <dialog> ouverte (modal), on y attache le calendrier
            container: document.querySelector('dialog[open]') || 'body'
        });
    }

    disconnect() {
        if (this.datepicker) {
            this.datepicker.destroy();
        }
        // On remet le type html5 d’origine au cas où
        this.element.type = 'date';
    }
}
