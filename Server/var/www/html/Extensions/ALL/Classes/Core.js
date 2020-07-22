/////////////////////////////////////////////////////////
// 
// @project GeniSys AI Location UI
// @module  ALLcore
// @author  Adam Milton-Barker <www.adammiltonbarker.com>
// 
/////////////////////////////////////////////////////////

var ALLcore = {
    "Correct": 0,
    "Incorrect": 0,
    "FP": 0,
    "FN": 0,
    "FileSelection": $('<input type="file" multiple="" id="fileSelector"  accept="image/*">'),
    "Classify": function(apiURL, classifyType, data) {

        switch (classifyType) {
            case "Classify":

                jQuery.ajax({
                    url: apiURL,
                    type: "POST",
                    async: true,
                    data: {
                        ftype: "Classify",
                        data: data
                    },
                    success: function(ajaxResponse) {
                        console.log(ajaxResponse)
                        var ajaxResponse = jQuery.parseJSON(ajaxResponse);
                        var j = 0;

                        switch (ajaxResponse.Response) {
                            case "OK":

                                GeniSys.HideElement("#coreResults");
                                GeniSys.HideElement("#coreLoader");
                                GeniSys.ShowElement("#classificationInfo");
                                GeniSys.ShowElement("#classificationContainer");

                                filename = ajaxResponse.ResponseData.File.split("/").pop().split(".").shift()

                                ALLcore.ProcessResult(filename[filename.length - 1], ajaxResponse.ResponseData.Data.aClassification);
                                ALLcore.ShowCDetails(ajaxResponse.ResponseData.Data, ajaxResponse.ResponseData.File);
                                break;

                            default:
                                break;
                        }
                    }
                });
                break;

            default:

                ALLcore.Correct = 0;
                ALLcore.Incorrect = 0;
                ALLcore.FP = 0;
                ALLcore.FN = 0;

                jQuery.ajax({
                    url: apiURL,
                    type: "POST",
                    async: true,
                    data: {
                        ftype: "ClassifyMulti",
                        data: data
                    },
                    success: function(ajaxResponse) {
                        console.log(ajaxResponse)
                        var ajaxResponse = jQuery.parseJSON(ajaxResponse);

                        switch (ajaxResponse.Response) {
                            case "OK":

                                GeniSys.HideElement("#coreResults");
                                GeniSys.HideElement("#coreLoader");
                                GeniSys.ShowElement("#classificationInfo");
                                GeniSys.ShowElement("#classificationContainer");

                                let i = 0;
                                const dataLoop = () => {
                                    if (i < ajaxResponse.ResponseData.length) {
                                        filename = ajaxResponse.ResponseData[i].File.split("/").pop().split(".").shift();

                                        ALLcore.ProcessResult(filename[filename.length - 1], ajaxResponse.ResponseData[i].Data.aClassification);
                                        ALLcore.ShowCDetails(ajaxResponse.ResponseData[i].Data, ajaxResponse.ResponseData[i].File);

                                        if (++i < ajaxResponse.ResponseData.length) {
                                            window.setTimeout(dataLoop, 5000);
                                        } else {
                                            setTimeout(function() {

                                                GeniSys.HideElement("#coreLoader");
                                                GeniSys.HideElement("#classificationInfo");
                                                GeniSys.HideElement("#classificationContainer");
                                                GeniSys.ShowElement("#coreResults");

                                                $("#files").text(ajaxResponse.ResponseData.length);
                                                $("#correct").text(ALLcore.Correct);
                                                $("#incorrect").text(ALLcore.Incorrect);
                                                $("#fp").text(ALLcore.FP);
                                                $("#fn").text(ALLcore.FN);

                                            }, 5000);
                                        }

                                    }
                                };
                                dataLoop();
                                break;
                            default:
                                break;
                        }
                    }
                });
                break;
        }
    },
    "DeleteTestData": function() {
        jQuery.ajax({
            url: window.location.href,
            type: "POST",
            async: true,
            data: {
                ftype: "DeleteAML"
            },
            success: function(ajaxResponse) {
                var ajaxResponse = jQuery.parseJSON(ajaxResponse);
                var j = 0;

                switch (ajaxResponse.Response) {
                    case "OK":
                        setTimeout(function() {
                            GeniSys.HideElement(".classifyALL");
                            GeniSys.HideElement("#coreLoader");
                            GeniSys.HideElement("#datasetHolder");
                            GeniSys.ShowElement("#uploadTemp");
                        }, 5000);
                        break;

                    default:
                        setTimeout(function() {
                            GeniSys.HideElement(".classifyALL");
                            GeniSys.HideElement("#coreLoader");
                            GeniSys.HideElement("#datasetHolder");
                            GeniSys.ShowElement("#uploadTemp");
                        }, 5000);
                        break;
                }
            }
        });
    },
    "UploadFiles": function(files) {
        jQuery.ajax({
            url: window.location.href,
            type: "POST",
            async: true,
            data: {
                ftype: "UploadTestData",
                data: files
            },
            success: function(ajaxResponse) {
                console.log(ajaxResponse);
                var ajaxResponse = jQuery.parseJSON(ajaxResponse);
                var j = 0;

                switch (ajaxResponse.Response) {
                    case "OK":
                        setTimeout(function() {

                            GeniSys.HideElement(".classifyALL");
                            GeniSys.HideElement("#coreLoader");
                            location.reload();

                        }, 5000);
                        break;

                    default:
                        break;
                }
            }
        });
    },
    "ProcessResult": function(lastChar, aClassification) {

        if (lastChar == 0 && aClassification == 0 || lastChar == 1 && aClassification == 1) {
            ALLcore.Correct += 1;
            if (aClassification == 0)
                message = "Classification: <strong>Correct</strong><br />Diagnosis: <strong>Negative</strong>";
            else if (aClassification == 1)
                message = "Classification: <strong>Correct</strong><br />Diagnosis: <strong>Positive</strong>";
        } else if (lastChar == 1 && aClassification == 0) {
            ALLcore.Incorrect += 1;
            ALLcore.FN += 1;
            message = "Classification: <strong>Incorrect</strong><br />Diagnosis: <strong>False Negative</strong>";
        } else if (lastChar == 0 && aClassification == 1) {
            ALLcore.Incorrect += 1;
            ALLcore.FP += 1;
            message = "Classification: <strong>Incorrect</strong><br />Diagnosis: <strong>False Positive</strong>";
        }
        $("#validation").html(message);
    },
    "ShowCDetails": function(rdata, rfile) {
        $("#fileName").text(rfile.substring(rfile.lastIndexOf("/") + 1));
        $("#classification").text(rdata.Classification);
        $("#confidence").text("Confidence: " + rdata.Confidence);
        $("#classificationContainer").attr("src", rfile);
    },
}

