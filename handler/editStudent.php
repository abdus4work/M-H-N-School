<?php
require __DIR__.'/studentDAO.php';
$data=array(
    'fname'=>'',
    'mname'=>'',
    'lname'=>'',
    'roll'=>'',
    'addr'=>'',
    'gname'=>'',
    'gmob'=>'',
    'class'=>'',
    'pin'=>'',
    'sec'=>'',
    'id'=>''
);
$upSucc=false;
$upErr=false;
$found=false;
$notfound=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['submit'])){
        $roll=$_POST['roll'];
        $class=$_POST['class'];
        $sec=$_POST['csec'];
        $result=getStudent($roll,$class,$sec);
        if($result->num_rows>0){
            $data=$result->fetch_assoc();
            $_SESSION['sid']=$data['id'];
            $found=true;
        }
        else{
            $notfound=true;
        }
    }
    if(isset($_POST['fname'])){
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
        $id= $_SESSION['sid'];
        try{
            if(updateStudent($id,$roll,$fname,$mname,$lname,$addr,$gname,$mob,$class,$sec,$pin)>0){
                $upSucc=true;
            }else{
                $upErr=true;
            }
        }catch(Exception $e){
            $upErr=true;
        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if($upSucc){
    echo '<div class="container alert alert-success alert-dismissible fade show" role="alert">
    <strong>Update successfully...</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else if($upErr){
    echo '<div class="container alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Data doesn\'t Update...</strong> Try agin... 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if($found){
    echo '<div class="container alert alert-success alert-dismissible fade show" role="alert">
    <strong>Data Found...</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else if($notfound){
    echo '<div class="container alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Data not found...</strong> Try agin... 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<div class="d-flex align-items-center justify-content-center">
    <div class="container-1">
    <h1 class="title">Search Student</h1>
    <form action="./dashboard?student=edit" method="POST">
        <div class="grid">
        <div class="form-group form-control">
                <label for="croll">Roll Number</label>
                <input name="submit" type="hidden">
                <input id="croll" name="roll" class="form-control" type="text" required>
        </div>
        <div class="form-group form-control">
                <label for="class">Class</label>
                <select name="class" id="cclass" >
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="N">Nursery</option>
                    <option value="L">Lower</option>
                    <option value="U">Upper</option>
                    <option value="One">One</option>
                    <option value="Two">Two</option>
                    <option value="Three">Three</option>
                </select>
            </div>

            <div class="form-group form-control">
                <label for="csec">Section</label>
                <select id="csec" name="csec">
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        </div>
        <div class="button-container">
        <input class="button" type="submit" value="Search">
    </div>
    </form>
    </div>
</div>
<!-- edit student -->
<div class=" d-flex align-items-center justify-content-center">
    <div class="container-1">

        <h1 class="title">Edit Student Details</h1>

        <form id="studentForm" action="./dashboard?student=edit" method="POST" class="was-validated">
        <div class="grid">
            <div class="form-group form-control">
                <label for="fname">First Name</label>
                <input  class="form-control name" id="fname" name="fname" type="text" value="<?=$data['fname']??null?>" required>
            </div>
            <div class="form-group form-control">
                <label for="mname">Middle Name</label>
                <input id="mname" class="name" name="mname" type="text" value="<?=$data['mname']??null?>">
            </div>
            <div class="form-group form-control">
                <label for="lname">Last Name</label>
                <input id="lname" class="form-control name" name="lname" type="text" required value="<?=$data['lname']??null?>">
            </div>
            
            <div style="grid-column: span 2;" class="form-group form-control">
                <label for="roll">Roll Number</label>
                <input id="roll" name="roll" class="form-control" type="text" required value="<?=$data['roll']??null?>">
            </div>

            <div class="textarea-group form-control">
                <label for="bio">Address</label>
                <textarea id="bio" name="addr" ><?=$data['addr']??null?></textarea>
            </div>
            
            <div class="form-group form-control ">
                <label for="gname">Guardian Name</label>
                <input id="gname" class="form-control" name="gname" type="text" required value="<?=$data['gname']??null?>">
            </div>
            <div class="form-group form-control ">
                <label for="mob">Mobile No.</label>
                <input id="mob" name="gmob" type="tel" value="<?=$data['gmob']??null?>" >
            </div>
            <div class="form-group form-control">
                <label for="class">Class</label>
                <select name="class" id="class">
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="N" <?= ($data['class']??null)=="N"? "selected":"";?> >Nursery</option>
                    <option value="L" <?= ($data['class']??null)=="L"? "selected":"";?>>Lower</option>
                    <option value="U" <?= ($data['class']??null)=="U"? "selected":"";?>>Upper</option>
                    <option value="One" <?= ($data['class']??null)=="One"? "selected":"";?>>One</option>
                    <option value="Two" <?= ($data['class']??null)=="Two"? "selected":"";?>>Two</option>
                    <option value="Three" <?= ($data['class']??null)=="Three"? "selected":"";?>>Three</option>
                </select>
            </div>

            <div class="form-group form-control" >
                <label for="sec">Section</label>
                <select name="sec" id="sec">
                    <option value="none" selected disabled hidden>Select</option>
                    <option value="A" <?= ($data['sec']??null)=="A"? "selected":"";?>>A</option>
                    <option value="B" <?= ($data['sec']??null)=="B"? "selected":"";?>>B</option>
                    <option value="C" <?= ($data['sec']??null)=="C"? "selected":"";?>>C</option>
                    <option value="D" <?= ($data['sec']??null)=="D"? "selected":"";?>>D</option>
                </select>
            </div>

            <div class="form-group form-control">
                <label for="zip">Code postal</label>
                <input id="zip"  name="pin" type="text" value="<?=$data['pin']?>">
            </div>
        </div>
        <div class="button-container">
            <input class="button" type="submit" value="Update Student">
        </div>
        </form>

    </div>
</div>