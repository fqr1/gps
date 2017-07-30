@extends('baseView')
@section('title', 'Last coordinate')
@section('content')
    Ingresa el nombre usuario:<input id="input_user" name="user" type="text"><br>
    <button id="send">Enviar</button><br><br>
    <div id="last-coordinate"></div>
    <div style="display: none" id="map"></div>

@endsection
@section('head_script')
    <script>
        $(document).ready(()=>{
            $('#send').click(()=>{
                val = $('#input_user').val();
                console.log('val',val);
                $.get({
                    url: '/api/coordinates/last/',
                    data: {user: val},
                    success: (data)=>{

                        console.log('sucess data ',data);
                        data = JSON.parse(data);
                        console.log('sucess data last coordinate ',data.last_coordinate);

                        if(data.last_coordinate){
                            data = data.last_coordinate;
                            str = data.lat+','+data.lon;
                            //TODO: instead showing the coordinate, paint on google maps
                            $('#last-coordinate').text(str);
                            $('#map').show();
                            initMap(data.lat, data.lon)
                        }


                    }
                });
            });


            function paintOnGoogleMaps(lat, lon){
                //key = 'AIzaSyBw1NAYieikzKLR8p_BI8eBShWDTGEh8Mg'
            }


        })
    </script>
    <script>
        function initMap(lat = 0, lon=0) {
            lat = parseFloat(lat)
            lon = parseFloat(lon)

            var uluru = {lat: lat, lng: lon};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
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
        height: 400px;
        background-color: grey;
    }
</style>
@endsection