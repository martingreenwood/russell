$ = jQuery;

/*=======================================
=            REST API SEARCH            =
=======================================*/

$('#search_developments').on('click', function() {
	$('#loading').addClass('show');

	var location = document.getElementById('location').value;	//console.log(vehicle_types);
	var bedrooms = document.getElementById('bedrooms').value;	//console.log(location);

	document.getElementById("loader").className = '';
	document.getElementById("loader").innerHTML = '<h3>Loading, Please wait...</h3>';
	
    $('html, body').animate({
        scrollTop: $("#loader").offset().top - 120
    }, 800);

	var primary_data = null,
		primary_xhr = new XMLHttpRequest();

	primary_xhr.open("GET", "wp-json/wp/v2/plots?filter[posts_per_page]=-1");
	primary_xhr.send(primary_data);

	primary_xhr.addEventListener("readystatechange", function () {
		if (this.readyState === this.DONE){
			var plotsOBJ = JSON.parse(this.responseText);
			var plotsSTR = JSON.stringify(plotsOBJ); // plots onject to string console.log(plotsOBJ);
			
			for(var key in plotsOBJ) {
			
				var house_data = null,
					house_xhr = new XMLHttpRequest(),

					arr = [], 			//to collect id values 
				    collection = []; 	//collect unique object


					plot = plotsOBJ[key],				
					plot_availability = plot.acf.plot_availability, 	//console.log(plot_availability);

					plot_title = plot.title.rendered, 					//console.log(plot_title);
					plot_link = plot.link, 								//console.log(plot_title);

					plot_sub_title = plot.acf.big_title, 				//console.log(plot_sub_title);
					plot_price = plot.acf.plot_price, 					//console.log(plot_price);
				
					special_offers = plot.acf.special_offers, 			//console.log(special_offers);
				
					choose_development = plot.acf.choose_development, 	//console.log(choose_development);
					choose_house_type = plot.acf.choose_house_type, 	//console.log(choose_house_type);

				house_xhr.open("GET", "wp-json/wp/v2/housetypes/"+choose_house_type);
				house_xhr.send(house_data);

				house_xhr.addEventListener("readystatechange", function () {
					if (this.readyState === this.DONE){
						var houseOBJ = JSON.parse(this.responseText); 	//console.log(houseOBJ);

						$.each(houseOBJ, function (index, value) {
							var house_name = houseOBJ.title.rendered;
							//console.log(house_name);
						});
					}
				});
				
				results =	'<div class="search_result">' +
								'<div class="img">' +
									'<img src="">' +
								'</div>' +
								'<div class="vehicle_info">' +
									'<p>house =  ('+choose_house_type +')</p>'+
									'<p>dev = '+ choose_development +'</p>'+
									'<h2 class="title">'+plot_title+'</h2>' +
									'<h3 class="price">'+plot_sub_title+'</h3>' +
									'<hr>' +
									'<div class="synopsis">' +
										special_offers +
									'</div>' +
									'<div class="synopsis">' +
										'<p>Price:'+ plot_price +'</p>'+
										//'<p>Benrooms'+ number_of_bedrooms +'</p>'
									'</div>' +
									'<div class="read-mores">' +
										'<a class="more" href="'+plot_link+'">View Plot</a>' +
										'<a class="more" href="'+plot_link+'">View Delopment</a>' +
									'</div>' +
								'</div>' +
							'</div>';

				document.getElementById("loader").className = 'hide';
				
				document.getElementById("search_res_title").className = 'show';

				document.getElementById("results").innerHTML += results;
			}
		}
	});
});
