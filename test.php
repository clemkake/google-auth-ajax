
<!DOCTYPE html>
<html>

  <head>

       <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 <script type="text/javascript">
  var merchantId = "";
 var keyap = "AIzaSyBw7Drqw4_j0xWN_6hKcVFU0YfQ-PgxpTU"
      function handleClientLoad() {
        // Loads the client library and the auth2 library together for efficiency.
        // Loading the auth2 library is optional here since `gapi.client.init` function will load
        // it if not already loaded. Loading it upfront can save one network request.
        gapi.load('client:auth2', initClient);
      }

      function initClient() {
        // Initialize the client with API key and People API, and initialize OAuth with an
        // OAuth 2.0 client ID and scopes (space delimited string) to request access.
        gapi.client.init({
            apiKey: keyap,
            discoveryDocs: ["https://www.googleapis.com/discovery/v1/apis/content/v2/rest"],
            clientId: '440936480720-m6o26614ua6g3g3dpb2ppvh4peklidi8.apps.googleusercontent.com',
            scope: 'https://www.googleapis.com/auth/content'
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
        });
      }

      function updateSigninStatus(isSignedIn) {
        // When signin status changes, this function is called.
        // If the signin status is changed to signedIn, we make an API call.
        if (isSignedIn) {
          makeApiCall();
        }
      }

      function handleSignInClick(event) {
        // Ideally the button should only show up after gapi.client.init finishes, so that this
        // handler won't be called before OAuth is initialized.
        gapi.auth2.getAuthInstance().signIn();
      }

      function handleSignOutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }

      function makeApiCall() {
        gapi.client.request({
          'path':"https://www.googleapis.com/content/v2/accounts/authinfo?fields=accountIdentifiers%2Ckind&key="
        }).then(function(response) {
          console.log(response.result.accountIdentifiers[0].merchantId);
           merchantId = response.result.accountIdentifiers[0].merchantId;
           hideForm();
        }, function(reason) {
          console.log('Error: ' + reason.result.error.message);
        });
      }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>

    

 </head>

<body>

<row> 
  <form class="merchant-login">
    <div class="py-5 text-center section-fade-in-out" >
      <div class="container py-5">
        <div class="row">
          <div class="col-md-12">
              <h6>Login Into Merchant Center To Start</h6>
            <button type="button" class="btn btn-success" onclick="handleSignInClick()">LOGIN</button>
          </div>
        </div>
      </div>
    </div>
    </br>
  </form>

  <div class="feed-creation" style="display: none;">
    <!-- Parallax section -->
    <div class="py-5 section-parallax" style="">
      <div class="container my-5 bg-light p-4">
        <div class="row mx-auto">
          <div class="col-md-12" style="">
            <h1 class="mb-3">Feed Creation</h1>
                <label class="alert-info"> Feed Name</label>
   <input type="email" name="email" class="form-control" placeholder="Enter Feed Name" required> 
                <label class="alert-info"> Select country</label>
                    <select class="mb-3  input-group">
                      <option value="volvo">Volvo</option>
                    </select> 
                <label class="alert-info">Language</label>
                    <select class="mb-3  input-group">
                      <option value="volvo">Volvo</option>
                    </select>             <button class="btn btn-lg btn-primary btn-block" id="register">
                      Register</button>
        </div>
      </div>
    </div>
   <div>
  </div>

  <div class="Products-listing" style="display: none;">
    <div class="py-5 section-parallax" style="">
      <div class="container my-5 bg-light p-4">
        <div class="row mx-auto">
          <div class="col-md-12" style="">
            <h1 class="mb-3">Select products</h1>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div  class="Feed-List" style="display: none;">
    <div class="py-5 section-parallax" style="">
      <div class="container my-5 bg-light p-4">
        <div class="row mx-auto">
          <div class="col-md-12" style="">
            <h1 class="mb-3">Feeds List</h1>
            
          </div>
        </div>
      </div>
    </div>
  </div> 
</row>


<script>
  var Products_list = "";

  console.log('Plugin initialized');
  var request;
  try {
    request = new XMLHttpRequest();
    console.log('Request Ready');
  } catch (tryMicrosoft) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (otherMicrosoft) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = null;
      }
    }
  }


  function generateFeed() {
    var url = "process.php";
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        var return_data = request.responseText;
        Products_list = return_data;
        console.log('feed saved');

      }
    }
    request.send();
  }

  function createFeed() {
    var url = "https://www.googleapis.com/content/v2/merchantId/products";
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        var return_data = request.responseText;
        Products_list = return_data;
        console.log('feed saved');
      }
    }
    request.send();
  }

  function postFeed() {
    generateFeed();
    gapi.client.request({
      'path': "https://www.googleapis.com/content/v2/" + merchantId + "/products?alt=json",
      'destination': Products_list,
    }).then(function(response) {
      console.log('Hello, ' + response.result.names[0].givenName);
    }, function(reason) {
      console.log('Error: ' + reason.result.error.message);
    });
  }

  function getFeedList() {
    var url = "https://www.googleapis.com/content/v2/merchantId/products";
    request.open("GET", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        var return_data = request.responseText;
        result = return_data;
      }
    }
    request.send();
  }


  function hideForm() {
    jQuery('.merchant-login').css('display', 'none');
    jQuery('.feed-creation').css('display', 'block');
  }

  jQuery('#register').click(function() {
    jQuery('.feed-creation').css('display','none');
     jQuery('.Products-listing').css('display','block');
    generateFeed();
  })</script>

  <row>
   <footer class="text-md-left text-center p-4 bg-dark text-light">
    <div class="row">
      <div class="col-md-12">
        <p class="text-muted">© Copyright 2018 Pingendo - All rights reserved. </p>
      </div>
    </div>
   </footer></row>

</body>

</html>