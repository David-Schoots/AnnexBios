 

       
    function add_chair(chair_number, chair_row) {
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
   
       document.getElementById("chairs").innerHTML = this.responseText;
       console.log(this.responseText);
   }  
   
   };
       xhttp.open("GET", "../modules/Ajax/temp_insert_chair.php?chair_num="+chair_number+"&chair_row="+chair_row, true);
       xhttp.send();
   }

   function remove_chair(chair_number, chair_row) {
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
   
       document.getElementById("chairs").innerHTML = this.responseText;
       console.log(this.responseText);
   }  
   
   };
       xhttp.open("GET", "../modules/Ajax/deselect_temp_chair.php?chair_num="+chair_number+"&chair_row="+chair_row, true);
       xhttp.send();
   }

   setInterval(function () {
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
   
       document.getElementById("chairs").innerHTML = this.responseText;
   }  
   
 };
 xhttp.open("GET", "../modules/Ajax/temp_chair_check.php", true);
 xhttp.send();
   }, 60000);

var remove_message;
function exit_message() {
remove_message = document.getElementById("message_chair_res");
remove_message.style.display = "none";
}

   