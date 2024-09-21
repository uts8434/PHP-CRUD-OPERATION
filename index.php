<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <style type="text/tailwindcss">
      @layer utilities {
        .content-auto {
          content-visibility: auto;
        }
      }
      body {
        width: 100%;
        height: 100vh;
      }
      .form{
        width: 50%;
        margin: 0 auto;
         border-radius: 15px;
         box-shadow: 0 0 10px gray;
         
      }
      form { 
        margin-top: 2%;
        
        padding: 20px 10%;
        
      
      }
      legend{
        background-color: lightcoral; text-align: center; font-size: 1.5em; font-weight: bolder; color:white ;

        margin-bottom: 5%;
      }
       label{
        font-weight: bold;
        font-size: 1em;
         text-wrap: nowrap;
       
       }
      input {
        padding: 8px;
        border-radius: 5px;
        width: 100%;
         box-shadow: 0 0 10px gray;
         margin-bottom: 10px;
      }
      button{
        background-color: lightcoral;
        padding: 7px 25px;
        border-radius: 8px;
        font-weight: bold;
         color: rgb(39, 16, 16);
      }
      .button{
        margin-top: 5%;
         display: flex;
          justify-content: space-around;
      }
      .class_section,.contact,.parents_name,.parents_mob ,.parents_email{
        gap: 15px;
        margin-top: 18px;
      }
      .contact{
        gap: 15px;
        margin-top: 18px;
      }
     
    </style>
  </head>
  <body>
    <?php
    include "./conn.php";
    $row="";
    if(isset($_GET["insert"])){
      $sreg=$_GET["sreg"];
      $sname=$_GET["sname"];
      $sclass=$_GET["sclass"];
      $sect=$_GET["sect"];
      $semail=$_GET["semail"];
      $smob =$_GET["smob"];

      if(empty($sreg)&& empty($sname)&& empty($sclass) && empty($sect) && empty($semail) && empty($smob)){
        echo "Please fill all the fields";
      }else{
     
       $chackdata="SELECT * FROM student WHERE sreg='$sreg' ";

       if(mysqli_num_rows(mysqli_query($conn,$chackdata))>0){
        echo "<script>alert('data already exist')</script>";
       }else {
        $sql="INSERT INTO student (sreg,sname,sclass,sect,semail,smob) VALUES ('$sreg','$sname','$sclass','$sect','$semail','$smob')";

        $result=mysqli_query($conn,$sql);
        echo $result;
        if($result){
          echo "<script>alert('data inserted')</script>";
        }else{
          echo "<script>alert('data not inserted')</script>";
        }
        
       }
    }
  }

    if(isset($_GET["read"])){
      $sreg=$_GET["sreg"];
     

      if(empty($sreg)){
        echo "<script>alert('please enter registration')</script>";
      }else{
        $sql="SELECT sreg,sname,sclass,sect,semail,smob  FROM student WHERE sreg='$sreg'";
        $result=mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result)>0){
          $row=mysqli_fetch_assoc($result);
         }else{
          echo "<script>alert('no data found')</script>";
         }
      }
       

    }

    if(isset($_GET["update"])){
      $sreg=$_GET["sreg"];
      $sname=$_GET["sname"];
      $sclass=$_GET["sclass"];
      $sect=$_GET["sect"];
      $semail=$_GET["semail"];
      $smob =$_GET["smob"];

      $sql= "UPDATE student set sname='$sname' ,sclass='$sclass', sect='$sect', semail='$semail', smob='$smob' WHERE sreg='$sreg' ";
       if(mysqli_query($conn,$sql)){
        echo "<script>alert('data updated')</script>";
       }else{
        echo "<script>alert('data not updated')</script>";
       }
    }

    if(isset($_GET["delete"])){
      $sreg=$_GET["sreg"];
      $sql="DELETE FROM student WHERE sreg='$sreg'";
      if(mysqli_query($conn,$sql)){
        echo "<script>alert('data deleted')</script>";
      }else{
        echo "<script>alert('data not deleted')</script>";
      }

      
    }

    if(isset($_GET["pinsert"])) {
      $sreg = $_GET["sreg"];
      $fname = $_GET["fname"];
      $mname = $_GET["mname"];
      $femail = $_GET["femail"];
      $memail = $_GET["memail"];
      $fmob = $_GET["fmob"];
      $mmob = $_GET["mmob"];
  
      if(empty($sreg)) {
          echo "<script>alert('Student registration number is required')</script>";
      } else {
          // Check if the student exists in the student table
          $checkStudent = "SELECT * FROM student WHERE sreg='$sreg'";
          $studentResult = mysqli_query($conn, $checkStudent);
  
          if(mysqli_num_rows($studentResult) > 0) {
              // If the student exists, insert parent data
              $sql = "INSERT INTO parents (sreg, fname, mname, femail, memail, fmob, mmob) 
                      VALUES ('$sreg', '$fname', '$mname', '$femail', '$memail', '$fmob', '$mmob')";
  
              if(mysqli_query($conn, $sql)) {
                  echo "<script>alert('Parent data inserted')</script>";
              } else {
                  echo "<script>alert('Parent data not inserted')</script>";
              }
          } else {
              // If the student does not exist, show an error
              echo "<script>alert('Student does not exist. Please insert student details first.')</script>";
          }
      }
  }
  

    if(isset($_GET["pread"])){
      $sreg = $_GET["sreg"];
      $sql="SELECT * FROM parents WHERE sreg='$sreg'";
       if(mysqli_num_rows(mysqli_query($conn, $sql))>0){

        $row=mysqli_fetch_assoc( mysqli_query($conn, $sql));
       }else{
        echo "<script>alert('No data found')</script>";
       }

    }
    if(isset($_GET["pupdate"])){
      $sreg = $_GET["sreg"];
      $fname = $_GET["fname"];
      $mname = $_GET["mname"];
      $femail = $_GET["femail"];
      $memail = $_GET["memail"];
      $fmob = $_GET["fmob"];
      $mmob = $_GET["mmob"];

      $sql=" UPDATE parents set sreg='$sreg',fname='$fname',mname='$mname',femail='$femail',memail='$memail',fmob='$fmob',mmob='$mmob' WHERE sreg='$sreg'";

      if( mysqli_query($conn,$sql)){
        echo "<script>alert('Parent data updated')</script>";
      }else{
        echo "<script>alert('Parent data not updated')</script>";
      }


    }
    if(isset($_GET["pdelete"])){
      $sreg = $_GET["sreg"];
      $fname = $_GET["fname"];
      $mname = $_GET["mname"];
      $femail = $_GET["femail"];
      $memail = $_GET["memail"];
      $fmob = $_GET["fmob"];
      $mmob = $_GET["mmob"];

      $sql="DELETE FROM parents WHERE sreg='$sreg' ";
       if(mysqli_query($conn,$sql)){
        echo "<script>alert('Parent data deleted')</script>";
       }

    }
    
    
    ?>
    <h2 class="bg-red-400 p-3 text-2xl font-bold text-center text-white">
      Crud Operation
    </h2>
    <div class="form  ">
      <form method="get" action="./index.php">
        <legend>Student Details</legend>
        <label for="sreg">Student Reg no</label> <br>
        <input type="text" placeholder="Student Registration Number" id="sreg" name="sreg"  value="<?php echo isset($row['sreg'])? $row['sreg']:''?>" />

        <label for="sname">Student Name</label> <br>
        <input type="text" placeholder="Student Name" id="sname" name="sname"  value="<?php echo isset($row['sname'])?  $row['sname']:''?>" />
      
        <div class="class_section flex align-middle justify-center ">
        <label for="sclass">Class</label> <br>
        <input type="text" placeholder="IX" id="sclass"  name="sclass"  value="<?php echo isset($row['sclass'])?  $row['sclass']:''?>"  />
        <label for="sect">Section</label>  <br>
        <input type="text" placeholder="SECTION A" id="sect" name="sect"  value="<?php echo isset($row['sect'])?  $row['sect']:''?>"   />
        </div>
        
       
        
        <div class="contact flex">
        <label for="semail">Email</label> <br>
        <input type="email" placeholder="abc@gmail.com" id="semail" name="semail" value="<?php echo isset($row['semail'])?  $row['semail']:''?>"  />
       
        <label for="smob">Mobile no</label> <br>
        <input type="number" placeholder="+91XXXXXXX86" id="smob" name="smob"  value="<?php echo isset($row['smob'])?  $row['smob']:''?>"  />
        </div>

       

        <div class="button">
          <button type="submit" name="insert">Insert</button>
        <button type="submit" name="read">Read</button>
        <button type="submit" name="update">Update</button>
        <button type="submit" name="delete">Delete</button>
        <button type="reset" name="delete">Reset</button>
         
        </div>
      </form>
      <form action="">
      <legend>Parents Details</legend>
      <label for="sreg">Student Reg no</label> <br>
        <input type="text" placeholder="Student Registration Number" id="sreg" name="sreg"  value="<?php echo isset($row['sreg'])? $row['sreg']:''?>" />
      <div class="parents_name flex">
          <label for="fname">Father  Name</label> <br>
          <input type="text" placeholder="Lakshman " id="fname" name="fname"  value="<?php echo isset($row['fname'])? $row['fname']:''?>" />
          
          <label for="mname">Mother  Name</label> <br>
          <input type="text" placeholder="Urmila devi" id="mname" name="mname"  value="<?php echo isset($row['mname'])? $row['mname']:''?>" />
         
        </div>
        <div class="parents_email flex">
          <label for="femail">Father Email</label> <br>
          <input type="email" placeholder="abc@gmail.com" id="femail" name="femail" value="<?php echo isset($row['femail'])? $row['femail']:''?>"  />
          <label for="memail">Mother Email</label> <br>
          <input type="email" placeholder="abc@gmail.com" id="memail" name="memail" value="<?php echo isset($row['memail'])? $row['memail']:''?>"  />
         
        </div>
        <div class="parents_mob flex">
          <label for="fmob">Father Mob</label> <br>
          <input type="number" placeholder="+91XXXXXXX86" id="fmob" name="fmob" value="<?php echo isset($row['fmob'])? $row['fmob']:''?>"  />
          <label for="mmob">Mother Mob</label> <br>
          <input type="number" placeholder="+91XXXXXXX86" id="mmob" name="mmob" value="<?php echo isset($row['mmob'])? $row['mmob']:''?>"  />
         
        </div>
        <div class="button">
          <button type="submit" name="pinsert">Insert</button>
        <button type="submit" name="pread">Read</button>
        <button type="submit" name="pupdate">Update</button>
        <button type="submit" name="pdelete">Delete</button>
       
         
      </form>
    </div>

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              clifford: "#da373d",
            },
          },
        },
      };
    </script>
  </body>
</html>
