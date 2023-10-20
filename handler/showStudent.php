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
$rows=array();
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
        $rows=getMarks($roll,$class,$sec);
            // $row=$marks->fetch_assoc();
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
}

?>


<div class="d-flex align-items-center justify-content-center">
    <div class="container-1">
    <h1 class="title">Search Student</h1>
    <form action="./dashboard?student=show" method="POST">
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

        <h1 class="title">Student Details</h1>
        <div class="grid">
            <div class="fnt form-group form-control">
                <label for="fname">Name</label>
                <?=$data['fname']??null?><?= " "?><?=$data['mname']??null?><?= " "?><?=$data['lname']??null?>
            </div>
            <div class="fnt form-group form-control">
                <label for="roll">Roll Number</label>
                <?=$data['roll']??null?>
            </div>

            <div class="fnt textarea-group form-control">
                <label for="bio">Address</label><br>
                <?=$data['addr']??null?>
            </div>
            
            <div class="fnt form-group form-control ">
                <label for="gname">Guardian Name</label>
                <?=$data['gname']??null?>
            </div>
            <div class="fnt form-group form-control ">
                <label for="mob">Mobile No.</label>
                <?=$data['gmob']??null?>
            </div>
            <div class="fnt form-group form-control">
                <label for="class">Class</label>
                <?= $data['class']??null?>
            </div>

            <div class="fnt form-group form-control" >
                <label for="sec">Section</label>
                <?= $data['sec']??null?>
            </div>

            <div class="fnt form-group form-control">
                <label for="zip">Code postal</label>
                <?=$data['pin']??null;?>
            </div>
        </div>
    </div>
</div>


<div class=" d-flex align-items-center justify-content-center">
    <div class="container-1">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Term</th>
      <th scope="col">Bengali</th>
      <th scope="col">English</th>
      <th scope="col">Math</th>
      <th scope="col">Arabic</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($rows as $rows){
        echo '<tr>
        <th scope="row">'.$rows['term'].'</th>
        <td>'.$rows['bengali'].'</td>
        <td>'.$rows['english'].'</td>
        <td>'.$rows['math'].'</td>
        <td>'.$rows['arabic'].'</td>
        </tr>';
    }
    ?>
    <tr>
  </tbody>
</table>
    </div>
</div>