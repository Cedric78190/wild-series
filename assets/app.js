/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

console.log('Hello Webpack Encore !');

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// assets/app.js

// returns the final, public path to this file
// path is relative to this file - e.g. assets/images/logo.png


//  import logoPath from '../images/logo.png';

//   let html = `<img src="${logoPath}" alt="ACME logo">`;

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// import logoPath from '../images/logo.png';

// let html = `<img src="${logoPath}" alt="ACME logo">`;
