<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $details['title'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 0;
            margin: 0;
        }

        .container-sec {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .btn-view {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .footer-text {
            color: #6c757d;
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }

        .footer-text a {
            color: #007bff;
            text-decoration: none;
        }

        .event-icon {
            color: #333;
            font-size: 80px;
        }

        .welcome-section {
            background: #144fa9db;
            padding: 30px;
            border-radius: 4px;
            color: #fff;
            font-size: 20px;
            margin: 20px 0px;
        }

        .welcome-text {
            font-family: monospace;
        }

        .app-name {
            font-size: 30px;
            font-weight: 800;
            margin: 7px 0px;
        }

        .event-text {
            margin-top: 25px;
            font-size: 25px;
            letter-spacing: 1px;
        }

        i.fas.fa-calendar-alt {
            font-size: 35px !important;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container-sec">
        <div class="text-center">
            <div><i class="fas fa-calendar-alt event-icon"></i></div>
            <div class="welcome-section">
                <div class="app-name">
                    MANAJEMEN EVENT
                </div>
                <div class="welcome-text">
                    {{ $details['title'] }}
                </div>
                <div class="email-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
            </div>
            <h2>Halo, {{ $details['full_name'] }}</h2>
            <p>{{ $details['body'] }}</p>
        </div>
        <div class="footer-text">
            <p>Jika Anda tidak mengharapkan pemberitahuan ini, silakan <a href="#">hubungi kami</a> segera.</p>
            <p>Terima kasih,<br>Tim Manajemen Event</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
