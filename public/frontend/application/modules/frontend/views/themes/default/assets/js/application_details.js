$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$(".userInfo span").text(location.search.split("=")[1]);
//Fetching data
async function fetchData(url = "") {
    const response = await fetch(url, {
        method: "GET",
    });
    return response.json();
}
//Submit data
async function submitData(url = "", data = {}) {
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });
    return response.json();
}
let cny_exchange_rates = 6;

//Get application data
// const applicationData = fetchData("/api/application/detail/" + location.search);
// applicationData
//     .then((response) => {
//         if (response.code == -1) {
//             $.wnoty({
//                 type: "error",
//                 message: `Application ${
//                     location.search.split("=")[1]
//                 } not found or not yours, Please contact support if needed`,
//                 autohide: false,
//             });
//         } else {
//             $("#application-id").text(location.search.split("=")[1]);
//             application_state = response.data.state;
//             var data = response.data;
//             console.log(data.waits_for);
//             ORIG_APP_FEE = data.origin_app_fee;
//             APP_FEE = data.application_fee;
//             SRV_FEE = data.service_fee;
//             OPT_SRV_FEE = data.opt_srv_fee;
//             TOTAL_FEE = data.fee;
//             updateFees();

//             cny_exchange_rates = parseFloat(response.exchange_rates.rates.CNY);

//             $(".application-fee,.service-fee-container,.total-fee").removeClass(
//                 "d-none"
//             );

//             //Set UI to application state
//             $(".status-current-step").text(response.data.status);

//             showForms();

//             $(".status-next-step").text(response.data.next_step);
//             $(".step-" + response.data.state).removeClass("d-none");
//             $(".notes").text(response.data.notes);
//             total_programs = response.data.programs.length;
//             for (var i = 0; i < response.data.programs.length; i++) {
//                 createApplicationDetails(
//                     response.data.programs[i],
//                     response.data.status
//                 );
//             }
//             if (data.waits_for !== "USER_SURVEY") {
//                 $(".delete-prog-btn").hide();
//                 $(".btn-add-prog").hide();
//             }

//             var selected_srv = data.survey_data.confirmation.optional_service;
//             //Get application optional services
//             getOptionalServices(selected_srv);

//             /* -------------------------------------------------------------------------- */
//             /*                       Parse application data to form                       */
//             /* -------------------------------------------------------------------------- */

//             var data = response.data.survey_data;

//             //Set optional info
//             if (data["personal"] && data["personal"]["is_in_china"])
//                 data.personal.is_in_china =
//                     data.personal.is_in_china.toString();

//             $("#aboutyou").jsonToForm(data.personal);
//             $(function () {
//                 if (data["personal"] && data["personal"]["nationality"])
//                     $("select#nationality")
//                         .val(data.personal.nationality)
//                         .trigger("change");
//                 else $("select#nationality").val("").trigger("change");
//             });

//             $("select#nationality").on("change", function () {
//                 var value = $(this).val();
//                 var text = $("#nationality option:selected").text();
//                 if (["CN", "HK", "TW", "MO"].indexOf(value) != -1) {
//                     $("#msg-nationality").text(
//                         `This platform is only for international students and students from ${text} are not able to apply. Please contact the university directly to apply`
//                     );
//                     $("#msg-nationality").show();
//                     $("#financialsupport-step").attr("disabled", true);
//                 } else {
//                     $("#msg-nationality").hide();
//                     $("#financialsupport-step").attr("disabled", false);
//                 }
//                 setFormHeight();
//             });

//             $("select#is_in_china").on("change", function () {
//                 var value = $(this).val();
//                 console.log(value);
//                 if (value === "true") {
//                     $("#msg-in-china").show();
//                 } else {
//                     $("#msg-in-china").hide();
//                 }
//             });

//             $("select#fund").on("change", function () {
//                 var value = $(this).val();
//                 if (value === "Self finance") {
//                     $("#msg-fund").html("");
//                     $("#txt-scholarship").hide();
//                     $(".supporting-doc").attr("disabled", false);
//                 } else if (value === "Chinese Government Scholarship") {
//                     $("#msg-fund").html(
//                         "Unfortunately we can't help you apply for the CSC Scholarship on China Admissions. But you can apply to the university here, and apply for the scholarship by yourself. " +
//                             'Please see the guide on how to apply <a style="color:#d71f27" href="https://www.china-admissions.com/blog/china-scholarship/" target="_blank" rel="noopener noreferrer">here</a> for CSC.'
//                     );
//                     $("#txt-scholarship").hide();
//                     $(".supporting-doc").attr("disabled", true);
//                 } else {
//                     $("#msg-fund").html("");
//                     $("#txt-scholarship").show();
//                     $(".supporting-doc").attr("disabled", false);
//                 }
//                 setFormHeight();
//             });

//             //Set contact info
//             $("#aboutyou").jsonToForm(data.contact);
//             $("#financialsupport").jsonToForm(data.family_finance);

//             //Set address info
//             if (data.home_address != undefined) {
//                 if (data.home_address.city) {
//                     fetchData("/api/address/list/").then((response) => {
//                         if (response.code == 0 && response.data.length != 0) {
//                             //This will overide if there are multiple addresses of type H
//                             response.data.forEach(function (addr) {
//                                 if (addr.type == "H")
//                                     $("#home_address").jsonToForm(addr);
//                             });
//                         } else {
//                             $("#home_address").find("[name=id]").remove();
//                         }
//                     });
//                 }
//             } else {
//                 $("#home_address").jsonToForm(data.home_address);
//             }
//             if (data.post_address != undefined) {
//                 if (data.post_address.city) {
//                     fetchData("/api/address/list/").then((response) => {
//                         if (response.code == 0 && response.data.length != 0) {
//                             //This will overide if there are multiple addresses of type P
//                             response.data.forEach(function (addr) {
//                                 if (addr.type == "P")
//                                     $("#post_address").jsonToForm(addr);
//                             });
//                         } else {
//                             $("#post_address").find("[name=id]").remove();
//                         }
//                     });
//                 }
//             } else {
//                 $("#post_address").jsonToForm(data.post_address);
//             }

//             //Populate work experience
//             if (data.work_experience && data.work_experience.length > 0) {
//                 //Always show work experirence
//                 $("#workexperience").createRepeater({
//                     showFirstItemToDefault: false,
//                 });
//                 for (i = 0; i < data.work_experience.length; i++) {
//                     $("#workexperience-template .form-data")
//                         .clone()
//                         .prependTo("#workexperience-data");
//                 }
//                 for (i = 0; i < data.work_experience.length; i++) {
//                     $("#workexperience-data .form-data").each(function (index) {
//                         if (index == i) {
//                             $(this).jsonToForm(data.work_experience[i]);
//                         }
//                     });
//                 }
//             } else {
//                 //Always show work experirence
//                 $("#workexperience").createRepeater({
//                     showFirstItemToDefault: true,
//                 });
//             }
//             //initialize date picker tool
//             $.each($("[date-field]"), function () {
//                 date = $(this).val();
//                 $(this).flatpickr({
//                     defaultDate: date || "2000-1-1",
//                     dateFormat: "Y-m-d",
//                     disableMobile: "true",
//                 });
//             });
//             //Validate date fields
//             $(".flatpickr-input:visible").on("focus", function () {
//                 $(this).blur();
//             });
//             $(".flatpickr-input:visible").prop("readonly", false);

