/////////////////////////////////////////////////////////
//
// @project GeniSys AI Location UI
// @module  GeniSys
// @author  Adam Milton-Barker <www.adammiltonbarker.com>
//
/////////////////////////////////////////////////////////

var GeniSys = {
  AsyncLoad: function(url, scriptId, callback) {
    var script = document.createElement("script"),
      firstscript = document.getElementsByTagName("script")[0];

    script.async = true;
    script.src = url;
    script.id = scriptId;

    if ("function" === typeof callback) {
      script.onload = function() {
        callback();
        script.onload = script.onreadystatechange = undefined;
      };
      script.onreadystatechange = function() {
        if (
          "loaded" === script.readyState ||
          "complete" === script.readyState
        ) {
          script.onload();
        }
      };
    }
    firstscript.parentNode.insertBefore(script, firstscript);
  },
  CheckServer: function() {
    $.post(window.location.href, "getServerStats=true", function(Response) {
      var Response = jQuery.parseJSON(Response);
      if ($("#cpu").length != 0) {
        $("#cpu").text(Response.CPU);
      }
      if ($("#memory").length != 0) {
        $("#memory").text(Response.Memory);
      }
    });
  },
  ShowElement: function(element) {
    $(element).removeClass("hide", 100);
  },
  HideElement: function(element) {
    $(element).addClass("hide", 100);
  },
  SendIoT: function() {
    console.log("StartIoT");
    setTimeout(SendIoT, 3000);
  }
};

GeniSys.SendIoT();
