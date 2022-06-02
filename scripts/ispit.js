$(function(){
    $('#Exit_btn').click(function(){

   $radios = $("input[type='radio']:checked");
   for(let i = 0; i< $radios.length; i++){
        $.ajax({
        url: "../db/db.php",
        method: "POST",
        data: { id: $radios[i].name},
      }).done(function(response) {
       
        let json = JSON.parse(response);
       
        if(json['id'] == $radios[i].id){
          $radios.eq(i).addClass('is-valid');
        }
        else{
          $radios.eq(i).addClass('is-invalid');
          console.log($radios.eq(i).parent());
          $("input[id="+json['id']+"]").parent().css('background-color', 'lightgreen')
         
        }
      }) 
   }
   $('#Exit_btn').text("Završi pregled");
   $('#Exit_btn').click(function(){
      $('#Exit_btn').attr('href','../pages/mojiRezultati.php');
      })
    })

    
})