//             $(".loading").addClass("d-none");
//             $(".app_summary").removeClass("d-none");
//             //Get uploads
//             getUploads(data.attachments);
//         }
//     })
//     .catch((error) => {
//         Sentry.captureException(error);
//         $.wnoty({
//             type: "error",
//             message: "Sorry and error occurred contact support!",
//         });
//     });

// const educationData = fetchData("/api/education/list/");
// educationData.then((response) => {
//     var data = response.data;
//     //Populate schools if present
//     if (data && data.length > 0) {
//         $("#education").createRepeater({
//             showFirstItemToDefault: false,
//         });
//         for (var i = 0; i < data.length; i++) {
//             $("#education-template .form-data")
//                 .clone()
//                 .prependTo("#education-data");
//         }
//         for (var i = 0; i < data.length; i++) {
//             $("#education-data .form-data").each(function (index) {
//                 if (index == i) {
//                     $(this).jsonToForm(data[i]);
//                 }
//             });
//         }
//     } else {
//         //Show empty space if school is not present
//         $("#education").createRepeater({
//             showFirstItemToDefault: true,
//         });
//     }

//     //initialize date picker tool
//     $.each($("[date-field]"), function () {
//         date = $(this).val();
//         $(this).flatpickr({
//             defaultDate: date || "2001-1-1",
//             dateFormat: "Y-m-d",
//             disableMobile: "true",
//         });
//     });
//     //Validate date fields
//     $(".flatpickr-input:visible").on("focus", function () {
//         $(this).blur();
//     });
//     $(".flatpickr-input:visible").prop("readonly", false);
// });
function activatePayment(element) {
    if (element.checked) {
        $(".payment-option input").removeAttr("disabled");
        //remove highlight class
        $(".highlight").removeClass("highlight");
    } else {
        $(".payment-option input").attr("checked", "checked");
        $(".payment-option input").attr("disabled", "disabled");
        $(".open").removeClass(".open");
    }
}

$(document.body).on("click", ".repeater-add-btn", function (e) {
    //Create datepicker on add button click
    $(
        "#workexperience .items:nth-last-child(1),#education .items:nth-last-child(1)"
    )
        .find("[date-field]")
        .each(function (e) {
            $(this).flatpickr({
                defaultDate: date || "2000-1-1",
                dateFormat: "Y-m-d",
                disableMobile: "true",
            });
        });
    //Validate date fields
    $(".flatpickr-input:visible").on("focus", function () {
        $(this).blur();
    });
    $(".flatpickr-input:visible").prop("readonly", false);
    setFormHeight();
});
var application_state;

var showForms = function showForms() {
    $(".states").addClass("d-none");
    if (application_state != 1) {
        //Hide the service step and override submit process
        $("#services-nav").remove();
        $("#services").remove();
        $(".app-already-paid").removeClass("d-none");
        resetForm();
    }
    $(".application_forms").removeClass("d-none");
    if (application_state == 3) {
        $(".missing-docs").removeClass("d-none");
    }
    if (
        application_state >= 4 ||
        application_state == 2 ||
        application_state == null
    ) {
        $("#submit-payment").addClass("d-none");
    }

    setFormHeight();
};

var confirmArriEmail = function confirmArriEmail() {
    window.location.href = `mailto:apply@china-admissions.com?subject=${student_name} ${applicationCode} University Registration Confirmation&body=Hello China Admissions,`;
};

var confirmRegEmail = function confirmRegEmail() {
    window.location.href = `mailto:apply@china-admissions.com?subject=${student_name} ${applicationCode} Arrival Confirmation&body=Hello China Admissions,`;
};
var leaveFeedback = function leaveFeedback() {
    window.location.href = `mailto:apply@china-admissions.com?subject=${student_name} ${applicationCode} China Admissions Service Feedback &body=Hello China Admissions,`;
};

/* -------------------------------------------------------------------------- */
/*                          Getting all attachments                          */
/* -------------------------------------------------------------------------- */
var is_in_china = false;

var getUploads = function getUploads(data) {
    $("#uploaded-attachments").html("");
    data.map(function (upload, index, array) {
        console.log(upload);
        //Set in china to true if student already uploaded doc
        // if (upload.title == "Your Current Visa Page") is_in_china = true;
        $form = $(`[value="${upload.document_name}"]`);
        //remove already upload files from file list
        $form.closest("li").remove();
        var invalid_doc = "";
        // if (upload.is_valid == "invalid")
        //     invalid_doc = `<div class="text-danger"> This document is invalid delete and upload a valid document <br> ${upload.attachment__invalid__reason} </div>`;

        uploadedFile = `
        <li class="list-group-item d-flex justify-content-between">
                    <div class="">
                    <span><span class="fas fa-file"></span></span>
                    <small class="col-8"><strong>${upload.document_name}</strong></small>
                    ${invalid_doc}
                    </div>
                    <div class="d-flex">
                      <form class="download-attachment"
                        action=""
                        method="get">
                        <input type="hidden" name="attachment_code" value="${upload.id}">
                        <input type="hidden" name="action" value="view">

                        <button type="submit" class="btn" title="download">
                            <span><i
                                    class="fas fa-download"></i></span>
                        </button>
                    </form>
                      <form class="delete-attachment"
                          action=""
                          method="get">
                          <input type="hidden" name="attachment_code" value="${upload.id}">
                          <input type="hidden" name="action" value="delete">

                          <button type="submit" class="btn" title="delete">
                              <span><span
                                      class="fas fa-trash"></span></span>
                          </button>
                      </form>

                      <div>

                      </div>
                    </div>
                  </li>`;
        $("#uploaded-attachments").append(uploadedFile);
    });
};
//Show custom attachement for users in china
$("#is_in_china").change(function (e) {
    e.preventDefault();
    getReqDocs();
});

