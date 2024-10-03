(function ($) {
  "use strict";
  $("document").ready(function () {
    //    ========= its for rating star ==============
    var base_url = $("#base_url").val();
    $('[data-toggle="tooltip"]').tooltip();
    var session_id = $("#session_id").val();
    var cart_contents = $("#cart_contents").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var enterprise_id = $("#enterprise_id").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    // alert(cart_contents);alert(session_id);
    if (cart_contents && !session_id) {
      $.ajax({
        url: base_url + enterprise_shortname + "/student-signinform",
        type: "POST",
        data: { csrf_test_name: CSRF_TOKEN },
        success: function (r) {
          $(".modal_ttl").html("Login to your account");
          $("#info").html(r);
          $("#modal_info").modal("show");
        },
      });
    }

    var segment2 = $("#segment2").val();
    if (segment2 == "student-dashboard") {
      $(".student-dashboard").addClass("active");
    } else if (segment2 == "student-profile-dashboard") {
      $(".student-profile-dashboard").addClass("active");
    } else if (segment2 == "student-profile-show") {
      $(".student-public-view").addClass("active");
    } else if (segment2 == "student-activity") {
      $(".student-activity").addClass("active");
    } else if (segment2 == "student-notification") {
      $(".student-notification").addClass("active");
    } else if (segment2 == "student-settings-account") {
      $(".student-settings-account").addClass("active");
      $(".settings-account").addClass("active");
    } else if (segment2 == "student-settings-notification") {
      $(".student-settings-account").addClass("active");
      $(".settings-notification").addClass("active");
    } else if (segment2 == "student-settings-payments") {
      $(".student-settings-account").addClass("active");
      $(".settings-payments").addClass("active");
    }

    // $("#defaults").raty({
    //   starHalf:
    //     base_url +
    //     "/application/modules/frontend/views/themes/default/assets/plugins/raty/lib/images/star-half.png",
    //   starOff:
    //     base_url +
    //     "/application/modules/frontend/views/themes/default/assets/plugins/raty/lib/images/star-off.png",
    //   starOn:
    //     base_url +
    //     "/application/modules/frontend/views/themes/default/assets/plugins/raty/lib/images/star-on.png",
    //     score: 3,
    //   hints: [
    //     ["Very Poor", "Very Poor"],
    //     ["Poor", "Poor"],
    //     ["Neutral", "Neutral"],
    //     ["Satisfactory", "Satisfactory"],
    //     ["Delightfull", "Delightfull"],
    //   ],
    //   target: "#hint",
    // });

    // var rating_success_msg = $("#rating_success_msg").val();
    // if (rating_success_msg) {
    //     toastrSuccessMsg("Rating submitted successfully");
    // }

    /* ---------------------------------------------
         Pre loader loader
         --------------------------------------------- */
    setTimeout(function () {
      $(".se-pre-con").fadeOut("slow");
    }, 3000);
    //   ==========these script must be here. its for order submited  ============
    var popup = $("#popup").val();
    if (popup == 1) {
      setTimeout(function () {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          timeOut: 1500,
          onHidden: function () {
            // window.location.reload();
          },
        };
        toastr.success("Order submited successfully!");
      }, 1000);
    }
    //      ========== close order submited ===========
// ---------------------- its for language -----------------
    let setLanguage = $('#set_language').val();
    if(setLanguage == "en"){
      $('#courseCart').load(location.href + " #courseCart");
    }else if(setLanguage == "bn"){
      En2BnStaticText();
      $('#courseCart').load(location.href + " #courseCart");
    }
    // -------------------- close language -------------------

    // ---------------------- owlCarousel -------------------

    $(".about_carousel").owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots: false,
      navText: [
          "<i class='fas fa-caret-left'></i>",
          "<i class='fas fa-caret-right'></i>",
      ],
      items: 1,
      });

      $(".mess-carousel").owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        dots: false,
        navText: [
            "<i class='fas fa-caret-left'></i>",
            "<i class='fas fa-caret-right'></i>",
        ],
        items: 3,
        });

// ---------------------- owlCarousel -------------------

    //    ======== its for confirm_btn ==========
    $("body").on("click", "#confirm_btn", function () {
      var name = $("#name").val();
      var email = $("#mail").val();
      var mobile = $("#mobile").val();
      var address = $("#address").val();
      var country_id = $("#country_id").val();
      var city = $("#city").val();
      var state = $("#state").val();
      var account_check = $("#account_check").val();
      var password = $("#pass").val();
      var confirm_password = $("#confirmpw").val();

      if (name == "") {
        $("#name").focus();
        toastrErrorMsg("Name  required!");
        return false;
      }
      if (email == "") {
        $("#mail").focus();
        toastrErrorMsg("Email address required!");
        return false;
      }
      if (IsEmail(email) == false) {
        toastrErrorMsg("Your email is invalid!");
        return false;
      }

      if (mobile == "") {
        $("#mobile").focus();
        toastrErrorMsg("Mobile No required!");
        return false;
      }

	  /*
	  if (address == "") {
        $("#address").focus();
        toastrErrorMsg("Address required!");
        return false;
      }
      if (country_id == "") {
        $("#country_id").focus();
        toastrErrorMsg("Country must be required");
        return false;
      }
      if (city == "") {
        $("#city").focus();
        toastrErrorMsg("City  required");
        return false;
      }
      if (state == "") {
        $("#state").focus();
        toastrErrorMsg("State must be required");
        return false;
      }
	  */

      // alert(account_check);return false;
      if (account_check == 1) {
        if (password == "") {
          $("#pass").focus();
          toastrErrorMsg("Password must be required");
          return false;
        }
        if (confirm_password == "") {
          $("#confirmpw").focus();
          toastrErrorMsg("Confirm password must be required");
          return false;
        }
      }

      // ======= its for password and confirm password check ===========
      if (password != confirm_password) {
        toastrErrorMsg("Confirm password does not match");
        $("#confirmpw").val("");
        $("#confirmpw").focus();
        return false;
      }

      if (!$(".p_method").is(":checked")) {
        toastrErrorMsg("Select a payment method!");
        return false;
      }

      // $(this).prop("disabled",true);

      // $(this).attr('disabled','disabled');

      //setTimeout(' window.location.href = "index.php"; ',4000);

    });
//    ============= otp check form ==========
     $("#otpcheckform").on("keypress", function (e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        otpsubmit();
      }
    });
    // login form
    $("#myform").on("keypress", function (e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        loginProcess(5);
      }
    });
    $("#learner_myform").on("keypress", function (e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        loginProcess(4);
      }
    });
    $("#affiliator_myform").on("keypress", function (e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        loginProcess(7);
      }
    });
    // student signup
    $("#student").on("keypress", function (e) {
      if (e.keyCode == 13) {
        var usertype = $("#usertype").val();
        e.preventDefault();
        // register_save(usertype);
      }
    });
    $(document).on("keypress", "input,select,select2", function (e) {
      if (e.which == 13) {
        e.preventDefault();
      }
    });

    //========== its for typeahead autocomplete =============
    // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    // $('input.typeahead').typeahead({
    //     highlight: true,
    //     minLength: 1,
    //     source: function (query, result) {
    //         $.ajax({
    //             url: base_url + "autocomplete-course-search",
    //             data: {'csrf_test_name': CSRF_TOKEN, query: query},
    //             dataType: "json",
    //             type: "POST",
    //             success: function (data) {
    //                 result($.map(data, function (item) {
    //                     return item.name;
    //                 }));
    //             },
    //         });
    //     }
    // });

    /*------------------------------------     Payment collapse     -------------------------------------- */
    // $('.payment-item label').on('click', function (event) {
    //     if ($(this).next().hasClass('in')) {
    //         $(this).next().collapse('show');
    //     } else {
    //         $(this).parents('.payment-block').find('.collapse').collapse('hide');
    //         $(this).next().collapse('show');
    //     }

    // });

    //============= its for course details progress bar ============
    // var progress_bar_5 = $(".progress_bar_5").val();
    // var progress_bar_4 = $(".progress_bar_4").val();
    // var progress_bar_3 = $(".progress_bar_3").val();
    // var progress_bar_2 = $(".progress_bar_2").val();
    // var progress_bar_1 = $(".progress_bar_1").val();

    // $(".progressbar_5").css({'width': progress_bar_5});
    // $(".progressbar_4").css({'width': progress_bar_4});
    // $(".progressbar_3").css({'width': progress_bar_3});
    // $(".progressbar_2").css({'width': progress_bar_2});
    // $(".progressbar_1").css({'width': progress_bar_1});

    // =========== its for proficiency typehead start==============
    
    // =========== its for proficiency typehead close==============

    //    ============ its for is popular value add ============
    $("body").on("click", "#agree-to-terms", function () {
      if ($("#agree-to-terms").is(":checked")) {
        $("#agree-to-terms").attr("value", "1");
      } else {
        $("#agree-to-terms").attr("value", "0");
      }
    });
    //    ============ its for is resumeshow value add ============
    $("body").on("click", "#is_resumeshow", function () {
      if ($("#is_resumeshow").is(":checked")) {
        $("#is_resumeshow").attr("value", "1");
      } else {
        $("#is_resumeshow").attr("value", "0");
      }
    });
    //    ============ its for is profileshow value add ============
    $("body").on("click", "#is_profileshow", function () {
      if ($("#is_profileshow").is(":checked")) {
        $("#is_profileshow").attr("value", "1");
      } else {
        $("#is_profileshow").attr("value", "0");
      }
    });
    //    ============ its for is biographyshow value add ============
    $("body").on("click", "#is_biographyshow", function () {
      if ($("#is_biographyshow").is(":checked")) {
        $("#is_biographyshow").attr("value", "1");
      } else {
        $("#is_biographyshow").attr("value", "0");
      }
    });
    //    ============ its for is skillshow value add ============
    $("body").on("click", "#is_skillshow", function () {
      if ($("#is_skillshow").is(":checked")) {
        $("#is_skillshow").attr("value", "1");
      } else {
        $("#is_skillshow").attr("value", "0");
      }
    });
    //    ============ its for is proficiencyshow value add ============
    $("body").on("click", "#is_proficiencyshow", function () {
      if ($("#is_proficiencyshow").is(":checked")) {
        $("#is_proficiencyshow").attr("value", "1");
      } else {
        $("#is_proficiencyshow").attr("value", "0");
      }
    });
    //    ============ its for is experienceshow value add ============
    $("body").on("click", "#is_experienceshow", function () {
      if ($("#is_experienceshow").is(":checked")) {
        $("#is_experienceshow").attr("value", "1");
      } else {
        $("#is_experienceshow").attr("value", "0");
      }
    });
    //    ============ its for is educationshow value add ============
    $("body").on("click", "#is_educationshow", function () {
      if ($("#is_educationshow").is(":checked")) {
        $("#is_educationshow").attr("value", "1");
      } else {
        $("#is_educationshow").attr("value", "0");
      }
    });
    //    ============ its for is hiringshow value add ============
    $("body").on("click", "#is_hiringshow", function () {
      if ($("#is_hiringshow").is(":checked")) {
        $("#is_hiringshow").attr("value", "1");
      } else {
        $("#is_hiringshow").attr("value", "0");
      }
    });
    //    ============ its for is contactshow value add ============
    $("body").on("click", "#is_contactshow", function () {
      if ($("#is_contactshow").is(":checked")) {
        $("#is_contactshow").attr("value", "1");
      } else {
        $("#is_contactshow").attr("value", "0");
      }
    });
    //    ============ its for is contacttitle value add ============
    $("body").on("click", "#is_contacttitle", function () {
      if ($("#is_contacttitle").is(":checked")) {
        $("#is_contacttitle").attr("value", "1");
      } else {
        $("#is_contacttitle").attr("value", "0");
      }
    });
    //    ============ its for is certificateshow value add ============
    $("body").on("click", "#is_certificateshow", function () {
      if ($("#is_certificateshow").is(":checked")) {
        $("#is_certificateshow").attr("value", "1");
      } else {
        $("#is_certificateshow").attr("value", "0");
      }
    });
    //    ============ its for is visibilityOnPort value add ============
    $("body").on("click", "#visibilityOnPort", function () {
      if ($("#visibilityOnPort").is(":checked")) {
        $("#visibilityOnPort").attr("value", "1");
      } else {
        $("#visibilityOnPort").attr("value", "0");
      }
    });
    //    ============ its for is getfeatured value add ============
    $("body").on("click", "#getfeatured", function () {
      if ($("#getfeatured").is(":checked")) {
        $("#getfeatured").attr("value", "1");
      } else {
        $("#getfeatured").attr("value", "0");
      }
    });
  });
})(jQuery);

var base_url = $("#base_url").val();
var CSRF_TOKEN = $("#CSRF_TOKEN").val();
var enterprise_id = $("#enterprise_id").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var user_id = $("#user_id").val();
//=========== its for valid mail check ===============
("use strict");
function IsEmail(email) {
  var regex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!regex.test(email)) {
    return false;
  } else {
    return true;
  }
}
// //=========== its for create_account  ============
// $(".password_area").css({ display: "none" });
// ("use strict");
// function create_account() {
//   if ($("input#account_check").is(":checked")) {
//     $(".password_area").slideToggle();
//   } else {
//     $(".password_area").slideToggle();
//   }
//   if ($("#account_check").is(":checked")) {
//     $("#account_check").attr("value", "1");
//   } else {
//     $("#account_check").attr("value", "0");
//   }
// }

// //============ its for shipping_address_status ============
// $(".shipping_area").css({'display': 'none'});
// "use strict";
// function shipping_address_status() {
//     if ($('input#is_different').is(':checked')) {
//         $(".shipping_area").slideToggle();
//     } else {
//         $(".shipping_area").slideToggle();
//     }
//     if ($('#is_different').is(':checked')) {
//         $('#is_different').attr('value', '1');
//     } else {
//         $('#is_different').attr('value', '0');
//     }
// }

// //            ========= its for toastr error message =============
("use strict");
function toastrErrorMsg(r) {
  setTimeout(function () {
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: "slideDown",
      timeOut: 1500,
    };
    toastr.error(r);
  }, 1000);
}
// //            ========= its for toastr success message =============
("use strict");
function toastrSuccessMsg(r) {
  setTimeout(function () {
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: "slideDown",
      timeOut: 1500,
      onHidden: function () {
        window.location.reload();
      },
    };
    toastr.success(r);
  }, 1000);
}

("use strict");
function get_explorecourse(type, id, sl) {
  var enterprise_id = $("#enterprise_id").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/get-explorecourse",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      type: type,
      id: id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      $(".tabidload").attr("id", "tab_" + sl);
      // alamin change here  16/7/21
      $(".firstbutton").hide();
      $("#course_type").val(type);
      $("#category_id").val(id);
      $(".loadexplorecourse").html(r);

      $(".hideClass .course").each(function (index) {
        var p_course_id = $(this).attr("id");
        $("#course_subscription_" + p_course_id)
          .first()
          .hide();
        $("#course_subscription_" + p_course_id)
          .first()
          .removeClass("d-flex");
      });
      $(".popup-youtube").YouTubePopUp();

      // alert(id);
    },
  });
}

