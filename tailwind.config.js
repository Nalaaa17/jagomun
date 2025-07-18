/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'navy': '#1E2233',
                'royal': '#2D3B61',
                'gold': '#B4976B',
                'champagne': '#D6C4A4',
                'ivory': '#F2EFEA'
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'fadeInUp': 'fadeInUp 0.8s ease-out',
                'slideInLeft': 'slideInLeft 0.8s ease-out',
                'slideInRight': 'slideInRight 0.8s ease-out',
                'bounce-slow': 'bounce 3s infinite',
                'pulse-slow': 'pulse 4s infinite',
                'typing': 'typing 3.5s steps(40, end) forwards, blink-caret 0.5s step-end 0 forwards',
                'toss-away': 'toss-away 0.7s forwards cubic-bezier(0.6, 0.04, 0.98, 0.335)',
                'return-from-side': 'return-from-side 0.7s forwards cubic-bezier(0.23, 1, 0.32, 1)',
                'settle-in-front': 'settle-in-front 0.6s forwards cubic-bezier(0.23, 1, 0.32, 1)',
                'move-to-next': 'move-to-next 0.6s forwards cubic-bezier(0.23, 1, 0.32, 1)',
                'fadeIn': 'fadeIn 0.5s ease',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                    '25%': { transform: 'translateY(-10px) rotate(1deg)' },
                    '50%': { transform: 'translateY(-20px) rotate(0deg)' },
                    '75%': { transform: 'translateY(-10px) rotate(-1deg)' },
                },
                fadeInUp: {
                    'from': { opacity: '0', transform: 'translateY(50px)' },
                    'to': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInLeft: {
                    'from': { opacity: '0', transform: 'translateX(-50px)' },
                    'to': { opacity: '1', transform: 'translateX(0)' },
                },
                slideInRight: {
                    'from': { opacity: '0', transform: 'translateX(50px)' },
                    'to': { opacity: '1', transform: 'translateX(0)' },
                },
                typing: {
                    'from': { width: '0' },
                    'to': { width: '100%' },
                },
                'blink-caret': {
                    'from, to': { borderColor: 'transparent' },
                    '50%': { borderColor: '#B4976B' },
                },
                'toss-away': {
                    '0%': { transform: 'translate3d(0, 0, 0) rotate(0)' },
                    '30%': { transform: 'translate3d(20%, -10%, 0) rotate(5deg) scale(1.05)' },
                    '100%': { transform: 'translate3d(150%, 20%, -200px) rotate(35deg) scale(0.5)', opacity: '0' },
                },
                'return-from-side': {
                    '0%': { transform: 'translate3d(-150%, 0, -200px) rotate(-35deg) scale(0.7)', opacity: '0' },
                    '70%': { transform: 'translate3d(0, 0, 0) rotate(0) scale(1.05)', opacity: '1' },
                    '100%': { transform: 'translate3d(0, 0, 0) scale(1)', opacity: '1' },
                },
                'settle-in-front': {
                    '0%': { transform: 'translate3d(0, 2%, 0) scale(0.9)', zIndex: '2' },
                    '70%': { transform: 'translate3d(0, 0, 0) scale(1.05)', zIndex: '3' },
                    '100%': { transform: 'translate3d(0, 0, 0) scale(1)', zIndex: '3' },
                },
                'move-to-next': {
                    'from': { transform: 'translate3d(0, 0, 0) scale(1)', zIndex: '3' },
                    'to': { transform: 'translate3d(0, 2%, 0) scale(0.9)', zIndex: '2' },
                },
                fadeIn: {
                    'from': { opacity: '0', transform: 'translateY(10px)' },
                    'to': { opacity: '1', transform: 'translateY(0)' },
                }
            }
        },
    },
    plugins: [],
}