/* -------------------------------------------------------------------------- */
/*               Get all required docs for applications in cart               */
/* -------------------------------------------------------------------------- */
var all_doc_provided = true;
function getReqDocs(method) {
    const requiredDocs = fetchData(
        "/api/application/req_docs/" + location.search
    );
    requiredDocs
        .then((response) => {
            $("#required-attachments, .upload-modals").html("");
            var data = response.data;
            all_doc_provided = true;
            var email = jQuery("#email").val();
            var code = location.search.split("=")[1];

            if ($("#is_in_china").val() == "true" && !is_in_china) {
                data.push({
                    description: "",
                    extra_intructions: "",
                    instructions:
                        "Please provide a copy of your current visa in China",
                    provided: false,
                    title: "Your Current Visa Page",
                    video: "",
                    category: "",
                });
            }

            categories = {};
            data.forEach((doc, i) => {
                if (doc["provided"]) {
                    return;
                }

                let category = doc["category"];
                doc.index = i;
                if (category in categories) {
                    categories[category].push(doc);
                } else {
                    categories[category] = [doc];
                }
            });

            let i = -1;
            for (let category in categories) {
                $("#required-attachments").append(
                    `<h6 class="mt-4">${category ? category : "Other Documents"
                    }</h6>`
                );

                categories[category].forEach((doc) => {
                    if (doc["provided"] == false) {
                        i += 1;
                        doci = `<li class="list-group-item d-flex justify-content-between" id="doc-container${i}" style="cursor: pointer;" data-toggle="modal" data-target="#doc${i}">
                    <div class="d-flex"> <span><span class="fas fa-file"></span></span>
                          <small class="col d-flex flex-column">
                          <strong>${doc["title"]}</strong>
                          </small>

                      </div>
                      <div><a class="btn" title="upload">
                      <span><i class="fas fa-plus"></i></i></span>
                    </a></div>


                      </li>`;
                        modal = ` <!-- Upload Modal -->
                      <div class="modal fade" id="doc${i}" tabindex="-1" role="dialog" aria-labelledby="doc${i}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Upload ${doc["title"]
                            }</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body d-md-flex justify-content-between">
                            <div class="col-md-6">
                            ${doc["video"] !== ""
                                ? `<smartvideo src="${doc["video"]}"  class="swarm-fluid" controls=""></smartvideo>`
                                : ""
                            }
                            ${doc["image"] === ""
                                ? ""
                                : `<div style="text-align: center;"><image src="${doc["image"]}" style="max-width: 100%;"></image></div>`
                            }
                            ${doc["university"] === ""
                                ? ""
                                : `<p>* This is required for ${doc["university"]}</p>`
                            }
                            <div class="doc-instruction">
                            <h5 class="multisteps-form__title">Instructions</h5>
                            ${doc["instructions"].replace(/\n/g, "<br>")}

                            ${doc["extra_intructions"].replace(/\n/g, "<br>")}
                            </div>

                            </div>


                            <form class="dropzone col-md-6 d-flex justify-content-center" data-container="#doc-container${i}" method="post" action="/add-attachment/upload/">

                                <input type="hidden" name="title" value="${doc["title"]
                            }">
                                <input id="code" type="hidden" name="code" value="${code}">
                                <input id="email" type="hidden" name="email" value="${email}">

                            </form>




                            </div>

                            <div class="modal-footer justify-content-between footer-actions" >
                                <button type="button" class="btn btn-secondary" style="line-height: normal;font-size: 12px;" data-dismiss="modal">Upload Later</button>
                            </div>

                          </div>
                        </div>
              </div>`;
                        $(".upload-modals").append(modal);
                        $("#required-attachments").append(doci);
                        all_doc_provided = false;
                        $("#supportdocs .js-btn-next").removeClass(
                            "js-btn-next"
                        );
                    }
                });
            }

            $(".dropzone").each(function (index) {
                $(this).dropzone({
                    dictDefaultMessage: "Drop files or click here to upload",
                    maxFiles: 1,
                    maxFilesize: 50,
                    thumbnailWidth: 300,
                    thumbnailHeight: 300,
                    addRemoveLinks: true,

                    init: function () {
                        this.on("thumbnail", function (file, dataUrl) {
                            $(".dz-image")
                                .last()
                                .find("img")
                                .attr({ width: "300px", height: "300px" });
                        }),
                            this.on("success", function (file) {
                                $(".dz-image").css({
                                    width: "300px",
                                    height: "300px",
                                });
                                $(document.body).trigger("refreshUpload");
                                //look messy
                                $(
                                    this.element.attributes["data-container"]
                                        .nodeValue
                                ).remove();

                                $(".modal").modal("hide"); // closes all active pop ups.
                                $(".modal-backdrop").remove(); // removes the grey overlay.
                                $.wnoty({
                                    type: "success",
                                    message: "Document Successfully Uploaded!",
                                });
                            });
                        this.on("addedfile", function (file) {
                            var ext = file.name.split(".").pop();

                            if (ext != "png" && ext != "jpg" && ext != "jpeg") {
                                $(file.previewElement)
                                    .find(".dz-image img")
                                    .attr(
                                        "src",
                                        "/static/assets/js/dropzone/file-icon.svg"
                                    );
                            }
                        });
                    },
                });
            });
            setFormHeight();
        })
        .then(() => {
            if (method == "check") {
                $(".supportdocs-btn").removeClass("supportdocs-btn");
                $(this).addClass("js-btn-next");
                $("#supportdocs .multisteps-form__panel.js-active").removeClass(
                    "js-active"
                );
                $(".confirm-nav").removeClass("disabled");
                $(".confirm-nav").addClass("js-active");
                $("#confirmation .multisteps-form__panel").addClass(
                    "js-active"
                );
                setFormHeight();
                //Pause video when user close modal
                $(".modal ").on("hidden.bs.modal", function (e) {
                    $(this).find(".vjs-tech").get(0).pause();
                });
                // if (all_doc_provided) {
                //   $(".supportdocs-btn").removeClass("supportdocs-btn");
                //   $(this).addClass("js-btn-next");
                //   $("#supportdocs .multisteps-form__panel.js-active").removeClass(
                //     "js-active"
                //   );
                //   $(".confirm-nav").removeClass("disabled");
                //   $(".confirm-nav").addClass("js-active");
                //   $("#confirmation .multisteps-form__panel").addClass("js-active");
                //   setFormHeight();
                // } else {
                //   $.wnoty({
                //     type: "error",
                //     message:
                //       "Please upload all required docs to proceed to the next step"
                //   });
                // }
                // feature detection for drag&drop upload
            }
        });
}
// getReqDocs();

var _requiredDocsComplete = function () {
    return new Promise((resolve, reject) => {
        fetchData("/api/application/req_docs/" + location.search)
            .then((response) => {
                var data = response.data;
                data.forEach((doc, i) => {
                    if (doc.provided == false) resolve(false);
                });
                resolve(true);
            })
            .catch((error) => {
                Sentry.captureException(error);
                reject(error);
            });
    });
};

async function requiredDocsComplete() {
    await _requiredDocsComplete();
}

/* -------------------------------------------------------------------------- */
/*                            Get optional services                           */
/* -------------------------------------------------------------------------- */
var getOptionalServices = function getOptionalServices(selected_srv) {
    fetchData("/api/optional_service/list/?code=" + applicationCode).then(
        (response) => {
            var data = response.data;
            var services = [];
            data.sort(function (a, b) {
                return parseFloat(a.total) - parseFloat(b.total);
            }).reverse();
            $("#optional-services").html("");
            for (var i = 0; i < data.length; i++) {
                //generate and add checked attr to option
                services.push(data[i].code);
                createService(data[i], selected_srv);
            }

            if (
                services.includes("application_premium") ||
                (services.includes("application_premium") &&
                    services.includes("application_priority"))
            ) {
                $(".guaranteed").removeClass("d-none");
            } else if (services.includes("application_priority")) {
                $(".priority").removeClass("d-none");
            }
            getAppFee();

            $(document.body).on(
                "change",
                "[name='optional_service']",
                function () {
                    selectOptionalService();
                    var optionSelected = $(
                        '[name="optional_service"]:checked'
                    ).data("name");
                    if (optionSelected == "application_premium") {
                        $(".service .title").text("To Counsellor");
                        $(".service").addClass("to-counsellor");
                    } else {
                        $(".service .title").text("Next");
                        $(".service").removeClass("to-counsellor");
                    }
                    getAppFee("service");
                }
            );

            //If program has doesn't have optional services skip service step
            if (
                !services.includes("application_premium") &&
                !services.includes("application_priority")
            ) {
                $("#optional-service").addClass("d-none");
                $("#no-optional-services").removeClass("d-none");
            }
        }
    );
    function createService(data, selected_srv) {
        var service = ` <div class="custom-control custom-radio">
        <input type="radio"
          data-orig-app-fee=${data.orig_app_fee}
          data-app-fee=${data.app_fee}
          data-srv-fee=${data.srv_fee}
          data-opt-srv-fee=${data.opt_srv_fee}
          data-total=${data.total}
          data-name="${data.code}"
          id="${data.code}"
        name="optional_service" class="custom-control-input" value="${data.id
            }" ${data.code == selected_srv ? "checked" : ""}>
        <label class="custom-control-label" for="${data.code}"><strong>
        ${data.code == "none" ? "No, thanks (Basic Service)" : data.title} - $${data.total
            }
        </strong></label>
        <small>
           ${data.description}
        </small>
    </div>`;
        $("#optional-services").append(service);
        setFormHeight();
    }
};

