<?php

    require_once __DIR__.'/src/Barcode128.class.php';

    $valor = $_POST["valor"];

    function generar($code) {

        // A font file located in the same directory
        // http://openfontlibrary.org/en/font/hans-kendrick
        //$font = __DIR__."/data/HansKendrick-Regular.ttf";
        $font = __DIR__."/data/Interleaved 2of5.ttf";

        // corresponding fontsize in px
        $fontSize = 12;

        // height of the barcode in px
        $height = 150;

        // create an Object of BarCode128 Class
        $barcode = new AMWD\BarCode128($code, $height);

        // OPTIONAL: add the font
        // if not: no Text can be written (only bars)
        $barcode->addFont($font, $fontSize);
        $barcode->ShowCode(false);
        // OPTIONAL: add the text above the barcode
        //$barcode->CustomText($text);

        /*
        * with $barcode->draw() the raw image will be echoed to the stdout
        * with $barcode->save('barcode.jpg') the image will be saved as jpg
        **/

        $data = $barcode->get();
        //$barcode->save($code.'.png');        
        return $data;
    }

    $imageData = generar($valor);
    $image = $valor.'.png';
    $imageData = base64_encode($imageData);

    $src = 'data: image/png;base64,'.$imageData;
    echo '<img src="'.$src.'">';
    echo $valor;
?>

<a href="index.html">Volver</a>
