<!DOCTYPE html>
<html>
<head>
    <meta
        charset="utf-8">
    <meta
        name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">body {
            margin: 40px auto;
            max-width: 650px;
            line-height: 1.6;
            font-size: 18px;
            color: #444;
            padding: 0 10px;
            font-family: "Helvetica", "Arial", sans-serif;
        }

        h1, h2, h3 {
            line-height: 1.2
        }</style>
</head>
<body>
<header>
    <p>Please click on the following link to verify your account</p>
    <aside><a href="<?=base_url().'register/confirmpassword/'.$token ?>">Verification Link</a></aside>
</header>

    <script>(function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-46163202-2', 'auto');
        ga('send', 'pageview');</script>
</body>
</html>