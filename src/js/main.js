$(document).ready(function() {
  // ouvrir le modal
  $('#open_modal').click(function() {
    $('#modal_to_open').css(
      {
        'display': 'block'
      }
    );
  });

  //fermer le modal
  $('#close_modal').click(function() {
    $('#modal_to_open').css(
      {
        'display': 'none'
      }
    );
  });

  //envoyer mail
  $('#submitForm').click(function(event){
    event.preventDefault();

    $.post(
      'mail.php',

      {
        msg : $("#msg").val(),
        nom : $('#nom').val(),
        prenom : $('#prenom').val(),
        mail : $('#mail').val()
      },

      function(data){
        if(data == 'Success'){
          $('#msgReponse').html("<p>Votre message s'est envoyé avec succès</p>");
          $("#msg").val("");
          $('#nom').val("");
          $('#prenom').val("");
          $('#mail').val("");
        }
        else {
          $('#msgReponse').html("<p>Erreur lors de l'envoie du message</p>");
        }
      },

      'text'
    );

  });

  //arrière fond du menu qui apparais quand on arrive sur le fond blanc
  $(document).on("scroll", onScroll);

  function onScroll(event){
    var Scroll = $(window).scrollTop() +1,
    divPass = $('#aboutID').offset().top;

    if (Scroll+25 >= divPass) {
      $('#headerColor').addClass('headColor');
    } else {
      $('#headerColor').removeClass('headColor');
    }

  }

});