var generatePayment = function generatePayment(
    code,
    optionSelected,
    delete_app
) {
    if (application_state != 3) {
        fetchData("/api/application/payment/?code=" + code).then((response) => {
            if (response.code == 0 || delete_app) {
                var data = response.data;
                var order_total = data.total;
                var optionName = $('[name="optional_service"]:checked').data(
                    "name"
                );

                $(".payment").removeClass("disabled");
                $(".payment-nav").removeClass("disabled");
                $("span.fee").text(order_total);
                $("#paypal-button-container").empty();

                if (window.paypal && window.paypal.Buttons) {
                    //displays Smart Payment Buttons on your web page.
                    paypal
                        .Buttons({
                            createOrder: function (paypaldata, actions) {
                                // This function sets up the details of the transaction, including the amount and line item details.
                                return actions.order.create({
                                    purchase_units: [
                                        {
                                            reference_id: data.long_code,
                                            amount: {
                                                value: order_total,
                                            },
                                        },
                                    ],
                                });
                            },
                            onApprove: function (data) {
                                $.wnoty({
                                    type: "info",
                                    message:
                                        "Verifying transaction, please wait a moment.",
                                    autohide: false,
                                });

                                $.when(
                                    $.ajax({
                                        type: "post",
                                        url: "/payments/paypal/capture-transaction/",
                                        data: JSON.stringify({
                                            orderID: data.orderID,
                                        }),
                                        dataType: "json",
                                        success: function (response) {
                                            $.wnoty({
                                                type: "success",
                                                message:
                                                    "Payment successful, redirecting to program status.",
                                            });
                                        },
                                    })
                                ).done(function (response) {
                                    $.wnoty({
                                        type: "success",
                                        message: "Payment successful",
                                    });

                                    $(".payment-methods").addClass("d-none");

                                    //used to trigger event for gtm
                                    ga_purchased(
                                        data.orderID,
                                        order_total,
                                        applicationCode
                                    );
                                    fbq_purchased(
                                        data.orderID,
                                        order_total,
                                        applicationCode
                                    );
                                    app_submitted(order_total, optionName);
                                    const submit = submitData(
                                        "/api/application/submit/" +
                                        location.search
                                    );
                                    submit.then(function (response) {
                                        if (response.code == -1) {
                                            if (
                                                response.msg ==
                                                "Please upload all required documents before submit!"
                                            ) {
                                                $.wnoty({
                                                    type: "error",
                                                    message:
                                                        "Please upload all required documents and fill all required fields before submit!",
                                                });
                                                $("form").addClass(
                                                    "was-validated"
                                                );
                                                application_state = 3;
                                                showForms();
                                            } else {
                                                $.wnoty({
                                                    type: "error",
                                                    message: response.msg,
                                                });
                                            }
                                        } else {
                                            app_submittesubmitApplid(
                                                order_total,
                                                optionName
                                            );
                                            window.location = "/account";
                                        }
                                    });
                                });
                            },
                        })
                        .render("#paypal-button-container");
                } else {
                    Sentry.captureMessage("Paypal Failed");
                    $.wnoty({
                        type: "error",
                        message:
                            "Please make sure your connected to the internet to continue with your application.",
                    });
                }

                //Configure stripe checkout
                var handler = StripeCheckout.configure({
                    key: data.stripe.public_key,
                    image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                    locale: "auto",
                    token: function (token) {
                        // You can access the token ID with `token.id`.
                        // Get the token ID to your server-side code for use.

                        var amount = order_total;
                        var short_code = data.short_code;
                        var long_code = data.long_code;
                        var payload = {
                            token: token.id,
                            amount: amount,
                            short_code: short_code,
                            long_code: long_code,
                        };
                        // submit the filter-form by ajax POST
                        $.post({
                            url: "/payments/stripe/charge/",
                            data: payload,
                            cache: false,
                        })
                            .done(function (response) {
                                status = response.status;
                                if (status == "SUCCESS") {
                                    $.wnoty({
                                        type: "success",
                                        message: "Payment successful",
                                    });

                                    $(".payment-methods").addClass("d-none");

                                    //used to trigger event for gtm
                                    ga_purchased(token.id, amount, short_code);
                                    fbq_purchased(
                                        data.orderID,
                                        order_total,
                                        applicationCode
                                    );
                                    app_submitted(order_total, optionName);

                                    const submit = submitData(
                                        "/api/application/submit/" +
                                        location.search
                                    );
                                    submit.then(function (response) {
                                        if (response.code == -1) {
                                            if (
                                                response.msg ==
                                                "Please upload all required documents before submit!"
                                            ) {
                                                $.wnoty({
                                                    type: "error",
                                                    message:
                                                        "Please upload all required documents and fill all required fields before submit!",
                                                });
                                                $("form").addClass(
                                                    "was-validated"
                                                );
                                                application_state = 3;
                                                showForms();
                                            } else {
                                                $.wnoty({
                                                    type: "error",
                                                    message: response.msg,
                                                });
                                            }
                                        } else {
                                            app_submittesubmitApplid(
                                                order_total,
                                                optionName
                                            );
                                            window.location = "/account";
                                        }
                                    });
                                } else if (status == "FAIL") {
                                    var errorMessage =
                                        "Payment Failed !\n" +
                                        response.outcome.seller_message;
                                    Sentry.captureException(response);
                                    $.wnoty({
                                        type: "error",
                                        message: errorMessage,
                                    });
                                }
                            })
                            .fail(function (response) {
                                Sentry.captureException(response);
                                $.wnoty({
                                    type: "error",
                                    message:
                                        "Sorry and error occurred when verifying your transaction.Please contact support for help.",
                                });
                            })
                            .always(function (response) {
                                //$('#ajax-loader').hide();
                            });
                    },
                });

                $("div#stripe-submit").on("click", function (e) {
                    // Open Checkout with further options:
                    handler.open({
                        name: "China Admissions",
                        description: "Application Fee",
                        zipCode: false,
                        image: "/static/assets/icon/ca-icon@0,25x.png",
                        amount: order_total * 100,
                    });
                    e.preventDefault();
                });

                if (!delete_app) {
                    $(".payment").removeClass("disabled");
                    $("#confirmation .payment").addClass("js-btn-next");
                    $(
                        "#confirmation .multisteps-form__panel.js-active"
                    ).removeClass("js-active");
                    $(".next-arrow").removeClass("d-none");
                    $("#payment-spinner").addClass("d-none");
                    $("#payment .multisteps-form__panel").addClass("js-active");
                    $(".payment-nav").addClass("js-active");
                    $(".payment-methods ").removeClass("d-none");

                    setFormHeight();
                }
            } else {
                if (!delete_app) {
                    $(".not_payable").removeClass("d-none");
                    $(".payment").removeClass("disabled");
                    $("#confirmation .payment").addClass("js-btn-next");
                    $(
                        "#confirmation .multisteps-form__panel.js-active"
                    ).removeClass("js-active");
                    $(".next-arrow").removeClass("d-none");
                    $("#payment-spinner").addClass("d-none");
                    $("#payment .multisteps-form__panel").addClass("js-active");
                    $(".payment-nav").addClass("js-active");
                    setFormHeight();
                }
            }
        });
    }
};

