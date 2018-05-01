  /* Key validation for User First Name*/

    function userFirstNameKey(e){
     var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

  /* Key validation for User Last Name*/
  function userLastNameKey(e){
   var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

  /* Key validation for User Middle Name*/
  function userMiddleNameKey(e){
    var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

    function isEmailKey(e){
    var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((charCode >= 97 && charCode <= 122) || (charCode >= 65 && charCode <= 90) || charCode == 8 || charCode == 46 || charCode == 9 || (charCode >= 48 && charCode <= 57) || charCode == 64 || (e.shiftKey == false && charCode == 37) || (e.which == 0  && charCode == 39) || (e.shiftKey == false && charCode == 36) || (charCode == 39) || (e.shiftKey == false && charCode == 35) || (e.shiftKey == true && charCode == 95) || (e.shiftKey == false && charCode == 45)){
           return true;
      }else{
           return false;
      }
  }


  /* Key validation for Street1 */
function street1Key(e){
    var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

/* Key validation for  Street2 */
function street2Key(e){
    var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }
/* Key validation for  Area */
function areaKey(e){
    var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

/* Key validation  City */
 function cityKey(e){
    var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

/* Key validation for  State */
  function stateKey(e){
    var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

 /* Key validation for Zipcode */ 
  function zipCodeKey(e){
  var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }

   /* Key validation for contact number */ 
  function contactNoKey(e){
  var charCode = (e.which) ? e.which : e.keyCode;
      //alert(charCode);
      if ((e.shiftKey == true && charCode == 60) || (e.shiftKey == true && charCode == 62) || (e.shiftKey == true && charCode == 124) || (charCode == 47) || (charCode == 92)){
           return false;
      }else{
           return true;
      }
  }