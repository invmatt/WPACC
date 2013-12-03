/* ======================
   WPACC | cookie.js	
====================== */

// @PLUGIN
// jQuery cookie plugin to retrieve the value
jQuery.cookie=function(a,b,c){if(arguments.length>1&&"[object Object]"!=b+""){if(c=jQuery.extend({},c),(null===b||void 0===b)&&(c.expires=-1),"number"==typeof c.expires){var d=c.expires,e=c.expires=new Date;e.setDate(e.getDate()+d)}return b+="",document.cookie=[encodeURIComponent(a),"=",c.raw?b:encodeURIComponent(b),c.expires?"; expires="+c.expires.toUTCString():"",c.path?"; path="+c.path:"",c.domain?"; domain="+c.domain:"",c.secure?"; secure":""].join("")}c=b||{};var f,g=c.raw?function(a){return a}:decodeURIComponent;return(f=RegExp("(?:^|; )"+encodeURIComponent(a)+"=([^;]*)").exec(document.cookie))?g(f[1]):null};

// @CLASS
// Retrieve the cookie value and add the class on to the homepage
if (jQuery.cookie('WPACC')) {
    jQuery('body').addClass(jQuery.cookie('WPACC'));
}

// @REMOVESTYLE
// If the theme developer has hardcoded any stylesheets strip them out
if (jQuery('body').is('.wpacc-2, .wpacc-3, .wpacc-4, .wpacc-5')) {
	jQuery('link[rel=stylesheet]').remove();
	// Add the default body class
	jQuery("body").addClass("WPACC");
}

// @ADDSTYLE
// Add the base WPACC styling back in
var install_path = jQuery(".wpacc-access-link").data("install");
// !! This is hacky and will be fixed in an upcoming release.
jQuery('head').append('<link rel="stylesheet" href="'+ install_path +'wpacc.css" type="text/css" />');