// alamin  change here 16/7/21
// load more index page
function loadmore_data(ids) {
  var course_type = $("#course_type").val();
  var enterprise_shortname = $("#enterprise_shortname").val();
  // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
  $.ajax({
    type: "POST",
    url: base_url + enterprise_shortname + "/get-explorecourse-load-more",
    cache: false,
    data: {
      lastid: ids,
      course_type: course_type,
      enterprise_shortname: enterprise_shortname,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (response) {
      $("#alldata").append(response);
      // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
      //remove old load more button
      $("#home_course_load" + ids).remove();
      $(".removebuton_" + ids).remove();

      $(".hideClass .course").each(function (index) {
        var p_course_id = $(this).attr("id");
        $("#course_subscription_" + p_course_id)
          .first()
          .hide();
        $("#course_subscription_" + p_course_id)
          .first()
          .removeClass("d-flex");
      });
      $(".popup-youtube").YouTubePopUp();
    },
  });
}
//$(".home_course_load").on("click", function () {
// var ids = $(this).attr("id");
// alert(ids);
// var course_type = $("#course_type").val();
// //    alert(course_type);
// // var category_id= $("#category_id").val();
// var enterprise_shortname = $("#enterprise_shortname").val();
// // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
// $.ajax({
//   type: "POST",
//   url: base_url + enterprise_shortname + "/get-explorecourse-load-more",
//   cache: false,
//   data: {
//     lastid: ids,
//     course_type: course_type,
//     enterprise_shortname: enterprise_shortname,
//     csrf_test_name: CSRF_TOKEN,
//   },
//   success: function (response) {
//     //  alert(response);
//     // console.log(response);
//     //  return false;
//     $("#alldata").append(response);
//     // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
//     //remove old load more button
//     $("#home_course_load" + ids).remove();

//   },
// });

//});

("use strict");
function coursesavecheck() {
  toastrErrorMsg("Login required!");
  return false;
}

//    ============= add login form ============
("use strict");
function get_coursesave(status) {
  var user_type = $("#user_type").val();
  var student_id = $("#student_id").val();
  var course_id = $("#course_id").val();
  if (user_type == "") {
    toastrErrorMsg("Login required!");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/get-coursesave",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      status: status,
      student_id: student_id,
      course_id: course_id,
    },
    success: function (r) {
      if (status == 0) {
        toastr["success"]("Unsaved successfully!");
      } else {
        toastr["success"]("Saved successfully!");
      }
      $("#savecourse" + course_id).html(r);
    },
  });
}

("use strict");
function get_coursesaveloop(status, course_id) {
  var user_type = $("#user_type").val();
  // var student_id = $("#student_id").val();
  var student_id = $("#user_id").val();
  if (user_type == "") {
    toastrErrorMsg("Login required!");
    return false;
  }
  $.ajax({
    url: base_url + "/frontend/frontend/get_coursesavelandigpage",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      status: status,
      student_id: student_id,
      course_id: course_id,
    },
    success: function (r) {
      // alert(course_id);
      if (status == 0) {
        // toastr["success"]("Unsaved successfully!");
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
            onHidden: function () {},
          };
          toastr.success("Unsaved successfully!");
        }, 1000);
      } else {
        // toastr["success"]("Saved successfully!");
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
            onHidden: function () {},
          };
          toastr.success("Saved successfully!");
        }, 1000);
      }
      $("#savecourse" + course_id).html(r);

      $("#deleteSavecourse").load(location.href + " #deleteSavecourse");
      $("#countsavedcourse").load(location.href + " #countsavedcourse");
      // toastrSuccessMsg(r);
      //toastr["success"](r);
    },
  });
}

// //    ============= add login form ============
// "use strict";
// function get_loginform() {
//     var base_url = $("#base_url").val();
//     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
//     $.ajax({
//         url: base_url + "login-form",
//         type: "POST",
//         data: {'csrf_test_name': CSRF_TOKEN},
//         success: function (r) {
//             $(".modal_ttl").html("Login to your account");
//             $("#info").html(r);
//             $("#modal_info").modal('show');
//         }
//     });
// }
// //    ============= add faculty register form ============
// "use strict";
// function get_facultyregisterform() {
//     var base_url = $("#base_url").val();
//     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
//     $.ajax({
//         url: base_url + "faculty-register-form",
//         type: "POST",
//         data: {'csrf_test_name': CSRF_TOKEN},
//         success: function (r) {
//             $(".modal_ttl").html("Faculty Registration");
//             $("#info").html(r);
//             $("#modal_info").modal('show');
//         }
//     });
// }
// //    ============= add student register form ============
// "use strict";
// function get_studentregisterform() {
//     var base_url = $("#base_url").val();
//     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
//     $.ajax({
//         url: base_url + "student-register-form",
//         type: "POST",
//         data: {'csrf_test_name': CSRF_TOKEN},
//         success: function (r) {
//             $(".modal_ttl").html("Student Registration");
//             $("#info").html(r);
//             $("#modal_info").modal('show');
//         }
//     });
// }

// ============ its for viewpassword ============
("use strict");
function viewpassword(type) {
  if (type == 1) {
    if ("password" == $("#user_password").attr("type")) {
      $("#user_password").prop("type", "text");
      $(".change-icon-1").html('<i class="far fa-eye-slash"></i>');
    } else {
      $("#user_password").prop("type", "password");
      $(".change-icon-1").html('<i class="fas fa-eye"></i>');
    }
  } else if (type == 2) {
    if ("password" == $("#user_cpassword").attr("type")) {
      $("#user_cpassword").prop("type", "text");
      $(".change-icon-2").html('<i class="far fa-eye-slash"></i>');
    } else {
      $("#user_cpassword").prop("type", "password");
      $(".change-icon-2").html('<i class="fas fa-eye"></i>');
    }
  }else if (type == 4 || type == 5) {
    if ("password" == $("#user_password").attr("type")) {
      $("#user_password").prop("type", "text");
      $(".change-icon").html('<i class="far fa-eye-slash"></i>');
    } else {
      $("#user_password").prop("type", "user_password");
      $(".change-icon").html('<i class="fas fa-eye"></i>');
    }
  }
   
  else if (type == 8) {
    if ("password" == $("#new_password").attr("type")) {
      $("#new_password").prop("type", "text");
      $(".change-icon-2").html('<i class="far fa-eye-slash"></i>');
    } else {
      $("#new_password").prop("type", "password");
      $(".change-icon-2").html('<i class="fas fa-eye"></i>');
    }
  } else if (type == 9) {
    if ("password" == $("#new_password_confirmation").attr("type")) {
      $("#new_password_confirmation").prop("type", "text");
      $(".change-icon-3").html('<i class="far fa-eye-slash"></i>');
    } else {
      $("#new_password_confirmation").prop("type", "password");
      $(".change-icon-3").html('<i class="fas fa-eye"></i>');
    }
  } 
}
// ============ its for viewpassword ============
("use strict");
function viewpasswordSignin(type) {
 if (type == 4) {
    if ("password" == $("#password").attr("type")) {
      $("#password").prop("type", "text");
      $(".change-icon").html('<i class="far fa-eye-slash"></i>');
    } else {
      $("#password").prop("type", "password");
      $(".change-icon").html('<i class="fas fa-eye"></i>');
    }
  }
}

/*

// //================= its for register_save ==========
("use strict");
function register_save(user_type) {
  // $("#exampleModal").modal('show');return false;
  // $(".modalDialog").css({
  //   "font-family": "ubuntu",
  //   position: "fixed",
  //   top: "0",
  //   right: "0",
  //   bottom: "0",
  //   left: "0",
  //   background: "rgba(0, 0, 0, 0.88)",
  //   "z-index": "99999",
  //   "-webkit-transition": "opacity 200ms ease-in",
  //   "-moz-transition": "opacity 200ms ease-in",
  //   transition: "opacity 200ms ease-in",
  // });
  // $(".modalDialog:target").css({
  //   opacity: "1",
  //   "pointer-events": "auto",
  // });
  // $(".modalDialog:target>div").css({
  //   margin: "8% auto",
  // });
  // $(".modalDialog>div").css({
  //   "-webkit-transition": "all 100ms ease-in",
  //   "-moz-transition": "all 100ms ease-in",
  //   transition: "all 100ms ease-in",
  //   width: "600px",
  //   position: "relative",
  //   margin: "5% auto",
  //   background: "#fff",
  //   "min-height": "200px",
  // });
  // return false;
  var name = $("#name").val();
  var mobile = $("#mobile").val();
  var utype = user_type;
  var email = $("#email").val();
  var username = $("#email").val();
  var password = $("#password").val();
  var confirmPassword = $("#password-confirm").val();
  var agree_toterms = $("#agree-to-terms").val();

  // alert(name +'<br />'+ mobile +'<br />'+ utype +'<br />'+ email +'<br />'+ username +'<br />'+ password +'<br />'+ confirmPassword +'<br />'+ agree_toterms +'<br />'+ CSRF_TOKEN);
  // return false;

  if (name == "") {
    $("#name").css({ border: "2px solid red" }).focus();
    toastrErrorMsg("Name must be required!");
    $("#name").focus();
    return false;
  }
  if (mobile == "") {
    $("#mobile").css({ border: "2px solid red" }).focus();
    toastrErrorMsg("Mobile must be required!");
    $("#mobile").focus();
    return false;
  }
  if (utype == "") {
    $("#utype").css({ border: "2px solid red" }).focus();
    toastrErrorMsg("User type must be required!");
    return false;
  }
  if (email == "") {
    $("#email").css({ border: "2px solid red" }).focus();
    toastrErrorMsg("Email must be required!");
    $("#email").focus();
    return false;
  }
  if (IsEmail(email) == false) {
    toastrErrorMsg("Your email is invalid");
    $("#email").focus();
    return false;
  }

  if (password == "") {
    $("#password").css({ border: "2px solid red" }).focus();
    toastrErrorMsg("Password must be required!");
    $("#password").focus();
    return false;
  }
  if ($("#password").val().length < 6) {
    $("#password").css({ border: "2px solid red" }).focus();
    toastrErrorMsg("Need At least 6  Characters!");
    return false;
  }

  if (password != confirmPassword) {
    toastrErrorMsg("Confirm password does not match");
    $("#password-confirm").val("");
    $("#password-confirm").focus();
    return false;
  }
  if (agree_toterms == 0) {
    toastrErrorMsg("Please checked  Terms & Conditions");
    $("#agree-to-terms").focus();
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/register-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      name: name,
      mobile: mobile,
      utype: utype,
      email: email,
      username: username,
      password: password,
      agree_toterms: agree_toterms,
      enterprise_id: enterprise_id,
    },
    beforeSend: function() {
      //$("#product_id").html('<option> Loading ...</option>');
      $(".registerbtn").prop('disabled', true); // disable button
    },
    success: function (r) {
      // alert(utype);
      // console.log(r); return false;
      if (r == "mobileexists") {
        $("#mobile").focus();
        // toastrErrorMsg("Mobile number already exists");
        swal({
          title: "Mobile number already exists",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
        });

        $(".registerbtn").prop('disabled', false);

      } else if (r == "mailexists") {

        $("#email").focus();
        // toastrErrorMsg("Mail already exists");
          swal({
            title: "Mail already exists",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: '#14AD54',
            confirmButtonText: 'OK',
            // cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
          });

        $(".registerbtn").prop('disabled', false);

      } else if (r == "usernameexists") {
        $("#email").focus();
        toastrErrorMsg("Username already exists");
        $(".registerbtn").prop('disabled', false);
      } else if (r == "not_valid_email") {
        $("#email").focus();
        toastrErrorMsg("Please enter valid email");
        $(".registerbtn").prop('disabled', false);
      } else {
        // $("#user_id").val(r);
        $("#name").val("");
        $("#mobile").val("");
        $("#email").val("");
        $("#password").val("");
        $("#password-confirm").val("");
        $("#agree-to-terms").prop("checked") == false;
       // $(".registerbtn").prop('disabled', false); // disable button
        //$('#confirm_btn').prop("disabled",true);
        var src = base_url + "/assets/img/ajax-loader.gif";
        $('.registerbtn').html('<img src= '+ src +' alt="loader" /> &nbsp; Loading...');

        if (utype == 4 || utype == 5) {
          // $("#exampleModal").modal("show");
          // $(".loadotpmodal").html('<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">OTP Modal</button>');
          // location.reload(base_url + enterprise_shortname + otp-check);
          // window.location.href = 'base_url+enterprise_shortname + otp-check';
          $(".registerbtn").prop('disabled', true); // disable button
          var src = base_url + "assets/img/ajax-loader.gif";
          // $(".registerbtn").html('<img src="'+ src +'" /> &nbsp; Loading ...');
          // location.href = base_url + "otp-check";
          var r_link = base_url + "/otp-check";
          $(".registerbtn").html('<img src="'+ src +'" /> &nbsp; Loading ...');
          setTimeout('window.location.href = "'+ r_link +'";',2000);

        }
        // if (utype == 5) {
        //   setTimeout(function () {
        //     swal(
        //       {
        //         title: "Congratulation !!",
        //         text: "Your registration successfully done!",
        //         type: "success",
        //         showCancelButton: false,
        //         confirmButtonColor: "#14AD54",
        //         confirmButtonText: "Ok",
        //         // cancelButtonText: "No",
        //         closeOnConfirm: false,
        //         closeOnCancel: false,
        //       },
        //       function (isConfirm) {
        //         if (isConfirm) {
        //           location.replace(base_url);
        //         } else {
        //           //location.replace(url+'/instructor-courses');
        //         }
        //       }
        //     );
        //   }, 1000);
        // }
      }
    },
  });
}

*/

function resendOtp() {
  // var log_id = $("#user_id").val();
  var log_id = $("#otp_user_id").val();
  if (log_id == "") {
    toastrErrorMsg("Invalid information!");
    return false;
  }

  $(".resendbtn").hide(400);
  setInterval(function () {
    $(".countdown").css({ display: "block" });
  }, 1000);

  var timer2 = "00:59";
  var interval = setInterval(function () {
    var timer = timer2.split(":");
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);
    --seconds;
    minutes = seconds < 0 ? --minutes : minutes;
    if (minutes < 0) clearInterval(interval);
    seconds = seconds < 0 ? 59 : seconds;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $(".countdown").html(minutes + ":" + seconds);
    timer2 = minutes + ":" + seconds;
    // alert(timer2);
    if (timer2 == "0:00") {
      $(".countdown").hide(400);
    }
  }, 1000);

  $.ajax({
    url: base_url + enterprise_shortname + "/resendotp",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      log_id: log_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      // console.log(r);
      setTimeout(function () {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          timeOut: 1500,
        };
        toastr.success(r);
      }, 1000);
    },
  });
}

function otpsubmit() {
  var otp_user_type = $("#otp_user_type").val();
  var log_id = $("#otp_user_id").val();
  var otp = $("#otp").val();

  if (otp == "") {
    setTimeout(function () {
      toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        timeOut: 1500,
      };
      toastr.error("OTP must be required!");
    }, 1000);
    return false;
  }
  if (log_id == "") {
    toastrErrorMsg("Invalid information!");
    return false;
  }
  if(otp_user_type == 7){
    var gotourl = base_url+'affiliate-signin';
    var txtmsg = "Please wait for admin approval!";
  }else{
    var gotourl = base_url+'home';
    var txtmsg = "Your registration successfully done!!";
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/otpsubmit",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      log_id: log_id,
      enterprise_id: enterprise_id,
      otp: otp,
    },

    success: function (r) {
      // console.log(r);
      if (r == "expire") {
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
          };
          toastr.error("Your OTP is Expire!");
        }, 1000);
        $("#otp").val("");
      } else if (r == 1) {
        $("#exampleModal").modal("hide");
        $(".loadotpmodal").html("");
        swal(
          {
            title: "Congratulation !!",
            text: txtmsg,
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#14AD54",
            confirmButtonText: "Ok",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false,
          },
          function (isConfirm) {
            if (isConfirm) {
              location.replace(gotourl);
            }
          }
        );
        $("#otp").val("");
        // location.replace(base_url);
      } else if (r == 0) {
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
          };
          toastr.error("Your OTP is not correct!");
        }, 1000);
        $("#otp").val("");
      }
    },
  });
}

// //    ============= its for is_receive ==============
// "use strict";
// function is_receive() {
//     if ($("#is_receive").is(':checked')) {
//         $('#is_receive').attr('value', '1');
//     } else {
//         $('#is_receive').attr('value', '0');
//     }
// }
// //    ============ its for is popular value add ============
("use strict");
function is_remember() {
    if ($("#rememberme").is(':checked')) {
        $('#rememberme').attr('value', '1');
    } else {
        $('#rememberme').attr('value', '0');
    }
}

