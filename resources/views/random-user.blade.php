<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>random lottery</title>
</head>

<body>
    <div class="container">
        <style>
            .container {
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .btn {
                padding: .5em;
                width: 200px;
                margin: .5em;
            }
        </style>
        <h1 id="names"></h1>
        <div style="display: flex;">
            <button id="btn-end" class="btn">Stop</button>
            <button id="btn-start" class="btn">Start random lottery </button>
            
        </div>
    </div>

    <script>
        function getUsers() {
            var xhr = new XMLHttpRequest();
            var method = "GET";
            var url = "{{ route('random.user') }}";
            var users;
            xhr.open(method, url, false);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    users = JSON.parse(xhr.responseText);
                }
            };
            xhr.send();
            return users;
        } //Get users from database
        function getRandomArbitrary(min, max) {
            return Math.floor(Math.random() * (max - min) + min);
        } //Get random number between min & max
        var users = getUsers(); //users
        var interval = null; //init interval
        document.querySelector('#btn-end').addEventListener('click', function() {
            end();
        }); //end random
        document.querySelector('#btn-start').addEventListener('click', function() {
            start();
        }); //begin random
        function end(){
            clearInterval(interval); //stop interval
        } //end random
        function start() {
            interval = setInterval(function() {
                var n = getRandomArbitrary(0, users.length);
                document.querySelector('#names').innerText = users[n]['name'];
            }, 10);
        } //begin random
    </script>
</body>

</html>
