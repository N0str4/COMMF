let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 47.54825018505105, lng: 2.3977692559568866 },
    zoom: 8,
  });
}