// //    ============ its for subscriber save function ==============
("use strict");
function subscriber_save() {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var email = $("#subscriber_email").val();
  if (email == "") {
    toastrErrorMsg("Email must be required!");
    $("#email").val("").focus();
    return false;
  }
  // alert(email);
  if (IsEmail(email) == false) {
    toastrErrorMsg("Your mail is invalid, please give your valid mail");
    return false;
  }

  var enterprise_shortname = $("#enterprise_shortname").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/subscriber-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      email: email,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      if (r == "error") {
        toastrErrorMsg("This email already subscribed");
      } else if (r == "not_valid_email") {
        toastrErrorMsg("Please enter valid email");
      } else {
        toastrSuccessMsg("Subscribed successfully");
      }
      $("#email").val("").focus();
      // $('#is_receive').prop('checked', false);
    },
  });
}

// //========== its for course details script =============

// //    =========== its for review_submitcheck ============
// "use strict";
// function review_submitcheck() {
//     toastrErrorMsg("Login required!");
//     get_loginform();
//     return false;
// }
// //======= its for review_submit ===========
("use strict");
function review_submit() {
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var score = $("input[name=score]").val();
  var user_id = $("#user_id").val();
  var course_id = $("#course_id").val();
  var faculty_id = $("#faculty_id").val();
  var user_name = $("#reviewer_name").val();
  var user_email = $("#reviewer_email").val();
  var enterprise_id = $("#enterprise_id").val();
  var review = $("#review").val();
  if (score == "") {
    toastrErrorMsg("Rating must be required");
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/review-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      user_id: user_id,
      course_id: course_id,
      faculty_id: faculty_id,
      user_name: user_name,
      user_email: user_email,
      review: review,
      score: score,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}
//============= its for free course =============
("use strict");
function addtomycourse(course_id) {

  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var user_id = $("#user_id").val();
  var user_type = $("#user_type").val();
  let course_type = $("#course_type").val();
  var enterprise_id = $("#enterprise_id").val();

  if(user_type==5){
    toastrErrorMsg("Please sign in as a student ");
    return false
  }

  if (user_type != 4) {
    toastrErrorMsg("You have to login first!");
    return false;
  } else {
    var course_id = $("#course_id_" + course_id).val();

    var coursename = $("#course_name_" + course_id).val();
    var qty = $("#qty").val();
    var price = $("#price_" + course_id).val();
    var picture = $("#picture_" + course_id).val();
    $.ajax({
      url: base_url + enterprise_shortname + "/add-to-mycourse",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        user_id: user_id,
        course_id: course_id,
        coursename: coursename,
        qty: qty,
        price: price,
        course_type: course_type,
        picture: picture,
        enterprise_id: enterprise_id,
      },
      success: function (r) {
        if (r == 1) {
          toastrErrorMsg("Already exists!");
        } else {
          toastrSuccessMsg(r);
        }
      },
    });
  }
}

function subscription_single_course(course_id) {
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var user_id = $("#user_id").val();
  var user_type = $("#user_type").val();
  // var course_type = $("#course_type").val();
  var enterprise_id = $("#enterprise_id").val();
  if (user_type != 4) {
    toastrErrorMsg("You have to login first!");
    return false;
  } else {
    // var course_id = $("#course_id_" + course_id).val();
    // var coursename = $("#course_name_" + course_id).val();
    // var qty = $("#qty").val();
    // var price = $("#price_" + course_id).val();
    // var picture = $("#picture_" + course_id).val();
    $.ajax({
      url: base_url + enterprise_shortname + "/add-subscription-mycourse",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
        user_id: user_id,
        course_id: course_id,
        // coursename: coursename,
        // qty: qty,
        // price: price,
        // course_type: course_type,
        // picture: picture,
        enterprise_id: enterprise_id,
      },
      success: function (r) {
        if (r == 1) {
          toastrErrorMsg("Already Enrolled!");
        } else {
          toastrSuccessMsg(r);
        }
      },
    });
  }
}

//=========== its for addtocart  =============
("use strict");
function addtocart(course_id, certificate_id) {
  //     var base_url = $("#base_url").val();
  //     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  // alert(course_id);
  //    alert(certificate_id); return false;

  var user_type = $("#user_type").val();
  var set_lang = $('#set_language').val();
// alert(set_lang);
// return false;
  if(user_type==5){
    toastrErrorMsg("Please sign in as a student ");
    return false
  }
  var course_id = $("#course_id_" + course_id).val();
  var certificate_id = $("#certificate_id_" + certificate_id).val();
  var is_certificate = $("#is_certificate_" + course_id).val();
  var coursename = $("#course_name_" + course_id).val();
  var slug = $("#slug_" + course_id).val();
  var qty = $("#qty").val();
  var course_type = $("#iscourse_type").val();

  var price = $("#price_" + course_id).val();
  var old_price = $("#old_price_" + course_id).val();
  var picture = $("#picture_" + course_id).val();
  var affiliator_id = $("#affiliator_id").val();
  var course_price = $("#course_price").val();
  var student_discount = $("#student_discount").val();
  // console.log(is_certificate);return false;
  $.ajax({
    url: base_url + enterprise_shortname + "/add-to-cart",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      certificate_id: certificate_id,
      is_certificate : is_certificate,
      coursename: coursename,
      slug: slug,
      qty: qty,
      price: price,
      old_price: old_price,
      picture: picture,
      is_course_type: course_type,
      affiliator_id : affiliator_id,
      course_price : course_price,
      student_discount : student_discount,
    },
    success: function (r) {
      // toastrSuccessMsg(r);
      //             $( "#cart").load(window.location.href + "#cart" );
      // setTimeout(function () {
      //   window.location.href = base_url + enterprise_shortname + "/cart";
      // }, 1000);

      /* lead inhouse by @Salehin 26062022 */
      swal(
        {
          title: set_lang === 'bn' ? "সফলভাবে কার্টে যোগ করা হয়েছে৷" : "Added to cart successfully",
          type: "success",
          showCancelButton: false,
          confirmButtonColor: "#14AD54",
          confirmButtonText: set_lang === 'bn' ? "ঠিক আছে" : "OK",
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            // location.reload();
            if(set_lang == 'en'){
              location.replace(base_url + 'cart');
            }else if(set_lang == 'bn'){
              location.replace(base_url + 'cart/bn');
            }
          }
        }
      );
      /* lead inhouse by @Salehin 26062022 */

      // console.log('course_id' + 'course_name' + 'slug' + 'qty' + 'price' + 'old_price' + 'picture');

      $("#cardbody").hide();
      $(".card_add").html(r);
      $("#notifications").load(window.location.href + " #notifications");
      $(".notifications-scroll").each(function () {
        const ps = new PerfectScrollbar($(this)[0]);
      });
      $(".shopping-cart").html(
        '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>'
      );

      $("#cart_in_" + course_id).html("Cart in");

      $("#cart_in_" + course_id).attr("onclick", "");
      // cart in disable color css
      $("#cart_in_disable" + course_id).addClass("cart_in_disable");
      // cart_in_disable
      // $("#cart_ins").attr('disabled','disabled'); //disable

      // $("#cart_ins").prop( "disabled", true );

      //Feather Icon
      feather.replace();
    },
  });
}

// header add to cart
("use strict");
function addtocart_header(course_id) {
  //     var base_url = $("#base_url").val();
  //     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  //    alert(enterprise_shortname); return false;
  var course_id = $("#course_id_" + course_id).val();
  var coursename = $("#course_name_" + course_id).val();
  var slug = $("#slug_" + course_id).val();
  var qty = $("#qty").val();
  var course_type = $("#is_course_type").val();
  var price = $("#price_" + course_id).val();
  var old_price = $("#old_price_" + course_id).val();
  var picture = $("#picture_" + course_id).val();
  // console.log(course_type);return false;


  $.ajax({
    url: base_url + enterprise_shortname + "/add-to-cart",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      coursename: coursename,
      slug: slug,
      qty: qty,
      price: price,
      old_price: old_price,
      picture: picture,
      is_course_type: course_type,
    },
    success: function (r) {
      $("#cardbody").hide();
      $(".card_add").html(r);
      $("#notifications").load(window.location.href + " #notifications");
      $(".notifications-scroll").each(function () {
        const ps = new PerfectScrollbar($(this)[0]);
      });
      // toastr.success(" Added to cart successfully");
      /* lead inhouse by @Salehin 26062022 */
      swal(
        {
          title: "Add to cart successfully",
          type: "success",
          showCancelButton: false,
          confirmButtonColor: "#14AD54",
          confirmButtonText: "OK",
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            location.reload();
            //location.replace(base_url + enterprise_shortname + '/course-details/' + course_id + '/1');
          }
        }
      );
      /* lead inhouse by @Salehin 26062022 */
      // $("#cart_load_data").load(location.href + " #cart_load_data");
      // $("#cart_count_data").load(location.href + " #cart_count_data");
      $(".shopping-cart").html(
        '<circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>'
      );

      //Feather Icon
      feather.replace();
      // toastrSuccessMsg(r);
      // $( "#cart").load(window.location.href + "#cart" );
      // setTimeout(function () {
      //   window.location.href = base_url + enterprise_shortname + "/cart";
      // }, 1000);
    },
  });
}

// //    ======== its for quantity calculation ===============
("use strict");
function quantity_cals(sl, qty) {
  var price = $("#price_" + sl).val();
  var subtotal = parseFloat(price) * qty;
  $("#subtotal_txt_" + sl).text(subtotal);
  $("#subtotal_" + sl).val(subtotal);
}
//    ========= its for cart update ===========
("use strict");
function cart_update(sl, rowid) {
  // var base_url = $("#base_url");
  var qty = $("#qty_" + sl).val();
  $.ajax({
    url: base_url + enterprise_shortname + "/cart-update",
    type: "POST",
    data: { rowid: rowid, qty: qty },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}
//    ========= its for cart delete ===========
("use strict");
function cart_delete(sl, rowid) {
  // var base_url = $("#base_url").val();
  // var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  // var qty = 0;
  // var r = confirm("Do you want to delete?");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/cart-delete",
  //     type: "POST",
  //     data: { csrf_test_name: CSRF_TOKEN, rowid: rowid, qty: qty },
  //     success: function (r) {
  //       toastrSuccessMsg(r);
  //     },
  //   });
  // }
  var set_lang = $('#set_language').val();
  /* lead inhouse by @Salehin 26062022 */
  swal(
    {
      title: set_lang === 'bn' ? "আপনি মুছে ফেলতে চান?" : "Do you want to delete?",
      type: "error",
      showCancelButton: true,
      confirmButtonColor: "#14AD54",
      confirmButtonText: set_lang === 'bn' ? "হ্যাঁ" : "Yes",
      cancelButtonText: set_lang === 'bn' ? "না" : "No",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        var qty = 0;

        $.ajax({
          url: base_url + enterprise_shortname + "/cart-delete",
          type: "POST",
          data: { csrf_test_name: CSRF_TOKEN, rowid: rowid, qty: qty },
          success: function (r) {
            //toastrSuccessMsg(r);
            location.reload();
          },
        });
      }
    }
  );
  /* lead inhouse by @Salehin 26062022 */
}
// //    ============ its for enroll save =========
// "use strict";
// function enroll_save(sl) {
//     var base_url = $("#base_url").val();
//     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
//     var user_type = $("#user_type").val();
//     var user_id = $("#user_id").val();
//     if (user_type == '') {
//         toastrErrorMsg('Login required!');
//         return false;
//     } else {
//         var product_id = $("#course_id_" + sl).val();
//         $.ajax({
//             url: base_url + "enroll-save",
//             type: "POST",
//             data: {'csrf_test_name': CSRF_TOKEN, product_id: product_id, user_id: user_id},
//             success: function (r) {
//                 toastrSuccessMsg(r);
//             }
//         });
//     }
// }

// //    ================== its for loginProcess ============
("use strict");
function loginProcess(type) {
  var email = $("#email").val();
  var password = $("#password").val();
  var checkout = $("#checkout").val();
  var subscription_id = $("#subscription_id").val();
  // var rememberme = $("#rememberme").val();

  // alert(type); return false;
  if (email == "") {
    // toastrErrorMsg("Mobile number or Email must be required!");
    /* lead inhouse by @Salehin 29062022 */
    swal({
      title: "Mobile number or Email is required!",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: "#14AD54",
      confirmButtonText: "OK",
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false,
    });
    /* lead inhouse by @Salehin 29062022 */
    $("#email").val("").focus();
    return false;
  }
  if (password == "") {
    // toastrErrorMsg("Password must be required!");
    /* lead inhouse by @Salehin 29062022 */
    swal({
      title: "Password is required!",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: "#14AD54",
      confirmButtonText: "OK",
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false,
    });
    /* lead inhouse by @Salehin 29062022 */

    $("#password").val("").focus();
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/login-process",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      type: type,
      email: email,
      password: password,
      // rememberme: rememberme,
    },
    success: function (r) {
      // console.log(r);return false;
      if (r == "nodata") {
        // toastrErrorMsg("Invalid Information");
        /* lead inhouse by @Salehin 29062022 */
        swal({
          title: "Wrong mobile number or email or password. Please Try again.",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: "#14AD54",
          confirmButtonText: "OK",
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false,
        });
        /* lead inhouse by @Salehin 29062022 */
        $("#password").val("");
        return false;
      } else if (r == "invalidAccess") {
        // toastrErrorMsg("You are not registered!");
        /* lead inhouse by @Salehin 29062022 */
        swal({
          title: "You are not registered!",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: "#14AD54",
          confirmButtonText: "OK",
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false,
        });
        /* lead inhouse by @Salehin 29062022 */
        $("#email").val("").focus();
        $("#password").val("");
      } else if (r == "facultylogin") {
        document.location.href =
          base_url + "instructor-dashboard";
      } else if (r == "affiliateloginok") {
        document.location.href =
          base_url + "affiliate-dashboard";
      } else if (r == "adminlogin") {
        // document.location.href = base_url + "dashboard/home";
        // toastrErrorMsg("You are not valid user!");
        /* lead inhouse by @Salehin 29062022 */
        swal({
          title: "You are not valid user!",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: "#14AD54",
          confirmButtonText: "OK",
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false,
        });
        /* lead inhouse by @Salehin 29062022 */
        return false;
      } else if (r == "0") {
        // toastrErrorMsg("Please wait for admin approval");
        /* lead inhouse by @Salehin 29062022 */

        // swal({
        //   title: "Please wait for admin approval",
        //   type: "warning",
        //   showCancelButton: false,
        //   confirmButtonColor: "#14AD54",
        //   confirmButtonText: "OK",
        //   // cancelButtonText: "No",
        //   closeOnConfirm: false,
        //   closeOnCancel: false,
        // });

        var src = base_url + "/assets/img/ajax-loader.gif";
        var r_link = base_url + "/otp-check";
        $(".login_submit").html('<img src="'+ src +'" /> &nbsp; Loading ...');
        setTimeout('window.location.href = "'+ r_link +'";',2000);

        /* lead inhouse by @Salehin 29062022 */
        return false;
      } else {
        // alert(checkout);
        // alert('dddd');return false;
        if (checkout == "checkout") {
          // alert(subscription_id);return false;
          if (subscription_id) {
            // window.location.href = base_url + enterprise_shortname + "/subscription-checkout/"+subscription_id;
            location.reload();
          } else {
            // setTimeout(function () {
            // toastr.options = {
            //   closeButton: true,
            //   progressBar: true,
            //   showMethod: "slideDown",
            //   timeOut: 1500,
            //   onHidden: function () {
            //     // document.location.href =
            //     //   base_url + "checkout";
            //     // location.reload();
            //   },
            // };
            // toastr.success("Login succesful");
            //
            setTimeout(function () {
              window.location.href = base_url + "checkout";
              toastr.success("Login succesful");
            }, 1000);

            // location.href = base_url + "checkout";


            // $(document.on("load", function () {
            //     // alert('page is loaded');
            //     setTimeout(function () {
            //         alert('page is loaded and 1 minute has passed');
            //     }, 1000);
            // });

          // setInterval(function my_function() {
          //     toastr.success("Login succesful");
          //     $('#chkout').load(location.href + " #chkout");
          //     window.location.href = base_url + 'checkout/';
          // }, 2000);


            // window.location.href = base_url + "checkout";
            // location.reload();
            // }, 1000);
          }
        } else {
          setTimeout(function () {
            // toastr.options = {
            //   closeButton: true,
            //   progressBar: true,
            //   showMethod: "slideDown",
            //   timeOut: 1500,
            //   onHidden: function () {
            //     document.location.href =
            //       base_url + enterprise_shortname + "/student-dashboard";
            //   },
            // };
            window.location.href =
              base_url + "student-dashboard";
            toastr.success("Login succesful");
          }, 1200);
        }
      }
    },
  });
}

