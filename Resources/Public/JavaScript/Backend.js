/**
 * Main JavaScript for Backend Module
 */

define(
  [
    'jquery',
    'TYPO3/CMS/MomoPreciousmetal/Chart'
  ],
  function ($) {
    var Module = {};

    // Initialize
    Module.initialize = function () {
      Module.renderLineChart('aurum-eur', data_eur, labels_eur);
      Module.renderLineChart('aurum-usd', data_usd, labels_usd);
    };

    Module.renderLineChart = function (id, data, labels) {
      let canvas = document.getElementById(id);
      let chart = new Chart(canvas, {
        "type": "line",
        "data": {
          "labels": labels,
          "datasets": [{
            "label": "Aurum rates",
            "data": data,
            "fill":false,
            "borderColor":"rgb(255, 215, 0)",
            "lineTension":0.1
          }],
        }
      });
    };

    // Initialize
    $(document).ready(function () {
      if ($("#aurum-eur").length) {
        Module.initialize();
      }
    });
  }
);
