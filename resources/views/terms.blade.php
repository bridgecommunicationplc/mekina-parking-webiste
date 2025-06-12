@extends('app')
@section('content')

    <div class="siddhi-cms-pages">
        <div class="container">
            <div class="cms-page pt-5 pb-5">
                <div class="content" id="terms_description"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            bodyTemplate = document.getElementById('terms_description');
            bodyTemplate.innerHTML = '';
            database.collection('settings').doc('global').get().then(async function (snapshots) {
                html = '';
                var data = snapshots.data();
                html = data.termsAndConditions;
                if (html != '') {
                    bodyTemplate.innerHTML = html;
                }
            });
        });

    </script>

@endsection
