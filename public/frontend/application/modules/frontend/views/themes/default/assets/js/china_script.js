$(document).ready(function() {
  $(".filter-open").on("click", function() {
    if (window.innerWidth < 768) {
      $(".wrapper-filters").css({ display: "block" });
      $(this).css({ display: "none" });
      $(".filter-opened").css({ display: "inline" });
    }
  });

  $(".filter-opened").on("click", function() {
    if (window.innerWidth < 768) {
      $(".wrapper-filters").css({ display: "none" });
      $(this).css({ display: "none" });
      $(".filter-open").css({ display: "inline" });
    }
  });
  $(window).resize(function() {
    if (window.innerWidth >= 768) {
      $(".wrapper-filters").css({ display: "block" });
    }
  });

  $(".check-card").on("click", function() {
    if (
      $(this)
        .parents(".display-flex")
        .hasClass("active-cart")
    ) {
      $(this)
        .parents(".display-flex")
        .removeClass("active-cart");
    } else {
      $(this)
        .parents(".display-flex")
        .addClass("active-cart");
    }
  });

  $(".toggle-header").on("click", function() {
    var vm = this,
      filterslistItem = $(vm).data();

    function completed() {
      if (
        $(
          ".toggle-content[data-filters=" + filterslistItem.filterslist + "]"
        ).css("display") == "none"
      ) {
        $(vm)
          .find(".toggle-icon")
          .css({
            transform: "rotate(-45deg)"
          });
      } else {
        $(vm)
          .find(".toggle-icon")
          .css({
            transform: "rotate(135deg)"
          });
      }
      return false;
    }

    $(
      ".toggle-content[data-filters=" + filterslistItem.filterslist + "]"
    ).toggle("blind", 500, completed());
  });

  $(".tab-link")
    .find("a")
    .on("click", event => {
      var el = event.target;
      if ($(el).hasClass("can-back")) {
        tab($(el).data("to"));
      }
    });

  function tab(el) {
    $(".wrapper-tabs")
      .children(".tab")
      .removeClass("active");
    $(".wrapper-tabs")
      .children('.tab[data-tab="' + el + '"]')
      .addClass("active");
  }

  // $("#accordion").accordion({ collapsible: true, active: false });
});
