jQuery(document).ready(function() {
  jQuery(".dorar-modal .close").click(function() {
    jQuery(".dorar-modal").hide();
  });

  // get all button
  jQuery(".dorar-takhrij-btn").click(function(e) {
    // get id
    var id = e.currentTarget.id;
    // get hadith text with this id
    var hadith = jQuery("#" + id + ".dorar-hadith").text();
    // open modal

    var modal = jQuery("#" + id + ".dorar-modal");
    modal.css("display", "block");

    modal
      .find(".dorar-modal-body")
      .html("<p style='color:red;'>جاري عملية البحث</p>");
    jQuery.get(
      {
        url: "http://dorar.net/dorar_api.json?skey=" + hadith,
        dataType: "jsonp"
      },
      function(data) {
        modal.find(".dorar-modal-body").html(data.ahadith.result);
      }
    );

    jQuery("body").click(function(e) {
      if (jQuery(e.target).is(modal)) {
        modal.hide();
      }
    });
  });
});
