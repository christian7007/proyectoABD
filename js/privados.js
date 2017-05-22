$(document).ready(function(){
   $("#ID_UsuarioDest").keyup(function(){
         $.post("../src/getPistasUsuarios.php", {'usuario' : $("#ID_UsuarioDest").val()}, function(data){
            $("#hints").html(data);
         }) 
   });
});