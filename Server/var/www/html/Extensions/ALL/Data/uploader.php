<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META name="robots" content="noindex, nofollow">

        <!-- 
          /*********************************************************
          ** @project GeniSys AI Location UI
          ** @author  Adam Milton-Barker <www.adammiltonbarker.com>
          **********************************************************/	
        -->

    </head>
    <body>
    
      <?php 
      
        function create_square($src, $dest, $dim, $jpeg_quality=90)
        {
          $img = imagecreatefromjpeg($src); 
          $cropped = imagecrop($img, ['x' => 0, 'y' => 0, 'width' => $dim, 'height' => $dim]); 
          if ($cropped !== FALSE) { 
              imagejpeg($cropped, $dest); 
          }
        }

        $count=0;
        foreach($_FILES["fileSelector"]['name'] as $filename):
          if ($_FILES["fileSelector"]['tmp_name'][$count] != ""):
            if(move_uploaded_file($_FILES["fileSelector"]['tmp_name'][$count], "Test/" .$filename)):
              create_square("Test/" .$filename, "Test/" .$filename, 600, $jpeg_quality=90);
              $status = "OK";
            else:
              $status = "FAILED";
            endif;
          else:
            $status = "EMPTY";
          endif;
            $count += 1;
        endforeach;
      ?>
      
      <script type="text/javascript" src="/Media/vendor/jquery/jquery.min.js"></script>

      <script>

        $( document ).ready(function() {
            parent.location.reload();
        });

      </script>
 
    </body>
</html>