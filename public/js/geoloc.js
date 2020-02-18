var placesAutocomplete = places({
    appId: 'plF08LHPG3UQ',
    apiKey: 'c68f096186cd99643002baf53e425d81',
    container: document.querySelector('#place_adresse')
});
placesAutocomplete.on('change', e => {
    document.querySelector('#place_city').value = e.suggestion.city;
    document.querySelector('#place_street').value = e.suggestion.name;
    document.querySelector('#place_zipcode').value = e.suggestion.postcode;
    document.querySelector('#place_latitude').value = e.suggestion.latlng.lat;
    document.querySelector('#place_longitude').value = e.suggestion.latlng.lng;
    var lat = e.suggestion.latlng.lat;
    var long = e.suggestion.latlng.lng;

    mapboxgl.accessToken = 'pk.eyJ1IjoicGF1bGluZW9obGl2ZCIsImEiOiJjazZobThqNm8yZm81M2xtZ2JiMjAwYTU4In0.rd9tpEypJqJ9VH4Z6r05lQ';
    var map = new mapboxgl.Map({
        container: 'map', // Container ID
        style: 'mapbox://styles/mapbox/streets-v11', // Map style to use
        center: [long, lat], // Starting position [lng, lat]
        zoom: 12, // Starting zoom level
    });

    var marker = new mapboxgl.Marker() // initialize a new marker
        .setLngLat([long, lat]) // Marker [lng, lat] coordinates
        .addTo(map); // Add the marker to the map
});