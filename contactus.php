<?php include("partials/menu.php");?>
    <div class="contactUs">
        <div class="container text-center">
            <h1>Contact Us</div>
            <form action="" method="POST" class="sender" onsubmit="return validateContactForm()">
             <div class="row">
               <label style="padding-top:20px;"><b>Name</b></label><span 
               id="userName-info" class="info"></span><br />
               <input type="text" class="input-field" name="userName" required/>
             </div>

             <div class="row">
               <label><b>Email<b></label><span 
               id="userEmail-info" class="info"></span><br />
               <input type="text" class="input-field" name="userEmail" required/>
             </div>

             <div class="row">
               <label><b>Subject</b></label><span 
               id="subject-info" class="info"></span><br />
               <input type="text" class="input-field" name="subject" required/>
             </div>

             <div class="row">
               <label><b>Message</b></label><span 
               id="userMessage-info" class="info"></span><br />
               <textarea name="content" class="input-field" cols="60" rows="6"></textarea>
             </div>
     
            
            <div>
              <input type="submit" name="send" class="btn-success" value="Send" />

              <div id="statusMessage">
                 <?php
                   if(!empty($message)){
                       ?>
                         <p class='<?php echo $type;?>Message'><?php echo $message; ?></p>
                       <?php
                   }
                 ?>
              </div>
            </div>
            </form>
        </div>
    </div>
<?php include("partials/footer.php");?>

<?php
if(isset($_POST['send'])){
    $name = $_POST['userName'];
    $email = $_POST['userEmail'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $toEmail = "Mugashab@gmail.com";
    $mailHeaders = "From:".$name."<".$email.">\r\n";
    if(mail($toEmail, $subject, $content, $mailHeaders)){
        $message = "Your Message is received Successfully";
        $type = "success";
    }

}
?>