jQuery(document).ready(function($){var hideLoginPopup=function(){if(!$("#login-content").is(".hidden")){$("#login-trigger").removeClass("active");$("#login-content").addClass("hidden")}};var hideRegPopup=function(){if($("#index_register").is(".unfold")){$("#index_register").removeClass("unfold").addClass("fold")}};$("#login-trigger").click(function(){$(this).toggleClass("active");if($("#login-content").hasClass("hidden")){$("#login-content").removeClass("hidden");$("#log").focus()}else{$("#login-content").addClass("hidden");$("#log").blur()};return false});$("body").click(function(){hideLoginPopup()});$('#login-content,#login-content input').click(function(e){e.stopPropagation()})});