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
            console.log('feed generated');
          }
        }
        request.send();
      }

      function createFeed() {
        
      }

      function postFeed() {
        gapi.client.request({
          'path': "https://www.googleapis.com/content/v2/"+mcid+"/products",
           'method': 'POST',
           'params':[{
               'merchantId':mcid,
               'resources':'products'
           }],
          'body': JSON.parse(Products_list.trim()),
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
       generateFeed(false);
      }

      jQuery('#register').click(function() {
        jQuery('.feed-creation').css('display', 'none');
        jQuery('.Products-listing').css('display', 'block');
      })
      jQuery('#feed-publish').click(function(){
        postFeed();
      })

console.log('loaded');
var timer = setInterval(function(){
    if(jQuery('.media-list').length > 0 && jQuery('.media-list').is(':visible') ){
          jQuery('.media-list').html(Products_list);
      clearInterval(timer);
      } 
},500)