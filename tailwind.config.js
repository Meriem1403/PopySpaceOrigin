// tailwind.config.js (à la racine du projet)
const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./vendor/tales-from-a-dev/flowbite-bundle/templates/**/*.html.twig",
        "./src/Twig/Components/**/*.php",
    ],
    darkMode: 'media',
    theme: {
        extend: {
            animation: {
                'fade-in': 'fadeIn .5s ease-out',
                wiggle: 'wiggle 1s ease-in-out infinite',
            },
            keyframes: {/*…*/}
        },
    },

    safelist: [
        'border-gray-600',
        'bg-gray-800',
        'text-white',
        'bg-transparent',
        'bg-gray-700',
        'text-gray-400',
        'border-gray-500',
        'bg-gray-600',
        'rounded-md',
        'shadow-md',
        'border-transparent',
        'border-t-white',
        'dark:border-t-gray-900',
    ],
    // –––––––––––––––––––––––––––––––––

    plugins: [
        plugin(function({ addVariant }) {
            addVariant('turbo-frame', 'turbo-frame[src] &');
            addVariant('modal', 'dialog &');
        }),
    ],
}
