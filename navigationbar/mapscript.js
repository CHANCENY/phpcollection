function loadMap() {
    var mapOptions={
        center:new google.maps.LatLng(17.240498, 82.287598),zoom:12,mapTypeId:google.maps.MapTypeId.ROADMAP
       };
      var map = new google.maps.Map(document.getElementById("maploader"),mapOptions);
    }
      google.maps.event.addDomListener(window,'load',loadMap);
