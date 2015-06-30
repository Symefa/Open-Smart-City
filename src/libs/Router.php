<?php
    /*
     *	Open Smart City Project
     */
    class Router
    {
       /*
        * Redirecting url to a function
        */
        Public static function route($BASEURL, $URL, $functions)
        {
            //check the path
            if (strpos($BASEURL, $URL))
            {
                //callback function
                $functions();
                exit();
            }
        }
    }		
	
?>