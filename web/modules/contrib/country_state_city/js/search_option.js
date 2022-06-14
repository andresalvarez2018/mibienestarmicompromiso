(function ($, Drupal) {
  Drupal.behaviors.search_option = {
    attach: function (context, settings) {
      $(".csc-country-details").select2();
      $(".csc-state-details").select2();
      $(".csc-city-details").select2();
    }
  };
})(jQuery, Drupal);