import * as Turbo from '@hotwired/turbo';
import './bootstrap.js';
import './styles/app.css';
import 'flowbite';
import alienGreeting from './lib/alien-greeting.js';
import TomSelect from 'tom-select'; // ✅ Import de Tom Select
import { shouldPerformTransition, performTransition } from 'turbo-view-transitions';

// alien hello 👽
alienGreeting('Give us all your candy!', false);

// Transition automatique
let skipNextRenderTransition = false;
document.addEventListener('turbo:before-render', (event) => {
    if (shouldPerformTransition() && !skipNextRenderTransition) {
        event.preventDefault();

        performTransition(document.body, event.detail.newBody, async () => {
            await event.detail.resume();
        });
    }
});

document.addEventListener('turbo:load', () => {
    // Exclut la page du cache turbo si nécessaire
    // if (shouldPerformTransition()) Turbo.cache.exemptPageFromCache();

    // ✅ Initialise Tom Select sur les <select.tom-select>
    document.querySelectorAll('select.tom-select').forEach((select) => {
        new TomSelect(select, {
            create: false,
            sortField: {
                field: 'text',
                direction: 'asc'
            }
        });
    });
});

document.addEventListener('turbo:before-frame-render', (event) => {
    if (shouldPerformTransition() && !event.target.hasAttribute('data-skip-transition')) {
        event.preventDefault();

        skipNextRenderTransition = true;
        setTimeout(() => {
            skipNextRenderTransition = false;
        }, 100);

        performTransition(event.target, event.detail.newFrame, async () => {
            await event.detail.resume();
        });
    }
});
