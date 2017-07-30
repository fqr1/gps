@extends('baseView')
@section('title', 'Last coordinate')
@section('content')
    Ingresa el nombre usuario:<input id="input_user" name="user" type="text"><br>
    <button id="send">Enviar</button><br><br>
    <div id="last-coordinate"></div>
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
                        }


                    }
                });
            });
        })
    </script>
@endsection