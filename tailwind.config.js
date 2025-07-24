/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './templates/**/*.html.twig',
        './assets/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                'popy-dark': '#2e2b65',
                'popy-primary': '#63478f',
                'popy-accent': '#ba748d',
                'popy-info': '#4e7198',
                'popy-light': '#8bdbdc',
                'popy-white': '#ffffff',
            },
        },
    },
    plugins: [],
}
