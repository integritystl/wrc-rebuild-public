<?php
// ask browsers nicely to allow this page to be in an iframe
header('Content-security-policy: frame-ancestors \'self\' *.authorize.net authorize.net', true);
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>IFrame Communicator</title>

    <!--
     To securely communicate between our Accept Hosted form and your web page,
     we need a communicator page which will be hosted on your site alongside
     your checkout/payment page. You can provide the URL of the communicator
     page in your token request, which will allow Authorize.net to embed the
     communicator page in the payment form, and send JavaScript messaging through
     your communicator page to a listener script on your main page.
     This page contains a JavaScript that listens for events from the payment
     form and passes them to an event listener in the main page.
   -->


    <script type="text/javascript">
        function callParentFunction(str) {
            if (str && str.length > 0 && window.parent && window.parent.parent
                && window.parent.parent.accept && window.parent.parent.accept.onReceiveCommunication)
            {
                var referrer = document.referrer;
                window.parent.parent.accept.onReceiveCommunication({qstr : str , parent : referrer});
            }
        }

        function receiveMessage(event) {
            if (event && event.data) {
                callParentFunction(event.data);
            }
        }

        if (window.addEventListener) {
            window.addEventListener("message", receiveMessage, false);
        } else if (window.attachEvent) {
            window.attachEvent("onmessage", receiveMessage);
        }

        if (window.location.hash && window.location.hash.length > 1) {
            callParentFunction(window.location.hash.substring(1));
        }
    </script>
</head>
<body>
</body>
</html>