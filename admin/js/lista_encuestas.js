jQuery(document).ready(function($){

    $("#btnnuevo").click(function(){
      
        $("#modalnew").modal("show");
        console.log('Click nuevo');
    });

    var i = 1;
    $("#add").click(function(){
        i++;add
        $("#camposdinamicos").append('<tr id="row'+i+'"><td><label for="txtnombre" class="col-form-label" style="margin-right:5px">Pregunta '+i+'</label></td><td><input type="text" name="name[]" id="name" class="form-control name_list"></td><td><button name="remove" id="'+i+'" class="btn btn-danger" style="margin-left:5px">X</button></td></tr>');
        return false;
    });
    
    $(document).on('click','.btn_remove',function(){
        var button_id = $(this).attr('id');
        $("#row"+button_id+"").remove();

    });
     

}); 