$(function(){
    $('#Exit_btn').click(function(){
   $radios = $("input[type='radio']:checked");
   $questions = $("p[id='pitanje']");
   
   $counterCorrect = 0;
   let rezultat;
   for(let i = 0; i< $radios.length; i++){
        $.ajax({
        url: "../db/db.php",
        method: "POST",
        data: { id: $radios[i].name},
      }).done(function(response) {
       
        let json = JSON.parse(response);
       
        if(json['id'] == $radios[i].id){
          $radios.eq(i).addClass('is-valid');
          $counterCorrect +=1;
        }
        else{
          $radios.eq(i).addClass('is-invalid');
          $("input[id="+json['id']+"]").parent().css('background-color', 'lightgreen')
         
        }
       // console.log($counterCorrect)
       // console.log(($counterCorrect/$questions.length)*100)
         rezultat = ($counterCorrect/$questions.length)*100

         if(i == $radios.length -1){
          $.post( "../pages/ispit.php",  { rezultat: rezultat }, function( data ) {
            console.log(data);
          });
         }
        /* $.ajax({
          url: "../pages/ispit.php",
          method: "POST",
          data: { rezultat: rezultat }
        }) */
       
       // console.log(rezultat)
      })
   
   }

   
  
    $('#Exit_btn').text("Završi pregled");
   $('#Exit_btn').click(function(){
      $('#Exit_btn').attr('href','../pages/mojiRezultati.php');
      }) 
    })

    
})