$j=jQuery;

/*=======================================
=            REST API SEARCH            =
=======================================*/

$j('#search_developments').click(function(e) {
	e.preventDefault();
	
    $j('html, body').animate({
        scrollTop: $j("#results").offset().top - 120
    }, 800);

	var data = null;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "/wp-json/wp/v2/plots?filter[posts_per_page]=-1");
	xhr.send(data);

	xhr.addEventListener("readystatechange", function () {
		if (this.readyState === this.DONE) {
			var posts = JSON.parse(this.responseText);
			var postsObj = JSON.stringify(posts);  
			console.log(postsObj);
			
			/*
			for(var key in posts) {
				var value = posts[key];
				var vehicle_name = value.title.rendered; //console.log(vehicle_name);
				var vehicle_link = value.link; //console.log(vehicle_link);
				var vehicle_pdf = value.acf.vehicle_pdf; //console.log(vehicle_pdf);
					if (vehicle_pdf == undefined) { vehicle_pdf = ""; }
				var vehicle_price = value.acf.vehicle_price; //console.log(vehicle_price);
				var vehicle_synopsis = value.acf.synopsis; //console.log(vehicle_synopsis);
				var vehicle_search_results_image = value.acf.search_results_image; //console.log(vehicle_search_results_image);

				vehicle_result_html =	'<div class="search_result">' +
											'<div class="img">' +
												'<img src="'+vehicle_search_results_image+'">' +
											'</div>' +
											'<div class="vehicle_info">' +
												'<h2 class="title">'+vehicle_name+'</h2>' +
												'<h3 class="price">'+vehicle_price+'</h3>' +
												'<div class="synopsis">' +
												vehicle_synopsis +
												'</div>' +
												'<div class="read-mores">' +
													'<a class="more" href="'+vehicle_link+'">Read More</a>' +
													'<a class="pdf" href="'+vehicle_pdf+'"">Download Brochure</a>' +
												'</div>' +
											'</div>' +
										'</div>';

				//document.getElementById("loader").className = 'hide';
				//document.getElementById("vehicle_results").innerHTML += vehicle_result_html;
			} 
			*/
		}
	});
});