("use strict");
function checkout_unique_mailcheck(email) {
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  $.ajax({
    url: base_url + "checkout-unique-mailcheck",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, email: email },
    success: function (r) {
      if (r == 1) {
        // toastrErrorMsg("Mail already exists");
                /* lead inhouse by @Salehin 29062022 */
                swal({
                  title: "Mail already exists",
                  type: "warning",
                  showCancelButton: false,
                  confirmButtonColor: '#14AD54',
                  confirmButtonText: 'OK',
                  // cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false
              });
              /* lead inhouse by @Salehin 29062022 */
        $("#mail").val("").focus();
        return false;
      }
    },
  });
}

// ========= its for show course preview =============
("use strict");
function showCoursePreview(course_id, lesson_id) {
  //    var base_url = $("#base_url").val();
  //    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  //    var enterprise_shortname = $("#enterprise_shortname").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/show-course-preview",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      lesson_id: lesson_id,
    },
    success: function (r) {
      //                $(".modal_ttl").html("Course Preview Information");
      $("#courseinfo").html(r);
      $("#coursePreviewModal").modal("show");
    },
  });
}


// =========== its for saveHostmeetinginfo =================
function saveHostmeetinginfo(id){

  $.ajax({
    url: base_url + enterprise_shortname + "/save-hostmeetinginfo",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      id: id,
    },
    success: function (r) {
      $("#subcategory_id").html(r);
    },
  });
}

// =============== its for  file type check ===============
function filetypecheck(fileid) {
  var allowedTypes = [
    "application/pdf",
    "application/msword",
    "application/vnd.ms-office",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "image/jpeg",
    "image/png",
    "image/jpg",
    "image/gif",
  ];

  // var file = this.files[0];
  var file = $("#" + fileid)[0].files[0];
  var fileType = file.type;
  if (!allowedTypes.includes(fileType)) {
    alert("Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).");
    $("#" + fileid).val("");
    return false;
  }
}
// =============== its for  pdf file type check ===============
function pdffiletypecheck(fileid) {
  var allowedTypes = ["application/pdf"];

  // var file = this.files[0];
  var file = $("#" + fileid)[0].files[0];
  var fileType = file.type;
  if (!allowedTypes.includes(fileType)) {
    alert("Please select a valid file (PDF).");
    $("#" + fileid).val("");
    return false;
  }
}

// ============= its for uploadCV ==============
function uploadCV(fileid) {
  pdffiletypecheck(fileid);
  var fd = new FormData();

  var cvsize = $("#resume")[0].files[0].size;
  // alert(cvsize);return false;
  // if(cvsize > 2097152){
  if (cvsize > 20971520) {
    alert("Try to upload file less than 20MB!");
    return false;
  }

  fd.append("resume", $("#resume")[0].files[0]);

  if ($("#is_resumeshow").is(":checked")) {
    var is_resumeshow = 1;
  } else {
    var is_resumeshow = 0;
  }

  fd.append("user_id", user_id);
  fd.append("is_resumeshow", is_resumeshow);
  fd.append("old_resume", $("#old_resume").val());
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    type: "POST",
    url:
      base_url + enterprise_shortname + "/student-fileupload-progressbar-check",
    // data: new FormData(this),
    data: fd,
    contentType: false,
    cache: false,
    processData: false,

    error: function () {
      $("#uploadStatus").html(
        '<p style="color:#EA4335;">File upload failed, please try again.</p>'
      );
    },
    success: function (resp) {
      // console.log(resp);
      if (resp == "ok") {
        $("#uploadStatus").html(
          '<p style="color:#28A74B;">File has uploaded successfully!</p>'
        );
        $(".progress-area").html(
          '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div></div>'
        );
      } else if (resp == "err") {
        $(".progress-area").html("");
        $("#uploadStatus").html(
          '<p style="color:#EA4335;">Please select a valid file to upload.</p>'
        );
      }
    },
  });
}

// ========= its for enterprise edit =============


("use strict");

function loadcoursecontent(type, lesson_id) {
  //    var base_url = $("#base_url").val();
  //    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  //    var enterprise_shortname = $("#enterprise_shortname").val();
  $("#preRequisites").hide();
  $("#learnings").hide();
  $.ajax({
    url: base_url + enterprise_shortname + "/load-course-content",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, type: type, lesson_id: lesson_id },
    success: function (r) {
      $(".loadcontent").html(r);
      $("#flexCheckDefault").prop("checked", false);
    },
  });

  var student_id = $("#student_id").val();
  var course_id = $("#course_id").val();
  $("#last_lesson").val(lesson_id);

  $(".activeremoveclass ").removeClass("active");
  $(".lstactive_" + lesson_id).addClass("active");
  $.ajax({
    url: base_url + enterprise_shortname + "/get-noteslist",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      student_id: student_id,
      course_id: course_id,
      lesson_id: lesson_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      $("#loadnotes").html(r);
    },
  });
  $.ajax({
    url: base_url + enterprise_shortname + "/get-notecount",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      student_id: student_id,
      course_id: course_id,
      lesson_id: lesson_id,
      enterprise_id: enterprise_id,
    },
    success: function (res) {
      $(".notecount-area").html(res);
      //  function of lesson wise description
      course_lesson_wise_information(lesson_id, course_id, enterprise_id);
    },
  });
}

//  function of lesson wise description
$("#lesson-resource-area").hide();
$(".lesson_wise_information").hide();
function course_lesson_wise_information(lesson_id, course_id, enterprise_id) {
  // $(".lesson_wise_information").html(res);

  $.ajax({
    url: base_url + "/frontend/course_lesson_wise_information",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      // student_id: student_id,
      course_id: course_id,
      lesson_id: lesson_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      var obj = JSON.parse(r);
      // console.log(obj.lesson_materials);
      if (obj.lesson_description.description != "") {
        $("#course_description").hide();
        $(".lesson_wise_information").show();
        $(".lesson_wise_information").html(obj.lesson_description.description);
        var desc_count = obj.lesson_description.description.length;
        if (desc_count > 220) {
          $(".lesson_readmorebtn_area").html(
            '<button onclick="showhide()" class="lsn_readmorebtn bg-white border-0 fw-semi-bold p-0 text-dark-cerulean" id="toggle">Read More</button>'
          );
        }
        $("#about_lesson").html("About this Lesson");
      } else {
        $(".lesson_wise_information").hide();
        $("#course_description").show();
      }

      // $(".load-lesson-resource").html(obj.lesson_materials[0].id);
      $("#lesson-resource-area").show();

      // =============== resource start ================/
      var peopleHTML = "";
      // Loop through Object and create peopleHTML
      for (var key in obj.lesson_materials) {
        if (obj.lesson_materials.hasOwnProperty(key)) {
          var ext = obj.lesson_materials[key]["files"].split("-f-").pop();
          // alert(base_url);
          // alert(obj.lesson_materials[key]["files"]);
          // ============= its for file size ==============
          var fileSize = "";
          var resource_url = base_url + obj.lesson_materials[key]["files"];
          var http = new XMLHttpRequest();
          http.open("HEAD", resource_url, false); // false = Synchronous
          http.send(null); // it will stop here until this http request is complete
          fileSize = http.getResponseHeader("content-length");
          fileSize = (fileSize / 1024).toFixed(2);
          // ============= its for file size ==============

          var filename = ext.split(".")[0];
          var fileext = ext.split(".")[1];
          peopleHTML += '<div class="col-sm-12">';
          peopleHTML += '<div class="d-block border mb-3">';
          peopleHTML +=
            '<div class="align-items-center bg-alice-blue d-sm-flex justify-content-between p-3">';
          peopleHTML += '<div class="align-items-center d-sm-flex">';
          peopleHTML +=
            '<div class="me-4"><svg width="31" height="22" viewBox="0 0 31 22" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M26.2012 20.4838C25.606 21.084 24.8168 21.47 23.9472 21.5351L21.5437 21.7152C16.4755 22.0949 11.3879 22.0949 6.31965 21.7152L4.09798 21.5487C2.34291 21.4173 0.895294 20.0585 0.579039 18.2459C-0.0617287 14.5732 -0.171427 10.8206 0.253623 7.11376L0.653472 3.62674C0.890763 1.55736 2.56714 0 4.55737 0H7.92005C9.56026 0 10.9268 1.22701 11.2284 2.85235L23.4291 2.85235C25.3461 2.85235 26.9789 4.31104 27.281 6.29345L27.3751 6.91035C27.3948 7.03997 27.4139 7.16968 27.4322 7.29946H27.9252C30.0859 7.29946 31.5713 9.57356 30.7882 11.6824L28.9548 16.6197C28.3854 18.1528 27.4303 19.4859 26.2012 20.4838ZM25.1074 6.65678L25.2015 7.27367C25.2028 7.28227 25.2041 7.29087 25.2054 7.29946H11.5404C9.87389 7.29946 8.37877 8.37233 7.77716 9.99991L4.35539 19.257L4.25505 19.2495C3.50157 19.1931 2.88009 18.6098 2.74431 17.8315C2.14321 14.3863 2.04031 10.8659 2.43904 7.38859L2.83889 3.90157C2.94335 2.99064 3.68128 2.30509 4.55737 2.30509H7.92005C8.56577 2.30509 9.08923 2.85328 9.08923 3.52951C9.08923 4.42859 9.78521 5.15745 10.6437 5.15745H23.4291C24.2643 5.15745 24.9758 5.79301 25.1074 6.65678ZM6.65211 19.429C11.5577 19.7878 16.4815 19.7835 21.3867 19.416L23.7901 19.2359L24.0756 19.208L24.0736 19.2042C25.3657 18.4407 26.3656 17.2322 26.9033 15.7842L28.7368 10.8469C28.9587 10.2492 28.5377 9.60456 27.9252 9.60456H11.5404C10.7829 9.60456 10.1033 10.0922 9.82985 10.832L6.65211 19.429Z" fill="#07477D"></path> </svg> </div>';
          peopleHTML +=
            '<div class="d-block my-3 my-sm-0"> <h6 class="fw-bold">' +
            filename +
            "." +
            fileext +
            '</h6><h6 class="mb-0">(' +
            fileSize +
            "kb)</h6> </div>";
          peopleHTML += "</div>";
          peopleHTML +=
            '<a href="' +
            resource_url +
            '" download class="btn d-block"> <svg width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.37158 0C7.37337 0 6.5407 0.777046 6.45353 1.78991C6.27128 3.9076 6.22516 6.03472 6.3153 8.15769C6.20649 8.1651 6.09769 8.17285 5.98891 8.18093L4.06697 8.32363C2.83852 8.41484 2.1518 9.81004 2.815 10.8672C4.22942 13.1219 6.05194 15.082 8.18541 16.643L8.9554 17.2064C9.57968 17.6632 10.4205 17.6632 11.0448 17.2064L11.8148 16.643C13.9483 15.082 15.7708 13.1219 17.1852 10.8672C17.8484 9.81004 17.1617 8.41484 15.9332 8.32363L14.0113 8.18093C13.9025 8.17285 13.7937 8.1651 13.6849 8.15769C13.775 6.03472 13.7289 3.90759 13.5467 1.7899C13.4595 0.777044 12.6268 0 11.6286 0H8.37158ZM8.2988 9.02221C8.15207 6.67329 8.17947 4.31634 8.38081 1.97143H11.6194C11.8207 4.31634 11.8481 6.67329 11.7014 9.02221C11.685 9.28555 11.7729 9.54462 11.9454 9.74142C12.118 9.93823 12.3608 10.0563 12.6196 10.0693C13.0368 10.0903 13.4538 10.1162 13.8706 10.1471L15.2664 10.2508C14.0283 12.1083 12.478 13.7304 10.6856 15.0419L10.0001 15.5435L9.31461 15.0419C7.52222 13.7304 5.97192 12.1083 4.7338 10.2508L6.12962 10.1471C6.54638 10.1162 6.96341 10.0903 7.38063 10.0693C7.63938 10.0563 7.88221 9.93823 8.05478 9.74142C8.22735 9.54462 8.31525 9.28555 8.2988 9.02221Z" fill="#07477D"></path><path d="M1.93548 18.0714C1.93548 17.527 1.50221 17.0857 0.967742 17.0857C0.433273 17.0857 0 17.527 0 18.0714V20.7C0 21.9703 1.01097 23 2.25806 23H17.7419C18.989 23 20 21.9703 20 20.7V18.0714C20 17.527 19.5667 17.0857 19.0323 17.0857C18.4978 17.0857 18.0645 17.527 18.0645 18.0714V20.7C18.0645 20.8815 17.9201 21.0286 17.7419 21.0286H2.25806C2.07991 21.0286 1.93548 20.8815 1.93548 20.7V18.0714Z" fill="#07477D"></path></svg> </a>';

          // peopleHTML += '<label for="" class="col-md-6 mb-2 mb-md-0 fw-bold">' + filename + "</label>";
          // peopleHTML += '<a href="'+base_url+'_'+obj.lesson_materials[key]["files"]+'" download="">';
          // if(fileext == 'pdf'){
          //   peopleHTML += '<i class="far fa-file-pdf fs-2 m-1"></i></a>';
          // }else if(fileext == 'txt'){
          //   peopleHTML += '<i class="fa-file-alt far fs-2 m-1"></i></a>';
          // }else if(fileext == 'xlsx' || fileext == 'xltx' || fileext == 'csv' || fileext =='xls'){
          //   peopleHTML += '<i class="far fa-file-excel fs-2 m-1"></i></a>';
          // }else if(fileext == 'doc' || fileext == 'docx'){
          //   peopleHTML += '<i class="far fa-file-word fs-2 m-1"></i></a>';
          // }else if(fileext == 'zip'){
          //   peopleHTML += '<i class="fa-file-archive far fs-2 m-1"></i></a>';
          // }else{
          //   peopleHTML += '<i class="far fa-file-image fs-2 m-1"></i></a>';
          // }
          peopleHTML += "</div>";
          peopleHTML += "</div>";
          peopleHTML += "</div>";
        }
      }
      // Replace table’s tbody html with peopleHTML
      $(".load-lesson-resource").html(peopleHTML);
      // =============== resource close ================/
    },
  });
}
function showhideT(arg) {
  console.log(arg);
  // $("#toggle").click(function(){
      var id=$(arg).attr('data-id');
      console.log(id);
  $(".moreText"+id).toggleClass("opened");

  var elem = $("#toggle"+id).text();
  console.log(elem);
  if (elem.trim() == "Read More") {
      //Stuff to do when btn is in the read more state
      $("#toggle"+id).text("Read Less");
      // $("#text").slideDown();
  } else {
      //Stuff to do when btn is in the read less state
      $("#toggle"+id).text("Read More");
      // $("#text").slideUp();
  }
  // });

}
function showhide() {
  var set_lang = $("#set_language").val();
  $(".moreText").toggleClass("opened");

  var elem = $("#toggle").text();
  // if (elem == "Read More") {
  //   //Stuff to do when btn is in the read more state
  //   $("#toggle").text("Read Less");
  //   $("#text").slideDown();
  // } else {
  //   //Stuff to do when btn is in the read less state
  //   $("#toggle").text("Read More");
  //   $("#text").slideUp();
  // }
  if (elem == "আরও পড়ুন") {
    $("#toggle").text("সংক্ষিপ্ত করুন");
    $("#text").slideDown();
} else if (elem == "সংক্ষিপ্ত করুন") {
    $("#toggle").text("আরও পড়ুন");
    $("#text").slideUp();
}else if (elem == "Read More") {
    $("#toggle").text("Read Less");
    $("#text").slideUp();
}else if (elem == "Read Less") {
    $("#toggle").text("Read More");
    $("#text").slideUp();
}else{
    $("#toggle").text(set_lang === 'bn' ? "সংক্ষিপ্ত করুন" : "Read Less");
    $("#text").slideUp();
}
}
// showhide();

