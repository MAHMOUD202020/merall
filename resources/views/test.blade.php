<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('8d0f6c8f269bd854fe16', {
            cluster: 'mt1',
            encrypted: true
        });

        var channel = pusher.subscribe('mohamed-channel');
        channel.bind('mohamed-event', function(data) {

            console.log(data)

        });
    </script>
</head>
<body>
<h1>Pusher Test</h1>
<p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
</p>
</body>
