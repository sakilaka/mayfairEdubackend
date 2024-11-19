$("#financialsupport-step").on("click", async function (e) {
    e.preventDefault();

    var updateProfile = false;
    var updateEducation = false;
    var updateWork = false;
    var invalid_sections = [];
    
    if ($("#aboutyou")[0].checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        wnoty_ff({
            type: "error",
            message:
                "Please fill all the required fields in the About you section.",
        });
        checkProfile = false;
        invalid_sections.push("#aboutyou");
    } else {
        updateProfile = true;
        await _updateProfile();
    }
    $("#aboutyou").addClass("was-validated");

    if ($("#home_address")[0].checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        $("#home_address").addClass("was-validated");
        wnoty_ff({
            type: "error",
            message:
                "Please fill all the required fields in the Address section.",
        });
        checkProfile = false;
        invalid_sections.push("#home_address");
    } else {
        updateAddress = true;
        await _updateAddress();
    }

    if ($("#post_address")[0].checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        $("#post_address").addClass("was-validated");
        wnoty_ff({
            type: "error",
            message:
                "Please fill all the required fields in the Address section.",
        });
        checkProfile = false;
        invalid_sections.push("#post_address");
    } else {
        updateAddress = true;
        await _updatePostAddress();
    }
    var education_data = [];
    $("#education-data form,.education_fields  form").each(function (index) {
       
        if ($(this)[0].checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
            wnoty_ff({
                type: "error",
                message:
                    "Please fill all the required fields in the Education section.",
            });
            invalid_sections.push("#education-data form");
        } else {
            var alldata = $(this).serializeJSON();

            //create new education fields
            if (alldata["education-fields"]) {
                updateEducation = true;

                data = alldata["education-fields"][index];
                education_data.push(data);
            } else {
                //update if exist
                data = alldata;
                updateEducation = true;
                education_data.push(data);
            }
        }
        $(this).addClass("was-validated");
    });
    await _updateEducation(education_data);

    var work_data = [];
    $("#workexperience-data form, .workexperience-fields  form").each(function (
        index
    ) {
        if ($(this)[0].checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
            wnoty_ff({
                type: "error",
                message:
                    "Please fill all the required fields in the Work experience section",
            });
            invalid_sections.push("#workexperience-data form");
        } else {
            var alldata = $(this).serializeJSON();
            //create new education fields
            if (alldata["workexperience-fields"]) {
                updateWork = true;

                data = alldata["workexperience-fields"][index];
               
                //remove place holder fields from data
                if (data.employer != "") {
                    work_data.push(data);
                }
            } else {
                //update if exist
              
                data = alldata;
                
                updateWork = true;
                if (data.employer != "") {
                    work_data.push(data);
                }
            }
        }
        $(this).addClass("was-validated");
    });
    await _updateWork(work_data);

    if (updateWork || updateEducation || updateProfile) {
        wnoty_ff({
            type: "success",
            message: "Successfully Updated.",
        });
    }

    //scroll to section with errors
 
    if (invalid_sections[0]) {

        $("html, body").animate(
            {
                scrollTop: $(invalid_sections[0]).offset().top,
            },
            500
        );
    }

    //Sync application
    $(document.body).trigger("syncApp");

    setFormHeight();
});

$(".supporting-doc").click(async function (e) {
    var updateFinancialSupport = false;
    //Update financial details
    if ($("#financialsupport")[0].checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        wnoty_ff({
            type: "error",
            message: "Please fill all the required fields.",
        });
    } else {
        updateFinancialSupport = await _updateSupportingDoc();
    }
    $("#financialsupport").addClass("was-validated");

    if (updateFinancialSupport) {
        wnoty_ff({
            type: "success",
            message: "Successfully Updated",
        });
        $(document.body).trigger("syncApp");
    }
    setFormHeight();
});

$("select#is_in_china").on("change", function () {
    var value = $(this).val();

    if (value === "true") {
        $("#msg-in-china").show();
    } else {
        $("#msg-in-china").hide();
    }
});

$("select#fund").on("change", function () {
    var value = $(this).val();
    if (value === "Self finance") {
        $("#msg-fund").html("");
        $("#txt-scholarship").hide();
        $(".supporting-doc").attr("disabled", false);
    } else if (value === "Chinese Government Scholarship") {
        $("#msg-fund").html(
            "Unfortunately we can't help you apply for the CSC Scholarship on China Admissions. But you can apply to the university here, and apply for the scholarship by yourself. " +
                'Please see the guide on how to apply <a style="color:#d71f27" href="https://www.china-admissions.com/blog/china-scholarship/" target="_blank" rel="noopener noreferrer">here</a> for CSC.'
        );
        $("#txt-scholarship").hide();
        $(".supporting-doc").attr("disabled", true);
    } else {
        $("#msg-fund").html("");
        $("#txt-scholarship").show();
        $(".supporting-doc").attr("disabled", false);
    }
    setFormHeight();
});

// $(document).on("click", ".modal-header .close", function () {
//     console.log($(this).parent().parent().parent().parent());
//     $(this).closest(".modal").modal("hide");
//     // $(".modal").modal("hide");
//     //$(this).parent().parent().parent().parent().modal("hide");
// });
$(".dropzone").each(function (index) {
    $(this).dropzone({
        dictDefaultMessage: "Drop files or click here to upload",
        maxFiles: 1,
        maxFilesize: 10,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
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
                    this.element.attributes["data-container"].nodeValue
                ).remove();

                $(".modal").modal("hide"); // closes all active pop ups.
                $(".modal-backdrop").remove(); // removes the grey overlay.
                wnoty_ff({
                    type: "success",
                    message: "Document Successfully Uploaded!",
                });
            });
            this.on("addedfile", function (file) {
                var ext = file.name.split(".").pop();
                if(file.size > (1024 * 1024 * 10)) // not more than 5mb
                {
                    this.removeFile(file); // if you want to remove the file or you can add alert or presentation of a message
                    wnoty_ff({
                        type: "error",
                        message: "File is larager than 10MB.",
                    });
                }else if(ext != "png" && ext != "jpg" && ext != "jpeg" && ext != "pdf"){
                    this.removeFile(file);
                    wnoty_ff({
                        type: "error",
                        message: "Please Select JPG,PNG And PDF File",
                    });
                }
                else{
                    
                    
                    if (ext != "png" && ext != "jpg" && ext != "jpeg") {
                        $(file.previewElement)
                            .find(".dz-image img")
                            .attr(
                                "src",
                                "/static/assets/js/dropzone/file-icon.svg"
                            );
                    }
                }
               
            });
            this.on('maxfilesexceeded',function(){
                
            })
        },
    });
});
