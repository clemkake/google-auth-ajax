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


      function generateFeed(choice) {
        var url = "process.php?choice="+choice;
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
            products_list = return_data;
            console.log('feed saved');
          }
        }
        request.send();
      }

      function postFeed() {
        generateFeed(true);
        gapi.client.request({
          'path': "https://www.googleapis.com/content/v2/",
           'method': POST,
           'params':[{
               'merchantId' = mcid,
               'resources' = 'product'
           }],
          'body': [Products_list],
        }).then(function(response) {
          console.log(response);
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
        jQuery('.feed-creation').css('display', 'none');
        jQuery('.Products-listing').css('display', 'block');
        generateFeed(false);
        jQuery('.media-list').html(Products_list);

      })

console.log('loaded');