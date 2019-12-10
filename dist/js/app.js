var map, featureList, boroughSearch = [], denpasartimurSearch = [], denpasarbaratSearch = [],denpasarselatanSearch = [],denpasarutaraSearch = [];

$(window).resize(function() {
  sizeLayerControl();
});

$(document).on("click", ".feature-row", function(e) {
  $(document).off("mouseout", ".feature-row", clearHighlight);
  sidebarClick(parseInt($(this).attr("id"), 10));
});

if ( !("ontouchstart" in window) ) {
  $(document).on("mouseover", ".feature-row", function(e) {
    highlight.clearLayers().addLayer(L.circleMarker([$(this).attr("lat"), $(this).attr("lng")], highlightStyle));
  });
}

$(document).on("mouseout", ".feature-row", clearHighlight);

$("#about-btn").click(function() {
  $("#aboutModal").modal("show");
  $(".navbar-collapse.in").collapse("hide");
  return false;
});

$("#full-extent-btn").click(function() {
  map.fitBounds(boroughs.getBounds());
  $(".navbar-collapse.in").collapse("hide");
  return false;
});

$("#legend-btn").click(function() {
  $("#legendModal").modal("show");
  $(".navbar-collapse.in").collapse("hide");
  return false;
});

$("#login-btn").click(function() {
  $("#loginModal").modal("show");
  $(".navbar-collapse.in").collapse("hide");
  return false;
});

$("#list-btn").click(function() {
  animateSidebar();
  return false;
});

$("#nav-btn").click(function() {
  $(".navbar-collapse").collapse("toggle");
  return false;
});

$("#sidebar-toggle-btn").click(function() {
  animateSidebar();
  return false;
});

$("#sidebar-hide-btn").click(function() {
  animateSidebar();
  return false;
});

function animateSidebar() {
  $("#sidebar").animate({
    width: "toggle"
  }, 350, function() {
    map.invalidateSize();
  });
}

function sizeLayerControl() {
  $(".leaflet-control-layers").css("max-height", $("#map").height() - 50);
}

function clearHighlight() {
  highlight.clearLayers();
}

function sidebarClick(id) {
  var layer = markerClusters.getLayer(id);
  map.setView([layer.getLatLng().lat, layer.getLatLng().lng], 17);
  layer.fire("click");
  /* Hide sidebar and go to the map on small screens */
  if (document.body.clientWidth <= 767) {
    $("#sidebar").hide();
    map.invalidateSize();
  }
}

function syncSidebar() {
  /* Empty sidebar features */
  $("#feature-list tbody").empty();
  /* Loop through museums layer and add only features which are in the map bounds */
  denpasarbarats.eachLayer(function (layer) {
    if (map.hasLayer(denpasarbaratLayer)) {
      if (map.getBounds().contains(layer.getLatLng())) {
        $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec2.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      }
    }
  });

  denpasarutaras.eachLayer(function (layer) {
    if (map.hasLayer(denpasarutaraLayer)) {
      if (map.getBounds().contains(layer.getLatLng())) {
        $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec1.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      }
    }
  });

  denpasarselatans.eachLayer(function (layer) {
    if (map.hasLayer(denpasarselatanLayer)) {
      if (map.getBounds().contains(layer.getLatLng())) {
        $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec3.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      }
    }
  });

  denpasartimurs.eachLayer(function (layer) {
    if (map.hasLayer(denpasartimurLayer)) {
      if (map.getBounds().contains(layer.getLatLng())) {
        $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec4.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      }
    }
  });
  /* Update list.js featureList */
  featureList = new List("features", {
    valueNames: ["feature-name"]
  });
  featureList.sort("feature-name", {
    order: "asc"
  });
}

/* Basemap Layers */
var cartoLight = L.tileLayer("https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://cartodb.com/attributions">CartoDB</a>'
});

/* Overlay Layers */
var highlight = L.geoJson(null);
var highlightStyle = {
  stroke: false,
  fillColor: "#00FFFF",
  fillOpacity: 0.7,
  radius: 10
};

var boroughs = L.geoJson(null, {
  style: function (feature) {
    return {
      clickable: false
    };
  },
  onEachFeature: function (feature, layer) {
    boroughSearch.push({
      name: layer.feature.properties.BoroName,
      source: "DENPASAR",
      id: L.stamp(layer),
      bounds: layer.getBounds()
    });
  }
});
$.getJSON("data/DENPASAR.geojson", function (data) {
  boroughs.addData(data);
});


