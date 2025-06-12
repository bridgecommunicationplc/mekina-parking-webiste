@extends('app')

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            bodyTemplate = document.getElementById('body-template');
            bodyTemplate.innerHTML = '';
            database.collection('settings').doc('landingPageTemplate').get().then(async function (snapshots) {
                html = '';
                var data = snapshots.data();
                html = data.landingPageTemplate;
                if (html != '') {
                    bodyTemplate.innerHTML = html;
                }
            });

        });

        function addContact() {
            jQuery("#overlay").show();
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var message = $('#message').val();
            if (name == '') {
                alert('Please enter your name!');
            } else if (email == '') {
                alert('Please enter your email!');

            } else if (phone == '') {
                alert('Please enter your phone!');

            } else if (message == '') {
                alert('Please enter your message!');

            } else {
                tempId = database.collection("tmp").doc().id;
                var createdAt = firebase.firestore.Timestamp.fromDate(new Date());
                database.collection('inquiry').doc(tempId).set({
                    'id': tempId,
                    'name': name,
                    'email': email,
                    'message': message,
                    'phone': phone,
                    'createdAt': createdAt
                }).then(function (result) {
                    var url = "{{url('send-email')}}";
                    var subject = '{{trans("lang.new_customer_inquiry")}}';
                    var recipients = $('.contact-email').attr('href');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            subject: subject,
                            message: message,
                            recipients: recipients
                        },
                        url: url,
                        success: function (data) {
                            jQuery("#overlay").hide();
                            alert('{{trans("lang.thankyou_for_contacting_us")}}');
                            window.location.reload();
                        },
                    });

                });
            }
        }

    </script>

@endsection
