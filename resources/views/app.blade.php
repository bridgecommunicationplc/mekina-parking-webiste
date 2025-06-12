<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('img/fav.png')}}">
    <title>{{ config('app.name','Park Me - Your Parking, Your Way') }}</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">
</head>

<body class="fixed-bottom-bar">


<div id="header-template"></div>

<main id="body-template">
    @yield('content')
    <div id="overlay" style="display:none">
        <img src="{{ asset('img/spinner.gif') }}">
    </div>

</main>

<div id="footer-template"></div>

<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script src="{{ asset('js/crypto-js.js') }}"></script>
<script src="{{ asset('js/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script type="text/javascript">

    var database = firebase.firestore();

    var headerRef = database.collection('settings').doc('headerTemplate');
    var footerRef = database.collection('settings').doc('footerTemplate');

    $(document).ready(function () {

        jQuery("#data-table_processing").show();

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        header = document.getElementById('header-template');
        header.innerHTML = '';
        headerRef.get().then(async function (snapshots) {
            html = '';
            var data = snapshots.data();
            html = data.headerTemplate;
            if (html != '') {
                header.innerHTML = html;
            }
        });

        footer = document.getElementById('footer-template');
        footer.innerHTML = '';

        footerRef.get().then(async function (snapshots) {
            html = '';
            var data = snapshots.data();
            html = data.footerTemplate;
            if (html != '') {
                footer.innerHTML = html;
            }
            jQuery("#data-table_processing").hide();
        });

        database.collection('settings').doc('contact_us').get().then(async function (snapshots) {
            var data = snapshots.data();
            setTimeout(() => {
                $('.contact-address').text(data.address);
                $('.contact-phone').attr('href', 'tel:' + data.phone).text(data.phone);
                $('.contact-email').attr('href', 'mailto:' + data.email).text(data.email);

            }, 3000);

        });


    });

</script>

@yield('scripts')

</body>

</html>
