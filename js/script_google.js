var googleUser = {};
var startApp = function() {
  gapi.load('auth2', function(){
    // Retrieve the singleton for the GoogleAuth library and set up the client.
    auth2 = gapi.auth2.init({
      client_id: '37624650937-13nifg7botn2fa6977r8khipkptu453l.apps.googleusercontent.com',
      cookiepolicy: 'single_host_origin',
      // Request scopes in addition to 'profile' and 'email'
      //scope: 'additional_scope'
    });
    attachSignin(document.getElementById('login_gg'));
  });
};

function attachSignin(element) {
  auth2.attachClickHandler(element, {},
      function(googleUser) {
          var profile = googleUser.getBasicProfile();
          // console.log(profile);
          $gg_id = profile.getId();
          $gg_name = profile.getName();
          $gg_img = profile.getImageUrl();
          $gg_email = profile.getEmail();
          $.ajax({
              type: "POST",
              data: {'id':$gg_id,'name':$gg_name,'img':$gg_img,'mail':$gg_email},
              url: 'ajax/login_social.php',
              success: function(msg){
                
                window.location.href='index.html';
                return false;
                // if(msg.error== 1){
                //   console.log('Something Went Wrong!');
                // }else{
                //   window.location.href='';
                //   return false;
                // }
              }
          });
      }, function(error) {
        console.log(JSON.stringify(error, undefined, 2));
      });
}