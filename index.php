<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta charset="UTF-8"/> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Galllery</title>
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
         text-align: center;    
     }
     div.album {
         display: block;
         float: left;
     }
     a.album {
         text-decoration: none;
     }
     img.album {
         max-width: 100%;
     }
  </style>
</head>
<body>
<?php

if ($handle = opendir(__DIR__ . '/albums')) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        if ($entry != '..' && $entry != '.' && !is_file(__DIR__.'/'.$entry)) {
?>

<div class="album">
  <a href="albums/<?php echo $entry;?>" class="album">
     <img src="images/album.png" class="album"/><br/>
     <?php echo "$entry"; ?>
  </a>
</div>

<?php
        }
    }
    closedir($handle);
}
?>
</body>