("use strict");
function noteedit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/noteedit-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttl").html("Notes Information");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

("use strict");
function notedelete(id) {
  // var r = confirm("Do you want to delete??");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/note-delete",
  //     type: "POST",
  //     data: { csrf_test_name: CSRF_TOKEN, id: id },
  //     success: function (r) {
  //       $("#notedivreload_" + id).load(location.href + " #notedivreload_" + id);
  //       toastr.success(r);
  //       // }, 1000);
  //     },
  //   });
  // }

  /* lead inhouse by @Salehin 26062022 */
  swal({
    title: "Do you want to delete?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: false,
    closeOnCancel: true
},
function(isConfirm) {
    if (isConfirm) {

        $.ajax({
            url: base_url + enterprise_shortname + "/note-delete",
            type: "POST",
            data: { csrf_test_name: CSRF_TOKEN, id: id },
            success: function(r) {
                // setTimeout(function () {
                // toastr.options = {
                //   closeButton: true,
                //   progressBar: true,
                //   showMethod: "slideDown",
                //   timeOut: 1500,
                //   onHidden: function () {
                //     window.location.reload();
                //   },
                // };
                $("#notedivreload_" + id).load(location.href + " #notedivreload_" + id);
                //toastr.success(r);
                // }, 1000);
            },
        });

    }
});
/* lead inhouse by @Salehin 26062022 */

}

// =============== its for claimcertificatemodal ==================
("use strict");
function claimcertificatemodal() {
  var course_id = $("#course_id").val();
  var student_id = $("#student_id").val();

  $.ajax({
    url: base_url + enterprise_shortname + "/claim-certificate-form",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      student_id: student_id,
    },
    success: function (r) {
      $(".modal_ttl").html("Clain a certificate");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

// =============== its for assignedStudentCertificate ======================
("use strict");
function assignedStudentCertificate() {
  var user_id = $("#user_id").val();
  var course_id = $("#course_id").val();
  var certificate_id = $("#certificate_id").val();
  if (certificate_id == "") {
    // toastrErrorMsg("Certificate field must be required!");
     /* lead inhouse by @Salehin 26062022 */
     swal({
      title: "Certificate field must be required!",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });
  /* lead inhouse by @Salehin 26062022 */
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/assign-student-course-certificate",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      user_id: user_id,
      certificate_id: certificate_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      toastrSuccessMsg(r);
      $("#modal_info").modal("hide");
      location.href =
        base_url + enterprise_shortname + "/student-profile-dashboard";
    },
  });
}

// =============== its for get_showexampaper ==========
// ("use strict");
// function get_showexampaper(exam_id) {
//   $.ajax({
//     url: base_url + enterprise_shortname + "/get-showexampaper",
//     type: "POST",
//     data: { csrf_test_name: CSRF_TOKEN, exam_id: exam_id },
//     success: function (r) {
//       $(".loadcontent").html(r);
//       // $("#flexCheckDefault").prop("checked", false);
//     },
//   });
// }
// =============== its for get_studentexamshow ==========
("use strict");
function get_studentexamshow(student_id, course_id, exam_id) {
  // toastrErrorMsg("This exam already done!");
   /* lead inhouse by @Salehin 26062022 */
   swal({
    title: "This exam already done!",
    type: "warning",
    showCancelButton: false,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'OK',
    // cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false
});
/* lead inhouse by @Salehin 26062022 */
  // $.ajax({
  //   url: base_url + enterprise_shortname + "/get-studentexamshow",
  //   type: "POST",
  //   data: {
  //     csrf_test_name: CSRF_TOKEN,
  //     student_id: student_id,
  //     course_id: course_id,
  //     exam_id: exam_id,
  //   },
  //   success: function (r) {
  //     $(".loadcontent").html(r);
  //     // $("#flexCheckDefault").prop("checked", false);
  //   },
  // });
}

// =================its for examDonestatus ============
("use strict");
function examDonestatus(questionexam_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/exam-donestatus",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      questionexam_id: questionexam_id,
    },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

// =============== its for get_passfailquiz ============
("use strict");
function get_passfailquiz(type) {
  $.ajax({
    url: base_url + enterprise_shortname + "/get-passfailquiz",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      type: type,
    },
    success: function (r) {
      $(".loadquizdata").html(r);
    },
  });
}

/* start Lead in house By @Salehin 16082022 */

// =================its for QuizDonestatus ============
("use strict");
function quizDonestatus(questionexam_id, course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/exam-donestatus",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      questionexam_id: questionexam_id,
      course_id: course_id,
    },
    success: function (r) {
      //toastrSuccessMsg(r);
      swal(
        {
          title: r,
          type: "success",
          showCancelButton: false,
          confirmButtonColor: "#14AD54",
          confirmButtonText: "OK",
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false,
        },
        function (isConfirm) {
          if (isConfirm) {
            //location.reload();
            location.replace(base_url + '/course-details/' + course_id);
          }
        }
      );

    },
  });
}

/* End Lead in house By @Salehin 16082022 */

// ============ its for resumeUpload ====================
("use strict");
function resumeUpload() {
  var user_id = $("#user_id").val();
  var is_resumeshow = $("#is_resumeshow").val();

  var inp = document.getElementById("resume");
  // if (inp.files.length == 0 && is_resumeshow == '0') {
  //     toastrErrorMsg("Empty not allow!");
  //     inp.focus();
  //     return false;
  // }

  var fd = new FormData();
  fd.append("resume", $("#resume")[0].files[0]);

  fd.append("user_id", user_id);
  fd.append("is_resumeshow", is_resumeshow);
  fd.append("old_resume", $("#old_resume").val());
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/resume-upload",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      // location.href = base_url + enterprise_shortname + "/settings/30";
    },
  });
}

// =========resume_upload_delete==================
("use strict");
function resume_upload_delete() {
  // var user_id = $("#user_id").val();
  // var fd = new FormData();
  // fd.append("user_id", user_id);
  // fd.append("csrf_test_name", CSRF_TOKEN);

  // var r = confirm("Do you want to delete??");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/resume-upload-delete",
  //     type: "POST",
  //     data: fd,
  //     enctype: "multipart/form-data",
  //     processData: false,
  //     contentType: false,
  //     success: function (r) {
  //       toastrSuccessMsg(r);
  //     },
  //   });
  // }

  /* lead inhouse by @Salehin 26062022 */
  swal({
    title: "Do you want to delete?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: false,
    closeOnCancel: true
},
function(isConfirm) {
    if (isConfirm) {

        var user_id = $("#user_id").val();
        var fd = new FormData();
        fd.append("user_id", user_id);
        fd.append("csrf_test_name", CSRF_TOKEN);

        $.ajax({
            url: base_url + enterprise_shortname + "/resume-upload-delete",
            type: "POST",
            data: fd,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(r) {
                toastrSuccessMsg(r);
            },
        });

    }
});
/* lead inhouse by @Salehin 26062022 */
}

// ================== its for profileupdate =================
("use strict");
function profileupdate() {
  var user_id = $("#user_id").val();
  var is_profileshow = 1; //$("#is_profileshow").val();
  var studentName = $("#studentName").val();
  var designation = $("#designation").val();
  var website = $("#website").val();

  if (studentName == "") {
    toastrErrorMsg("Name must be required!");
    $("#studentName").focus();
    return false;
  }
  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("is_profileshow", is_profileshow);
  fd.append("studentName", studentName);
  fd.append("designation", designation);
  fd.append("website", website);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/profile-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}
// =============== its for skillsupdate ================
("use strict");
function skillsupdate() {
  var user_id = $("#user_id").val();
  var is_skillshow = $("#is_skillshow").val();
  var skillsSelect = $("#skillsSelect").val();
  if (skillsSelect == "") {
    toastrErrorMsg("Skills must be required!");
    $("#skillsSelect").focus();
    return false;
  }
  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("is_skillshow", is_skillshow);
  fd.append("skillsSelect", skillsSelect);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/skills-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      // console.log(r);
    },
  });
}
// =============== its for proficiencyupdate =================
("use strict");
function proficiencyupdate() {
  var is_proficiencyshow = $("#is_proficiencyshow").val();
  var proficiencySelect = $("#proficiencySelect").val();
  // if(proficiencySelect==""){
  //    toastrErrorMsg("Professional proficiency field must be required!");
  //   return false;
  // }

  var fd = new FormData();
  fd.append("enterprise_id", enterprise_id);
  fd.append("user_id", user_id);
  fd.append("is_proficiencyshow", is_proficiencyshow);
  fd.append("proficiencySelect", proficiencySelect);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/proficiency-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      // toastrSuccessMsg(r);
      toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        // timeOut: 500,
      };
      toastr.success(r);
    },
  });

  setTimeout(function () {
    $.ajax({
      url: base_url + enterprise_shortname + "/proficiency-load",
      type: "POST",
      data: {
        csrf_test_name: CSRF_TOKEN,
      },
      success: function (r) {
        $("#proficiency-load").html(r);
        feather.replace();
      },
    });
  }, 1000);
}

// ============= its for studentproficiency_delete ===============
("use strict");
function studentproficiency_delete(id) {
  var r = confirm("Do you want to delete??");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/student-proficiency-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          // timeOut: 500,
        };
        toastr.success(r);
      },
    });

    setTimeout(function () {
      $.ajax({
        url: base_url + enterprise_shortname + "/proficiency-load",
        type: "POST",
        data: {
          csrf_test_name: CSRF_TOKEN,
        },
        success: function (r) {
          $("#proficiency-load").html(r);
          feather.replace();
        },
      });
    }, 1000);
  }
}

// =============== its for featureshowupdate =================
("use strict");
function featureshowupdate() {
  var user_id = $("#user_id").val();
  var enterprise_id = $("#enterprise_id").val();

  if ($("#is_featureshow").is(":checked")) {
    var is_featureshow = 1;
  } else {
    var is_featureshow = 0;
  }
  var is_featureshow = is_featureshow;
  var csrf_test_name = $('[name="csrf_test_name"]').val();

  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("is_featureshow", is_featureshow);
  fd.append("enterprise_id", enterprise_id);
  fd.append("csrf_test_name", csrf_test_name);

  $.ajax({
    url: base_url + enterprise_shortname + "/student-featureshow-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        timeOut: 1500,
      };
      toastr.success(r);
    },
  });
}
// ============ its for addmoreexperience ==============
("use strict");
ex = 0;
exx = 1;
function addmoreexperience() {
  var yeardynamic = $("#yeardynamic").val();
  ex++;
  exx++;
  $("#experience_area").append(
    '<div id="rmvEx' +
      ex +
      '"><hr>\n\
    <div class="row">\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="companyname" class="form-label mb-1 fw-medium">Company *</label>\n\
                <input type="text" class="form-control form-control-lg" id="companyname" name="companyname[]">\n\
            </div>\n\
        </div>\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="cityname" class="form-label mb-1 fw-medium">City</label>\n\
                <input type="text" class="form-control form-control-lg" id="cityname" name="cityname[]">\n\
            </div>\n\
        </div>\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="title" class="form-label mb-1 fw-medium">Title *</label>\n\
                <input type="text" class="form-control form-control-lg" id="title" name="title[]">\n\
            </div>\n\
        </div>\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="country" class="form-label mb-1 fw-medium">Country *</label>\n\
                <input type="text" class="form-control form-control-lg" id="country" name="country[]">\n\
            </div>\n\
        </div>\n\
    </div>\n\
    <div class="row gx-3 gy-2 align-items-end mb-4">\n\
        <div class="col-sm-2">\n\
            <label for="frommonth">From</label>\n\
            <select class="form-select" id="frommonth" name="frommonth[]">\n\
                <option value="">Choose Month</option>\n\
                <option value="January">January</option>\n\
                <option value="February">February</option>\n\
                <option value="March">March</option>\n\
                <option value="April">April</option>\n\
                <option value="May">May</option>\n\
                <option value="June">June</option>\n\
                <option value="July">July</option>\n\
                <option value="August">August</option>\n\
                <option value="September">September</option>\n\
                <option value="October">October</option>\n\
                <option value="November">November</option>\n\
                <option value="December">December</option>\n\
            </select>\n\
        </div>\n\
        <div class="col-sm-2">\n\
            <label class="visually-hidden" for="fromyear">year</label>\n\
            <select class="form-select" id="fromyear" name="fromyear[]">\n\
                <option value="">Choose Year</option>\n\
                ' +
      yeardynamic +
      '\n\
            </select>\n\
        </div>\n\
        <div class="toaddareahide_' +
      exx +
      '" style="display: contents;">\n\
        <div class="col-auto me-3">\n\
            <span class="fromto"></span>\n\
        </div>\n\
        <div class="col-sm-2 me-3">\n\
            <label for="tomonth_' +
      exx +
      '">To</label>\n\
            <select class="form-select" id="tomonth_' +
      exx +
      '" name="tomonth[]">\n\
                <option value="">Choose Month</option>\n\
                <option value="January">January</option>\n\
                <option value="February">February</option>\n\
                <option value="March">March</option>\n\
                <option value="April">April</option>\n\
                <option value="May">May</option>\n\
                <option value="June">June</option>\n\
                <option value="July">July</option>\n\
                <option value="August">August</option>\n\
                <option value="September">September</option>\n\
                <option value="October">October</option>\n\
                <option value="November">November</option>\n\
                <option value="December">December</option>\n\
            </select>\n\
        </div>\n\
        <div class="col-sm-2">\n\
            <label class="visually-hidden" for="toyear">year</label>\n\
            <select class="form-select" id="toyear_' +
      exx +
      '" name="toyear[]">\n\
                <option value="">Choose Year</option>\n\
                ' +
      yeardynamic +
      '\n\
            </select>\n\
        </div>\n\
        </div>\n\
        <div class="col-auto">\n\
            <div class="form-check">\n\
                <input class="form-check-input" type="checkbox" onclick="isNowworking(' +
      exx +
      "," +
      "'add'" +
      ')" id="nowworking_' +
      exx +
      '" name="nowworking[]">\n\
                <input type="hidden" name="hdn_nowworking[]" id="hdn_nowworking_' +
      exx +
      '">\n\
                <label class="form-check-label" for="nowworking_' +
      exx +
      '"> I currently work here </label>\n\
            </div>\n\
        </div>\n\
        <div class="col-auto">\n\
            <button type="button" class="btn btn-danger" onclick="removeexperience(this)">Delete</button>\n\
        </div>\n\
    </div>\n\
</div>'
  );
}

("use strict");
function isNowworking(sl, mode) {
  if (mode == "add") {
    if ($("#nowworking_" + sl).is(":checked")) {
      $("#nowworking_" + sl).attr("value", "1");
      $("#hdn_nowworking_" + sl).val(1);
    } else {
      $("#nowworking_" + sl).attr("value", "0");
      $("#hdn_nowworking_" + sl).val(0);
    }
    $(".toaddareahide_" + sl).slideToggle();
  } else {
    $(".toeditareahide").slideToggle();
    $("#isnow").val(0);
    // $(".toeditareahide").css("display", "block");
    if ($("#nowworking_edit").is(":checked")) {
      $("#nowworking_edit").attr("value", "1");
      $("#hdn_nowworking_" + sl).val(1);
    } else {
      $("#nowworking_edit").attr("value", "0");
      $("#hdn_nowworking_" + sl).val(0);
    }
  }
}

("use strict");
function removeexperience(experienceElem) {
  // alert(removeexperience);return false;
  var parentid = $(experienceElem).parent().parent().parent().remove();
}

