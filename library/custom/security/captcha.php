<?php

namespace WebMasterWill\Library\Custom\Security;

/**
 * 
 */
class Captcha
{

	public function generateCaptchaImg() {

		$image = imagecreatetruecolor(200, 50);       
        $background_color = imagecolorallocate($image, 255, 255, 255);  
        imagefilledrectangle($image,0,0,200,50,$background_color); 
 
        $line_color = imagecolorallocate($image, 64,64,64);
        $number_of_lines=rand(3,7);
 
        for($i=0;$i<$number_of_lines;$i++)
        {
            imageline($image,0,rand()%50,250,rand()%50,$line_color);
        }
 
        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }  
 
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        $text_color = imagecolorallocate($image, 0,0,0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
            $word.=$letter;
        }
 
        $_SESSION['captcha_string'] = $word;
 
        imagepng($image, "captcha_image.png");

        return $image;

	}

	public function generateImg($captcha_string) {

		$img = imagecreatetruecolor(200, 50);
 
		imageantialias($img, true);
		 
		$colors = [];
		 
		$red = rand(125, 175);
		$green = rand(125, 175);
		$blue = rand(125, 175);
		 
		for($i = 0; $i < 5; $i++) {
		  $colors[] = imagecolorallocate($img, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
		}
		 
		imagefill($img, 0, 0, $colors[0]);
		 
		for($i = 0; $i < 10; $i++) {
		  imagesetthickness($img, rand(2, 10));
		  $rect_color = $colors[rand(1, 4)];
		  imagerectangle($img, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
		}

		 
		$black = imagecolorallocate($img, 0, 0, 0);
		$white = imagecolorallocate($img, 255, 255, 255);
		$textcolors = [$black, $white];

		$fonts = ['../assets/fonts/AlexBrush-Regular.ttf', '../assets/fonts/Rubik-Regular.ttf'];

		$string_length = 6;
		 
		for($i = 0; $i < $string_length; $i++) {
		  $letter_space = 170/$string_length;
		  $initial = 15;
		   
		  imagettftext($img, 24, rand(-15, 15), $initial + $i*$letter_space, rand(25, 45), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
		}

		imagepng($img, "captcha_image.png");

		return $img;

	}

	function generate_string($input, $strength = 5) {
	    $input_length = strlen($input);
	    $random_string = '';
	    for($i = 0; $i < $strength; $i++) {
	        $random_character = $input[mt_rand(0, $input_length - 1)];
	        $random_string .= $random_character;
	    }
	  
	    return $random_string;
	}

}