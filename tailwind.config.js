import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Primary Colors
                primary: {
                    DEFAULT: '#4F46E5',
                    hover: '#4338CA',
                },
                // Background & Surface
                bg: {
                    primary: '#F9FAFB',
                    surface: '#FFFFFF',
                },
                // Text Colors
                text: {
                    primary: '#111827',
                    secondary: '#6B7280',
                },
                // Border
                border: {
                    light: '#E5E7EB',
                },
                // Status Colors
                status: {
                    success: '#10B981',
                    warning: '#F59E0B',
                    danger: '#EF4444',
                },
            },
            borderRadius: {
                card: '12px',
                btn: '8px',
                input: '8px',
                modal: '16px',
            },
            boxShadow: {
                card: '0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06)',
                modal: '0 20px 25px -5px rgba(0,0,0,0.1)',
                input: '0 0 0 3px rgba(79,70,229,0.1)',
            },
            spacing: {
                gutter: '24px',
            },
            fontSize: {
                xxs: '0.75rem',
                xs: '0.75rem',
                sm: '0.875rem',
                base: '0.875rem',
                lg: '1rem',
                '2xl': '1.5rem',
                '3xl': '1.875rem',
            },
        },
    },

    plugins: [forms],
};
