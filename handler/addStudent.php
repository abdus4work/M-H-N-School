<?php 
require __DIR__.'/studentDAO.php';
$insertSucc=false;
$insertErr=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $fname=test_input($_POST['fname']);
    $mname=test_input($_POST['mname']);
    $lname=test_input($_POST['lname']);
    $roll=$_POST['roll'];
    $mob=$_POST['gmob'];
    $pin=$_POST['pin'];
    $gname=test_input($_POST['gname']);
    $addr=test_input($_POST['addr']);
    $class=test_input($_POST['class']);
    $sec=test_input($_POST['sec']);
    try{
        if(addStudent($roll,$fname,$mname,$lname,$addr,$gname,$mob,$class,$sec,$pin)>0){
            $insertSucc=true;
        }
    }catch(Exception $e){
        $insertErr=true;
        echo $e;
    }

}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($insertSucc){
    echo '<div class="container alert alert-success alert-dismissible fade show" role="alert">
    <strong>Inserted successfully...</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else if($insertErr){
    echo '<div class="container alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Data doesn\'t Inserted...</strong> Try agin... 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<div class=" d-flex align-items-center justify-content-center">
    <div class="container-1">

        <h1 class="title">Student Details</h1>

        <form id="studentForm" action="./dashboard?student=add" method="POST" class="was-validated">
        <div class="grid">
            <div class="form-group form-control">
                <label for="fname">First Name</label>
                <input  class="form-control name" id="fname" name="fname" type="text" required>
            </div>
            <div class="form-group form-control">
                <label for="mname">Middle Name</label>
                <input id="mname" class="name" name="mname" type="text">
            </div>
            <div class="form-group form-control">
                <label for="lname">Last Name</label>
                <input id="lname" class="form-control name" name="lname" type="text" required>
            </div>
            
            <div style="grid-column: span 2;" class="form-group form-control">
                <label for="roll">Roll Number</label>
                <input id="roll" name="roll" class="form-control" type="text" required>
            </div>

            <div class="textarea-group form-control">
                <label for="bio">Address</label>
                <textarea id="bio" name="addr"></textarea>
            </div>
            
            <div class="form-group form-control ">
                <label for="gname">Guardian Name</label>
                <input id="gname" class="form-control" name="gname" type="text" required>
            </div>
            <div class="form-group form-control ">
                <label for="mob">Mobile No.</label>
                <input id="mob" name="gmob" type="text" >
            </div>
            <div class="form-group form-control">
                <label for="class">Class</label>
                <select name="class" id="class" >
                    <option value="N">Select</option>
                    <option value="N">Nursery</option>
                    <option value="L">Lower</option>
                    <option value="U">Upper</option>
                    <option value="One">One</option>
                    <option value="Two">Two</option>
                    <option value="Three">Three</option>
                </select>
            </div>

            <div class="form-group form-control">
                <label for="sec">Section</label>
                <select name="sec" id="sec">
                    <option value="">Select</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <div class="form-group form-control">
                <label for="zip">Code postal</label>
                <input id="zip"  name="pin" type="text">
            </div>
        </div>
        <div class="button-container">
            <input class="button" type="submit" value="Add Student">
        </div>
        </form>

    </div>
</div>





<!-- <script>
    const namField=document.getElementById('sname');
    namField.addEventListener('keydown',()=>{
        namField.value=namField.value.toUpperCase();
    })
</script> -->