// Current Application Fees
var ORIG_APP_FEE = 0;
var APP_FEE = 0;
var SRV_FEE = 0;
var OPT_SRV_FEE = 0;
var TOTAL_FEE = 0;

function updateFees() {
    $("#orig-app-fee span").text(
        ORIG_APP_FEE != undefined ? parseInt(ORIG_APP_FEE) : "0.00"
    );
    if (ORIG_APP_FEE === APP_FEE) {
        $("#orig-app-fee").hide();
    } else {
        $("#orig-app-fee").show();
    }

    $("#application-fee").text(
        APP_FEE != undefined ? parseInt(APP_FEE) : "0.00"
    );
    $(".app-fee").text(
        ORIG_APP_FEE != undefined ? parseInt(ORIG_APP_FEE) : "0.00"
    );

    $("#service-fee").text(
        SRV_FEE != undefined && SRV_FEE > 0
            ? `$${parseInt(SRV_FEE)} USD`
            : "Free"
    );
    $("#opt-service-fee").text(
        OPT_SRV_FEE != undefined && OPT_SRV_FEE > 0
            ? `$${parseInt(OPT_SRV_FEE)} USD`
            : "Free"
    );

    if (parseInt(SRV_FEE) == 0) {
        $(".service-fee-container").removeClass("d-flex");
        $(".service-fee-container").addClass("d-none");
    } else {
        $(".service-fee-container").addClass("d-flex");
        $(".service-fee-container").removeClass("d-none");
    }
    if (parseInt(OPT_SRV_FEE) == 0) {
        $(".opt-service-fee-container").removeClass("d-flex");
        $(".opt-service-fee-container").addClass("d-none");
    } else {
        $(".opt-service-fee-container").addClass("d-flex");
        $(".opt-service-fee-container").removeClass("d-none");
    }
    if (parseInt(SRV_FEE) == 0 && parseInt(OPT_SRV_FEE) == 0) {
        $(".service-fee-container").addClass("d-flex");
        $(".service-fee-container").removeClass("d-none");
    }

    $("#total-fee").text(
        TOTAL_FEE != undefined ? `${parseInt(TOTAL_FEE)}` : "0.00"
    );

    $("#wechat-fee").text(
        TOTAL_FEE != undefined
            ? Math.round(TOTAL_FEE * cny_exchange_rates)
            : "0.00"
    );
    $("span.fee").text(
        TOTAL_FEE != undefined ? `${parseInt(TOTAL_FEE)}` : "0.00"
    );
}

var getAppFee = function (caller) {
    if (caller == "service") {
        var optionSelected = $('[name="optional_service"]:checked').data(
            "name"
        );
        ORIG_APP_FEE = $('[name="optional_service"]:checked').data(
            "orig-app-fee"
        );
        APP_FEE = $('[name="optional_service"]:checked').data("app-fee");
        SRV_FEE = $('[name="optional_service"]:checked').data("srv-fee");
        OPT_SRV_FEE = $('[name="optional_service"]:checked').data(
            "opt-srv-fee"
        );
        TOTAL_FEE = $('[name="optional_service"]:checked').data("total");

        updateFees();

        if (optionSelected == "none") {
            $(".opt-service-fee").text("Basic Service Fee");
            $(".service-notes").text(
                `We provide a Price Match Guarantee. If you later find fee is lower from the university we will refund you the difference`
            );
        } else if (optionSelected == "application_premium") {
            $(".opt-service-fee").text("Guaranteed Service Fee");
            $(".service-notes").html(
                `Your application has been upgraded to Guaranteed Service. Please ensure you have <a href="https://www.china-admissions.com/services/" style="color:#d71f27" target="_blank">had a consultation with our counsellor</a> and signed your guaranteed service agreement before paying the service fee.`
            );
        } else {
            $(".opt-service-fee").text("Priority Service Fee");
            $(".service-notes").text(
                `Your application has been upgraded to Priority Service. This includes the application fees to the university.`
            );
        }
    } else {
        fetchData("/api/application/payment/" + location.search).then(
            (response) => {
                if (response.code == 0) {
                    var data = response.data;
                    ORIG_APP_FEE = data.origin_app_fee;
                    APP_FEE = data.subtotal_programs;
                    SRV_FEE = data.subtotal_programs_service;
                    OPT_SRV_FEE = data.subtotal_optional_service;
                    TOTAL_FEE = data.total;
                    updateFees();
                } else {
                    Sentry.captureException(response.msg);
                }
            }
        );
    }
};
// getAppFee();

/* var createApplicationDetails = function (data, status) {
    var program = `
                 <div class=" d-md-flex item p-4" id="prog-${data.id}">
                 <div style="position: absolute;right: 0px;z-index: 999;top: -10px;">
                 <div class="delete-container">
                                <button type="button" title="Delete program" data-code="${
                                    data.id
                                }" class="delete-prog-btn close" aria-label="Delete program" data-toggle="modal" data-target="#delete_program">
                                    <span aria-hidden="true" style="font-size:12px">Delete program</span>
                                </button>
                         </div>
                 </div>
                 <div class="d-flex">
                            <div class="uniLogo d-inline-block">
                                <img  src="${
                                    data.logo != undefined
                                        ? `${data.logo}`
                                        : `/static/assets/icon/ca-icon.png`
                                }" style="width:50px;height:50px">

                            </div>
                            <div class="d-md-flex flex-column justify-content-between mainContentArea">
                              <div class=""><a href=" ${
                                  data.url
                              }" class="title" style="font-size: 1.2rem;">
                                        ${data.user_program_name}
                                    </a><div class="status">
                                    <div class="d-flex justify-content-between">Deadline:

                                    <div class="d-flex flex-column">
                                      <strong data-tippy-content="- Note: Submitting earlier increases your chances of being accepted. If you leave your application to close the deadline it increases your risk of being rejected because the university is very busy and there may not be enough time for your documents to be corrected if there are problems.">
                                     <i class="far fa-question-circle"></i> ${
                                         data.deadline != undefined
                                             ? `${data.deadline}`
                                             : `Not Listed`
                                     }
                                     </strong>
                                     ${
                                         data.days_to_deadline >= 0
                                             ? ``
                                             : `<span class="badge badge-danger" data-tippy-content="This program application deadline has passed, you can't proceed with your application unless you remove this program and select another program.">Expired</span> `
                                     }
                                     </div>

                                     </div>

                                    <div class="d-flex justify-content-between">Start:<strong>
                                    ${
                                        data.start_date != undefined
                                            ? `${data.start_date}`
                                            : `Not Listed`
                                    }
                                    </strong></div>
                                </div>

                                <div class="status">
                                    <div class="">Current Status:</div>
                                    <div class=""> <strong>${status}</strong></div>

                                </div>
                                </div>
                                </div>

                        </div>

                `;
    $(".program").append(program);

    //show notice for deadline see form-utils.js
    $("body").trigger("initTooltip");
}; */
const download = async (url, filename) => {
    const data = await fetch(url);
    const blob = await data.blob();
    const objectUrl = URL.createObjectURL(blob);

    const link = document.createElement("a");

    link.setAttribute("href", objectUrl);
    link.setAttribute("download", filename);
    link.style.display = "none";

    document.body.appendChild(link);

    link.click();

    document.body.removeChild(link);
};
//Download attachments
$(document.body).on("submit", ".download-attachment", function (e) {
    e.preventDefault();
    var data =
        $(this).serialize() +
        "&_token=" +
        $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "post",
        url: base_url + "/attachment/download/" + application_id,
        data: data,
        success: function (response) {
            download(response.file_url, response.filename);
        },
    });

    // var code = $(this).find("[name='code']").val();
    // var url = base_url + "/attachment/download/" + application_id;
    // var data =
    //     $(this).serialize() +
    //     "&_token=" +
    //     $('meta[name="csrf-token"]').attr("content");
    // let fnGetFileNameFromContentDispostionHeader = function (header) {
    //     console.log(header);
    //     let disposition = header.split(";");
    //     let filename = "";
    //     if (disposition && disposition.indexOf("attachment") !== -1) {
    //         var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
    //         var matches = filenameRegex.exec(disposition);
    //         if (matches != null && matches[1])
    //             filename = matches[1].replace(/['"]/g, "");
    //     }
    //     return filename;
    // };

    // fetch(url, {
    //     method: "POST",
    //     body: data,
    // })
    //     .then(async (res) => ({
    //         filename: fnGetFileNameFromContentDispostionHeader(
    //             res.headers.get("content-disposition")
    //         ),
    //         blob: await res.blob(),
    //     }))
    //     .then((resObj) => {
    //         console.log(resObj);
    //         // It is necessary to create a new blob object with mime-type explicitly set for all browsers except Chrome, but it works for Chrome too.
    //         const newBlob = new Blob([resObj.blob]);

    //         // MS Edge and IE don't allow using a blob object directly as link href, instead it is necessary to use msSaveOrOpenBlob
    //         if (window.navigator && window.navigator.msSaveOrOpenBlob) {
    //             window.navigator.msSaveOrOpenBlob(newBlob);
    //         } else {
    //             // For other browsers: create a link pointing to the ObjectURL containing the blob.
    //             const objUrl = window.URL.createObjectURL(newBlob);

    //             let link = document.createElement("a");
    //             link.href = objUrl;
    //             link.download = resObj.filename;
    //             link.click();

    //             // For Firefox it is necessary to delay revoking the ObjectURL.
    //             setTimeout(() => {
    //                 window.URL.revokeObjectURL(objUrl);
    //             }, 250);
    //         }
    //     })
    //     .catch((error) => {
    //         Sentry.captureException(error);
    //         alert("DOWNLOAD ERROR", error);
    //     });
});
//Delete attachments
$(document.body).on("submit", ".delete-attachment", function (e) {
    e.preventDefault();
    var code = $(this).find("[name='code']").val();
    var data =
        $(this).serialize() +
        "&_token=" +
        $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "post",
        url: base_url + "/attachment/delete/" + application_id,
        data: data,
        success: function (response) {
            $(document.body).trigger("refreshUpload");
            getReqDocs();
        },
    });
});

