<?php include("header.php"); ?>

<?php 

include("connect.php");

while ( TRUE ) {
	$ID = mt_rand(1,5807);
	$sql = "SELECT * FROM quotes WHERE ID = " . $ID ;
	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	if( $row['STATUS'] == 0 )
		break;
} 

$Quote = $row['QUOTE'];
$Quote = ucwords($Quote);
$Quote = $Quote . "\n-" . $row['AUTHOR'];

$conn->close();

?>

    <div class="container">

      <form class="form-horizontal" action="image.php" method="post">
        <div class="form-group">
          <label for="GENRE" class="col-sm-2 control-label">GENRE</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="GENRE" id="GENRE" value="<?php echo $row['GENRE']; ?>">
          </div>
          <label for="AUTHOR" class="col-sm-2 control-label">AUTHOR</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="AUTHOR" id="AUTHOR" value="<?php echo $row['AUTHOR']; ?>">
          </div>
          <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
        </div>
          
          
        <div class="form-group">
          <label for="Log" class="col-sm-2 control-label">Quote</label>
          <div class="col-sm-10">
			<textarea class="form-control" name="QUOTE" rows="10" cols="82" id="Log" style="resize:none"><?php echo $Quote; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="skip.php?ID=<?php echo $ID; ?>"><button type="button" class="btn btn-primary">Reload</button></a>
          </div>
        </div>
        
      </form>
    </div><!-- /.container -->

    <footer class="footer">
      <div class="container">
        
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
