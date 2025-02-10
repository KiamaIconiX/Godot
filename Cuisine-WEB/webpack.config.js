const Encore = require('@symfony/webpack-encore');
const path = require('path');

Encore
    // Répertoire de sortie
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    // Fichier d'entrée
    .addEntry('app', './assets/app.js')

    // Active Vue.js
    .enableVueLoader()

    // Ajoute cette ligne pour corriger l'erreur
    .enableSingleRuntimeChunk()

    // Autres configurations ici...

module.exports = Encore.getWebpackConfig();