//Delete receipt
$(document.body).on("submit", ".delete-receipt", function (e) {
    e.preventDefault();
    var code = $(this).find("[name='code']").val();
    data = {};
    data["csrfmiddlewaretoken"] = $("[name='csrfmiddlewaretoken']").val();
    data.attachment_code = code;
    $.ajax({
        type: "post",
        url: "/delete-attachment/",
        data: data,
        dataType: "json",
        success: function (response) {
            var template = `<span><span class="fas fa-file"></span></span>
                                <small class="col-8">
                                  <strong>Click to upload bank receipt</strong>
                                </small>
                              <form class="upload-receipt" action="" method="post">
                                  <input hidden="" type="file" name="attached_file" id="receipt">
                                  <button type="submit" class="btn receipt-file-upload">
                                      <span><i class="fas fa-upload"></i></span>
                                  </button>
                              </form>`;
            $(".receipt-attachment").html(template);
        },
    });
});

// setFormHeight();
/* -------------------------------------------------------------------------- */
/*                                Attachements                                */
/* -------------------------------------------------------------------------- */

$(document.body).on("refreshUpload", function () {
    fetchData(base_url + "/get-attachments/" + application_id).then(
        (response) => {
            console.log(response.documents);
            getUploads(response.documents);
            setFormHeight();
        }
    );
});

$("#uploadFile").on("click", function (e) {

    if ($("#uploadForm")[0].checkValidity()) {
        e.preventDefault();
        $(".spinner").toggleClass("d-none");
        $(".upload-status").text("Uploading...");

        //set upload form values based on user application
        $("#uploadForm #email").val(jQuery("#email").val());
        $("#uploadForm #code").val(location.search.split("=")[1]);
        let data = new FormData($("#uploadForm")[0]);
        let application_id = $("#uploadForm").data('application-id');
        console.log(application_id);
        
        var url = "/add-attachment/upload/";

        /* $.wnoty({
            type: "info",
            message: "Uploading file",
            autohide: false,
        }); */
        $.ajax({
            type: "post",
            url: url,
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                $(".spinner").toggleClass("d-none");
                $(".upload-status").text("Upload document");
                file_uploaded($("#uploadForm #documentTitle").val());
                $("#uploadForm")[0].reset();
                $(document.body).trigger("refreshUpload");
                // $(".wnoty-info").remove();

                // $.wnoty({
                //     type: "success",
                //     message: "Upload successful",
                // });
            },
            error: function (err) {
                $(".upload-status").text("Upload document");
                $(".spinner").toggleClass("d-none");
                $("#uploadForm")[0].reset();
            },
        });
    } else {
        e.preventDefault();
        /* $.wnoty({
            type: "error",
            message:
                "Please add a document title and select a document to upload.",
        }); */
    }
});
$(document.body).on("click", ".receipt-file-upload", function (e) {
    e.preventDefault();
    $(this).closest("form").find("[name='file']").trigger("click");
});

$(document.body).on("change", "#receipt", function (e) {
    e.preventDefault();
    let data = new FormData($(this).closest("form")[0]), // you can consider this as 'data bag'
        url = "/api/attachment/detail/";
    setFormHeight();
    data.append("csrfmiddlewaretoken", $("[name='csrfmiddlewaretoken']").val());
    $.wnoty({
        type: "info",
        message: "Uploading file",
        autohide: false,
    });
    $.ajax({
        type: "post",
        url: url,
        processData: false,
        contentType: false,
        data: data,
        success: function (response) {
            var template = `
                    <div class="">
                    <span><span class="fas fa-file"></span></span>
                    <small class="col-8"><strong>Bank Receipt</strong></small>
                    </div>
                    <div class="d-flex">
                    <form class="delete-receipt" action="" method="get">
                          <input type="hidden" name="receipt_code" value="${response.data.code}">
                          <button type="submit" class="btn" title="delete">
                              <span><span class="fas fa-trash"></span></span>
                          </button>
                    </form>
                    </div>
          `;
            $(".receipt-attachment").html(template);
            $(".wnoty-info").remove();
            $.wnoty({
                type: "success",
                message: "Upload successful",
            });
        },
        error: function (err) {
            $.wnoty({
                type: "error",
                message: "Upload failed",
            });
        },
    });
});

//Additional document button
$(".btn-add-docs").on("click", function () {
    $(".add-upload-form-code").val(applicationCode);
    $(".add-upload-form-email").val(student_email);
    $(".add-upload-form").submit();
});

$(document.body).on("syncApp", function () {
    var data = {
        to_profile: 1,
        code: location.search.split("=")[1],
    };
    $.ajax({
        type: "post",
        data: data,
        url: "/api/application/sync/" + location.search + "&to_profile=1",
        success: function (response) { },
    });
});

var allowPayment = true;
var paymentGenerated = false;
var appSubmitted = false;
var applicationCode = location.search.split("=")[1];
var total_programs = 0;

