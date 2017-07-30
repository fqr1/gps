@extends('baseView')
@section('title', 'map')
@section('content')

    <div>
        <div>
            <div>Ingresa el nombre usuario:</div> <input id="input_user" name="user" type="text">
            <div>Ingresa la fecha de inicio:</div><input id="input_begin" name="begin" type="text">
            <div>Ingresa la fecha de fin:</div><input id="input_end" name="end" type="text">
            <div><button id="send">Enviar</button></div>
        </div>
        <div class="hide" id="map"></div>
    </div>

@endsection
@section('head_script')
    <script>
        $(document).ready(()=>{
            $('#send').click(()=>{

                user = $('#input_user').val();
                start = $('#input_begin').val();
                end = $('#input_end').val();

                data = {
                    user:user,
                    start:start,
                    end:end
                }


                $.get({
                    url: '/api/coordinates/',
                    data: data,
                    success: (data)=>{
                        console.log('sucess data ',data);

                        data = JSON.parse(data);
                        console.log('sucess data coordinates ',data.coordinates);

                        if(data.coordinates){
                            data = data.coordinates;
                            //str = data.lat+','+data.lon+' on '+data.date;
                            //TODO: instead showing the coordinate, paint on google maps
                            //$('#last-coordinate').text(str);
                            $('#map').removeClass('hide');
                            $('#map').addClass('show');

                            initMap(parseCoordinates(data))
                        }


                    }
                });
            });


            function parseCoordinates(data){
                coords = [];
                data.forEach(e=>{
                    c = new Object();
                    c.lat = parseFloat(e.lat);
                    c.lng = parseFloat(e.lon);
                    coords.push(c)
                });

                return coords;
            }

        })
    </script>
    <script>
        function initMap(data = []) {

            originLat = 21.8878406;
            originLon =-102.3030515;

            if(data.length > 0){
                originLat = data[0].lat;
                originLon = data[0].lng;
            }

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: {lat: originLat, lng: originLon},
                mapTypeId: 'terrain'
            });

            var flightPlanCoordinates = data;
            var flightPath = new google.maps.Polyline({
                path: flightPlanCoordinates,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            flightPath.setMap(map);
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw1NAYieikzKLR8p_BI8eBShWDTGEh8Mg&callback=initMap">
    </script>
@endsection

@section('css')
    <style>
        #map {
            width: 100%;
            height: 90%;
            background-color: grey;
        }
        .hide{
            display: none;
        }
        .show{
            display: inline-block;
        }

        .container{
            display: inline-block;
            width: 100%;
        }

    </style>
@endsection