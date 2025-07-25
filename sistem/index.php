<?php
header("X-Robots-Tag: noindex, nofollow, noarchive", true);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">
    <title>TRACED</title>
    <style>
        :root {
            --background-start: #1a2a6c;
            --background-mid: #b21f1f;
            --background-end: #fdbb2d;
            --card-background: rgba(255, 255, 255, 0.9);
            --text-color: #333;
            --title-color: #d9534f;
            --shadow-color: rgba(0, 0, 0, 0.2);
            --link-color: #007bff;
        }

        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--text-color);
            background: linear-gradient(-45deg, var(--background-start), var(--background-mid), var(--background-end));
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        .seal-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-bottom: 2rem;
        }

        .seal {
            max-width: 100px;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        .main-card {
            background-color: var(--card-background);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 25px var(--shadow-color);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .title {
            font-size: 2.5rem;
            color: var(--title-color);
            margin-top: 0;
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .law-text {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .info-links p {
            margin: 0.5rem 0;
        }

        .info-links a {
            color: var(--link-color);
            text-decoration: none;
            font-weight: 600;
        }

        .info-links a:hover {
            text-decoration: underline;
        }
        
        footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: white;
            opacity: 0.8;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .title {
                font-size: 2rem;
            }
            .seal-container {
                gap: 20px;
            }
            .seal {
                max-width: 80px;
            }
        }
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            .main-card {
                padding: 1.5rem;
            }
            .title {
                font-size: 1.8rem;
            }
            .law-text {
                font-size: 1rem;
            }
            .seal-container {
                flex-direction: column;
                gap: 15px;
            }
            .seal {
                max-width: 100px;
            }
        }
    </style>
</head>
<body>

    <main class="container" role="main">
        <div class="seal-container">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0f/Logo_BSSN_new.png" class="seal" alt="Logo BSSN">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/Logo_Bareskrim_Polri.png" class="seal" alt="Logo Bareskrim Polri">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Logo_Kementerian_Komunikasi_dan_Digital_Republik_Indonesia_%282024_full_version%29.svg/330px-Logo_Kementerian_Komunikasi_dan_Digital_Republik_Indonesia_%282024_full_version%29.svg.png" class="seal" alt="Logo Bareskrim Polri">
        </div>

        <div class="main-card">
            <h1 class="title">This Page Has Detected a Policy Violation</h1>
            <p class="law-text">
                Berdasarkan <b>Pasal 27 Ayat (2) UU ITE 2024</b> dan <b>Pasal 378 KUHP</b>.
            </p>
            <div class="info-links">
                <p>Informasi lebih lanjut:</p>
                <p><a href="https://www.bssn.go.id" target="_blank" rel="noopener noreferrer">Badan Siber dan Sandi Negara (BSSN)</a></p>
                <p><a href="https://www.komdigi.go.id/" target="_blank" rel="noopener noreferrer">Kementerian Komunikasi dan Digital (Komdigi)</a></p>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Republic of Indonesia. All rights reserved.</p>
    </footer>

</body>
</html>
