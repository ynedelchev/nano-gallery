<!DOCTYPE html>
<?php
$dir = basename(__DIR__);

function makeThumb($updir, $img, $id, $MaxWe=1024,$MaxHe=700){
    $arr_image_details = getimagesize($img); 
    $width = $arr_image_details[0];
    $height = $arr_image_details[1];

    $percent = 100;
    if($width > $MaxWe)                        { $percent = floor(($MaxWe * 100) / $width); }
    if(floor(($height * $percent)/100)>$MaxHe) { $percent = (($MaxHe * 100) / $height);     }

    if($width > $height) {
        $newWidth=$MaxWe;
        $newHeight=round(($height*$percent)/100);
    } else {
        $newWidth=round(($width*$percent)/100);
        $newHeight=$MaxHe;
    }

    if ($arr_image_details[2] == 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }


    if ($imgt) {
        $old_image = $imgcreatefrom($img);
        $new_image = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        return ImagePNG($new_image, $updir."/".$id.".png");
            
    }
}
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta charset="UTF-8"/> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Галерия <?php echo "$dir";?></title>
  <style>
    @font-face {
        font-family: bgcyrillic;
        src: url(http://bgkalendar.com/fonts/notoserif-regular.ttf);
    }
    * {
      font-family: bgcyrillic;
    }
     body {
         background-color: black;
         color: white;
         text-align: center;
     }
     div.header {
         width: 100%;
         display: block;
         min-height: 50px;
         text-align: center;    
     }
     div.image {
         margin-left: auto;
         margin-right: auto;
         max-width: 1024px;
         display: block;
         border: 2px solid blue;
         border-radius: 20px;
         padding: 20px;
     }
     a.image {
         text-decoration: none;
     }
     img.image {
         max-width: 100%;
         border-radius: 10px; 
         border: 2px solid white;
         object-fit: cover;
     }
  </style>
</head>
<body>
<div class="header">
   <br/>Галерия <?php echo "$dir";?><br/><br/>
</div>
<?php
$isempty = true;
$thumbs = __DIR__ . '/thumbs';
$thumbsfor = array();
if (!file_exists($thumbs)) {
    if (!mkdir($thumbs, 0755)) {
         error_log("Cannot create thumbnails directory '".$thumbs."' for gallery '".$dir."'.");
    }
} else if (!is_dir($thumbs)) {
     error_log("The thumbnails directory '".$thumbs."' is expected to be a directory, but is actually a file. Can't store thumbnails in it.");
} 
if ($handle = opendir(__DIR__)) {
    while (false !== ($entry = readdir($handle))) {
        $pathinfo = pathinfo($entry);
        $ext = $pathinfo['extension'];
        $name = $pathinfo['filename'];
        $ext = ($ext == null) ? '' :  strtolower($ext); 
        if ($entry != 'album.png' && ( $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' )) {
            $isempty = false;
?>

        <div class="image">
        <a href="<?php echo $entry;?>" class="image">
           <?php if (file_exists($thumbs.'/'.$name.'.png')) { ?>
             <img src="<?php echo 'thumbs/'.$name.'.png';?>" class="image"/><br/>
           <?php } else { ?> 
             <?php      $thumbsfor[$entry] = $name; ?>
               <img src="<?php echo $entry;?>" class="image"/><br/>
           <?php } ?>
           <?php echo "$entry"; ?>
        </a>
        </div>
        <br/>
        <br/>

<?php
        } else if ($entry != 'album.png' && ( $ext == 'mp4' || $ext == 'ogg' || $ext == 'webm' || $ext == 'mts' || $ext == 'ogv' )) {
          $isempty = false;
          $format = ($ext == 'ogv') ? 'ogg' : $ext;
?>
        <div class="image">
           <video width="320" controls="true">
             <source src="<?php echo $entry;?>" type="video/<?php echo $format;?>"/>
             <a name="<?php echo $name;?>" href="<?php echo $entry;?>">
               <src img="../../video.png" alt="<?php echo $name;?>"/>
             </a>
           </video>
           <br/>
           <a name="nm<?php echo $name;?>" href="<?php echo $entry;?>"><?php echo "$entry"; ?></a>
        </div>
        <br/>
        <br/>
<?php
        }
    }
    closedir($handle);
}
?>
<?php if ($isempty) {?>
    Галерията е празна
<?php } ?>
<?php
foreach ($thumbsfor as $entry => $name) {
    if (!makeThumb($thumbs, __DIR__.'/'.$entry, $name, 1024, 700)) {
        error_log("Error creating thumbnail for image '".__DIR__.'/'.$entry."' and storing it as '".$thumbs.'/'.$name.".png'");
    }
}
?>
</body>
</html>

