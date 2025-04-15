/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./assets/css/**/*.css",
  ],

  theme: {
    extend: {
      spacing: {
        128: "32rem", // `mr-128` = 32rem (512px)
        144: "36rem", // `mr-144` = 36rem (576px)
        160: "40rem", // `mr-160` = 40rem (640px)
        192: "48rem", // `mr-192` = 48rem (768px)
        256: "64rem", // `mr-256` = 64rem (1024px)
      },
    },
  },

  plugins: [],
};