/* Single marker cluster layer to hold all clusters */
var markerClusters = new L.MarkerClusterGroup({
  spiderfyOnMaxZoom: true,
  showCoverageOnHover: false,
  zoomToBoundsOnClick: true,
  disableClusteringAtZoom: 16
});


var denpasarutaraLayer = L.geoJson(null);
var denpasarutaras = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl: "dist/img/kec1.png",
        iconSize: [24, 28],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
            var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Nama Instansi</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Tanggal Pelaksanaan</th><td>" + feature.properties.WAKTUDANTANGGAL + "</td></tr>" + "<tr><th>Alamat</th><td>" + feature.properties.ALAMAT + "</td></tr>" + "<tr><th>Kecamatan</th><td>" + feature.properties.KECAMATAN + "</td></tr>" + "<tr><th>Link</th><td><a href=" + feature.properties.LINK + " target='_blank'>Link</a></td></tr>" +
              "<table>";
      layer.on({
        click: function (e) {
          var container = L.DomUtil.create('div'),
          deskripsi = createButton('Deskripsi Lokasi', container),
          arahkan = createButton('Menuju Lokasi Ini', container);
  
          L.popup()
              .setContent(container)
              .setLatLng(e.latlng)
              .openOn(map);
      
          L.DomEvent.on(arahkan, 'click', function() {
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
            map.closePopup();
          });
          L.DomEvent.on(deskripsi, 'click', function() {
            $("#feature-title").html(feature.properties.NAME);
            $("#feature-info").html(content);
            $("#featureModal").modal("show");
            map.closePopup();
      });
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], highlightStyle));
        }
      });
      $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec1.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      denpasarutaraSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ALAMAT,
        source: "Denpasar Utara",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
$.getJSON("http://127.0.0.1/pmi/data/DATA_JADWAL.php?posisi=Denpasar Utara", function (data) {
  denpasarutaras.addData(data);
});

var denpasarbaratLayer = L.geoJson(null);
var denpasarbarats = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl: "dist/img/kec2.png",
        iconSize: [24, 28],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
            var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Nama Instansi</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Tanggal Pelaksanaan</th><td>" + feature.properties.WAKTUDANTANGGAL + "</td></tr>" + "<tr><th>Alamat</th><td>" + feature.properties.ALAMAT + "</td></tr>" + "<tr><th>Kecamatan</th><td>" + feature.properties.KECAMATAN + "</td></tr>" + "<tr><th>Link</th><td><a href=" + feature.properties.LINK + " target='_blank'>Link</a></td></tr>" +
              "<table>";
      layer.on({
        click: function (e) {
          var container = L.DomUtil.create('div'),
          deskripsi = createButton('Deskripsi Lokasi', container),
          arahkan = createButton('Menuju Lokasi Ini', container);
  
          L.popup()
              .setContent(container)
              .setLatLng(e.latlng)
              .openOn(map);
      
          L.DomEvent.on(arahkan, 'click', function() {
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
            map.closePopup();
          });
          L.DomEvent.on(deskripsi, 'click', function() {
            $("#feature-title").html(feature.properties.NAME);
            $("#feature-info").html(content);
            $("#featureModal").modal("show");
            map.closePopup();
      });
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], highlightStyle));
        }
      });
      $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec2.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      denpasarbaratSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ALAMAT,
        source: "Denpasar Barat",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
$.getJSON("http://127.0.0.1/pmi/data/DATA_JADWAL.php?posisi=Denpasar Barat", function (data) {
  denpasarbarats.addData(data);
});

var denpasarselatanLayer = L.geoJson(null);
var denpasarselatans = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl: "dist/img/kec3.png",
        iconSize: [24, 28],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
            var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Nama Instansi</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Tanggal Pelaksanaan</th><td>" + feature.properties.WAKTUDANTANGGAL + "</td></tr>" + "<tr><th>Alamat</th><td>" + feature.properties.ALAMAT + "</td></tr>" + "<tr><th>Kecamatan</th><td>" + feature.properties.KECAMATAN + "</td></tr>" + "<tr><th>Link</th><td><a href=" + feature.properties.LINK + " target='_blank'>Link</a></td></tr>" +
              "<table>";
      layer.on({
        click: function (e) {
          var container = L.DomUtil.create('div'),
          deskripsi = createButton('Deskripsi Lokasi', container),
          arahkan = createButton('Menuju Lokasi Ini', container);
  
          L.popup()
              .setContent(container)
              .setLatLng(e.latlng)
              .openOn(map);
      
          L.DomEvent.on(arahkan, 'click', function() {
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
            map.closePopup();
          });
          L.DomEvent.on(deskripsi, 'click', function() {
            $("#feature-title").html(feature.properties.NAME);
            $("#feature-info").html(content);
            $("#featureModal").modal("show");
            map.closePopup();
      });
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], highlightStyle));
        }
      });
      $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec3.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      denpasarselatanSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ALAMAT,
        source: "Denpasar Selatan",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
