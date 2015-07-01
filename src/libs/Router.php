<?php
    /*
     *	Open Smart City Project
     */
    class Router
    {
       /*
        * Redirecting url to a function
        */
        Public static function route($BASEURL, $Regex, $functions)
        {
            //check the path
            if (preg_match($Regex, $BASEURL))
            {
                //callback function
                $functions();
                exit();
            }
        }
    }		
	
?>