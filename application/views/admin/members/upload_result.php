<?php  

if($this->session->userdata("logged_in")){

?>

<!DOCTYPE html>

<html>

<head>

    <title>Certificate</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <style type="text/css">

      .txt{

        cursor: text;

      }

        .resizemove {

            background-color: orange;

            width: 150px; 

            border: 1px solid #f30;

        }

        .text-pos{

            width: 200px;

            position: fixed;

            top: 120px;

            right: 10px;

            background: #a1a1a1;

        }

        #TextBoxesGroup{

            background-image: url(<?php  echo "./assets/images/".$file_path;?>);

            width: <?php  echo $file_width."px";?>;

            height: <?php  echo $file_height."px";?>;

            background-size: 100%; 

            background-position: center;

            background-repeat: no-repeat;

            position: relative;

            overflow: hidden;

        }

        .txt{

            max-width: 250px;

            position: fixed;

            top: 100px;

            right: 10px;

        }

        .newTextBoxDiv{

            background-color:orange;

            border:1px solid red;

            width:250px;

            text-align:center;

            padding:2px;

            cursor: move;

        }

  </style>

  <script type="text/javascript">

      $(document).ready(function(){

        $("#myModal").modal('show');

        $("#textModal").modal('show');

      });

  </script>

</head>

<body class="bg-secondary">

    <nav class="navbar navbar-expand-sm bg-info navbar-light">

            <a class="navbar-brand" href="#">

                <img class="rounded" width="50" hieght="50" src="<?php echo base_url('assets/images/logo.png')?>">

            </a>

            <a class="navbar-brand" href="csv"><h1 class="text-white">UCT Certificate</h1></a>

        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">

            <ul class="navbar-nav">

              <li class="nav-item">

                <a class="nav-link text-white" href="home">Home</a>

              </li>

              <li class="nav-item">

                <a class="nav-link text-white" href="result">Result</a>

              </li>  

            </ul>

        </div>  

    </nav>

    <!-- add Text Modal -->

    <div class="txt p-2" id="txt">

        <input class="btn btn-primary btn-block" type='button' value='Add Text Position' id='addButton'>

        <input class="btn btn-danger my-3 btn-block" type='button' value='Remove Text Position' id='removeButton'>

        <input class="btn btn-success btn-block" style="z-index: 2;" type='button' value='Submit' id='getButtonValue'>

    </div>

<!-- The Modal -->

  <div class="modal fade" id="myModal">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header bg-primary text-white font-weight-bold">

          <h4 class="modal-title">Important Steps : </h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

            <p class="alert alert-info text-dark h4 py-1 my-1"><span class="h5">Step-1 : </span>Click on the <span class="mark">Add Text Position</span> Button for inserting Text-Data.</p>

            <p class="alert alert-info text-dark h4 py-1 my-1"><span class="h5">Step-2 : </span>You can drag and resize the Locater as you need.</p>

            <p class="alert alert-info text-dark h4 py-1 my-1"><span class="h5">Step-3 : </span>You can add Three Locater.</p>

            <p class="alert alert-info text-dark h4 py-1 my-1"><span class="h5">Step-4 : </span>Select Color, Font- Size, Font & Font-style.</p>

            <p class="alert alert-info text-dark h4 py-1 my-1"><span class="h5">Step-5 : </span>Submit the form.</p>

            <p class="alert alert-warning py-1 h4 my-2 bg-warning text-danger text-center">Note : Text-Data will be centered align.</p>

        </div>

        <!-- Modal footer -->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>

        

      </div>

    </div>

  </div>



<div class="container-fluid my-5" style="z-index: -1">

    <center>

        <div id='TextBoxesGroup'></div>

    </center>

    <div class="test" id="tst"></div>

    <?php echo form_open('add','name = "myform"'); ?>

        <div class="row pt-3">

            <div class="col-sm-1"></div>

            <div class="col-sm-1 bg-info" id="myfield1"></div>

            <div class="col-sm-1 bg-info" id="myfield2"></div>

            <div class="col-sm-2 bg-info" id="myfield3"></div>

            <div class="col-sm-2 bg-info" id="myfield4"></div> 

            <div class="col-sm-2 bg-info" id="myfield5"></div>

            <div class="col-sm-2 bg-info" id="myfield6"></div>

            <div class="col-sm-1"></div>       

        </div>

        <div class="row pt-0">

            <div class="col-sm-10 m-auto bg-info" id="myfield7"></div>

        </div>

    <?php echo form_close(); ?>

    </div> 

