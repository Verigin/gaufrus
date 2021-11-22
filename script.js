$(document).ready(function(){     
      var files; 

      $('input[type=file]').on('change', function(){
        files = this.files;
        console.log("files",files);
      });

      $('#create').on( "click", function(e) {
        e.stopPropagation(); 
        e.preventDefault();  

        if( typeof files == 'undefined' ) return;
        var data = new FormData();

        $.each( files, function( key, value ){
          data.append( key, value );
        });
        data.append( 'my_file_upload', 1 );
        data.append( 'name', $('#name').val() );
        data.append( 'email', $('#email').val() );
        data.append( 'phone', $('#phone').val() );

        $.ajax({
          url         : './ajax.php',
          type        : 'POST', // важно!
          data        : data,
          cache       : false,
          dataType    : 'json',
          processData : false,
          contentType : false, 
          success     : function( respond, status, jqXHR ){
            if( typeof respond.error === 'undefined' ){
              document.location.reload();
            }
            else {
              console.log('ОШИБКА: ' + respond.data );
            }
          },
          error: function( jqXHR, status, errorThrown ){
            console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
          }
      
        });
      
      });

      $( ".delete_item" ).on( "click", function() {
        let id = $(this).data('id');
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: { id: id}
          })
        .done(function( data ) {
            data = JSON.parse(data);
            if (data.status) {
            $('#item_'+id).remove();
            }
        });
      }); 
 });