var deleteSchool = function (school) {
    var school_id = $(school)
        .parents(".form-row.form-data")
        .find("input#id")
        .val();
    fetchData("/api/education/del/?id=" + school_id)
        .then((response) => {
            if (response.code == 0) {
                $(school).parents(".form-row.form-data").remove();
            } else {
                $.wnoty({
                    type: "error",
                    message:
                        "An error occurred while deleting your education background. please contact support for help.",
                });
            }
        })
        .catch((error) => {
            Sentry.captureException(error);
            $.wnoty({
                type: "error",
                message:
                    "An error occurred while deleting your education background. please contact support for help.",
            });
        });
};
var _updateProfile = function () {
    // console.log($("#aboutyou"));
    // return false;
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: base_url + "/application/personal/" + application_id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: $("#aboutyou").serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response);
                resolve(response);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
};
var _updateAddress = function () {
    //If this is a new account the new account will not have an address thus the id will be undefined
    url = base_url + "/application/home_address/" + application_id;
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: $("#home_address").serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response);
                resolve(response);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
};
var _updatePostAddress = function () {
    //If this is a new account the new account will not have an address thus the id will be undefined
    url = base_url + "/application/post_address/" + application_id;
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: $("#post_address").serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response);
                resolve(response);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
};
var _updateEducation = function (education_data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: base_url + "/application/education/" + application_id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { education_data: education_data },
            dataType: "json",
            success: function (response) {
                resolve(response);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
};
var _updateWork = function (work_data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: base_url + "/application/work_experience/" + application_id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { work_data: work_data },
            dataType: "json",
            success: function (response) {
                console.log("work");
                console.log(response);
                resolve(response);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
};

var _updateSupportingDoc = function () {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: base_url + "/application/family_finance/" + application_id,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: $("#financialsupport").serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response);
                resolve(true);
            },
            error: function (error) {
                reject(false);
            },
        });
    });
};

var copySupporter = function (supporter) {
    if (supporter === "father") {
        $("#supporter_company").val($("#family_member_work_employer").val());
        $("#supporter_email").val($("#family_member_email").val());
        $("#supporter_phone").val($("#family_member_phone").val());
        $("#supporter_name").val($("#family_member_name").val());
        $("#supporter_relationship").val("Father");
    } else {
        $("#supporter_company").val($("#family_member1_work_employer").val());
        $("#supporter_email").val($("#family_member1_email").val());
        $("#supporter_phone").val($("#family_member1_phone").val());
        $("#supporter_name").val($("#family_member1_name").val());
        $("#supporter_relationship").val("Mother");
    }
};

// TODO:
function selectOptionalService(jump) {
    var data = {
        optional_service: $('[name="optional_service"]:checked').data("name"),
    };
    $.ajax({
        type: "post",
        url: base_url + "/application/optional_service/" + application_id,
        data: JSON.stringify(data),
        dataType: "json",
        success: function (response) {
            if (response.code == 0) {
                if (jump) {
                    if (data.optional_service === "none") {
                        freeSrvModal.show();
                        return;
                    }

                    setActiveStep(3);
                    setActivePanel(3);
                }
            } else {
                $.wnoty({
                    type: "error",
                    message:
                        "Failed to select the service for your program. Please contact support.",
                });
            }
        },
    });
}

var freeSrvModal;

// $(document).ready(function () {

/* -------------------------------------------------------------------------- */
/*                         Event handler for each step                        */
/* -------------------------------------------------------------------------- */

//check if user uploaded all attachments
$(".supportdocs-btn").on("click", function (e) {
    getReqDocs("check");
    setFormHeight();
});

/* --------------------------------- Service -------------------------------- */

freeSrvModal = new bootstrap.Modal(document.getElementById("freeSrvModal"), {});
$(".btn-upgrade-srv").on("click", function () {
    freeSrvModal.hide();
});
$("#checkFreeSrv").on("change", function (e) {
    var val = $("#checkFreeSrv").prop("checked");
});
$(".btn-confirm-free-srv").on("click", function () {
    var val = $("#checkFreeSrv").prop("checked");
    if (!val) {
        alert("Please confirm!");
        return;
    }
    freeSrvModal.hide();
    setActiveStep(3);
    setActivePanel(3);
});

$(".service").on("click", function () {
    selectOptionalService(true);
});

var goToSection = function goToSection(step, section) {
    setActivePanel(step);
    setActiveStep(step);
    $("#" + section).addClass("was-validated");
    $("#" + section + " form").addClass("was-validated");
    setFormHeight();
    $("html, body").animate(
        {
            scrollTop: $("#" + section).offset().top,
        },
        500
    );
};

$(document.body).on("click", ".to-counsellor", function (e) {
    var open_in_new_tab = function (url) {
        var win = window.open(url, "_blank");
        win.focus();
    };
    open_in_new_tab("https://www.china-admissions.com/book-a-call/");
});

$(document.body).on("shown.bs.collapse", ".multi-collapse", function () {
    setFormHeight();
});
$(document.body).on("hidden.bs.collapse", ".multi-collapse", function () {
    setFormHeight();
});

/* -------------------------------------------------------------------------- */
/*                                   Payment                                  */
/* -------------------------------------------------------------------------- */

//resize form when payment method accordions are opened and closed
var confirmTerms = function confirmTerms() {
    $(".terms-conditions").addClass("highlight");
    $("html, body").animate(
        {
            scrollTop: $("#confirm-terms").offset().top,
        },
        500
    );
    $("#confirm-terms").addClass("highlight");
};
$(".payment-option").on("click", function () {
    if ($("#confirm-terms").is(":checked")) {
        setFormHeight();
    } else {
        $.wnoty({
            type: "error",
            message:
                "Please accept the terms and conditions before you can proceed to pay!",
        });
        confirmTerms();
    }
});

$("#paypal_accordion").on("click", function () {
    setFormHeight();
});

