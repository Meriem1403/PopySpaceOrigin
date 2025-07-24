import * as Turbo from '@hotwired/turbo';
import './bootstrap.js';
import './styles/app.css';
import alienGreeting from './lib/alienGreeting.js';
import { shouldPerformTransition, performTransition } from 'turbo-view-transitions';
import JSConfetti from 'js-confetti';

// Message d’accueil personnalisé
alienGreeting('Bienvenue sur PopySpaceOrigin !', true);

// Transitions Turbo + animation douce lors des changements de vues
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
    // Affichage de confettis galactiques à l’arrivée sur une page
    const jsConfetti = new JSConfetti();

    jsConfetti.addConfetti({
        emojis: ['🚀', '🪐', '👾', '✨', '🌌'],
        confettiRadius: 6,
        confettiNumber: 60,
    });

    // Turbo cache désactivé pour éviter les glitches visuels (optionnel)
    // if (shouldPerformTransition()) Turbo.cache.exemptPageFromCache();
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
