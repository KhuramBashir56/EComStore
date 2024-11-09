import forms from '@tailwindcss/forms';

export default {
    content: [
        './resources/views/**/*.blade.php',
        './app/livewire/**/*.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            screens: {
                'xs': '425px',
                '2xs': '320px',
            },
            colors: {
                primary: {
                    50: '#e7e8fd',
                    100: '#b7b9fa',
                    200: '#878bf7',
                    300: '#575cf4',
                    400: '#0f17f0',
                    500: '#070a6e',
                    600: '#060960',
                    700: '#050748',
                    800: '#030530',
                    900: '#020218',
                    950: '#000000',
                },
                secondary: {
                    50: '#ffe1cc',
                    100: '#ffa666',
                    200: '#ff974d',
                    300: '#ff8833',
                    400: '#ff791a',
                    500: '#ff6c00',
                    600: '#e66000',
                    700: '#cc5500',
                    800: '#b34a00',
                    900: '#994000',
                    950: '#803500',
                },
            },
        },
    },
    plugins: [forms],
};

