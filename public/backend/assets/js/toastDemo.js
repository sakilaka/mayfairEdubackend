(function ($) {
  showSuccessToast = function (message) {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: message,
      showHideTransition: 'slide',
      icon: 'success',
      loaderBg: '#f96868',
      position: 'top-right',
      textColor: '#FFFFFF'
    })
  };
  showDangerToast = function (message) {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Failed',
      text: message,
      showHideTransition: 'slide',
      icon: 'error',
      loaderBg: '#f2a654',
      position: 'top-right',
      textColor: '#FFFFFF'
    })
  };

  resetToastPosition = function () {
    $('.jq-toast-wrap').removeClass(
      'bottom-left bottom-right top-left top-right mid-center');
    $(".jq-toast-wrap").css({
      "top": "",
      "left": "",
      "bottom": "",
      "right": ""
    });
  }
})(jQuery);