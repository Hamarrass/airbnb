
    function f(){
        //je récupère le numéro des futurs champs que je vais créer
         const index = +$('#widgets-counter').val();
         //je récupère le prototype des entrées
         const tmpl = $("#ad_images").data('prototype').replace(/__name__/g,index);
         $('#ad_images').append(tmpl);
  
         $('#widgets-counter').val(index+1);
         //je gère le bouton supprimer
         handleDeleteButtons();
      }
  
      function handleDeleteButtons(){
         $('button[data-action="delete"]').click(function(){
           const target = this.dataset.target;
            $(target).remove()
         })
      }
  
  
      function updateCounter(){    
        const count = $('#ad_images div.form-group').length;
          $('#widgets-counter').val(count);
      }
  
      document.addEventListener("DOMContentLoaded", () => {
        updateCounter();
        handleDeleteButtons();
      });
      