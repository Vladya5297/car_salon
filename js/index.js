ymaps.ready(init);
var myMap;

function init() {
    myMap = new ymaps.Map('map', {
        zoom: 16,
        center: [55.670080, 37.480176],
        controls: ['geolocationControl']
    });

    myMap.controls.add('zoomControl', {
        position: {
            top: 175,
            right: 10
        }
    });
    
    myMap.behaviors.disable('scrollZoom'); 
    
    showResults(55.670080, 37.480176);
}

function showResults(lat, long) {
    myMap.geoObjects.add(new ymaps.Placemark([lat, long], {
        preset: 'islands#icon',
        iconColor: '#0095b6'
    }));
}