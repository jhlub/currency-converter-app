<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex"/>

        <title>Currencies Converter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Fav Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

        <link href="/css/app.css" rel="stylesheet">

        <script src="/js/app.js" async></script>

    </head>
    <body>
        <header class="st-header">
            <h2 class="header-title">Currencies Converter</h2>
        </header>
        <main class="st-main">
            <section class="currencies-converter-section">
                <div class="flex-center position-ref full-height">
                    <div class="content">
                        <div class="title m-b-md">
                            <h1 class="title">Calculate Currencies:</h1>
                            <div class="currency-calc-form-container loading">
                                <p class="error-text">Only numbers and dots are allowed!</p>
                                <div class="loader-v1"><div></div><div></div><div></div></div>
                                <form class="currency-calc-form" method="GET" action="/api/v1/convert">
                                    <div class="cur-box">
                                        <label class="st-label" for="pln-sgd">PLN</label>
                                        <input name="pln-sgd" data-currency-symbol="PLN" type="text" placeholder="Type value">
                                    </div>

                                    <div class="cur-box">
                                        <label class="st-label" for="sgd-pln">SGD</label>
                                        <input name="sgd-pln" data-currency-symbol="SGD" type="text" placeholder="Type value">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="st-footer">
            <h4 class="footer-title">Created by Jakub Hlubiński</h4>
        </footer>
    </body>
</html>
