/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  daisyui: {
    themes: ["light", "dark", "forest", "dracula"],
  },
  plugins: [
    require("daisyui"), 
    require("@tailwindcss/typography")
  ],
}