//    ================== its for experience edit ===========
("use strict");
function studentexperience_edit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/experience-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modalprofile_ttl").html("Experience information update");
      $("#profileinfo").html(r);
      $("#modalprofile_info").modal("show");
    },
  });
}

// ============ its for experienceinfo_update ================
("use strict");
function experienceinfo_update(id) {
  var companyname = $("#edit_companyname").val();
  var edit_title = $("#edit_title").val();
  var edit_city = $("#edit_city").val();
  var edit_country = $("#edit_country").val();
  var edit_frommonth = $("#edit_frommonth").val();
  var edit_fromyear = $("#edit_fromyear").val();
  var edit_tomonth = $("#edit_tomonth").val();
  var edit_toyear = $("#edit_toyear").val();
  var nowworking = $("#nowworking_edit").val();
  // alert(nowworking);
  // return false;
  var fd = new FormData();
  fd.append("id", id);
  fd.append("user_id", user_id);
  fd.append("companyname", companyname);
  fd.append("title", edit_title);
  fd.append("city", edit_city);
  fd.append("country", edit_country);
  fd.append("frommonth", edit_frommonth);
  fd.append("fromyear", edit_fromyear);
  fd.append("tomonth", edit_tomonth);
  fd.append("toyear", edit_toyear);
  fd.append("is_now", nowworking);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/experience-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      $("#modal_info").modal("hide");
    },
  });
}

// ============= its for student experience delete ===============
("use strict");
function studentexperience_delete(id) {
  // var r = confirm("Do you want to delete??");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/student-experience-delete",
  //     type: "POST",
  //     data: { csrf_test_name: CSRF_TOKEN, id: id },
  //     success: function (r) {
  //       toastrSuccessMsg(r);
  //     },
  //   });
  // }
  /* lead inhouse by @Salehin 29062022 */
  swal({
    title: "Do you want to delete?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: false,
    closeOnCancel: true
},
function(isConfirm) {
    if (isConfirm) {
        $.ajax({
            url: base_url + enterprise_shortname + "/student-experience-delete",
            type: "POST",
            data: { csrf_test_name: CSRF_TOKEN, id: id },
            success: function(r) {
                //toastrSuccessMsg(r);
            },
        });
    }
});
/* lead inhouse by @Salehin 29062022 */
}

//=============== its for addmoreeducation ========================
("use strict");
edu = 0;
eduu = 1;
function addmoreeducation() {
  edu++;
  eduu++;
  var yeardynamic = $("#yeardynamic").val();

  $("#education_area").append(
    '<div id="rmvEdu' +
      edu +
      '"><hr>\n\
                        <div class="row mb-4">\n\
                            <div class="col-md-6">\n\
                                <div class="mb-3">\n\
                                    <label for="institutename_' +
      eduu +
      '" class="form-label mb-1 fw-medium">School/College/University/Institute *</label>\n\
                                    <input type="text" class="form-control form-control-lg" id="institutename_' +
      eduu +
      '" name="institutename[]">\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-md-6">\n\
                                <div class="mb-3">\n\
                                    <label for="degreename_' +
      eduu +
      '" class="form-label mb-1 fw-medium">Degree</label>\n\
                                    <input type="text" class="form-control form-control-lg" id="degreename_' +
      eduu +
      '" name="degreename[]]">\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                        <div class="row gx-3 gy-2 align-items-end mb-5">\n\
                            <div class="col-auto">\n\
                                <label class="visually-hidden" for="passing_year_' +
      eduu +
      '">Passing Year</label>\n\
                                <select class="form-select" id="passingyear_' +
      eduu +
      '" name="passing_year[]">\n\
                                <option value="">Choose Year</option>\n\
                               ' +
      yeardynamic +
      '\n\
                                </select>\n\
                            </div>\n\
                            <div class="col-auto ms-auto">\n\
                                <button type="button" class="btn btn-danger" onclick="removeeducation(this)">Delete</button>\n\
                            </div>\n\
                        </div>\n\
                    </div>'
  );
}

("use strict");
function removeeducation(experienceElem) {
  var parentid = $(experienceElem).parent().parent().parent().remove();
}

//    ================== its for educationEdit  ===========
("use strict");
function educationEdit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/education-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".modal_ttl").html("Education information update");
      $("#info").html(r);
      $("#modal_info").modal("show");
    },
  });
}

// ============ its for educationinfo_update ================
("use strict");
function educationinfo_update(id) {
  var institutename = $("#institutename").val();
  var degree = $("#degree").val();
  var passing_year = $("#passing_year").val();
  // alert(degree);
  // alert(institutename);return false;

  var fd = new FormData();
  fd.append("id", id);
  fd.append("user_id", user_id);
  fd.append("institutename", institutename);
  fd.append("degree", degree);
  fd.append("passing_year", passing_year);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/education-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
      $("#modal_info").modal("hide");
    },
  });
}

// ============= its for student education delete ===============
("use strict");
function educationDelete(id) {
  // var r = confirm("Do you want to delete??");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/student-education-delete",
  //     type: "POST",
  //     data: { csrf_test_name: CSRF_TOKEN, id: id },
  //     success: function (r) {
  //       toastrSuccessMsg(r);
  //     },
  //   });
  // }
  /* lead inhouse by @Salehin 26062022 */
  swal({
    title: "Do you want to delete?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: false,
    closeOnCancel: true
},
function(isConfirm) {
    if (isConfirm) {

        $.ajax({
            url: base_url + enterprise_shortname + "/student-education-delete",
            type: "POST",
            data: { csrf_test_name: CSRF_TOKEN, id: id },
            success: function(r) {
                //toastrSuccessMsg(r);
            },
        });

    }
});
/* lead inhouse by @Salehin 26062022 */
}

// ================ its for hiringinfoUpdate =============
("use strict");
function hiringinfoUpdate() {
  var is_hiringshow = $("#is_hiringshow").val();
  var hiringtitle = $("#hiringtitle").val();
  var hiringtype = $("#hiringtype").val();

  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("is_hiringshow", is_hiringshow);
  fd.append("hiringtitle", hiringtitle);
  fd.append("hiringtype", hiringtype);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/hiringinfo-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

// ==============its for contactInfoUpdate ==================
("use strict");
function contactInfoUpdate() {
  var is_contactshow = $("#is_contactshow").val();
  var is_contacttitle = $("#is_contacttitle").val();
  var contacttitle = $("#contacttitle").val();
  var public_email = $("#public_email").val();

  if (IsEmail(public_email) == false) {
    // toastrErrorMsg("invalid email!");
    /* lead inhouse by @Salehin 26062022 */
    swal({
      title: "invalid email!",
      type: "success",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });
  /* lead inhouse by @Salehin 26062022 */
    return false;
  }

  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("is_contactshow", is_contactshow);
  fd.append("is_contacttitle", is_contacttitle);
  fd.append("contacttitle", contacttitle);
  fd.append("public_email", public_email);

  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/contact-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      // toastrSuccessMsg(r);
      setTimeout(function () {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          timeOut: 1500,
        };
        toastr.success(r);
      }, 1000);
    },
  });
}

// ================= its for studentprofilepictureupload  ================
("use strict");
function studentprofilepictureupload(value) {
  var enterprise_id = $("#enterprise_id").val();

  var path = value.value;
  var extenstion = path.split(".").pop();
  if (
    extenstion == "jpg" ||
    extenstion == "svg" ||
    extenstion == "jpeg" ||
    extenstion == "png" ||
    extenstion == "gif" ||
    extenstion == "svg"
  ) {
    // document.getElementById('image-preview').src = window.URL.createObjectURL(value.files[0]);
    var filename = path
      .replace(/^.*[\\\/]/, "")
      .split(".")
      .slice(0, -1)
      .join(".");
    // alert(filename);
    // document.getElementById("filename").innerHTML = filename;
    var fd = new FormData();
    var CSRF_TOKEN = $("#csrf_token").val();
    fd.append("profilepic", $("#profilepic")[0].files[0]);
    fd.append("enterprise_id", enterprise_id);
    fd.append("csrf_test_name", CSRF_TOKEN);
    $.ajax({
      url: base_url + enterprise_shortname + "/student-profile-picture-update",
      type: "POST",
      data: fd,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      success: function (r) {
        toastrSuccessMsg(r);
        // $("#imgffront").val(r);
      },
    });
  } else {
    alert(
      "File not supported. Kindly Upload the Image of below given extension "
    );
  }
}
// ================= its for studentprofilepictureupload  ================
("use strict");
function studentcoverpictureupload(value) {
  var enterprise_id = $("#enterprise_id").val();

  var path = value.value;
  var extenstion = path.split(".").pop();
  if (
    extenstion == "jpg" ||
    extenstion == "svg" ||
    extenstion == "jpeg" ||
    extenstion == "png" ||
    extenstion == "svg" ||
    extenstion == "gif"
  ) {
    // document.getElementById('image-preview').src = window.URL.createObjectURL(value.files[0]);
    var filename = path
      .replace(/^.*[\\\/]/, "")
      .split(".")
      .slice(0, -1)
      .join(".");
    // alert(filename);
    // document.getElementById("filename").innerHTML = filename;
    var fd = new FormData();
    var CSRF_TOKEN = $("#csrf_token").val();
    fd.append("coverpicture", $("#coverpicture")[0].files[0]);
    fd.append("enterprise_id", enterprise_id);
    fd.append("csrf_test_name", CSRF_TOKEN);
    $.ajax({
      url: base_url + enterprise_shortname + "/student-cover-picture-update",
      type: "POST",
      data: fd,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      success: function (r) {
        toastrSuccessMsg(r);
      },
    });
  } else {
    alert(
      "File not supported. Kindly Upload the Image of below given extension "
    );
  }
}

function certificate() {
  var is_certificateshow = $("#is_certificateshow").val();
  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("is_certificateshow", is_certificateshow);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/certificateshow-update",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

("use strict");
function studentFollowInstructor(faculty_id) {
  var user_id = $("#user_id").val();
  var enterprise_id = $("#enterprise_id").val();
  // alert(user_id);
  // alert(faculty_id);return false;
  if (user_id == "") {
    // toastrErrorMsg("Please Login First!");
    /* Lead In house By @Salehin 28062022 */
    swal({
      title: "Please Login First!",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });
  /* Lead In house By @Salehin 28062022 */
    return false;
  }
  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("faculty_id", faculty_id);
  fd.append("enterprise_id", enterprise_id);
  fd.append("csrf_test_name", CSRF_TOKEN);

  $.ajax({
    url: base_url + enterprise_shortname + "/student-follow-instructor",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}
("use strict");
function studentUnfollowInstructor(id) {
  var user_id = $("#user_id").val();
  var enterprise_id = $("#enterprise_id").val();

  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("id", id);
  fd.append("enterprise_id", enterprise_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  var r = confirm("Are you Sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/student-unfollow-instructor",
      type: "POST",
      data: fd,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      success: function (r) {
        toastrSuccessMsg(r);
      },
    });
  }
}

("use strict");
function get_sectionbycourse(course_id) {
  var enterprise_id = $("#enterprise_id").val();
  var user_id = $("#user_id").val();

  $.ajax({
    url: base_url + enterprise_shortname + "/get-sectionbycourse",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      $("#section_id").html(r);
      get_coursepicture(course_id);
    },
  });
}
("use strict");
function get_lessonbycoursesection(section_id) {
  var enterprise_id = $("#enterprise_id").val();
  var course_id = $("#course_id").val();

  $.ajax({
    url: base_url + enterprise_shortname + "/get-lessonbycoursesection",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      section_id: section_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      $("#lesson_id").html(r);
    },
  });
}

function get_coursepicture(course_id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/get-coursepicture",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      console.log(r);
      $(".loadcoursethumbnail").html(r);
    },
  });
}

("use strict");
function projectdetailsdelete(id) {
  // var r = confirm("Do you want to delete?");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/project-details-delete",
  //     type: "POST",
  //     data: {
  //       csrf_test_name: CSRF_TOKEN,
  //       id: id,
  //       enterprise_id: enterprise_id,
  //     },
  //     success: function (r) {
  //       toastrErrorMsg(r);
  //       window.location.reload();
  //     },
  //   });
  // }
  /* lead inhouse by @Salehin 26062022 */
  swal({
    title: "Do you want to delete?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: false,
    closeOnCancel: true
},
function(isConfirm) {
    if (isConfirm) {

        $.ajax({
            url: base_url + enterprise_shortname + "/project-details-delete",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                id: id,
                enterprise_id: enterprise_id,
            },
            success: function(r) {
                //toastrErrorMsg(r);
                window.location.reload();
            },
        });

    }
});
/* lead inhouse by @Salehin 26062022 */
}

("use sctrict");
function typewiseproject(type, mode) {
  $.ajax({
    url: base_url + enterprise_shortname + "/type-wise-project-load",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      type: type,
      mode: mode,
      enterprise_id: enterprise_id,
      enterprise_shortname: enterprise_shortname,
    },
    success: function (r) {
      // setTimeout(function() {
      $(".load-project").html(r);
      // }, 1000);
      //Feather Icon
      feather.replace();
    },
  });
}

("use sctrict");
function typewiseprojectpublic(type, mode) {
  var student_id = $("#segment3").val();

  $.ajax({
    url: base_url + enterprise_shortname + "/type-wise-project-load-public",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      type: type,
      mode: mode,
      student_id: student_id,
      enterprise_id: enterprise_id,
      enterprise_shortname: enterprise_shortname,
    },
    success: function (r) {
      // setTimeout(function() {
      $(".load-project").html(r);
      // }, 1000);
    },
  });
}

// =============== its for studentprojectdelete ====================
("use strict");
function studentprojectdelete(project_id) {
  // var r = confirm("Do you want to delete?");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/student-project-delete",
  //     type: "POST",
  //     data: {
  //       csrf_test_name: CSRF_TOKEN,
  //       project_id: project_id,
  //       enterprise_id: enterprise_id,
  //     },
  //     success: function (r) {
  //       toastrErrorMsg(r);
  //       // window.location.reload();
  //       location.href =
  //         base_url + enterprise_shortname + "/student-profile-edit";
  //     },
  //   });
  // }
   /* lead inhouse by @Salehin 26062022 */
   swal({
    title: "Do you want to delete?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: false,
    closeOnCancel: true
},
function(isConfirm) {
    if (isConfirm) {

        $.ajax({
            url: base_url + enterprise_shortname + "/student-project-delete",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                project_id: project_id,
                enterprise_id: enterprise_id,
            },
            success: function(r) {
                toastrErrorMsg(r);
                // window.location.reload();
                location.href = base_url + enterprise_shortname + "/student-profile-edit";
            },
        });

    }
});
/* lead inhouse by @Salehin 26062022 */
}
("use strict");
function get_publicnotpublicstatus(status) {
  if (status == 0) {
    $("#projectpublish").prop("disabled", true);
    $("#projectsave").prop("disabled", false);
  } else if (status == 1) {
    $("#projectsave").prop("disabled", true);
    $("#projectpublish").prop("disabled", false);
  }
}

// ============= its for biographyUpdate ===============
// "use strict";
// function biographyUpdate(){
//   var user_id = $("#user_id").val();
//   var editor = $("#editor").val();
//   // var editor = CKEDITOR.instances['editor'].getData();
//   var des = $('textarea[id="editor"]').val()
//   alert(editor);
//   alert(des);
// }

// //============== its for checkout_signup ============
// "use strict";
// function checkout_signup() {
//     $("#modal_info").modal('hide');
// }

