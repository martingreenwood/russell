$j=jQuery;

/*=======================================
=            REST API SEARCH            =
=======================================*/

function sortlist(){

	var cl = document.getElementById('vehicle_makes');
	var clTexts = new Array();

	for(i = 1; i < cl.length; i++){
    	clTexts[i-1] =
        cl.options[i].text.toUpperCase() + "," +
        cl.options[i].text + "," +
        cl.options[i].value + "," +
        cl.options[i].selected;
	}

	clTexts.sort();

	for(i = 1; i < cl.length; i++){
	    var parts = clTexts[i-1].split(',');

	    cl.options[i].text = parts[1];
    	cl.options[i].value = parts[2];
    	if(parts[3] == "true"){
        	cl.options[i].selected = true;
    	}else{
   			cl.options[i].selected = false;
    	}
	}

	$j('#loading').removeClass('show');
}

$j('#vehicle_types').change(function() {
	$j('#loading').addClass('show');

	var vehicle_types = document.getElementById('vehicle_types').value;	//console.log(vehicle_types);
	var vehicle_makes = document.getElementById('vehicle_makes');
		document.getElementById('vehicle_makes').options.length = 0;
		document.getElementById("vehicle_makes").innerHTML = '<option value="">Select make...</option>';
	var data = null;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "wp-json/wp/v2/cars?filter[vehicle_type]="+vehicle_types);
	xhr.send(data);

	xhr.addEventListener("readystatechange", function () {
		if (this.readyState === this.DONE) {
			var posts = JSON.parse(this.responseText);
			var postsObj = JSON.stringify(posts);  //console.log(postsObj);

			var arr = [], //to collect id values 
			    collection = []; //collect unique object


			for(var key in posts) {
				var value = posts[key];	
				var vehicle_make = value.vehicle_make; //console.log(vehicle_make);
			
				var make__data = null;
				var make__xhr = new XMLHttpRequest();

				var make__options = null;
				make__xhr.open("GET", "wp-json/wp/v2/vehicle_make/"+vehicle_make);
				make__xhr.send(make__data);
				make__xhr.addEventListener("readystatechange", function () {
					if (this.readyState === this.DONE) {
						var make__posts = JSON.parse(this.responseText);

						$j.each(make__posts, function (index, value) {
							var vehicle_make_name = make__posts.name;
							var vehicle_make_slug = make__posts.slug;
		
						    if ($j.inArray(make__posts.name, arr) == -1) { //check if id value not exits than add it
						        arr.push(make__posts.name, make__posts.slug);//push id value in arr
						        collection.push(make__posts); //put object in collection to access it's all values
			
					            make__options = '<option value="'+vehicle_make_slug+'">'+vehicle_make_name+'</option>';
								document.getElementById("vehicle_makes").innerHTML += make__options;
								sortlist();

						    }
						});

						//console.log(collection); //you can access it values like collection[index].keyName
						//console.log(arr);
					}
				});
			}
		}
	});
});


$j('#vehicle_makes').change(function() {
	//$j('#loading').addClass('show');
	document.getElementById("vehicle_results").innerHTML = '';
	document.getElementById("loader").className = '';
	document.getElementById("loader").innerHTML = '<h3>Loading, Please wait...</h3>';
	
    $j('html, body').animate({
        scrollTop: $j("#loader").offset().top - 120
    }, 800);

	var vehicle_types = document.getElementById('vehicle_types').value;	//console.log(vehicle_types);
	var vehicle_makes = document.getElementById('vehicle_makes').value; //console.log(vehicle_makes);

	var data = null;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "wp-json/wp/v2/cars?filter[vehicle_type]="+vehicle_types+"&filter[vehicle_make]="+vehicle_makes);
	xhr.send(data);

	xhr.addEventListener("readystatechange", function () {
		if (this.readyState === this.DONE) {
			var posts = JSON.parse(this.responseText);
			var postsObj = JSON.stringify(posts);  //console.log(postsObj);
			
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

				document.getElementById("loader").className = 'hide';

				document.getElementById("vehicle_results").innerHTML += vehicle_result_html;
			}
		}
	});
});
