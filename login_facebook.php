<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facebook Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-offset-3" align="center">
                <form>
                    <input class="form-control" placeholder="Email..."><br>
                    <input class="form-control" placeholder="Password..."><br>
                    <input type="submit" value="Log In">
                    <input type="button" onclick="logIn()" value="Log In With Facebook">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var person = { userID: "", name: "", accessToken: "", picture: "", email: ""};

        function logIn() {
            FB.login(function (response) {
                if (response.status == "connected") {
                    person.user_id = response.authResponse.userID;
                    person.access_token = response.authResponse.accessToken;

                    FB.api('/me?fields=id,name,email,picture.type(large)', function (userData) {
                        person.name = userData.name;
                        person.email = userData.email;
                        person.picture = userData.picture.data.url;

                        $.ajax({
                           url: "http://localhost:21152/api/candidate/login_facebook",
                           method: "POST",
                           data: person,
                           dataType: 'JSON',
                           success: function (serverResponse) {
                               debugger;
                               console.log(serverResponse);
                               //if (serverResponse == "success")
                                   //window.location = "index.php";
                           }
                        });
                    });
                }
            }, {scope: 'public_profile, email'})
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId            : '592240992622181',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v2.11'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>