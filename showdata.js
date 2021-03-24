$(document).ready(function(){
    $("#show-by").submit(function(e){
        var thistag = $(this);
        e.preventDefault();
        $.ajax({
          type : "POST",
          url : "byshow.php",
          data : new FormData(this),
          contentType : false,
          processData : false,
          beforeSend : function(){
           $("#bySubInput").val("wait...");
           $("#bySubInput").attr("disabled","disabled");
          },
          success : function(res){
            $("#bySubInput").val("SHOW GRAPH");
            $("#bySubInput").removeAttr("disabled");
           // var data = JSON.parse(res);
            console.log(res);
            // fetch();
          },
          error : function(xhr, massage){
            $(thistag).val("IMPORT");
            $(thistag).removeAttr("disabled");
            $("#csvalert").html(xhr.responseText);
            $("#csvalert").removeClass("d-none");
            setTimeout(()=>{ 
              $("#csvalert").html(xhr.responseText);
              $("#csvalert").addClass("d-none");
             },3000);
          }
        });
      });
});
