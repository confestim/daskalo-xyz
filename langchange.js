$(document).ready(function () {
  // By default
  $(".en_lang").addClass("active-lang");
  $("#lang-switch .en").addClass("active-flag");

  // Function switch
  $(function () {
    // French button
    $("#lang-switch .fr").click(function () {
      // Enable French
      $(".fr_lang").addClass("active-lang");

      // Disable English
      $(".en_lang").removeClass("active-lang");

      // Active or remove the opacity on the flags.
      $("#lang-switch .fr").addClass("active-flag");
      $("#lang-switch .en").removeClass("active-flag");
    });

    // English button
    $("#lang-switch .en").click(function () {
      // Enable English
      $(".en_lang").addClass("active-lang");

      // Disable French
      $(".fr_lang").removeClass("active-lang");

      // Active or remove the opacity on the flags.
      $("#lang-switch .en").addClass("active-flag");
      $("#lang-switch .fr").removeClass("active-flag");
    });
  });
});
