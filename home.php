<?php
  session_start(); //starts the session
  if($_SESSION['email']){ // checks if the user is logged in 
    $email = $_SESSION['email']; //assigns email value
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
  }
  else{
    header("location: index.php"); // redirects if user is not logged in
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Custom CSS -->
    <style type="text/css">
      html, body, #map-canvas { 
        height: 100%; 
        width: 100%; 
        margin: 0; 
        padding: 5px;
      }

      #map-canvas{        
        border: solid Gray 1px;
        border-radius: 2px;
      }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> 
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">     
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBijJW7Sza7_8F5mlobNi9j7kWf3lCGY_A"></script>
    <!-- Custom Javascript -->
    <script type="text/javascript">
      // Map Initialization
      function initialize() {
        var mapOptions = {
          center: { lat: 1.2940397, lng: 103.8369427},
          zoom: 5
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var markers = [
          ['Rawa Island, Malaysia - Mai 2015', 2.518531,103.975951,2],
          ['Bintan Island, Indonesia - January 2015', 1.185849, 104.576009,2],
          ['Bako National Park, Kuching, Malaysia - June 2015', 1.716358, 110.467299,2],
          ['Fairy Caves, Kuching, Malaysia - June 2015', 1.381751, 110.117173,2],
          ['Wind Caves, Kuching, Malaysia - June 2015', 1.414957, 110.135552,2],
          ['Palau Ubin, Singapore - Mai 2015', 1.413136, 103.957969,2],
          ['Phuket, Thailand - Juillet 2015', 7.896701, 98.295528,1]
        ];
        for (i = 0; i < markers.length; i++) { 
          if(markers[i][3] == 2) {
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(markers[i][1], markers[i][2]),
              map: map,
              title: markers[i][0],
              icon: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Chartreuse-icon.png'
            });
          }
          else if(markers[i][3] == 1){
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(markers[i][1], markers[i][2]),
              map: map,
              title: markers[i][0],
              icon: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Azure-icon.png'
            });
          }
        }

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <?php
      include_once 'searchbar.php';
    ?>
    <div id="map-canvas"></div>
  </body>
</html>