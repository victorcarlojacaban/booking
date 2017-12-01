<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Test</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php include_once("functions.php"); 

        if(isset($_POST['submit'])) {
            $weeklyArray = ['weekly', '2_weeks', '3_weeks'];

            $req_often = $_POST['repeat_often'];
            $postDate = $_POST["date"];
            $repeatTimes = $_POST["repeat_times"];

            if (!empty($postDate) && !empty($repeatTimes)) {
                if ($req_often == 'everyday') {
                    $dates = getDatesEveryday($postDate, $repeatTimes);
                } elseif ($req_often == 'weekdays') {
                    $dates = getDatesWeekdays($postDate, $repeatTimes);
                } elseif (in_array($req_often, $weeklyArray)) {

                    $range = 7;

                    if ($req_often == '2_weeks') {
                        $range = $range * 2;
                    } elseif ($req_often == '3_weeks') {
                        $range = $range * 3;
                    }

                    $dates = getDatesWeekly($postDate, $repeatTimes, $range);
                } elseif ($req_often == 'monthly') {
                    $dates = getDatesMonthly($postDate, $repeatTimes);
                } elseif ($req_often == 'yearly') {
                    $dates = getDatesYearly($postDate, $repeatTimes);
                } elseif ($req_often == 'first_of_the_month') {
                    $dates = getDatesFirstMonOfMonth($postDate, $repeatTimes);
                }
        	}
        }

    ?>
	<div class = "page-header">
	   <h1>New Booking</h1>
	</div>
	<br/>
   <div class="container">
        Booking
        <hr>
        	<center>
            <form method="POST" action="index.php">
				 <div class="row">
				  	<div class="col-sm-4">
					  	<div class="form-group">
					        <div class="input-group date">
					              <input type="text" name="date" class="form-control" id="datepicker" placeholder="Start Date">
					        </div>
					    </div>
				  	</div>
				  	<div class="col-sm-6">
				  		<div class="form-group">
				            <select class="form-control" name="repeat_often">
				                <option>Repeat Every</option>
				                <option value="everyday">Everyday</option>
				                <option value="weekdays">Every Weekday</option>
				                <option value="weekly">Every Week</option>
				                <option value="2_weeks">Every 2 Weeks</option>
				                <option value="3_weeks">Every 3 Weeks</option>
				                <option value="monthly">Every Month</option>
				                <option value="yearly">Every Year</option>
				                <option value="first_of_the_month">First Month of Each Month</option>
				             </select>
				        </div>
				        <div class="form-group">
				        <select class="form-control" name="repeat_times">
				            <option>Repeat For</option>
				            <option value="1">1 Time</option>
				            <option value="2">2 Times</option>
				            <option value="3">3 Times</option>
				            <option value="4">4 Times</option>
				            <option value="5">5 Times</option>
				            <option value="6">6 Times</option>
				            <option value="7">7 Times</option>
				            <option value="8">8 Times</option>
				            <option value="9">9 Times</option>
				            <option value="10">10 Times</option>
				          </select>
				     	</div>
				  	</div>
				  	<div class="col-sm-2">
						 <button type="submit" name="submit" class="btn btn-success custom-btn">Confirm</button>
				  	</div>
				</div> 
          </form>
          </center>
        <br/>

		<?php if (!empty($postDate)) : ?>
			<h5>Selected Date: <?php echo  date("F jS, Y", strtotime($postDate));?></h5>
		<?php endif;?><br/>
        <table class="table table-bordered">
            <tr>
                <td><h3>Dates the booking will repeat</h3></td>
            </tr>
            <?php if (!empty($dates)) : 
                    foreach ($dates as $date) : ?>
                         <tr>
                            <td><?php echo $date; ?></td>
                        </tr>
            <?php  endforeach;?> 
            <?php  else: ?>
                   <tr>
                        <td>No dates to Display</td>
                    </tr>
            <?php endif;?>
        </table>
      </div>
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $('#datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        });
    </script>
</body>
</html>