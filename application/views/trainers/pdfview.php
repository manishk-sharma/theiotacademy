<?php include 'assets/template/header.php';?>

<?php

    if(filter_input(INPUT_GET, 'studymaterial_id')){
        $filename= "uploads/".filter_input(INPUT_GET, 'studymaterial_id').".pdf";
        if(file_exists($filename))
        {    echo "<embed src='$filename' type='application/pdf' width='100%' height='600px' />";
        }
        else{
            echo "<h4 style='font-weight:bold;color:#ff0000'>File Does Not Exist</h4>";
        }
    }
    
    if(filter_input(INPUT_GET, 'assignment_id')){
        $filename= "uploads/assignment/".filter_input(INPUT_GET, 'assignment_id').".pdf";
        if(file_exists($filename)){
            echo "<embed src='$filename' type='application/pdf' width='100%' height='600px' />";
        }
        else{
            echo "<h4 style='font-weight:bold;color:#ff0000'>File Does Not Exist</h4>";
        }
    }
    
    
?>

<?php include 'assets/template/footer.php';?>