$.getJSON("http://127.0.0.1/pmi/data/DATA_JADWAL.php?posisi=Denpasar Selatan", function (data) {
  denpasarselatans.addData(data);
});

var denpasartimurLayer = L.geoJson(null);
var denpasartimurs = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl: "dist/img/kec4.png",
        iconSize: [24, 28],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
            var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Nama Instansi</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Tanggal Pelaksanaan</th><td>" + feature.properties.WAKTUDANTANGGAL + "</td></tr>" + "<tr><th>Alamat</th><td>" + feature.properties.ALAMAT + "</td></tr>" + "<tr><th>Kecamatan</th><td>" + feature.properties.KECAMATAN + "</td></tr>" + "<tr><th>Link</th><td><a href=" + feature.properties.LINK + " target='_blank'>Link</a></td></tr>" +
              "<table>";
      layer.on({
        click: function (e) {
          var container = L.DomUtil.create('div'),
          deskripsi = createButton('Deskripsi Lokasi', container),
          arahkan = createButton('Menuju Lokasi Ini', container);
  
          L.popup()
              .setContent(container)
              .setLatLng(e.latlng)
              .openOn(map);
      
          L.DomEvent.on(arahkan, 'click', function() {
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
            map.closePopup();
          });
          L.DomEvent.on(deskripsi, 'click', function() {
            $("#feature-title").html(feature.properties.NAME);
            $("#feature-info").html(content);
            $("#featureModal").modal("show");
            map.closePopup();
      });
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], highlightStyle));
        }
      });
      $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="16" height="18" src="dist/img/kec4.png"></td><td class="feature-name">' + layer.feature.properties.NAME + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
      denpasartimurSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ALAMAT,
        source: "Denpasar Timur",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
$.getJSON("http://127.0.0.1/pmi/data/DATA_JADWAL.php?posisi=Denpasar Timur", function (data) {
  denpasartimurs.addData(data);
});

map = L.map("map", {
  zoom: 10,
  center: [40.702222, -73.979378],
  layers: [cartoLight, boroughs, markerClusters, highlight],
  zoomControl: false,
  attributionControl: false


});

/* Layer control listeners that allow for a single markerClusters layer */
map.on("overlayadd", function(e) {
  if (e.layer === denpasarutaraLayer) {
    markerClusters.addLayer(denpasarutaras);
    syncSidebar();
  }

  if (e.layer === denpasarbaratLayer) {
    markerClusters.addLayer(denpasarbarats);
    syncSidebar();
  }

  if (e.layer === denpasarselatanLayer) {
    markerClusters.addLayer(denpasarselatans);
    syncSidebar();
  }

  if (e.layer === denpasartimurLayer) {
    markerClusters.addLayer(denpasartimurs);
    syncSidebar();
  }
});



map.on("overlayremove", function(e) {
  if (e.layer === denpasarbaratLayer) {
    markerClusters.removeLayer(denpasarbarats);
    syncSidebar();
  }

  if (e.layer === denpasarutaraLayer) {
    markerClusters.removeLayer(denpasarutaras);
    syncSidebar();
  }

  if (e.layer === denpasarselatanLayer) {
    markerClusters.removeLayer(denpasarselatans);
    syncSidebar();
  }

  if (e.layer === denpasartimurLayer) {
    markerClusters.removeLayer(denpasartimurs);
    syncSidebar();
  }
});

/* Filter sidebar feature list to only show features in current map bounds */
map.on("moveend", function (e) {
  syncSidebar();
});

function createButton(label, container) {
  var btn = L.DomUtil.create('button', '', container);
  btn.setAttribute('type', 'button');
  btn.setAttribute('class', 'leaflet-button');
  btn.innerHTML = label;
  return btn;
}



/* Clear feature highlight when map is clicked */
map.on("click", function(e) {
  highlight.clearLayers();
  var container = L.DomUtil.create('div'),
        startBtn = createButton('Mulai Dari Lokasi Ini', container),
        destBtn = createButton('Menuju Lokasi Ini', container);

    L.popup()
        .setContent(container)
        .setLatLng(e.latlng)
        .openOn(map);

    L.DomEvent.on(destBtn, 'click', function() {
      control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
      map.closePopup();
    });
    
    L.DomEvent.on(startBtn, 'click', function() {
      control.spliceWaypoints(0, 1, e.latlng);
      map.closePopup();
    });
});

