/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
global.$ = global.jQuery = $;
require('bootstrap');
$(document).ready(function() {
  //plugins bootstrap
  // data-bs-toggle est dans le template
  // l'argument d'appel du plugin
     $('[data-bs-toggle="popover"]').popover();
     $('[data-bs-toggle="tooltip"]').tooltip();
     $('[data-bs-toggle="modal"]').modal();
     $('[data-bs-toggle="collapse"]').collapse();
     $('[data-bs-toggle="dropdown"]').dropdown();
 });