// // ============ its for typeahead_search =============
// "use strict";
// function typeahead_search() {
//     var item = $("#item").val();
//     var base_url = $("#base_url").val();
//     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
//     if (item == '') {
//         toastrErrorMsg("Empty field not allow!");
//         return false;
//     }
//     $.ajax({
//         url: base_url + "typeahead-search",
//         type: "POST",
//         data: {'csrf_test_name': CSRF_TOKEN, item: item},
//         success: function (r) {
//             $(".content_search").html(r);
//         }
//     });
// }
// //============== its for send_comment ============
// "use strict";
// function send_comment() {
//     var base_url = $("#base_url").val();
//     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
//     var user_type = $("#user_type").val();
//     var user_id = $("#user_id").val();
//     var event_id = $("#event_id").val();
//     var comment = $("#comment").val();
//     if (comment == '') {
//         toastrErrorMsg("Empty field not allow");
//         return false;
//     }
//     if (user_type == '' && user_id == '') {
//         toastrErrorMsg("Please Login First");
//     } else {
//         $.ajax({
//             url: base_url + "send-comment",
//             type: "POST",
//             data: {'csrf_test_name': CSRF_TOKEN, user_id: user_id, event_id: event_id, comment: comment},
//             success: function (r) {
//                 $("#comment").val('');
//                 toastrSuccessMsg(r);
//                 window.reload();
//             }
//         });
//     }
// }

//============== its for student password change ============
// ("use strict");
// function student_changepassword() {
//   var user_id = $("#user_id").val();
//   var current_password = $("#current_password").val();
//   var new_password = $("#new_password").val();
//   var retype_password = $("#retype_password").val();

//   if (current_password == "") {
//     toastrErrorMsg("Current password must be required");
//     $("#current_password").focus();
//     return false;
//   } else if (new_password == "") {
//     toastrErrorMsg("New password must be required");
//     $("#new_password").focus();
//   } else if (retype_password == "") {
//     toastrErrorMsg("Retype password must be required");
//     $("#retype_password").focus();
//     return false;
//   }
//   if (new_password != retype_password) {
//     toastrErrorMsg("New password and retype password does not match");
//     return false;
//   }
//   $.ajax({
//     url: base_url + enterprise_shortname + "/student-password-update",
//     type: "POST",
//     data: {
//       csrf_test_name: CSRF_TOKEN,
//       user_id: user_id,
//       current_password: current_password,
//       new_password: new_password,
//       retype_password: retype_password,
//     },
//     success: function (r) {
//       if (r == 0) {
//         toastrErrorMsg("Current password does not match");
//         return false;
//       } else if (r == 1) {
//         toastrSuccessMsg("Updated successfully");
//       }
//     },
//   });
// }

function student_changepassword() {
  //     var base_url = $("#base_url").val();
  //     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var user_id = $("#user_id").val();
  var current_password = $("#current_password").val();
  var new_password = $("#new_password").val();
  var retype_password = $("#retype_password").val();

  if (current_password == "") {

      //toastrErrorMsg("Current password must be required");

      swal({
          title: "Current password must be required",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });

      $("#current_password").focus();

      return false;

  } else if (new_password == "") {

      //toastrErrorMsg("New password must be required");

      swal({
          title: "New password must be required",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });

      $("#new_password").focus();

  } else if (retype_password == "") {

      //toastrErrorMsg("Retype password must be required");

      swal({
          title: "Retype password must be required",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });

      $("#retype_password").focus();

      return false;

  }
  if (new_password != retype_password) {

      //toastrErrorMsg("New password and retype password does not match");

      swal({
          title: "New password and retype password does not match",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });

      return false;
  }
  $.ajax({
      url: base_url + enterprise_shortname + "/student-password-update",
      type: "POST",
      data: {
          csrf_test_name: CSRF_TOKEN,
          user_id: user_id,
          current_password: current_password,
          new_password: new_password,
          retype_password: retype_password,
      },
      success: function(r) {
          if (r == 0) {

              //toastrErrorMsg("Current password does not match");

              swal({
                  title: "Current password does not match",
                  type: "warning",
                  showCancelButton: false,
                  confirmButtonColor: '#14AD54',
                  confirmButtonText: 'OK',
                  // cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false
              });

              return false;

          } else if (r == 1) {

              //toastrSuccessMsg("Updated successfully");

              swal({
                  title: "Updated successfully",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonColor: '#14AD54',
                  confirmButtonText: 'OK',
                  // cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false
              });

          }
      },
  });
}


("use strict");
function saveLanguage() {
  var user_id = $("#user_id").val();
  var language = $("#language").val();

  if (language == "") {
    // toastrErrorMsg("Please select your language");
    /* lead inhouse by @Salehin 26062022 */
    swal({
      title: "Please select your language",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });

  /* lead inhouse by @Salehin 26062022 */
    $("#language").focus();
    return false;
  }
  $.ajax({
    url: base_url + enterprise_shortname + "/language-update",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, user_id: user_id, language: language },
    success: function (r) {
      toastrSuccessMsg(r);
    },
  });
}

("use strict");
function stickynotesave() {
  var enterprise_id = $("#enterprise_id").val();
  var user_id = $("#user_id").val();
  var title = $("#notetitle").val();
  var description = $("#description").val();
  if (title == "") {
    // toastrErrorMsg("Title must be required");
    /* lead inhouse by @Salehin 26062022 */
    swal({
      title: "Title must be required",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });
  /* lead inhouse by @Salehin 26062022 */
    $("#notetitle").focus();
    return false;
  }
  if (description == "") {
    // toastrErrorMsg("Description must be required");
     /* lead inhouse by @Salehin 26062022 */
     swal({
      title: "Description must be required",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });
  /* lead inhouse by @Salehin 26062022 */
    $("#description").focus();
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/sticky-note-save",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      enterprise_id: enterprise_id,
      user_id: user_id,
      title: title,
      description: description,
    },
    success: function (r) {
      toastrSuccessMsg(r);
      // toastr.success(r);
      $("#notetitle").val("");
      $("#description").val("");
      $("#NoteModal").modal("hide");
      // $(".note-carousel").load();
    },
  });
}

// ("use strict");
// function stickynoteedit(id,sl) {
//   $.ajax({
//     url: base_url + enterprise_shortname + "/stickynoteedit-form",
//     type: "POST",
//     data: { csrf_test_name: CSRF_TOKEN, id: id },
//     success: function (r) {
//       // alert(r);
//       var obj=JSON.parse(r);
//       var title=obj.title;
//       var notes=obj.notes;
//       var ids= obj.id;
//       $("#NoteModal").modal('show');
//       $("#notetitle").val(title);
//       $("#description").val(notes);
//       $("#stickynote_id").val(ids);
//       $(".modal-title").html('Update Note');
//       $('#stickynoteupdate').show();
//       $('#stickynotesave').hide();
//     },
//   });
// }

("use strict");
function updateStickynote(id, sl) {
  var title = $("#notetitle_" + sl).val();
  var description = $("#notedescription_" + sl).val();
  var enterprise_id = $("#enterprise_id").val();
  var user_id = $("#user_id").val();
  if (id != "") {
    if (title == "") {
      // toastrErrorMsg("Title must be required");
       /* lead inhouse by @Salehin 29062022 */
       swal({
        title: "Title is required",
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: '#14AD54',
        confirmButtonText: 'OK',
        // cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    });
    /* lead inhouse by @Salehin 29062022 */
      $("#notetitle").focus();
      return false;
    }
    if (description == "") {
      // toastrErrorMsg("Description must be required");
      /* lead inhouse by @Salehin 29062022 */
      swal({
        title: "Description must be required",
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: '#14AD54',
        confirmButtonText: 'OK',
        // cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    });
    /* lead inhouse by @Salehin 29062022 */
      $("#description").focus();
      return false;
    }
    $.ajax({
      url: base_url + enterprise_shortname + "/sticky-note-update",
      type: "POST",
      data: {
        id: id,
        csrf_test_name: CSRF_TOKEN,
        enterprise_id: enterprise_id,
        user_id: user_id,
        title: title,
        description: description,
      },
      success: function (r) {
        toastr.success(r);
        // toastrSuccessMsg(r);
        // $("#notetitle").val("");
        // $("#description").val("");
        // $("#NoteModal").modal('hide');
      },
    });
  }
}

// ============= its for deleteStickynote ===============
function deleteStickynote(id) {
  // var title = $("#notetitle_1").text();
  // var r = confirm("Do you want to delete?");
  // if (r == true) {
  //   $.ajax({
  //     url: base_url + enterprise_shortname + "/sticky-note-delete",
  //     type: "POST",
  //     data: { csrf_test_name: CSRF_TOKEN, id: id, title: title },
  //     success: function (r) {
  //       toastrSuccessMsg(r);
  //       $("#note_item").load();
  //     },
  //   });
  // }
  /* lead inhouse by @Salehin 26062022 */
  swal({
    title: "Do you want to delete?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: '#14AD54',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: false,
    closeOnCancel: true
},
function(isConfirm) {
    if (isConfirm) {
        var title = $("#notetitle_1").text();
        $.ajax({
            url: base_url + enterprise_shortname + "/sticky-note-delete",
            type: "POST",
            data: { csrf_test_name: CSRF_TOKEN, id: id, title: title },
            success: function(r) {
                toastrSuccessMsg(r);
                $("#note_item").load();
            },
        });

    }
});
/* lead inhouse by @Salehin 26062022 */
}

// //=========== its for mail special character remove =========
("use strict");
function mail_specialcharacter_remove(vtext, id) {
  var specialChars = $("#mail_specialcharacter_remove").val();
  var check = function (string) {
    for (i = 0; i < specialChars.length; i++) {
      if (string.indexOf(specialChars[i]) > -1) {
        return true;
      }
    }
    return false;
  };
  if (check($("#" + id).val()) == false) {
    // Code that needs to execute when none of the above is in the string
  } else {
    toastrErrorMsg(specialChars + " these special character are not allowed");
    $("#" + id)
      .val("")
      .focus();
  }
}

// //=========== its for coursespecial_character_remove =========
("use strict");
function coursespecial_character_remove(vtext, id) {
  var specialChars = $("#coursespecial_character").val();
  var check = function (string) {
    for (i = 0; i < specialChars.length; i++) {
      if (string.indexOf(specialChars[i]) > -1) {
        return true;
      }
    }
    return false;
  };
  if (check($("#" + id).val()) == false) {
    // Code that needs to execute when none of the above is in the string
  } else {
    toastrErrorMsg(specialChars + " these special character are not allowed");
    $("#" + id)
      .val("")
      .focus();
  }
}
// //=========== its for special character remove =========
("use strict");
function special_character_remove(vtext, id) {
  var specialChars = $("#security_character").val();
  var check = function (string) {
    for (i = 0; i < specialChars.length; i++) {
      if (string.indexOf(specialChars[i]) > -1) {
        return true;
      }
    }
    return false;
  };
  if (check($("#" + id).val()) == false) {
    // Code that needs to execute when none of the above is in the string
  } else {
    toastrErrorMsg(specialChars + " these special character are not allowed");
    $("#" + id)
      .val("")
      .focus();
  }
}
// //=========== its for only number allow=========
("use strict");
function onlynumber_allow(vtext, id) {
  var specialChars = $("#onlynumber_allow").val();
  var check = function (string) {
    for (i = 0; i < specialChars.length; i++) {
      if (string.indexOf(specialChars[i]) > -1) {
        return true;
      }
    }
    return false;
  };
  if (check($("#" + id).val()) == false) {
    // Code that needs to execute when none of the above is in the string
  } else {
    toastrErrorMsg(specialChars + " these special character are not allowed");
    $("#" + id)
      .val("")
      .focus();
  }
}
//============== its for forgotpassword_form ============
("use strict");
function forgotpassword_form() {
  $.ajax({
    url: base_url + enterprise_shortname + "/forgotpassword-form",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN },
    success: function (r) {
      $("#forgotmodal_info").modal("show");
      $(".forgotmodal_ttl").html("Forgot Password");
      $("#forgotinfo").html(r);
      $("#forgot_email").focus();
      $("#checkout").attr("value", "");
    },
  });
}
//============= its for forgotpassword_send =============
("use strict");
function forgotpassword_send() {
  var email = $("#forgot_email").val();
  var enterprise_id = $("#enterprise_id").val();
  if (email == "") {
    // toastrErrorMsg("Email must be required!");
     /* lead inhouse by @Salehin 26062022 */
     swal({
      title: "Email must be required!",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });
  /* lead inhouse by @Salehin 26062022 */
    return false;
  }
  // alert(email);
  if (IsEmail(email) == false) {
    // toastrErrorMsg("Invalid mail");
    // toastr.error("Invalid mail");
        /* lead inhouse by @Salehin 26062022 */
        swal({
          title: "Invalid email",
          type: "info",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });

      /* lead inhouse by @Salehin 26062022 */
    return false;
  }

  // toastrErrorMsg("Mail option didn't set yet");
  // return false;
  $.ajax({
    url: base_url + enterprise_shortname + "/forgot-password-send",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      email: email,
      enterprise_id: enterprise_id,
      enterprise_shortname: enterprise_shortname,
    },
    success: function (r) {
      $("#forgot_email").val("");
      if (r == 1) {
        $("#forgotmodal_info").modal("hide");
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
          };
          toastr.success("Please check your email!");
        }, 1000);
      } else {
        setTimeout(function () {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
          };
          toastr.error("Invalid email!");
        }, 1000);
      }
    },
  });
}

// ========= its for resetpassword =============
("use strict");
function resetpassword(log_id) {
  var newpassword = $("#newpassword").val();
  if (newpassword == "") {
    // toastrErrorMsg("Empty field not allow");
    /* lead inhouse by @Salehin 26062022 */
    swal({
      title: "Empty field not allow",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: '#14AD54',
      confirmButtonText: 'OK',
      // cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
  });
  /* lead inhouse by @Salehin 26062022 */
    $("#newpassword").focus();
    return false;
  }

  $.ajax({
    url: base_url + enterprise_shortname + "/password-reset",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      newpassword: newpassword,
      log_id: log_id,
    },
    success: function (r) {
      $("#newpassword").val("");
      setTimeout(function () {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: "slideDown",
          timeOut: 1500,
        };
        toastr.success(r);
      }, 1000);
    },
  });
}

// //============== its for purchase lesson check =============
// "use strict";
// function purchaselessoncheck() {
//     toastrErrorMsg("You have to purchase this course first");
//     return false;
// }

// //============== its for forgotpassword_form ============
// "use strict";
// function courseQuickView(course_id) {
//     var base_url = $("#base_url").val();
//     var CSRF_TOKEN = $('#CSRF_TOKEN').val();
//     $.ajax({
//         url: base_url + "course-quick-view",
//         type: "POST",
//         data: {'csrf_test_name': CSRF_TOKEN, course_id: course_id},
//         success: function (r) {
//             $("#course_view").html(r);
//             $("#courseQuickView").modal('show');
//         }
//     });
// }