/* Attribution control */
function updateAttribution(e) {
  $.each(map._layers, function(index, layer) {
    if (layer.getAttribution) {
      $("#attribution").html((layer.getAttribution()));
    }
  });
}
map.on("layeradd", updateAttribution);
map.on("layerremove", updateAttribution);

var attributionControl = L.control({
  position: "bottomright"
});
attributionControl.onAdd = function (map) {
  var div = L.DomUtil.create("div", "leaflet-control-attribution");
  div.innerHTML = "<span class='hidden-xs'>Leaflet </span><a href='#' onclick='$(\"#attributionModal\").modal(\"show\"); return false;'>Attribution</a>";
  return div;
};
map.addControl(attributionControl);

var zoomControl = L.control.zoom({
  position: "bottomright"
}).addTo(map);


/* GPS enabled geolocation control set to follow the user's location */
var locateControl = L.control.locate({
  position: "bottomright",
  drawCircle: true,
  follow: true,
  setView: true,
  keepCurrentZoomLevel: true,
  markerStyle: {
    weight: 1,
    opacity: 0.8,
    fillOpacity: 0.8
  },
  circleStyle: {
    weight: 1,
    clickable: true
  },
  icon: "fa fa-location-arrow",
  metric: false,
  strings: {
    title: "My location",
    popup: "You are within {distance} {unit} from this point",
    outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
  },
  locateOptions: {
    maxZoom: 18,
    watch: true,
    enableHighAccuracy: true,
    maximumAge: 10000,
    timeout: 10000
  }
}).addTo(map);


map.locate().on('locationfound', function(e){
  control.spliceWaypoints(0, 1, e.latlng);
})
.on('locationerror', function(e){
  console.log(e);
  alert("Gagal Mendapatkan Lokasi Terkini!.");
});

/* Larger screens get expanded layer control and visible sidebar */
if (document.body.clientWidth <= 767) {
  var isCollapsed = true;
} else {
  var isCollapsed = false;
}

var control = L.Routing.control({
  position: "bottomleft",
  waypoints: [
      L.latLng(-8.676742, 115.186333),
      L.latLng(-8.659603, 115.228813)
  ],
  routeWhileDragging: true,
  geocoder: L.Control.Geocoder.nominatim()
}).addTo(map);

L.Routing.errorControl(control,{
  position: "bottomright"
}).addTo(map);

var groupedOverlays = {
  "Lokasi": {
    "<img src='dist/img/kec3.png' width='16' height='16'>&nbsp;Denpasar Selatan": denpasarselatanLayer,
    "<img src='dist/img/kec4.png' width='16' height='16'>&nbsp;Denpasar Timur": denpasartimurLayer,
    "<img src='dist/img/kec2.png' width='16' height='16'>&nbsp;Denpasar Barat": denpasarbaratLayer,
    "<img src='dist/img/kec1.png' width='16' height='16'>&nbsp;Denpasar Utara": denpasarutaraLayer
  },
};

var layerControl = L.control.groupedLayers("", groupedOverlays, {
  position: "topright",
  collapsed: isCollapsed
}).addTo(map);

/* Highlight search box text on click */
$("#searchbox").click(function () {
  $(this).select();
});

/* Prevent hitting enter from refreshing the page */
$("#searchbox").keypress(function (e) {
  if (e.which == 13) {
    e.preventDefault();
  }
});

$("#featureModal").on("hidden.bs.modal", function (e) {
  $(document).on("mouseout", ".feature-row", clearHighlight);
});

