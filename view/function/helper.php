<?php
/**
 * View helper functions
 */



/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param string $size Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $default Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $rating Maximum rating (inclusive) [ g | pg | r | x ]
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function getGravatar($email, $img = false, $size = 80, $default = 'mm', $rating = 'g', $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$size&d=$default&r=$rating";
    if ($img) {
        $url = '<img src="' . $url . '" alt="' . $email . '"';
        foreach ($atts as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }
        $url .= ' />';
    }
    return $url;
}
