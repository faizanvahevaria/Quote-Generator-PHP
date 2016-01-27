<?php

include('createimage.php');

//settings
$fontSize = 28;
$backgroundPath = "bg.png";
$watrmarkPath = "wm.png";
$font = "Quote.ttf";
//$text = "Surround YOURSELF\nWith those WHO\nBring out BEST\nin YOU,Not the\nStress in YOU.";
$padding = 50; //from edges

//$text 	= $_REQUEST['QUOTE'];
$text = "Our Greatest Glory Is 
Not In Never Falling, 
But In Rising Every Time We Fall.
-Confucius

";

$ID		= 2135;
$AUTHOR	= "Aristophanes";
$GENRE 	= "Inspiration";

$caption = $text . "\n\n#" . str_replace(' ', '', $AUTHOR) . " #" . $GENRE . " #KingsmanMotivation #Motivation #MotivationQuote #MotivationQuotes #DailyMotivation #Inspiration #InspirationQuotes" ;



//create image
$im = imagecreatefrompng($backgroundPath);
$watermark_im = imagecreatefrompng($watrmarkPath);
$imageSize = getimagesize($backgroundPath);
$width = $imageSize[0];
$height = $imageSize[1];

//get textRows
$textRows = GetTextRowsFromText($fontSize, $font, $text, $width - ($padding * 2));

//colors
$colorWhite = imagecolorallocate($im, 255, 255, 255);
$colorBlack = imagecolorallocate($im, 0, 0, 0);
$colorGrey = imagecolorallocate($im, 130, 130, 130);

//border
//imagerectangle($im, 0, 0, $width - 1, $height - 1, $colorGrey);

for($i = 0; $i < count($textRows); $i++)
{
    //text size
    $line_box = imagettfbbox ($fontSize, 0, $font, $textRows[$i]);
    $text_width = GetTextWidth($fontSize, $font, $textRows[$i]); 
    $text_height = GetMaxTextHeight($fontSize, $font, $textRows) * 2.3;

    //align: center 
    $position_center = ceil(($width - $text_width) / 2);

    //valign: middle
    $test = (count($textRows) - $i) - ceil(count($textRows) / 2);
    $position_middle = ceil(($height - ($text_height * $test)) / 2);

    imagettfstroketext($im, $fontSize, 0, $position_center, $position_middle, $colorBlack, $colorWhite, $font, $textRows[$i], 0);
}

// Inserting watermark at the end of text

$x = ceil(($width - 200) / 2);
$y = $position_middle + 10;

imagecopymerge ( $im , $watermark_im , $x , $y , 0 , 0 , 200 , 37 , 100 );

//Image File Name
$file_name = "../../../Quotes/" . $ID . ".png";

imagepng($im,$file_name);
imagedestroy($im);

include('connect.php');

$sqlUpdate = "UPDATE quotes SET STATUS = 1 WHERE ID = " . $ID;

if ($conn->query($sqlUpdate) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

//s$text = str_replace(" ", "</br>", $text);
//echo $text;

?>

<body>
	<form action="CaptionInsert.php" method="post">
		
		<textarea autofocus rows=15 cols=100 id="txtarea" onfocus="SelectAll('txtarea');" name="CAPTION"><?php echo $caption; ?></textarea>
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
		<br>
		<input type="submit" value=" <-- BACK ">
	</form>
	
<script type="text/javascript">
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}

</script>

</body>