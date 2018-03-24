/*!
 * jQuery Smart Banner
 * Copyright (c) 2012 Arnold Daniels <arnold@jasny.net>
 * Based on 'jQuery Smart Web App Banner' by Kurt Zenisek @ kzeni.com
 */
!function(t,s){"function"==typeof define&&define.amd?define(["jquery"],s):s(t.jQuery)}(this,function(t){function s(){var t=document.createElement("smartbanner"),s={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var i in s)if(void 0!==t.style[i])return{end:s[i]};return!1}var i=navigator.userAgent,n=/Edge/i.test(i),e=function(s){this.origHtmlMargin=parseFloat(t("html").css("margin-top")),this.options=t.extend({},t.smartbanner.defaults,s);var e=navigator.standalone;if(this.options.force?this.type=this.options.force:null!==i.match(/Windows Phone/i)&&null!==i.match(/Edge|Touch/i)?this.type="windows":null!==i.match(/iPhone|iPod/i)||i.match(/iPad/)&&this.options.iOSUniversalApp?null!==i.match(/Safari/i)&&(null!==i.match(/CriOS/i)||window.Number(i.substr(i.indexOf("OS ")+3,3).replace("_","."))<6)&&(this.type="ios"):i.match(/\bSilk\/(.*\bMobile Safari\b)?/)||i.match(/\bKF\w/)||i.match("Kindle Fire")?this.type="kindle":null!==i.match(/Android/i)&&(this.type="android"),this.type&&!e&&!this.getCookie("sb-closed")&&!this.getCookie("sb-installed")){this.scale="auto"==this.options.scale?t(window).width()/window.screen.width:this.options.scale,this.scale<1&&(this.scale=1);var o=t("android"==this.type?'meta[name="google-play-app"]':"ios"==this.type?'meta[name="apple-itunes-app"]':"kindle"==this.type?'meta[name="kindle-fire-app"]':'meta[name="msApplication-ID"]');if(o.length){if("windows"==this.type)n&&(this.appId=t('meta[name="msApplication-PackageEdgeName"]').attr("content")),this.appId||(this.appId=t('meta[name="msApplication-PackageFamilyName"]').attr("content"));else{var a=/app-id=([^\s,]+)/.exec(o.attr("content"));if(!a)return;this.appId=a[1]}this.title=this.options.title?this.options.title:o.data("title")||t("title").text().replace(/\s*[|\-·].*$/,""),this.author=this.options.author?this.options.author:o.data("author")||(t('meta[name="author"]').length?t('meta[name="author"]').attr("content"):window.location.hostname),this.iconUrl=o.data("icon-url"),this.price=o.data("price"),"function"==typeof this.options.onInstall?this.options.onInstall=this.options.onInstall:this.options.onInstall=function(){},"function"==typeof this.options.onClose?this.options.onClose=this.options.onClose:this.options.onClose=function(){},this.create(),this.show(),this.listen()}}};e.prototype={constructor:e,create:function(){var s,i=this.price||this.options.price,e=this.options.url||function(){switch(this.type){case"android":return"market://details?id=";case"kindle":return"amzn://apps/android?asin=";case"windows":return n?"ms-windows-store://pdp/?productid=":"ms-windows-store:navigate?appid="}return"https://itunes.apple.com/"+this.options.appStoreLanguage+"/app/id"}.call(this)+this.appId,o=i?function(){var t=i+" - ";switch(this.type){case"android":return t+this.options.inGooglePlay;case"kindle":return t+this.options.inAmazonAppStore;case"windows":return t+this.options.inWindowsStore}return t+this.options.inAppStore}.call(this):"",a=null==this.options.iconGloss?"ios"==this.type:this.options.iconGloss;"android"==this.type&&this.options.GooglePlayParams&&(e+="&referrer="+this.options.GooglePlayParams);var r='<div id="smartbanner" class="'+this.type+'"><div class="sb-container"><a href="#" class="sb-close">&times;</a><span class="sb-icon"></span><div class="sb-info"><strong>'+this.title+"</strong><span>"+this.author+"</span><span>"+o+'</span></div><a href="'+e+'" class="sb-button"><span>'+this.options.button+"</span></a></div></div>";this.options.layer?t(this.options.appendToSelector).append(r):t(this.options.appendToSelector).prepend(r),this.options.icon?s=this.options.icon:this.iconUrl?s=this.iconUrl:t('link[rel="apple-touch-icon-precomposed"]').length>0?(s=t('link[rel="apple-touch-icon-precomposed"]').attr("href"),null==this.options.iconGloss&&(a=!1)):t('link[rel="apple-touch-icon"]').length>0?s=t('link[rel="apple-touch-icon"]').attr("href"):t('meta[name="msApplication-TileImage"]').length>0?s=t('meta[name="msApplication-TileImage"]').attr("content"):t('meta[name="msapplication-TileImage"]').length>0&&(s=t('meta[name="msapplication-TileImage"]').attr("content")),s?(t("#smartbanner .sb-icon").css("background-image","url("+s+")"),a&&t("#smartbanner .sb-icon").addClass("gloss")):t("#smartbanner").addClass("no-icon"),this.bannerHeight=t("#smartbanner").outerHeight()+2,this.scale>1&&(t("#smartbanner").css("top",parseFloat(t("#smartbanner").css("top"))*this.scale).css("height",parseFloat(t("#smartbanner").css("height"))*this.scale).hide(),t("#smartbanner .sb-container").css("-webkit-transform","scale("+this.scale+")").css("-msie-transform","scale("+this.scale+")").css("-moz-transform","scale("+this.scale+")").css("width",t(window).width()/this.scale)),t("#smartbanner").css("position",this.options.layer?"absolute":"static")},listen:function(){t("#smartbanner .sb-close").on("click",t.proxy(this.close,this)),t("#smartbanner .sb-button").on("click",t.proxy(this.install,this))},show:function(s){var i=t("#smartbanner");if(i.stop(),this.options.layer)i.animate({top:0,display:"block"},this.options.speedIn).addClass("shown").show(),t(this.pushSelector).animate({paddingTop:this.origHtmlMargin+this.bannerHeight*this.scale},this.options.speedIn,"swing",s);else if(t.support.transition){i.animate({top:0},this.options.speedIn).addClass("shown");var n=function(){t("html").removeClass("sb-animation"),s&&s()};t(this.pushSelector).addClass("sb-animation").one(t.support.transition.end,n).emulateTransitionEnd(this.options.speedIn).css("margin-top",this.origHtmlMargin+this.bannerHeight*this.scale)}else i.slideDown(this.options.speedIn).addClass("shown")},hide:function(s){var i=t("#smartbanner");if(i.stop(),this.options.layer)i.animate({top:-1*this.bannerHeight*this.scale,display:"block"},this.options.speedIn).removeClass("shown"),t(this.pushSelector).animate({paddingTop:this.origHtmlMargin},this.options.speedIn,"swing",s);else if(t.support.transition){"android"!==this.type?i.css("top",-1*this.bannerHeight*this.scale).removeClass("shown"):i.css({display:"none"}).removeClass("shown");var n=function(){t("html").removeClass("sb-animation"),s&&s()};t(this.pushSelector).addClass("sb-animation").one(t.support.transition.end,n).emulateTransitionEnd(this.options.speedOut).css("margin-top",this.origHtmlMargin)}else i.slideUp(this.options.speedOut).removeClass("shown")},close:function(t){t.preventDefault(),this.hide(),this.setCookie("sb-closed","true",this.options.daysHidden),this.options.onClose(t)},install:function(t){this.options.hideOnInstall&&this.hide(),this.setCookie("sb-installed","true",this.options.daysReminder),this.options.onInstall(t)},setCookie:function(t,s,i){var n=new Date;n.setDate(n.getDate()+i),s=encodeURI(s)+(null==i?"":"; expires="+n.toUTCString()),document.cookie=t+"="+s+"; path=/;"},getCookie:function(t){var s,i,n,e=document.cookie.split(";");for(s=0;s<e.length;s++)if(i=e[s].substr(0,e[s].indexOf("=")),n=e[s].substr(e[s].indexOf("=")+1),i=i.replace(/^\s+|\s+$/g,""),i==t)return decodeURI(n);return null},switchType:function(){var s=this;this.hide(function(){s.type="android"==s.type?"ios":"android";var i=t("android"==s.type?'meta[name="google-play-app"]':'meta[name="apple-itunes-app"]').attr("content");s.appId=/app-id=([^\s,]+)/.exec(i)[1],t("#smartbanner").detach(),s.create(),s.show()})}},t.smartbanner=function(s){var i=t(window),n=i.data("smartbanner"),o="object"==typeof s&&s;n||i.data("smartbanner",n=new e(o)),"string"==typeof s&&n[s]()},t.smartbanner.defaults={title:null,author:null,price:"FREE",appStoreLanguage:"us",inAppStore:"On the App Store",inGooglePlay:"In Google Play",inAmazonAppStore:"In the Amazon Appstore",inWindowsStore:"In the Windows Store",GooglePlayParams:null,icon:null,iconGloss:null,button:"VIEW",url:null,scale:"auto",speedIn:300,speedOut:400,daysHidden:15,daysReminder:90,force:null,hideOnInstall:!0,layer:!1,iOSUniversalApp:!0,appendToSelector:"body",pushSelector:"html"},t.smartbanner.Constructor=e,void 0===t.support.transition&&(t.fn.emulateTransitionEnd=function(s){var i=!1,n=this;t(this).one(t.support.transition.end,function(){i=!0});var e=function(){i||t(n).trigger(t.support.transition.end)};return setTimeout(e,s),this},t(function(){t.support.transition=s()}))});