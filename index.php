<?php 
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Animated marker with Google Maps using PHP-MySQL</title>

<style>
html{height:100%;}
body{height:100%;margin:0px;font-family: Helvetica,Arial;}
</style>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script type ="text/javascript" src="http://www.geocodezip.com/scripts/v3_epoly.js"></script>
<script type="text/javascript">
  
  var map;
  var directionDisplay;
  var directionsService;
  var stepDisplay;
 
  var position;
  var marker = [];
  var polyline = [];
  var poly2 = [];
  var poly = null;
  var startLocation = [];
  var endLocation = [];
  var timerHandle = [];
    
  
  //var speed = 0.000005, wait = 1;
  var infowindow = null;
  
  var myPano;   
  var panoClient;
  var nextPanoId;
  	   var startLoc = new Array();
	   var endLoc = new Array();
<?php
       $query = "SELECT * FROM markers";
       $map1 = $db1->prepare($query);
       $map1->execute();
       $res1 = $map1->get_result();
	   	 $brs=0;
       while ($row = $res1->fetch_assoc()) { 
	       $id = $row['id'];
		   if ($id == 1) {
	   	     $dist1 = $row['dist'];
		   }
		   if ($id == 2) {
	   	     $dist2 = $row['dist'];
		   }	
		   if ($id == 3) {
	   	     $dist3 = $row['dist'];
		   }	
		   if ($id == 4) {
	   	     $dist4 = $row['dist'];
		   }		   
       ?>
        startLoc[<?php echo $brs; ?>] = '<?php echo $row['area1'].", ".$row['city1']?>';
		endLoc[<?php echo $brs; ?>] = '<?php echo $row['area2'].", ".$row['city2']?>';
	  <?php 
	  $brs++; }  
	  ?>
//  var startLoc = new Array();
//  startLoc[0] = 'pluit, jakarta'; 
//  startLoc[1] = 'marunda, jakarta'; 
//  startLoc[2] = 'bintaro, jakarta';
//  startLoc[3] = 'bekasi, jakarta';

//  var endLoc = new Array();
//  endLoc[0] = 'cililitan, jakarta';
//  endLoc[1] = 'cileduk, jakarta';
//  endLoc[2] = 'sunter, jakarta';
//  endLoc[3] = 'kalideres, jakarta'; 


  var Colors = ["#FF0000", "#00FF00", "#0000FF"];


function initialize() {  

  infowindow = new google.maps.InfoWindow(
    { 
      size: new google.maps.Size(150,50)
    });

// location : Jakarta, Indonesia
//    var myLatlng = new google.maps.LatLng(-6.175110, 106.865036);
<?php
       $query = "SELECT * FROM markers WHERE id = 1";
       $map1 = $db1->prepare($query);
       $map1->execute();
       $res1 = $map1->get_result();
	   	 $brs=0;
       while ($row = $res1->fetch_assoc()) { 
       ?>
        var myLatlng = {lat: <?php echo $row['lat'];?>, lng: <?php echo $row['lng'];?>};
	   <?php } ?>
    var myOptions = {
      zoom: 10,
	  center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    address = 'DKI Jakarta'
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
     map.fitBounds(results[0].geometry.viewport);

    }); 
  // setRoutes();
  } 


function createMarker(latlng, label, html, color) {
// alert("createMarker("+latlng+","+label+","+html+","+color+")");
   if ( color == '0' ) {
    var contentString = '<b>'+label+'</b><br>'+html+'<br>'+'<b>'+'distance = '+'</b>'+<?php echo $dist1; ?> + ' km';
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: label,
		icon: 'blue_MarkerB.png',
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        marker.myname = label;


    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    return marker; 
 }
 
   if ( color == '1' ) {
    var contentString = '<b>'+label+'</b><br>'+html+'<br>'+'<b>'+'distance = '+'</b>'+<?php echo $dist2; ?> + ' km';
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: label,
		icon: 'darkgreen_MarkerA.png',
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        marker.myname = label;


    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    return marker; 
 } 

   if ( color == '2' ) {
    var contentString = '<b>'+label+'</b><br>'+html+'<br>'+'<b>'+'distance = '+'</b>'+<?php echo $dist3; ?> + ' km';
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: label,
		icon: 'red_MarkerD.png',
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        marker.myname = label;


    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    return marker; 
 } 

   if ( color == '3' ) {
    var contentString = '<b>'+label+'</b><br>'+html+'<br>'+'<b>'+'distance = '+'</b>'+<?php echo $dist4; ?> + ' km';
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: label,
		icon: 'yellow_MarkerC.png',
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        marker.myname = label;


    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    return marker; 
 } 
 
}


