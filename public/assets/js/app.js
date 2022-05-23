let lon = document.getElementById('lon').value;
let lat = document.getElementById('lat').value;
let map = L.map('map').setView([lat, lon], 13); //48.8 = lat, lon = 2.35 donc je remplace ça par les valeurs de mon tableau coor

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

//--------------------GEOCODER----------------------------------------------
/*let geocoder = L.Control.Geocoder.nominatim();
      if (typeof URLSearchParams !== 'undefined' && location.search) {
        // parse /?geocoder=nominatim from URL
        var params = new URLSearchParams(location.search);
        var geocoderString = params.get('geocoder');
        if (geocoderString && L.Control.Geocoder[geocoderString]) {
          console.log('Using geocoder', geocoderString);
          geocoder = L.Control.Geocoder[geocoderString]();
        } else if (geocoderString) {
          console.warn('Unsupported geocoder', geocoderString);
        }
      }
let control = L.Control.geocoder({
    query: 'Moon',
    placeholder: 'Search here...',
    geocoder: geocoder
  }).addTo(map);
  var marker;

L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


map.on('click', function(e) {
    geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
      var r = results[0];
      if (r) {
        if (marker) {
          marker
            .setLatLng(r.center)
            .setPopupContent(r.html || r.name)
            .openPopup();
        } else {
          marker = L.marker(r.center)
            .bindPopup(r.name)
            .addTo(map)
            .openPopup();
        }
      }
    });
});*/

/*L.marker([48.8, 2.35]).addTo(map)
    .bindPopup('Vous êtes ici')
    .openPopup();*/