$("#wrapper").on("click", ".classifyALL", function() {
    GeniSys.HideElement("#coreResults");
    GeniSys.ShowElement("#coreLoader");
    GeniSys.ShowElement("#classificationLive");
    GeniSys.HideElement("#classificationLoader");
    GeniSys.HideElement("#classificationInfo");
    GeniSys.HideElement("#classificationContainer");
    ALLcore.Classify(window.location.href, "Classify", $(this).attr("src"));
});


$("#wrapper").on("click", "#classifyALLMulti", function() {
    GeniSys.HideElement("#coreResults");
    GeniSys.ShowElement("#coreLoader");
    GeniSys.ShowElement("#classificationLive");
    GeniSys.HideElement("#classificationLoader");
    GeniSys.HideElement("#classificationInfo");
    GeniSys.HideElement("#classificationContainer");
    ALLcore.Classify(window.location.href, "ClassifyMulti", "");
});


$("#wrapper").on("click", "#deleteAML", function() {
    GeniSys.HideElement("#datasetHolder");
    GeniSys.ShowElement("#coreLoader");
    ALLcore.DeleteTestData();
});

$("#wrapper").on("click", "#uploadAML", function() {
    $("#fileSelector").click();
    return false;
});

$("#fileSelector").change(function() {
    GeniSys.HideElement("#datasetHolder");
    GeniSys.ShowElement("#coreLoader");
    $("#dropzone").submit();
});