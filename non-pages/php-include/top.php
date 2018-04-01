<!DOCTYPE html>
<html lang="en">
<head>
    <?php //454521 URL SET_UP, the important stuff for linking
    //=============IMPORTANT variable $ROOT_DIRECTORY must be where the project is housed (where the homepage is). ==========================
    $ROOT_DIRECTORY = "safe-sierra-77775.herokuapp.com";        //MUST CHANGE THIS OR THE ENTIRE PROJECT WON'T WORK! Default is "php-magic-linking" because that's the name of the git repo, but you can rename the root folder and everything else will work as long as this variable matches the new name

    //======Magical code to display PHP errors instead of simply a blank page========\\
    //error_reporting(E_ALL);           //longer version = 2 lines
    //ini_set('display_errors', '1');
    ini_set('error_reporting', E_ALL);  //short version


    // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    // PATH SETUP, (making sure it uses https)
    $domain = "http://";     //commenting out next 5 lines didn't work
    if (isset($_SERVER['HTTPS'])) {   //OLD WAY, DIDN'T USE
        if ($_SERVER['HTTPS']) {
            $domain = "https://";
        }
    }

    $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");
    $domain .= $server;     //concatenate server to domain yielding "http://[your_domain_here]" or "https://[your_domain_here]"

    $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");     // Yields string of the url AFTER the domain (so just the folders & exact file). Use htmlentites to remove any suspicous vales that someone may try to pass in. htmlentites helps avoid security issues. //## $_SERVER['PHP_SELF'] returns full url path and file extension, htmlentities() just converts special characters
    $path_parts = pathinfo($phpSelf);       //get an associative array of the url with dirname, basename, extension & filename


    $split_url = explode('/', $path_parts['dirname']);  //split string of directories at each / character

    $baseLevelIndex = 0;        //used to find the "base directory" in the url. If the site's home is in "topLevel/level1/level2/ROOT_SITE_FOLDER_HERE" then it's 3 folders down, so everything should relate the the url array from index 3. We iterate through the URL array to find the $ROOT_FOLDER, then adjust and make a new array
    for ($i = 0; $i < count($split_url); $i++) {     //loop through the URL
        if ($split_url[$i] == $ROOT_DIRECTORY) {     //SUPER IMPORTANT ($ROOT_DIRECTORY must match the BASE folder that the site lives inside)
            $baseLevelIndex = $i;
            break;    //This stops when the 1st occurence of $ROOT_DIRECTORY is found. COMMENT OUT OR REMOVE THIS  break;  if your actual root directory has a parent folder with the exat same name ()
        }
    }
    $folderCountRaw = count($split_url); //this gives an int of how many folders are in the URL
    $folderCount = $folderCountRaw - $baseLevelIndex - 1; //subtract $baseLevelIndex to get the base directory (no matter how deep the file structure, this resets it to a base folder. Then subtract 1 to make the "home" directory be 0 folders up from anything
    //0 means the homepage, 1 means top level pages (file is located in 1 folder below $ROOT_DIRECTORY), 2 means 2 levels down, etc.

    $split_url_adjusted = $split_url;       //array to hold the URL parts AFTER the $ROOT_DIRECTORY (remove any directories ABOVE $ROOT_DIRECTORY)
    for ($i = 0; $i < ($folderCountRaw - $folderCount - 1); $i++) {   //remove the beginning indices of the array (anything before $ROOT_DIRETORY)
        unset($split_url_adjusted[$i]);     //actually remove the element, but the indices will be messed up
    }
    $split_url_adjusted = array_values($split_url_adjusted);     //array_values re-indexes the array. Now this contains a list folderis in the the URL including & AFTER the $ROOT_DIRECTORY

    $containing_folder = $split_url_adjusted[count($split_url_adjusted) - 1]; //IMPORTANT this gets the very last folder in the $split_url_adjusted array (the very last index of an array is 1 less than its size, hence: count($split_url_adjusted) -1 ). This folder "contains" the current page file. Used almost everywhere to tell what page I'm on since all my pages are called 'index.php' but have unique cotaining-folder names
    if ($folderCount == 0) {      //special case for the homepage. Since its actual containing folder is the contents of $ROOT_DIRECTORY, it must be overridden to equal "index". This is to avoid confusion if $ROOT_DIRECTOY is NOT a a good name for the site. This disregards where the site is located & just make the homepage's containing folder = "index". ALSO USED TO PRINT ID'S IN THE BODY TAG FOR EACH PAGE
        $containing_folder = 'index';
    }
    $fileName = $path_parts['filename'];        //not used much, but just in case
    $dirName = $path_parts['dirname'];          //the url of folders (excluding filename). Not used much


    $upFolderPlaceholder = '';                //initialize to empty string (assume it's at the highest folder level)
    for ($i = 0; $i < $folderCount; $i++) {
        $upFolderPlaceholder .= '../';      //append ../ for how many levels the currrent folder is below the root
    }

    //end path setup
    // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%

    ?>
</head>

<?php
if (session_id() == "") session_start();
include_once($upFolderPlaceholder . 'helper/dynamicTable/index.php');
include_once($upFolderPlaceholder . 'db/allDBFunction.php');
include_once($upFolderPlaceholder . 'helper/index.php');
?>

<p align="Left">
    <a href="<?= $upFolderPlaceholder . "index.php" ?>">Home</a>
</p>

<?php
if (isset($_SESSION['publisher'])):?>
    <p align="right">
        <a href="<?= $upFolderPlaceholder . "app/publisher/logout.php" ?>">Logout!</a>
    </p>
    <?php
endif;

if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    echo $_SESSION['msg'];
    $_SESSION['msg'] = '';
}

?>