("use strict");
function category_loadmore_data(ids) {
  // $(".load").on("click", function () {
  // var ids = $(this).attr("id");
  var category_id = $("#category_id").val();
  var enterprise_shortname = $("#enterprise_shortname").val();
  // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
  $.ajax({
    type: "POST",
    url: base_url + enterprise_shortname + "/locad-more-course",
    cache: false,
    data: {
      lastid: ids,
      category_id: category_id,
      enterprise_shortname: enterprise_shortname,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (response) {
      // alert(response);
      // console.log(response);
      // return false;
      $("#alldata").append(response);
      // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
      //remove old load more button

      $("#load" + ids).remove();
      $(".removebuton_" + ids).remove();
      $(".hideClass .course").each(function (index) {
        var p_course_id = $(this).attr("id");
        $("#course_subscription_" + p_course_id)
          .first()
          .hide();
        $("#course_subscription_" + p_course_id)
          .first()
          .removeClass("d-flex");
      });
      $(".popup-youtube").YouTubePopUp();
    },
  });
  // });
}

("use strict");
function category_course_filtering_loadmore(ids) {
  // $(".load").on("click", function () {
  // var ids = $(this).attr("id");
  var category_id = $("#category_id").val();
  var category_type = $("#category_type").val();
  var enterprise_shortname = $("#enterprise_shortname").val();
  // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
  $.ajax({
    type: "POST",
    url: base_url + enterprise_shortname + "/course-filtering-loadmore",
    cache: false,
    data: {
      lastid: ids,
      category_id: category_id,
      course_type: category_type,
      enterprise_shortname: enterprise_shortname,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (response) {
      // console.log(response);
      // return false;
      $("#alldata").append(response);
      // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
      //remove old load more button

      $("#load" + ids).remove();
      $(".removebuton_" + ids).remove();
      $(".hideClass .course").each(function (index) {
        var p_course_id = $(this).attr("id");
        $("#course_subscription_" + p_course_id)
          .first()
          .hide();
        $("#course_subscription_" + p_course_id)
          .first()
          .removeClass("d-flex");
      });
      $(".popup-youtube").YouTubePopUp();
    },
  });
  // });
}

// course details project load more
function project_loadmore_data(ids) {
  var enterprise_shortname = $("#enterprise_shortname").val();
  var course_id = $("#course_id").val();

  // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
  $.ajax({
    type: "POST",
    url: base_url + enterprise_shortname + "/locad-more-project",
    cache: false,
    data: {
      lastid: ids,
      course_id: course_id,
      enterprise_shortname: enterprise_shortname,
      csrf_test_name: CSRF_TOKEN,
    },
    success: function (response) {
      $("#project_load_more").append(response);
      // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
      //remove old load more button
      $("#home_course_load" + ids).remove();
      $(".removebuton_" + ids).remove();

      //   $(".hideClass .course" ).each(function( index ) {
      //     var p_course_id=$(this).attr('id');
      //   $("#course_subscription_"+p_course_id).first().hide();
      //   $('#course_subscription_'+p_course_id).first().removeClass('d-flex');
      // });
      // $(".popup-youtube").YouTubePopUp();
    },
  });
}

// student take a note  start   course details
// $(document).ready(function () {
//   var segment1 = $("#segment1").val();
//     if(segment1 != ''){
//     "use strict";
//     let theEditor;

//     ClassicEditor.create(document.querySelector("#editor"), {
//       toolbar: ["bold", "italic", "link", "bulletedList", "numberedList"],
//     })
//       .then((editor) => {
//         theEditor = editor;
//       })
//       .catch((error) => {
//         console.error(error);
//       });

//     function getDataFromTheEditor() {
//       return theEditor.getData();
//     }

//     document.getElementById("getdata").addEventListener("click", () => {
//       var enterprise_shortname = $("#enterprise_shortname").val();
//       var enterprise_id = $("#enterprise_id").val();
//       var student_id = $("#student_id").val();
//       var course_id = $("#course_id").val();
//       var lesson_id = $("#last_lesson").val();
//       var endtimevalues = $("#pauseNotetime").val();
//       var notes = getDataFromTheEditor();
//       // alert(endtimevalues); return false;

//       //   getnoteslist();
//       // return false;
//       if (notes == "") {
//         setTimeout(function () {
//           toastr.options = {
//             closeButton: true,
//             progressBar: true,
//             showMethod: "slideDown",
//             timeOut: 1500,
//           };
//           // toastr.error("Empty field not allow!");
//           /* lead inhouse by @Salehin 26062022 */

//           swal({
//             title: "Empty field not allow!",
//             type: "warning",
//             showCancelButton: false,
//             confirmButtonColor: '#14AD54',
//             confirmButtonText: 'OK',
//             // cancelButtonText: "No",
//             closeOnConfirm: false,
//             closeOnCancel: false
//         });

//         /* lead inhouse by @Salehin 26062022 */
//         }, 1000);
//         return false;
//       }
//       if (lesson_id == "") {
//         setTimeout(function () {
//           toastr.options = {
//             closeButton: true,
//             progressBar: true,
//             showMethod: "slideDown",
//             timeOut: 1500,
//           };
//           // toastr.error("Please select first any lesson!");
//           /* lead inhouse by @Salehin 26062022 */

//           swal({
//             title: "Please select first any lesson!",
//             type: "warning",
//             showCancelButton: false,
//             confirmButtonColor: '#14AD54',
//             confirmButtonText: 'OK',
//             // cancelButtonText: "No",
//             closeOnConfirm: false,
//             closeOnCancel: false
//         });

//         /* lead inhouse by @Salehin 26062022 */
//         }, 1000);
//         return false;
//       }
//       //        alert(enterprise_id); return false;

//       $.ajax({
//         url: base_url + enterprise_shortname + "/course-notesave",
//         type: "POST",
//         data: {
//           csrf_test_name: CSRF_TOKEN,
//           student_id: student_id,
//           course_id: course_id,
//           lesson_id: lesson_id,
//           enterprise_id: enterprise_id,
//           notes: notes,
//           endtimevalues: endtimevalues,
//         },
//         success: function (r) {
//           theEditor.setData("");
//           // toastrSuccessMsg(r);
//           toastr.success(r);
//           getnoteslist();
//         },
//       });
//     });
//   }
// });
function getnoteslist() {
  var student_id = $("#student_id").val();
  var course_id = $("#course_id").val();
  var lesson_id = $("#last_lesson").val();
  $.ajax({
    url: base_url + enterprise_shortname + "/get-noteslist",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      student_id: student_id,
      course_id: course_id,
      lesson_id: lesson_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      $("#loadnotes").html(r);
    },
  });

  $.ajax({
    url: base_url + enterprise_shortname + "/get-notecount",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      student_id: student_id,
      course_id: course_id,
      lesson_id: lesson_id,
      enterprise_id: enterprise_id,
    },
    success: function (res) {
      $(".notecount-area").html(res);
    },
  });
}

//    =============== its for existing_mailcheck ==========
("use strict");
function existing_mailcheck() {
  var email = $("#mail").val();
  var email = encodeURIComponent(email);
  $.ajax({
    url: base_url + enterprise_shortname + "/uniqueemail-check",
    type: "post",
    data: { csrf_test_name: CSRF_TOKEN, email: email },
    success: function (data) {
      // console.log(data);
      if (data == 1) {
        $("#mail").focus().val("");
        // toastrErrorMsg("This email already exists!");
        /* lead inhouse by @Salehin 26062022 */
        swal({
          title: "This email already exists!",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });
      /* lead inhouse by @Salehin 26062022 */
        return false;
      }
    },
  });
}


//    =============== its for existing_mailcheck ==========
("use strict");
function existing_mobilecheck() {
  var mobile = $("#mobile").val();
  var mobile = encodeURIComponent(mobile);
  $.ajax({
    url: base_url + enterprise_shortname + "/uniquemobile-check",
    type: "post",
    data: { csrf_test_name: CSRF_TOKEN, mobile: mobile },
    success: function (data) {
      // console.log(data);
      if (data == 1) {
        $("#mobile").focus().val("");
        // toastrErrorMsg("This email already exists!");
        /* lead inhouse by @Salehin 26062022 */
        swal({
          title: "This mobile already exists!",
          type: "warning",
          showCancelButton: false,
          confirmButtonColor: '#14AD54',
          confirmButtonText: 'OK',
          // cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
      });
      /* lead inhouse by @Salehin 26062022 */
        return false;
      }
    },
  });
}


// student take a note end

// ============= its for student profile edit biography ==================
$(document).ready(function () {
  var segment1 = $("#segment1").val();
    if(segment1 != ''){
    "use strict";
    let BioEditor;

    ClassicEditor.create(document.querySelector("#bieditor"), {
      toolbar: ["bold", "italic", "link", "bulletedList", "numberedList"],
    })
      .then((bieditor) => {
        BioEditor = bieditor;
      })
      .catch((error) => {
       // console.error(error);
      });

    function getDataFromBioEditor() {
      return BioEditor.getData();
    }
    if(document.getElementById("getdatas") != null){
      document.getElementById("getdatas").addEventListener("click", () => {
        var notes = getDataFromBioEditor();
        var user_id = $("#user_id").val();
        var is_biographyshow = $("#is_biographyshow").val();
        // alert('notes');return false;
        if (notes == "") {
          // toastrErrorMsg("Biography must be required!");
          /* lead inhouse by @Salehin 26062022 */
          swal({
            title: "Biography must be required!",
            type: "waring",
            showCancelButton: false,
            confirmButtonColor: '#14AD54',
            confirmButtonText: 'OK',
            // cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        });
        /* lead inhouse by @Salehin 26062022 */
          return false;
        }
        var fd = new FormData();
        fd.append("user_id", user_id);
        fd.append("is_biographyshow", is_biographyshow);
        fd.append("notes", notes);
        fd.append("csrf_test_name", CSRF_TOKEN);
        $.ajax({
          url: base_url + enterprise_shortname + "/biography-update",
          type: "POST",
          data: fd,
          enctype: "multipart/form-data",
          processData: false,
          contentType: false,
          success: function (r) {
            toastrSuccessMsg(r);
            // location.href = base_url + enterprise_shortname + "/settings/30";
          },
        });
      });
    }
  }
});



function En2BnStaticText(){

  // Home Page
  $('.courses').text('কোর্সসমূহ');
  $('.top_search_txt').attr('placeholder', 'আপনি কী শিখতে চান?');
  $('.all_courses').text('সকল কোর্স');
  $('.signin').text('সাইন-ইন');
  $('.signup').text('নিবন্ধন করুন');
  $('.about').text('সম্পর্কিত তথ্য');
  $('.learner').text('শিক্ষার্থী');
  $('.instructor').text('প্রশিক্ষক');
  $('.enterprise').text('উদ্যোগ');
  $('.library').text('লাইব্রেরি');
  $('.event').text('ইভেন্ট');
  $('.blog').text('ব্লগ');
  $('.project').text('প্রকল্প');
  $('.explore_course').text('কোর্স অনুসন্ধান করুন');
  $('.addTocart').text('কার্টে যোগ করুন');
  $('.enroll').text('নিবন্ধিত');
  $('.details_txt').text('বিস্তারিত');
  $('.goto_course_txt').text('কোর্স এ প্রবেশ করুন');
  $('.all_category').text('সকল ক্যাটাগরি');
  $('.browse_more').text('আরো কোর্স দেখুন');
  $('.coll_text').text('সহযোগী প্রতিষ্ঠান');
  $('.learn_anything').text('যেকোনো জায়গায় যেকোনো কিছু শিখে আপনার ভবিষ্যৎ নিশ্চিত করুন।');
  $('.featured_in').text('প্রচারসমূহ');
  $('.strength_number').text('আমাদের পরিসংখ্যান');
  // $('.testimonial').text('প্রশংসাপত্র');
  $('.learner_saying').text('আমাদের ছাত্ররা কি বলছে');
  $('.ready_to_start').text('শুরু করার জন্য প্রস্তুত?');
  $('.monthly').text('মাসিক');
  $('.yearly').text('বার্ষিক');
  $('.free').text('বিনামূল্যে');
  $('.any_question').text('কোনো প্রশ্ন?');
  $('.need_consultation').text('পরামর্শ প্রয়োজন');
  $('.contact_us').text('যোগাযোগ করুন');
  $('.offers_updates').text('বিশেষ অফার এবং আপডেট সম্পর্কে আমাদের ইমেল করতে চান?');
  $('.newsletter').text('নিউজলেটার');

  // course details page
  $('.ins_txt').text('প্রশিক্ষক');
  $('.course_level_txt').text('কোর্স স্তর');
  $('.duration_txt').text('সময়কাল');
  $('.rating_txt').text('রেটিং');
  $('.students_txt').text('শিক্ষার্থী');
  $('.overview_txt').text('পরিদর্শন');
  $('.prerequisites_txt').text('পূর্বশর্ত');
  $('.outcome_txt').text('ফলাফল');
  $('.lessons_txt').text('সমস্ত পাঠ');
  $('.review_txt').text('পর্যবেক্ষণ');
  $('.student_work_txt').text('কার্য');
  $('.faq_txt').text('প্রায়শই জিজ্ঞাসিত প্রশ্ন');
  $('.save_txt').text('সংরক্ষণ');
  $('.share_txt').text('শেয়ার');
  $('.about_this_course').text('এই কোর্স সম্পর্কে');
  $('.read_more_txt').text('আরো পড়ুন');
  $('.what_will_i_learn_txt').text('আমি কি শিখব?');
  $('.topics_for_this_course').text('এই কোর্সের জন্য বিষয়');
  $('.course_content').text('কোর্সের বিষয়বস্তু');
  $('.meet_your_instructor_txt').text('আপনার প্রশিক্ষকের সাথে দেখা করুন');
  $('.follow_ins_txt').text('এই প্রশিক্ষক অনুসরণ করুন');
  $('.unfollow_ins_txt').text('এই প্রশিক্ষককে অনুসরণ করা বন্ধ করুন');
  $('.student_feedback_txt').text('ছাত্রদের প্রতিক্রিয়া');
  $('.browse_more').text('আরও ব্রাউজ করুন');
  $('.related_course_txt').text('সম্পর্কিত কোর্স');
  $('.browse_more_course_txt').text('আরও কোর্স ব্রাউজ করুন');

  //category course page

  // About Page
  $('.about_txt').text('লিড একাডেমী সম্পর্কে');
  $('.mission_txt').text('লক্ষ্য');
  $('.why_choose_us').text('কেন আমাদের নির্বাচন করেছে');
  $('.why_choose_short_text').text('যা আমাদের অন্য যেকোনো স্থানীয় অনলাইন শিক্ষার সাথে অতুলনীয় করে তোলে প্ল্যাটফর্ম');
  $('.service_txt').text('আমাদের সেবাসমূহ');

  // Contact Us Page
  $('.contact_txt').text('আমাদের সাথে যোগাযোগ করুন');

  // All course text
  $('.all_categories_txt').text('সকল ক্যাটাগরি');
  $('.cat_shot_txt').text('আপনি এই কোর্সগুলি অন্বেষণ করার সাথে সাথে আপনাকে কী মুগ্ধ করে তা খুঁজুন।');
  $('.course_search_txt').attr('placeholder', 'কোর্সের জন্য অনুসন্ধান করুন');
  // $(this).text('EN');
}


// $(function(){
//   // let url = $(location).attr('href');
//   let setLanguage = $('#set_language').val();
//   // alert(setLanguage);
//   if(setLanguage == 'en'){
//     $('#menu').load(location.href + " #menu");
//     $('#courseCart').load(location.href + " #courseCart");
//     // $('#set_language').load(location.href + " #set_language");
//   }else if(setLanguage == 'bn'){
//     En2BnStaticText();
//     $('#menu').load(location.href + " #menu");
//     $('#courseCart').load(location.href + " #courseCart");
//     // $('#set_language').load(location.href + " #set_language");
//   }
// });

// function languageSwitch(){
//   let setLanguage = $('#set_language').val();
//   if(setLanguage == 'en'){
//     //url.reload();
//   }else if(setLanguage == 'bn'){
//     En2BnStaticText();
//   }
// }



/*
  // Language Switch Start
  $(function(){
    let url = $(location).attr('href');
    $.ajax({
      url : base_url + 'load-language-switcher',
      type : 'POST',
      data : {
        csrf_test_name : CSRF_TOKEN,
        url : url,
      },
      success : function(res) {
        $('#languageSwitcher').html(res);
      }
    });
  });
*/
/*
  $('#languageSwitch').on('click',function(e){
    e.preventDefault();
    // define url
    let url = $(location).attr('href');
    // let rest = url.substring(0, url.lastIndexOf("/") + 1);
    let last = url.substring(url.lastIndexOf("/") + 1, url.length);

    if(last == 'bn'){

      url.reload();

    }else{

      window.history.pushState('obj', 'newtitle', url + '/bn');

      En2BnStaticText();

      // location.reload();

      // setTimeout(function() {
      //   En2BnStaticText();
      // }, 1000);

      // setInterval(function my_function(){
      //   En2BnStaticText();
      // }, 1000);

    }

  });

*/
/*
  function en2bn(){

    // define url
    let url = $(location).attr('href');
    let rest = url.substring(0, url.lastIndexOf("") + 1);
    let last = url.substring(url.lastIndexOf("/") + 1, url.length);

    // alert(rest);
    // return false;

    if(last == 'bn'){

      window.history.replaceState('obj', 'newtitle', rest);
      location.reload();

    }else{

      window.history.pushState('obj', 'newtitle', url + '/bn');
      // location.reload();
      En2BnStaticText();

    }

  }
*/


