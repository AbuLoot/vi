$(document).ready(function () {
    var address = $("#show_on_map .modal-header").html();
    var coords = [0,0];
    var firstGeoObject;
    
    ymaps.ready(function () {
	    ymaps.geocode(address, {
	    	results: 1
	    }).then(function (res) {
	    	firstGeoObject = res.geoObjects.get(0),
            coords = firstGeoObject.geometry.getCoordinates();
	    	init(coords);
	    });
    });

    function init(coords) {

        var myPlacemark,
            myMap = new ymaps.Map('map', {
                center: coords,
                zoom: 13
            }, {
                searchControlProvider: 'yandex#search'
            });

        myMap.geoObjects.add(firstGeoObject);
    }
});