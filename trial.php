<?php

    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: index.php");
        exit;
    }
 
    if(time()-$_SESSION["login_time_stamp"] >1800)   
    { 
        session_unset(); 
        session_destroy(); 
        header("location:index.php"); 
    } 
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['Id'];
        $name = $_POST['name'];

        $year = date("Y"); 
        $today = date('h-i-s');
//      mkdir($year);
//  mkdir("$year/$camp");
//    if (!file_exists("$year/$camp")) {
//        mkdir("$year/$camp");
//    }
//         $file_name=$name .'_'.$id.'.txt';
//        
//    function get_data(){
//        $datae=array();
//        $datae[]=array(
//            'Id' => $_POST['Id'],
//            'Name' => $_POST['name'],
//        );
//        return json_encode($datae);
//    }

        function get_data()
				{
                    $today=$_POST['date'];
                    $name = $_POST['name'];
                    $id = $_POST['Id'];
                    $file_name=$name .'_'.$id.'.txt'; 
                     $camp=$_SESSION["entercamp"];
                    $year = date("Y"); 
            if (file_exists("$year/$camp/$file_name")) {
            $current_data=file_get_contents("$year/$camp/$file_name");
                        $array_data=json_decode($current_data,true);
                        $extra=array(

                            'Date' => $_POST['date'],
                            'Attendence'=>$_POST['attendence'],
                        );
                        $array_data[]=$extra;
//                         echo "file exist<br/>";
                         return json_encode($array_data);
            }
                        
                    }
        $camp=$_SESSION["entercamp"];
    $file_name=$name .'_'.$id.'.txt';
    if(file_put_contents("$year/$camp/$file_name",get_data())){
//        echo "<script>alert('Details added succesfully')</script>";
        // echo '<div class="alert alert-success alert-dismissible" role="alert">
        //     <button type="button" class="close" data-dismiss="alert">&times;</button>
        //     <p>Details added succesfully</p>
        //     </div>';
    }
     
    else{
        echo "<script>alert('There is some error')</script>";
        //echo 'There is some error';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Get Detail</title>
    <title>Welcome-<?php $_SESSION['username']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="trial.css">
    <link href="footer.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
       

</head>
<body>
    <?php require 'header2.html'?>
    <section id='sectionid'>
        <button  id='inpsubmit' name='submit' class="btn btn-dark" onclick='document.location="form2.php"'>Add New Student</button>
        <input type="text" class="btn btn-light" id="inpsearch" placeholder="SEARCH" /><br>
        <div class="container-fluid">       
            <h1>Student Details on
                <div class="row">
					<div class="col-xs-6">
						
						<input
							type="date"
							class="form-control"
							id="inpdob"
							name="dob"
                               
						/>
                    </div>
                    
					</div>
                 
                    </h1>
            <div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="selectcamp" class="control-label">Camp:</label>
							<select id="dropDownId" name="camp" class="form-control" required>
								<option>Working day</option>
								<option>Holiday</option>
								
							</select>
						</div>
					</div>
        <table id='tbltable' class="table table-bordered">
            <tr class="text-light">
                  <th class="tdId">Id</th>
                <th class="tdname">Name</th>
                <th>Update</th>
                <th>Mark Attendence</th>
                <div class='button'>
                
                
            </div>
            </tr>
            <script> 
                var select=$('#dropDownId :selected').text();
                    if(select=='Holiday')
                 {
                    $('input[type="checkbox"]').click(function(e){
                        e.preventDefault();
                         console.log(select);
                     });
                 }
            </script>
            <?php
           $year = date("Y");
            $dir_path = "$year/";
            if (is_dir($dir_path)) {
                $files = opendir($dir_path); {
                    if ($files) {
                        $file_name=$_SESSION["entercamp"];
                       
                            if ($file_name != '.' ) {
                                $dirpath = "$year/" . $file_name . "/";
                                if (is_dir($dirpath)) {
                                    $file = opendir($dirpath); {
                                        if ($file) {
                                            while (($filename = readdir($file)) !== FALSE) {
                                                if ($filename != '.' && $filename != '..') {
            ?>
                                                    <script>
                                                        
                                                        $(document).ready(function() {
                                                            $.getJSON("<?php echo "$year/" . $file_name . "/" . $filename; ?>", function(data) {
                                                                var student = '';
                                                                var d="2020-09-01";
                                                                $.each(data, function(key, value) {
                                                                    var d=document.getElementById('inpdob').value;
//                                                                   
                                                                    student+='<tbody id="tbltbody">';
                                                                    student += '<tr>';
                                                                    
                                                                    if(value.Name)
                                                                        {
                                                                                           
                                                                         student += '<td class="tdId">' +data[0].Id+ '</td>';
                                                                    student += '<td class="tdname">' +data[0].Name+ '</td>';
                                                                             
                                                                            student += '<td class="tdmark"><input type="checkbox" value="P" id="check_id"/></td>';
                                                                    student += '<td><button type="button" class="tdupdate bg-secondary" data-toggle="modal" data-target="#divModal">Update</button></td>';   
                                                                        }
                                                                    
                                                                    
                                                                    
                                                                    student += '</tbody>';
                                                                    student += '</tr>';
                                                                });
                                                                $('#tbltable').append(student);
                                                                if(window.navigator.userAgent.indexOf("Mobile") > -1){
                                                                     $(".tdDOB").hide(); $(".tdclass").hide();$(".tdcontact").hide(); $(".tdschool").hide(); $(".tdmotheroccupation").hide(); $(".tdmother").hide();$(".tdfather").hide();$(".tdfatheroccupation").hide(); console.log("it is mobile");}
                                                                else{
                                                                    console.log("it is desktop")};
                                                                
                                                               
                                                                
            
                                                               
                                                                
    $(function () {    
       
        $(".tdupdate").click(function() {
            var a = $(this).parents("tr").find(".tdname").text();
            var b = $(this).parents("tr").find(".tdId").text();
            var select=$('#dropDownId :selected').text();
            if(select=='Working day')
                {
                     if($(this).parents("tr").find("input").is(":checked"))
                    {
                        var c='P';
                    }
                    else{
                        var c='A';
                    }
                    
                }
            else{
                var c='H';
                
                 
            }
//            var select=$('#dropDownId :selected').text();
//                 if(select=='Holiday')
//             {
//                 $('input[type="checkbox"]').click(function(e){
//                    e.preventDefault();
//                });
//             }
          
            console.log(a);
            var d=(document.getElementById('inpdob').value);
            $("#inpname").val(a);
            $("#inpId").val(b);
            $("#inpattendence").val(c);
            $("#inpdate").val(d)
        })
    })
                                                            });
                                                        });
                                                    </script>
            <?php }
                                            }
                                        }
                                    }
                                }
                            }
                        
                    }
                }
            } ?>
            </table>
    </section>
    <script>
       $(document).ready(function() { 
                $("#inpsearch").on("keyup", function() { 
                    var value = $(this).val().toLowerCase(); 
                    $("#tbltbody tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                }); 
            }); 
    </script>

    <div class="modal fade" id="divModal" tabindex="-1" role="dialog" aria-labelledby="hmodaltitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="hmodaltitle">UPDATE</h2>
                </div>
                <div class="modal-body">
                    <div class="contact-form">
                        <form method="post" action="trial.php">
                            Id<input type="text" id="inpId" name='Id' readonly><br>
                            Name<input type="text" id="inpname" name='name' readonly><br>
                             Attendence<input type="text" id="inpattendence" name='attendence' readonly><br>
                            Date<input type="text" id="inpdate" name='date' readonly><br>
                 <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit" onclick='document.location="trial.php"'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.html'?>
</body>
</html>