$(".payment").on("click", function (e) {
    e.preventDefault();

    optionSelectedPrice = $('[name="optional_service"]:checked').data("price");

    if (optionSelectedPrice == 0) {
        $(".has-fee").addClass("d-none");
        $(".no-fee").removeClass("d-none");
        $(".not_payable").removeClass("d-none");
        $(".submit-payment span").text("Submit Application");
        $(".payment-methods").addClass("d-none");
        getAppFee();
    } else {
        $(".has-fee").removeClass("d-none");
        $(".no-fee").addClass("d-none");
        $(".not_payable").addClass("d-none");
    }
    $(".next-arrow").addClass("d-none");
    $("#payment-spinner").removeClass("d-none");
    var data = $("#optional-service").serializeJSON();
    //if the application is not in waiting application fee payment
    if (application_state != 1) {
        $(".payment").removeClass("disabled");
        $("#confirmation .payment").addClass("js-btn-next");
        $("#confirmation .multisteps-form__panel.js-active").removeClass(
            "js-active"
        );
        $(".next-arrow").removeClass("d-none");
        $("#payment-spinner").addClass("d-none");
        $("#payment .multisteps-form__panel").addClass("js-active");
        $(".payment-nav").addClass("js-active");
        $(".submit-payment span").text("Submit Application");
        setFormHeight();
    } else {
        const submit = submitData("/api/application/check/" + location.search);
        submit.then(function (response) {
            if (response.code == -1) {
                if (
                    response.msg ==
                    "Please upload all required documents before submit!"
                ) {
                    $.wnoty({
                        type: "error",
                        message:
                            "Please upload all required documents and fill all required fields before submit!",
                    });
                    $("form").addClass("was-validated");
                } else {
                    $.wnoty({
                        type: "error",
                        message: response.msg,
                    });
                }
            }
            if (response.code == 1) {
                //No application fee update UI to remove payment form and show submit button
                $(".payment").removeClass("disabled");
                $("#confirmation .payment").addClass("js-btn-next");
                $(
                    "#confirmation .multisteps-form__panel.js-active"
                ).removeClass("js-active");
                $(".next-arrow").removeClass("d-none");
                $("#payment-spinner").addClass("d-none");
                $("#payment .multisteps-form__panel").addClass("js-active");
                $(".payment-nav").addClass("js-active");
                $(".submit-payment span").text("Submit Application");
                setFormHeight();
            } else {
                var optionSelected = $(
                    '[name="optional_service"]:checked'
                ).data("name");
                var optionPrice = $('[name="optional_service"]:checked').data(
                    "total"
                );
                if (optionPrice != 0) {
                    generatePayment(applicationCode, optionSelected);
                } else {
                    $(".payment").removeClass("disabled");
                    $("#confirmation .payment").addClass("js-btn-next");
                    $(
                        "#confirmation .multisteps-form__panel.js-active"
                    ).removeClass("js-active");
                    $(".next-arrow").removeClass("d-none");
                    $("#payment-spinner").addClass("d-none");
                    $("#payment .multisteps-form__panel").addClass("js-active");
                    $(".payment-nav").addClass("js-active");
                    $(".not_payable").toggleClass("d-none");
                    $(".submit-payment span").text("Submit Application");
                    setFormHeight();
                }
                //Stop spinning arrow
                $(".next-arrow").removeClass("d-none");
                $("#payment-spinner").addClass("d-none");
            }
            //Stop spinning arrow
            $(".next-arrow").removeClass("d-none");
            $("#payment-spinner").addClass("d-none");
        });
    }
});

$(".payment-nav").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    //activate step 3 and trigger payment button click
    setActiveStep(3);
    $(".payment").trigger("click");
});
/* -------------------------------------------------------------------------- */
/*                            Handle receipt upload                           */
/* -------------------------------------------------------------------------- */

$(".submit-payment").on("click", function () {
    submitedReciept = $("[name='receipt_code']").length > 0;
    var optionPrice = $('[name="optional_service"]:checked').data("total");
    var optionName = $('[name="optional_service"]:checked').data("name");

    //Check if accepted terms and conditions
    if (!$("#confirm-terms").is(":checked") && application_state == 1) {
        $.wnoty({
            type: "error",
            message:
                "Please accept the terms and conditions before submitting your application!",
        });
        confirmTerms();
        return false;
    }
    //check if the user uploaded a receipt
    if (submitedReciept) {
        var receipt_code = {
            receipt_code: $("[name='receipt_code']").val(),
        };
        // Payed using receipt
        $.ajax({
            type: "post",
            url: " /api/application/payment/?code=" + applicationCode,

            data: JSON.stringify(receipt_code),
            dataType: "json",
            success: function (response) {
                const submit = submitData(
                    "/api/application/submit/" + location.search
                );
                submit.then(function (response) {
                    if (response.code == -1) {
                        if (
                            response.msg ==
                            "Please upload all required documents before submit!"
                        ) {
                            $.wnoty({
                                type: "error",
                                message:
                                    "Please upload all required documents and fill all required fields before submit!",
                            });
                            $("form").addClass("was-validated");
                            application_state = 3;
                            showForms();
                        } else {
                            $.wnoty({
                                type: "error",
                                message: response.msg,
                            });
                        }
                    } else {
                        app_submittesubmitApplid(optionPrice, optionName);
                        window.location = "/account";
                    }
                });
            },
        });
    } else {
        const submit = submitData(
            "/api/application/submit/" + location.search,
            { code: location.search.split("=")[1] }
        );
        submit.then(function (response) {
            if (response.code == -1) {
                $.wnoty({
                    type: "error",
                    message: response.msg,
                });
            } else {
                if (response.msg == "Application waits for payment!") {
                    $.wnoty({
                        type: "error",
                        message:
                            "Please pay the application fee to submit your application",
                    });
                } else {
                    //used to trigger event for gtm
                    app_submitted(optionPrice, optionName);
                    window.location = "/account";
                }
            }
        });
    }
});

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

/* -------------------------------------------------------------------------- */
/*                               Delete program                               */
/* -------------------------------------------------------------------------- */

/* $(document.body).on("click", ".delete-prog-btn", function () {
    $("#delete_program").modal("show");
});
$(".delete-prog").on("click", function (e) {
    var code = $(".remove-this").data("code");
    var data = {
        action: "del",
        prog_id: code,
    };
    var appCode = location.search.split("=")[1];
    var optionSelected = $('[name="optional_service"]:checked').data("name");
    $.ajax({
        type: "post",
        url: base_url + "/application/program/delete/" + application_id,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: data,
        cache: false,
        success: function (response) {
            console.log(response);
            $(".delete-app").attr("data-code", "");
            $("#delete_program").modal("hide");
            if (response.code == 0) {
                wnoty_ff({
                    type: "success",
                    message: "Application successfully deleted.",
                });
                // getAppFee();
                // generatePayment(appCode, optionSelected, true);

                fetchData(base_url + "/application/detail/" + application_id)
                    .then((response) => {
                        $("#delete_program").modal("hide");
                        if (response.code == -1) {
                            Sentry.captureException(response.msg);
                        } else {
                            $(".program").html("");
                            total_programs = response.programs.length;
                            for (var i = 0; i < response.programs.length; i++) {
                                createApplicationDetails(
                                    response.programs[i],
                                    response.status
                                );
                            }
                            $("#application-fee").text(
                                response.application_fee
                            );
                            $("#total-fee").text(response.total_fee);
                            // if (response.waits_for !== "USER_SURVEY") {
                            //     $(".delete-prog-btn").hide();
                            //     $(".btn-add-prog").hide();
                            // }
                            // var selected_srv =
                            //     response.data.survey_data.confirmation
                            //         .optional_service;
                            // getOptionalServices(selected_srv);
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        Sentry.captureException(error);
                        wnoty_ff({
                            type: "error",
                            message:
                                "Sorry and error occurred contact support!",
                        });
                    });
            } else {
                wnoty_ff({
                    type: "error",
                    message: response.msg,
                });
            }
        },
    });
}); */
const $toggle = $(".arrow");

$toggle.on("click", function () {
    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(".app-summary").removeClass("d-none");
    } else {
        $(this).addClass("active");
        $(".app-summary").addClass("d-none");
    }
});
tippy("[data-tippy-content]");
// });

//Google analytics event
var app_submitted = function app_submitted(amount = 0, service = "none") {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: "app_submitted",
        application_fee: amount,
    });

    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: "service_selected",
        "Service selected": service,
    });
};

var file_uploaded = function file_uploaded(title) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: "file_uploaded",
        "File title": title,
    });
};
var ga_purchased = function ga_purchased(id, amount, appCode) {
    gtag("event", "purchase", {
        transaction_id: id,
        value: amount,
        currency: "USD",
        items: appCode,
    });
};
//Facebook analytics events

var fbq_purchased = function fbq_purchased(id, amount, appCode) {
    fbq("track", "Purchase", {
        value: amount || 0,
        currency: "USD",
        contents: [
            {
                id: appCode || "None",
            },
        ],
        content_type: "service",
    });
};
