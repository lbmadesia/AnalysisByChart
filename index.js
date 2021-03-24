

// start fetch data for chart
function fetch(){
  $.ajax({
    type : "GET",
    url : "iottech.php",
    success : function(res){
     // var data = JSON.parse(res);
      var data = res;
      var ctype = sessionStorage.getItem("ctype");
      if(ctype == "area"){
        chartshow(data,'corechart');
      }
      else if(ctype == "column"){
        chartshow(data,'bar');
      }
      else if(ctype == "pie"){
        chartshow(data,'corechart');
      }
      
    },
    error : function(xhr){
      
    }
});
}
// chart show from here
function chartshow(data,chtype){
  google.charts.load('current', {'packages':[chtype]});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
   var ctype = sessionStorage.getItem("ctype");
    var d = new  google.visualization.DataTable();
    d.addColumn("number","sourcePoint");
    d.addColumn("number","targetValue");
    for(var i=0;i<data.length;++i){
      var sorcePoint = Number(data[i].sorcePoint);
      var argetValue = Number(data[i].targetValue);
      d.addRows([[sorcePoint,argetValue]]);
    }
    var options = {
      title: 'Company Performance',
      hAxis: {title: 'Source Point',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0},
      pointSize : 10,
      // legend : "none",
      pointShape : 'star'
    };
    
     if(ctype == "area"){
    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
   google.visualization.events.addListener(chart,"ready",function(){
     var imgstring = chart.getImageURI();
   // exportchart(imgstring,"iottecharea");
      localStorage.setItem("img",imgstring);
      localStorage.setItem("imgname","iottecharea");
  });
    chart.draw(d, options);
     }
     else if(ctype == "column"){
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      google.visualization.events.addListener(chart,"ready",function(){
        var imgstring = chart.getImageURI();
       //exportchart(imgstring,"iottechcolumn");
       localStorage.setItem("img",imgstring);
      localStorage.setItem("imgname","iottechcolumn");
     });
       chart.draw(d, options);
     }
     else if(ctype == "pie"){
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      google.visualization.events.addListener(chart,"ready",function(){
        var imgstring = chart.getImageURI();
      // exportchart(imgstring,"iottechpie");
      localStorage.setItem("img",imgstring);
      localStorage.setItem("imgname","iottechpie");
     });
      chart.draw(d, options);
    }
    
  }
}

// ========================================= 

$(document).ready(function(){
  var ctype = sessionStorage.getItem("ctype");
  if(ctype == null){
    sessionStorage.setItem("ctype","area");
  }
  fetch();
  // start form data send on server
  $("#insert-formdata").submit(function(e){
    var thistag = $(this);
    e.preventDefault();
    $.ajax({
      type : "POST",
      url : "iottech.php",
      data : new FormData(this),
      contentType : false,
      processData : false,
      beforeSend : function(){
        $(thistag).val("Wait...");
        $("#chart_div").val("<h3 class='text-warning'>please wait...</h3>");
        $(thistag).attr("disabled","disabled");
       },
      success : function(res){
        $(thistag).val("UPLOAD");
        $(thistag).removeAttr("disabled");
        fetch();
      },
      error : function(xhr){
        $(thistag).val("UPLOAD");
        $(thistag).removeAttr("disabled");
        console.log(xhr);
      }
    })
  });
  // start chart btn code
  $(document).ready(function(){
    $("button").click(function(){
      var ctype = $(this).attr("data-type");
      if(ctype == "area"){
        sessionStorage.setItem("ctype","area");
        fetch();
      }
      else if(ctype == "column"){
        sessionStorage.setItem("ctype","column");
        fetch();
      }else if(ctype == "pie"){
        sessionStorage.setItem("ctype","pie");
        fetch();
      }
    });
  });
  // start upload data from csv file
  $("#filedata").submit(function(e){
    var thistag = $(this);
    e.preventDefault();
    $.ajax({
      type : "POST",
      url : "csv.php",
      data : new FormData(this),
      contentType : false,
      processData : false,
      beforeSend : function(){
        $("#insertSubInput").val("wait...");
        $("#insertSubInput").attr("disabled","disabled");
      },
      success : function(res){
        $("#insertSubInput").val("IMPORT");
        $("#insertSubInput").removeAttr("disabled");
        fetch();
      },
      error : function(xhr, massage){
        $("#insertSubInput").val("IMPORT");
        $("#insertSubInput").removeAttr("disabled");
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
// start export chart IN IMAGE 
$(document).ready(function(){
    $("#downloadChart").click(function(){
      var img = localStorage.getItem("img");
      var imgname = localStorage.getItem("imgname");
      var a = document.createElement("a");
      a.href = img;
      a.download = imgname+".png",
      a.click();
    });
});
