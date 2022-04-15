const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'primary':'#04F06A',
                'brown':'#5b362a',
                'blue':'#1e3888',
                'white':'#fffcf9',
                'black':'#040101',
                'red':'#801500',
                'yellow':'#F3B61F'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
