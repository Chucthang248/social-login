<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-signin-client_id" content="519093123816-i8lg5e5tenlgpkdjva2o8kb7pm5ijttq.apps.googleusercontent.com">
    <title>Google Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-offset-3" align="center">
                <form>
                <div id="g_id_onload"
                    data-client_id="519093123816-i8lg5e5tenlgpkdjva2o8kb7pm5ijttq"
                    data-callback="handleCredentialResponse"
                    data-auto_prompt="false">
                </div>
                <div class="g_id_signin"
                    data-type="standard"
                    data-size="large"
                    data-theme="outline"
                    data-text="sign_in_with"
                    data-shape="rectangular"
                    data-logo_alignment="left">
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://accounts.google.com/gsi/client" async defer></script>
      <script>
        function handleCredentialResponse(response) {
            
            $.ajax({
                url: "http://localhost:21152/api/candidate/login_google",
                method: "POST",
                data: {access_token: response.credential},
                dataType: 'JSON',
                success: function (serverResponse) {
                    debugger;
                    console.log(serverResponse);
                    //if (serverResponse == "success")
                        //window.location = "index.php";
                }
            });
        }
        window.onload = function () {
          google.accounts.id.initialize({
            client_id: "519093123816-i8lg5e5tenlgpkdjva2o8kb7pm5ijttq",
            callback: handleCredentialResponse
          });
          
          google.accounts.id.prompt(); // also display the One Tap dialog
        }
    </script>
    <div id="buttonDiv"></div> 
</body>

</html>