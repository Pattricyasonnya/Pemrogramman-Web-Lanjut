<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <meta name="vieport" content="width+device-width, initial-scale=1">
        <title>PWL 2024</title>
    </head>
    <body>
        <h1>Daftar Dosen</h1>
        <ol>
        <li><?php echo $dosen[0];?></li>
        <li><?php echo $dosen[1];?></li>
        <li><?php echo $dosen[2];?></li>
        <li><?php echo $dosen[3];?></li>
        <li><?php echo $dosen[4];?></li>
        </ol>
    </body>
</html>