/* Typeahead search functionality */
$(document).one("ajaxStop", function () {
  $("#loading").hide();
  sizeLayerControl();
  /* Fit map to boroughs bounds */
  map.fitBounds(boroughs.getBounds());
  featureList = new List("features", {valueNames: ["feature-name"]});
  featureList.sort("feature-name", {order:"asc"});

  var boroughsBH = new Bloodhound({
    name: "DENPASAR",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: boroughSearch,
    limit: 10
  });

  var denpasarbaratBH = new Bloodhound({
    name: "Denpasar Barat",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: denpasarselatanSearch,
    limit: 10
  });

  var denpasarutaraBH = new Bloodhound({
    name: "Denpasar Utara",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: denpasarselatanSearch,
    limit: 10
  });

  var denpasarselatanBH = new Bloodhound({
    name: "Denpasar Selatan",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: denpasarselatanSearch,
    limit: 10
  });

  var denpasartimurBH = new Bloodhound({
    name: "Denpasar Timur",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: denpasartimurSearch,
    limit: 10
  });

  var geonamesBH = new Bloodhound({
    name: "GeoNames",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: "http://api.geonames.org/searchJSON?username=bootleaf&featureClass=P&maxRows=5&countryCode=UK&name_startsWith=%QUERY",
      filter: function (data) {
        return $.map(data.geonames, function (result) {
          return {
            name: result.name + ", " + result.adminCode1,
            lat: result.lat,
            lng: result.lng,
            source: "GeoNames"
          };
        });
      },
      ajax: {
        beforeSend: function (jqXhr, settings) {
          settings.url += "&east=" + map.getBounds().getEast() + "&west=" + map.getBounds().getWest() + "&north=" + map.getBounds().getNorth() + "&south=" + map.getBounds().getSouth();
          $("#searchicon").removeClass("fa-search").addClass("fa-refresh fa-spin");
        },
        complete: function (jqXHR, status) {
          $('#searchicon').removeClass("fa-refresh fa-spin").addClass("fa-search");
        }
      }
    },
    limit: 10
  });
  boroughsBH.initialize();
  denpasarutaraBH.initialize();
  denpasarbaratBH.initialize();
  denpasarselatanBH.initialize();
  denpasartimurBH.initialize();
  geonamesBH.initialize();

  /* instantiate the typeahead UI */
  $("#searchbox").typeahead({
    minLength: 3,
    highlight: true,
    hint: false
  }, {
    name: "Boroughs",
    displayKey: "name",
    source: boroughsBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'>Boroughs</h4>"
    }
  },  {
    name: "Denpasar Utara",
    displayKey: "name",
    source: denpasarutaraBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='dist/img/kec1.png' width='24' height='28'>&nbsp;Denpasar Selatan</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  },{
    name: "Denpasar Barat",
    displayKey: "name",
    source: denpasarbaratBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='dist/img/kec2.png' width='24' height='28'>&nbsp;Denpasar Selatan</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  }, {
    name: "Denpasar Selatan",
    displayKey: "name",
    source: denpasarselatanBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='dist/img/kec3.png' width='24' height='28'>&nbsp;Denpasar Selatan</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  },{
    name: "Denpasar Timur",
    displayKey: "name",
    source: denpasartimurBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='dist/img/kec4.png' width='24' height='28'>&nbsp;Denpasar Timur</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  }, {
    name: "GeoNames",
    displayKey: "name",
    source: geonamesBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='dist/img/globe.png' width='25' height='25'>&nbsp;GeoNames</h4>"
    }
  }).on("typeahead:selected", function (obj, datum) {
    if (datum.source === "DENPASAR") {
      map.fitBounds(datum.bounds);
    }
    if (datum.source === "Denpasar Utara") {
      if (!map.hasLayer(denpasarutaraLayer)) {
        map.addLayer(denpasarutaraLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "Denpasar Barat") {
      if (!map.hasLayer(denpasarbaratLayer)) {
        map.addLayer(denpasarbaratLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "Denpasar Selatan") {
      if (!map.hasLayer(denpasarselatanLayer)) {
        map.addLayer(denpasarselatanLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "Denpasar Timur") {
      if (!map.hasLayer(denpasartimurLayer)) {
        map.addLayer(denpasartimurLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "GeoNames") {
      map.setView([datum.lat, datum.lng], 14);
    }
    if ($(".navbar-collapse").height() > 50) {
      $(".navbar-collapse").collapse("hide");
    }
  }).on("typeahead:opened", function () {
    $(".navbar-collapse.in").css("max-height", $(document).height() - $(".navbar-header").height());
    $(".navbar-collapse.in").css("height", $(document).height() - $(".navbar-header").height());
  }).on("typeahead:closed", function () {
    $(".navbar-collapse.in").css("max-height", "");
    $(".navbar-collapse.in").css("height", "");
  });
  $(".twitter-typeahead").css("position", "static");
  $(".twitter-typeahead").css("display", "block");
});

// Leaflet patch to make layer control scrollable on touch browsers
var container = $(".leaflet-control-layers")[0];
if (!L.Browser.touch) {
  L.DomEvent
  .disableClickPropagation(container)
  .disableScrollPropagation(container);
} else {
  L.DomEvent.disableClickPropagation(container);
}


