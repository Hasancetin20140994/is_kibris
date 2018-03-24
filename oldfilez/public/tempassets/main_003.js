 (function($) {
	
	$( document ).ready(function() {
		
		$("#mainmenuarea #mainmenu>li.signup>a").addClass("trbtn");
		$("#mainmenuarea #mainmenu>li.logout>a").addClass("trbtn");
		$("#mainmenuarea #mainmenu>li.login>a").addClass("pnkbtn");
		
		var searchWidget = $(".inv_job_search_component");
		searchWidget.append('<div class="megadropdown"></div>');
		var megaSelect = searchWidget.find(".megaselect");
		
		megaSelect.find("option").each(function(){
			var optVal = $(this).val();
			var optText = $(this).text();
			if(optVal){
				searchWidget.find(".megadropdown").append('<a href="#" data="'+optVal+'">'+optText+'</a>');
			}
		});
		
		
		megaSelect.on('mousedown', function(e) {
			e.preventDefault();
			searchWidget.find(".megadropdown").addClass("active");
			console.log("click trigered");
		});
		
		searchWidget.find(".megadropdown>a").on('click', function(e){
			e.preventDefault();
			var optData = $(this).attr("data");
			console.log(optData);
			megaSelect.val(optData);
			searchWidget.find(".megadropdown").removeClass("active");
		});
		
		
		
	});
})(jQuery);
