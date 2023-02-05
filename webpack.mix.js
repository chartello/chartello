let mix = require("laravel-mix");

mix
  .js("resources/js/app.js", "js")
  .postCss("resources/css/app.css", "css")
  .vue({ version: 3 })
  .setPublicPath("public");