</div>

<?php 

    $data1 = '<div class="form-group"><label for="sel2">Font :</label><select class="form-control" id="font" name="fontName[]">';

    foreach ($fonts as $value) 

    {

        $data1 .= '<option value="'.$value->fontName.'">'.$value->fontName.'</option>';

    }

    $data1 .= '</select></div>';

?>

<script type="text/javascript">

$(document).ready(function(){

    var counter = 1;

    $("#addButton").click(function () {

    if(counter>3){

            alert("Only 3 textboxes allow");

            return false;

    }

    var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter).resizable().addClass( "newTextBoxDiv").draggable();

    //$('#TextBoxDiv'+counter).draggable().resizable();

    newTextBoxDiv.text("Text-Box : " + counter);

    newTextBoxDiv.appendTo("#TextBoxesGroup");

    counter++;

     });

     $("#removeButton").click(function () 

     {

        if(counter==1){

              alert("No more textbox to remove");

              return false;

           }

        counter--;



            $("#TextBoxDiv" + counter).remove();

     });



     $("#getButtonValue").click(function () 

     {

        if (counter==1) 

        {

            alert("No Text Position Selected");

            return false;

        }

        $("#txt").hide();

        //$(".newTextBoxDiv").style.cursor = "pointer";

        var pos_var = "";

        var x = "";

        var y = "";

        var font_color = "";

        var font_size = "";

        var font_name = "";

        var font_category = "";

        var font_case = "";

        for(i=1; i<counter; i++)

        {

            $("#TextBoxDiv"+i).draggable( 'destroy' );

            var pos = $("#TextBoxDiv"+i).position();

            var ht = $("#TextBoxDiv"+i).height()+1;

            var wt = $("#TextBoxDiv"+i).width()+1;

            var xp = Math.floor(pos.left + (wt/2));

            var yp = Math.floor(pos.top + ht);

            x += '<input type="hidden" name="x[]" value="'+xp+'">';

            y += '<input type="hidden" name="y[]" value="'+yp+'">';

            pos_var+= '<div class="form-group mb-3"><label for="coords">Position '+i+':</label><input type="text" class="form-control" name="position[]" value="Text '+i+'" readonly></div>';

                

                font_color +='<div class="form-group mb-3"><label for="fontcolor">Font Color :</label><input type="color" class="form-control" name="fontColor[]"></div>';

                

                font_size += '<div class="form-group mb-3"><label for="size">Font Size :</label><select class="form-control" name="fontSize[]"><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="14">14</option><option value="16">16</option><option value="18">18</option><option value="20"selected>20</option><option value="22">22</option><option value="24">24</option><option value="26">26</option><option value="28">28</option><option value="36">36</option><option value="48">48</option><option value="72">72</option></select></div>';

                font_name += '<?php echo $data1?>';

                font_category += '<div class="form-group"><label for="sel2">Font Style:</label><select class="form-control" id="font_category" name="fontType[]"><option value="1">Regular</option><option value="2">Bold</option><option value="3">Italic</option><option value="4">Bold-Italic</option></select></div>';

                font_case += '<div class="form-group"><label for="sel2">Font Case :</label><select class="form-control" id="text_case" name="fontCase[]"><option value="1">UpperCase</option><option value="2">LowerCase</option><option value="3">1st Char UpperCase</option><option value="4">1st Char Lower Case</option><option value="5">Each 1st Str UpperCase</option></select></div>';

                

        }

        var btn = '<input type="submit" class="btn btn-primary mb-5" name="pos_save" value="Submit">';

        var cncl = '<a  class="btn btn-danger mb-5 ml-3" href="home">Cancel</a>';

        var file_name = '<input type="hidden" name="filename" value="<?php echo $file_path;?>">';

        var eventName = '<div class="form-group mb-3 w-50"><label for="coords">Event Name : </label><input type="text" class="form-control" name="eventName" required></div>'; 

        document.getElementById('myfield1').innerHTML = pos_var;

        document.getElementById('myfield2').innerHTML = font_size;

        document.getElementById('myfield3').innerHTML = font_color;

        document.getElementById('myfield4').innerHTML = font_name;

        document.getElementById('myfield5').innerHTML = font_category;

        document.getElementById('myfield6').innerHTML = font_case;

        document.getElementById('myfield7').innerHTML = eventName+x+y+file_name+btn+cncl;

     });

  });

</script>

</body>

</html>

<?php 

}else{

  redirect(base_url()."login");

}

?>