function setRoutes(){   

    var directionsDisplay = new Array();

    for (var i=0; i< startLoc.length; i++){

    var rendererOptions = {
        map: map,
        suppressMarkers : true,
        preserveViewport: true
    }
    directionsService = new google.maps.DirectionsService();

    var travelMode = google.maps.DirectionsTravelMode.DRIVING;  

    var request = {
        origin: startLoc[i],
        destination: endLoc[i],
        travelMode: travelMode
    };  

        directionsService.route(request,makeRouteCallback(i,directionsDisplay[i]));

    }   


    function makeRouteCallback(routeNum,disp){
        if (polyline[routeNum] && (polyline[routeNum].getMap() != null)) {
         startAnimation(routeNum);
         return;
        }
        return function(response, status){
          
          if (status == google.maps.DirectionsStatus.OK){

            var bounds = new google.maps.LatLngBounds();
            var route = response.routes[0];
            startLocation[routeNum] = new Object();
            endLocation[routeNum] = new Object();


            polyline[routeNum] = new google.maps.Polyline({
            path: [],
            strokeColor: '#FFFF00',
            strokeWeight: 3
            });

            poly2[routeNum] = new google.maps.Polyline({
            path: [],
            strokeColor: '#FFFF00',
            strokeWeight: 3
            });     


            // For each route, display summary information.
            var path = response.routes[0].overview_path;
            var legs = response.routes[0].legs;


            disp = new google.maps.DirectionsRenderer(rendererOptions);     
            disp.setMap(map);
            disp.setDirections(response);


            //Markers               
            for (i=0;i<legs.length;i++) {
              if (i == 0) { 	
                if (routeNum == 0) {			  
                startLocation[routeNum].latlng = legs[i].start_location;
                startLocation[routeNum].address = legs[i].start_address;
                // marker = google.maps.Marker({map:map,position: startLocation.latlng});				
                marker[routeNum] = createMarker(legs[i].start_location,"","<b>" + "From: " + "</b>" + legs[i].start_address + "<br>"  + "<b>"  +" To: " + "</b>" +legs[i].end_address, "0");            			   
                }
				
                if (routeNum == 1) {			  
                startLocation[routeNum].latlng = legs[i].start_location;
                startLocation[routeNum].address = legs[i].start_address;
                // marker = google.maps.Marker({map:map,position: startLocation.latlng});
                marker[routeNum] = createMarker(legs[i].start_location,"","<b>" + "From: " + "</b>" + legs[i].start_address + "<br>"  + "<b>"  +" To: " + "</b>" +legs[i].end_address, "1");            			   
                }

                if (routeNum == 2) {			  
                startLocation[routeNum].latlng = legs[i].start_location;
                startLocation[routeNum].address = legs[i].start_address;
                // marker = google.maps.Marker({map:map,position: startLocation.latlng});
                marker[routeNum] = createMarker(legs[i].start_location,"","<b>" + "From: " + "</b>" + legs[i].start_address + "<br>"  + "<b>"  +" To: " + "</b>" +legs[i].end_address, "2");            			   
                }

                if (routeNum == 3) {			  
                startLocation[routeNum].latlng = legs[i].start_location;
                startLocation[routeNum].address = legs[i].start_address;
                // marker = google.maps.Marker({map:map,position: startLocation.latlng});
                marker[routeNum] = createMarker(legs[i].start_location,"","<b>" + "From: " + "</b>" + legs[i].start_address + "<br>"  + "<b>"  +" To: " + "</b>" +legs[i].end_address, "3");            			   
                }

			   }			  
              endLocation[routeNum].latlng = legs[i].end_location;
              endLocation[routeNum].address = legs[i].end_address;
			//  marker[routeNum] = createMarker(legs[i].end_location,"end",legs[i].end_address,"blue");
			  
              var steps = legs[i].steps;

              for (j=0;j<steps.length;j++) {
                var nextSegment = steps[j].path;                
                var nextSegment = steps[j].path;

                for (k=0;k<nextSegment.length;k += 2) {
                    polyline[routeNum].getPath().push(nextSegment[k]);
                    //bounds.extend(nextSegment[k]);
                }

              }
            }

         }       

         polyline[routeNum].setMap(map);
         //map.fitBounds(bounds);
         startAnimation(routeNum);  

    } // else alert("Directions request failed: "+status);

  }

}

    var lastVertex = 1;
    var stepnum = 0;
    var step = 50; // 5; // metres
    var tick = 50; // milliseconds --> adjust step speed marker 
    var eol= [];
//----------------------------------------------------------------------                
 function updatePoly(i,d) {
 // Spawn a new polyline every 20 vertices, because updating a 100-vertex poly is too slow
    if (poly2[i].getPath().getLength() > 20) {
          poly2[i]=new google.maps.Polyline([polyline[i].getPath().getAt(lastVertex-1)]);
          // map.addOverlay(poly2)
        }

    if (polyline[i].GetIndexAtDistance(d) < lastVertex+2) {
        if (poly2[i].getPath().getLength()>1) {
            poly2[i].getPath().removeAt(poly2[i].getPath().getLength()-1)
        }
            poly2[i].getPath().insertAt(poly2[i].getPath().getLength(),polyline[i].GetPointAtDistance(d));
    } else {
        poly2[i].getPath().insertAt(poly2[i].getPath().getLength(),endLocation[i].latlng);
    }
 }
//----------------------------------------------------------------------------

function animate(index,d) {
   if (d>eol[index]) {

      marker[index].setPosition(endLocation[index].latlng);
      return;
   }
    var p = polyline[index].GetPointAtDistance(d);

    //map.panTo(p);
    marker[index].setPosition(p);
    updatePoly(index,d);
    timerHandle[index] = setTimeout("animate("+index+","+(d+step)+")", tick);
}

//-------------------------------------------------------------------------

function startAnimation(index) {
        if (timerHandle[index]) clearTimeout(timerHandle[index]);
        eol[index]=polyline[index].Distance();
        map.setCenter(polyline[index].getPath().getAt(0));

        poly2[index] = new google.maps.Polyline({path: [polyline[index].getPath().getAt(0)], strokeColor:"#FFFF00", strokeWeight:3});

        timerHandle[index] = setTimeout("animate("+index+",50)",2000);  // Allow time for the initial map display
}

//----------------------------------------------------------------------------    



</script>
</head>
<body onload="initialize()">

<div id="tools">

    <button onclick="setRoutes();">Start</button>

</div>

<div id="map_canvas" style="width:100%;height:100%;"></div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-162157-1";
urchinTracker();
</script>
</body>
</html>