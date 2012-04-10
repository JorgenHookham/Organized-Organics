/* Author: 

*/





// Toggles appropriate groups of check boxes for add/edit listing pages
function show_listing_options ()
{
	var current_listing_type = $('#listingType').val();
	
	if ( current_listing_type == 'market' || current_listing_type == 'farm' )
	{
		$('#listing-cuisine-inputs').addClass('s-hidden');
		$('#listing-stock-inputs').removeClass('s-hidden');
	}
	
	else if ( current_listing_type == 'restaurant' )
	{
		$('#listing-cuisine-inputs').removeClass('s-hidden');
		$('#listing-stock-inputs').addClass('s-hidden');
	}
}





$(function()
{
	// Initializes the Google map if there is one on the page
	if ( $('#listing-map').length )
	{
	    //var lat = ( $('#listing-latitude') && $('#listing-latitude').text() != '0' && $('#listing-latitude').text() != '' ) ? $('#listing-latitude').text() : 49.2899;
	    //var long = ( $('#listing-longitude') && $('#listing-longitude').text() != '0' && $('#listing-longitude').text() != '' ) ? $('#listing-longitude').text() : -123.1403;
	    var lat = $('#latitude').text();
	    var long = $('#longitude').text();
	    console.log(lat + ", " + long);
	    var latlng = new google.maps.LatLng(lat, long);
	    var myOptions = {
	      zoom: 14,
	      center: latlng,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	    var map = new google.maps.Map(document.getElementById("listing-map"),
	        myOptions);
	        
	    var marker = new google.maps.Marker({
		    position: latlng,
		    title: $('#listing-title').text()
		});
		marker.setMap(map);
	}
	
	$('#listing-delete-link').click(function () 
	{
		if ( ! confirm('Are you sure you want to delete this entry?') )
		{
			return false;
		}
	});
	
	$('#listingType').change(function ()
	{
		show_listing_options();

	});
	
	show_listing_options();
	
	
	$('img.listing-category-icon').hover(
		function(){
		
		$(this).next().css('display', 'block');
		},
		
		function(){
		$('p.tooltip').css('display', 'none');
	});


});

















