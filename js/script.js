/*MENU--SIDEBAR*/



document.getElementById('colapse-menu').onclick = function changeContent() {

    if(document.getElementById('sidebar').classList.contains('colapsed')){
        document.getElementById('sidebar').classList.remove('colapsed');

        document.getElementById('main').classList.replace('col-lg-12','col-lg-10');
        document.getElementById('paraRemover').classList.remove('col-lg-1');
    }else{
        document.getElementById('sidebar').classList.add('colapsed');
        document.getElementById('main').classList.replace('col-lg-10','col-lg-12');
        document.getElementById('linha').insertAdjacentHTML("afterbegin","<div class='col-lg-1' id='paraRemover'> </div>");
    }
    
 
 }

 /*MODAL */
   
 function openModal(id,current,operacao){
    $('#loadModal').load('http://192.168.1.20/teste/common/modal.php',{id:id,current:current,operacao:operacao})
    }
   
/*FOOOTER*/

function doDate(){

    var today = new Date();
    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    $('#time').html (dateTime);

};
setInterval(doDate, 1000);



function fetchInfo() {
    
    var selectBox = document.getElementById("fiscCriar");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

    window.location.href = 'http://192.168.1.20/teste/autofill.php?id='+selectedValue;

    } 


    $(document).ready(function(){
        $("#codCliente").keyup( function() {
          var id = $(this).val();
          if(id!=''){
              $.ajax({
                  url:'http://192.168.1.20/teste/searchInput.php',
                  method:'post',
                  data:{query:id},
                  success:function(response){
                      $('#show-list').html(response);
                  }
              });
          }
          else{
              $('#show-list').html('');
          }
        });
        $(document).on('click','#selection', function(){
            $('#codCliente').val($(this).text());
            $('#show-list').html('');
            var id = $('#codCliente').val();
            if(id!=''){
                $.ajax({
                    url:'http://192.168.1.20/teste/fillNomeCliente.php',
                    method:'post',
                    data:{query:id},
                    success:function(response){
                        $('#nomeCli').val(response);
                    }
                });
            }
            else{
                $('#nomeCli').html('');
            }
        });
        
      });

   
    