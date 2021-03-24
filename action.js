// start  menu list
$(document).ready(function(){
    $(".li-item").click(function(){
      
            $(".show-graph").addClass("d-none");
            $(".insert-form").addClass("d-none");
            $(".show-graph-by").addClass("d-none");

        var type = $(this).data("action");
        $(".li-item").each(function(){
            $(this).css({background : "#fff"});
        });
        $(this).css({background : "#ccc"});
        if(type == "show"){
            showMenuList();
        }
        else if(type == "insert"){
           $(".show-graph").removeClass("d-none");
           $(".insert-form").removeClass("d-none");
        }
        else if(type == "delete"){
            deleteMenuList();
         }
    });
    // show li
    $(document).ready(function(){
        $(".show-li").click(function(){
            $(".show-li").each(function(){
                $(this).css({border : 0});
            });
            $(this).css({border : "1px solid #ccc"});
        });
    });
});
//   menu list
// start show data menu list
function showMenuList(){
   if($(".show-ul").hasClass("d-none")){
    $(".show-ul").removeClass("d-none");
    }
    else{
        $(".show-ul").addClass("d-none");
        $(".show-li").each(function(){
            $(this).css({border : 0});
        });
    }
}

// end show data menu list 


// start delete data menu list
function deleteMenuList(){
   if($(".delete-ul").hasClass("d-none")){
    $(".delete-ul").removeClass("d-none");
    }
    else{
        $(".delete-ul").addClass("d-none");
        $(".delete-li").each(function(){
            $(this).css({border : 0});
        });
    }
}

// end show data menu list 


// start code show graph menu li
$(document).ready(function(){
    $(".show-li").click(function(){
        $("#show-by").removeClass("d-none");
        $("#delete-by").addClass("d-none");
        $(".li-item").each(function(){
            $(this).css({background : "#fff"});
        });
        $(".delete-m-li2").css({background : "#ccc"});

        var litype = $(this).data("bytype");
        if(litype == "bydate"){
            $(".show-graph-by").removeClass("d-none");
            $("#showby-form").html(`
            <div class="form-group">
            <label>From</label> 
            <input required type="date" name="from" data-cname="dates" class="form-control mb-2">
            </div>
            <div class="form-group">
            <label>To</label> 
            <input required type="date" name="to" data-cname="dates" class="form-control mb-2">
            </div>
            `);
        }
        else if(litype == "byshift"){
            $(".show-graph-by").removeClass("d-none");
            $("#showby-form").html(`
            <div class="form-group">
            <label>DATE</label> 
            <input required type="date" name="date" data-cname="dates" class="form-control mb-2">
            </div>
            <div class="form-group">
            <label>BY SHIFT</label> 
            <select class="form-control mb-2" name="shift" data-cname="dates">
              <option>Sift - 1</option>
              <option>Sift - 2</option>
              <option>Sift - 3</option>
            </select>
            </div>
            `);
        }
        else if(litype == "bymachine"){
            $(".show-graph-by").removeClass("d-none");
            $("#showby-form").html(`
            <div class="form-group">
            <label>Mchine Number</label> 
            <input required type="text" name="machineNo" class="form-control mb-2" placeholder="Machine number">
            </div>
            `);
        }
    });
});
// end code show graph menu li

// start code delete data menu li
$(document).ready(function(){
    $(".delete-li").click(function(){
        $("#delete-by").removeClass("d-none");
        $("#show-by").addClass("d-none");
        $(".li-item").each(function(){
            $(this).css({background : "#fff"});
        });
        $(".delete-m-li3").css({background : "#ccc"});

        var litype = $(this).data("bytype");
        if(litype == "bydate"){
            $(".show-graph-by").removeClass("d-none");
            $("#deleteby-form").html(`
            <div class="form-group">
            <label>From</label> 
            <input required type="date" name="from" data-cname="dates" class="form-control mb-2">
            </div>
            <div class="form-group">
            <label>To</label> 
            <input required type="date" name="to" data-cname="dates" class="form-control mb-2">
            </div>
            `);
        }
        else if(litype == "byshift"){
            $(".show-graph-by").removeClass("d-none");
            $("#deleteby-form").html(`
            <div class="form-group">
            <label>DATE</label> 
            <input required type="date" name="from" data-cname="dates" class="form-control mb-2">
            </div>
            <div class="form-group">
            <label>BY SHIFT</label> 
            <select class="form-control mb-2" name="byshift" data-cname="dates">
              <option>Sift - 1</option>
              <option>Sift - 2</option>
              <option>Sift - 3</option>
            </select>
            </div>
            `);
        }
        else if(litype == "bymachine"){
            $(".show-graph-by").removeClass("d-none");
            $("#deleteby-form").html(`
            <div class="form-group">
            <label>Mchine Number</label> 
            <input required type="text" name="machineNo" class="form-control mb-2" placeholder="Machine number">
            </div>
            `);
        }
    });
});
// end code show graph menu li
 