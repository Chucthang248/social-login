<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Login linkedin</title>

</head>
<body>
    <div id="loginContainer">
        <a href='#' onClick='login(event);'>Click here to login</a>
    </div>
    <script>
        var client_id = "78ifr7gvptfljx";
        var client_secret = "7Xx3hx6CMuGdkajb";
        var redirect_uri = "http://localhost:21352/login_linkedin.php"; // pass redirect_uri here
        var scope = "r_liteprofile r_emailaddress"; // permissions required by end-user
        var win;
        
        function login(e) {
            e.preventDefault();
        
            if(!sessionStorage.inState) {
                sessionStorage.inState = inState = Math.floor(Math.random()*90000) + 10000;
            } else {
                inState = sessionStorage.inState;
            }
            var url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id="+client_id+"&redirect_uri="+redirect_uri+"&scope="+scope+"&state="+inState;
        
            win = window.open(encodeURI(url), "LinkedIn Login", 'width=800, height=600, left=300, top=100');
        }
        
        var cur_url = new URL(window.location.href);
        var urlParams = new URLSearchParams(cur_url.search);
        
        if(urlParams.has('state') && (sessionStorage.inState == urlParams.get('state'))) {
        
            if(urlParams.has('code')) {
                document.getElementById("loginContainer").innerHTML = "Logging you in...";
        
                var code = urlParams.get('code');
                var state = urlParams.get('state');
                //console.log(code);
                $.ajax({
                    type: "POST",
                    url: "http://localhost:21152/api/candidate/login_linkedin",
                    headers: {  'Access-Control-Allow-Origin': '*' },
                    data: {code: code},
                    success: function (res) {
                        console.log(res);
                    }
                });
                
            } else if(urlParams.has('error') && urlParams.has('error_description')) {
                // close window
                parent.close();
            }
        }
    </script>
</body>
</html>

 
