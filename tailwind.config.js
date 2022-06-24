/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
    content: ["./modules/frontend/src/js/**/*.{js,vue}"],
    theme: {
        extend: {
            colors: {
                'brand': colors.blue
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography')
    ],
}
