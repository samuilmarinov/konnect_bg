<?php 
//Template  Custom Form
// $options = get_option( 'Form_Submissions_options' );
// $api_key = $options['api_key'];
$booking_a = $_GET['book'];
$driver = $_GET['driver'];

if(strpos($_SERVER['REQUEST_URI'], 'transfers') !== false){
    $booking_service = 'Transfer';
}elseif(strpos($_SERVER['REQUEST_URI'], 'pick-ups') !== false){
    $booking_service = 'Pick-up';
}else{
    $booking_service = $_GET['service'];  
}

$space = " - ";
if($driver != ''){
    $booking = $booking_a.$space.$driver;
}else{
   $booking = $_GET['book']; 
}

$today = date('y-m-d h:i:s');

?>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js" type="text/javascript"></script>
		<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		</script>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
		</script>
		<style>
		  .hiddenbooking{display:none;}
		   #pickup-time, #return-time{max-height: 40px; margin-bottom: 10px;}
			.final{display:none;}
			.btn + .btn {margin-left: 0;}
			@keyframes heartbeat { 0% { transform: scale( .95 ); } 20% { transform: scale( 1 ); } 40% { transform: scale( .95 ); } 60% { transform: scale( 1 ); } 80% { transform: scale( .95 ); } 100% { transform: scale( .95 ); } }
			.animated{animation: heartbeat 2s infinite;}
		</style>
		<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
	<div class="container">

	<form autocomplete="off" id="msform_booking" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" >
		  <h2>New Booking</h2>
		  <div class="row">
		
			<div class="col-md-6">
			  <div class="form-group">
				<label for="first">First Name</label>
				<input type="text" class="form-control" name="cf-name" required value="<?php  ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) ?>" id="first" placeholder="First Name">
			  </div>
			</div>
			<!--  col-md-6   -->
			<div class="col-md-6">
			  <div class="form-group">
				<label for="first">Last Name</label>
				<input type="text" class="form-control" name="cf-name-last" required value="<?php  ( isset( $_POST["cf-name-last"] ) ? esc_attr( $_POST["cf-name-last"] ) : '' ) ?>" id="last" placeholder="Last Name">
			  </div>
			</div>
			<!--  col-md-6   -->
		  </div>
	  
	  
		  <div class="row">
		  <div class="col-md-6">
			
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="cf-email" name="cf-email" placeholder="Email" required>
			  </div>

      </div>
			<!--  col-md-6   -->
	  
			<div class="col-md-6">
	  
			  <div class="form-group">
				<label for="phone">Phone Number</label>
				<input type="tel" class="form-control" id="cf-phone" name="cf-phone" placeholder="Phone" required>
			  </div>
			</div>
			<!--  col-md-6   -->
		  </div>
		  <!--  row   -->
	  
	 
		  <div class="row">
			  <div class="col-md-6">
			  
			  <div class="form-group hideonbooking">
		          <label for="vehicle">Vehicle Selected</label>
		          <input readonly name="vehicle" type="text" class="form-control" placeholder="" value="<?php if($booking != ''){ echo $booking;} ?>" id="vehicle">
		      </div>

			  <div class="form-group hiddenbooking">
		          <label for="pickup">Pick-up from</label>
		          <input name="pickup" type="text" class="form-control" placeholder="" id="pickup">
		      </div>

			  </div>
			<!--  col-md-6   -->
		 <div class="col-md-6">

		  <div class="form-group hiddenbooking">
	          <label for="destination">Destination</label>
	          <input name="destination" type="text" class="form-control" placeholder="" id="destination">
	      </div>

	      </div>
		
			<!--  col-md-6   -->
		  </div>
		  <!--  row   -->
		    <div class="row">
		
    	    <div class="col-md-6">
            <div class="form-group">
			<label for="pickup-time">Pick-up?</label>
            <input type="datetime-local" id="pickup-time"
                   name="pickup-time" value=""
                   min="<?php echo $today; ?>" max="">
             </div>
             </div> 
        
          
    	    <div class="col-md-6">
            <div class="form-group returngroup">
			<label for="return-time">Return?</label>
            <input type="datetime-local" id="return-time"
                   name="return-time" value=""
                   min="<?php echo $today; ?>" max="">
             </div>
             </div> 
             
            </div>
           
			<!--<div class="checkbox">-->

			<!--	<label>-->
			<!--		<input type="checkbox" value="Sure!" id="newsletter"> Sure!-->
			<!--	</label>-->
			<!--</div>-->

			  <div class="form-group">
		          <input readonly name="booking_service" type="hidden" class="form-control" placeholder="" value="<?php if($booking_service != ''){ echo $booking_service;} ?>" id="booking_service">
		      </div>


			<span name="submitted_2" id="tohide" onClick="gcaptchacheck()" class="btn btn-primary">Accept Terms</span>
            
		  <input type="submit" id="#submit_final" name="submitted" class="btn btn-primary final" value="Submit">
		  <div class="terms">
            <a href="https://konnect.bg/terms-and-conditions/">Terms and Conditions</a>
            </div>
			<div style="margin-top:1rem;" id="capchag" class="grecaptcha"></div>			
		</form>
	  </div>
<script type="text/javascript">
var widgetId1;
var onloadCallback = function() {
 widgetId1 = grecaptcha.render('capchag', {
          'sitekey' : '6Levq8saAAAAAOEU55ISv94V09nnU6MY4HrzbqmI',
          'theme' : 'light'
        }); 
};
</script>
<script>
function gcaptchacheck() {
	(function($) {
   var response = grecaptcha.getResponse(widgetId1);
   if(response != ""){
		jQuery("#tohide").hide();
		jQuery(".final").show();
		jQuery(".final").addClass("animated");
		setTimeout(function() {
    	jQuery(".final").removeClass("animated");
  	}, 3000);
   }else{
     alert("Please complete the captcha!");
   }
	})(jQuery);
}
</script>