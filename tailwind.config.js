/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        "./modules/frontend/src/js/**/*.{js,vue}",
        "./templates/**/*.{twig,svg}",
    ],
    theme: {
        extend: {
            colors: {
                'brand': colors.sky,
                'gray': colors.slate
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography')
    ],
}
