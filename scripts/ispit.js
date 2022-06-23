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
            rezultat = ($counterCorrect/$questions.length)*100
            if(i == $radios.length -1){
              $.post( "../pages/ispit.php",  { rezultat: rezultat }, function( data ) {
                console.log(data);
              });
            }    
            
          })
          
      }
        $('#Exit_btn').hide();
        $('#Završni_btn').show();
      })     

      $('#Završni_btn').click(function(){
        $('#Završni_btn').attr('href','../pages/mojiRezultati.php'); 
      })
})

