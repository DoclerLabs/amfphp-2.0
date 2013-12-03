<?php
/**
 *  This file is part of amfPHP
 *
 * LICENSE
 *
 * This source file is subject to the license that is bundled
 * with this package in the file license.txt.
 * @package Amfphp_Backoffice
 * 
 */
/**
 * Sign in dialog If not checks POST data for login newComer.
 * throws Exception containing user feedback
 * @author Ariel Sommeria-klein
 *
 */
/**
 * includes
 */
require_once(dirname(__FILE__) . '/ClassLoader.php');



$errorMessage = '';
$redirectToHome = false;
$config = new Amfphp_BackOffice_Config();
$showNewComerExplanation = false;

try {
    if (count($config->backOfficeCredentials) == 0) {
        $showNewComerExplanation = true;
        throw new Exception('Sign In is not possible because no credentials were set. ');
    }

    if (isset($_POST['username'])) {
        //user is logging in.
        $username = $_POST['username'];
        $password = $_POST['password'];


        if (isset($config->backOfficeCredentials[$username]) && ($config->backOfficeCredentials[$username] === $password)) {
            if (session_id() == '') {
                session_start();
            }
            if (!isset($_SESSION[Amfphp_BackOffice_AccessManager::SESSION_FIELD_ROLES])) {
                $_SESSION[Amfphp_BackOffice_AccessManager::SESSION_FIELD_ROLES] = array();
            }

            $_SESSION[Amfphp_BackOffice_AccessManager::SESSION_FIELD_ROLES][Amfphp_BackOffice_AccessManager::AMFPHP_ADMIN_ROLE] = true;

            $redirectToHome = true;
        } else {
            throw new Exception('Invalid username/password');
        }
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" type="text/css" href="css/style.css" />

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
        <script type="text/javascript" src="js/amfphp_updates.js"></script>
        <script type="text/javascript">
<?php
echo 'var amfphpVersion = "' . AMFPHP_VERSION . "\";\n";
echo 'var amfphpEntryPointUrl = "' . $config->resolveAmfphpEntryPointUrl() . "\";\n";
if ($config->fetchAmfphpUpdates) {
    echo "var shouldFetchUpdates = true;\n";
} else {
    echo "var shouldFetchUpdates = false;\n";
}
if($showNewComerExplanation){
    echo "var showNewComerExplanation = true;\n";
} else {
    echo "var showNewComerExplanation = false;\n";
}
?>
        </script>  

    </head>
    <body>
        <?php if ($redirectToHome) {
            ?>
            <script>
                window.location = './index.php';
            </script>
            <?php
            return;
        }
        ?>
            <div class="page-wrap">
                <?php require_once(dirname(__FILE__) . '/Header.inc.php'); ?>
            
                <div id='main'>
            
                    <div id = "left">
                        <div class="menu">
                            <form method = "POST">
                                <h3>Sign In</h3>
                                <div class="warning">
                                    <?php echo $errorMessage ?>
                                </div>
                                User Name<br/>
                                <input name = "username"/><br/>
                                Password<br/>
                                <input name = "password" type = "password"/><br/>
                                <input type = "Submit" value = "Sign In"/>
                            
                            </form>
                        
                        </div>                    
                    </div>
                    <div id="right" class="notParamEditor">
                        
                        <div id="newComerExplanation">
                            <span class="warning">Access is disabled by default for security purposes</span>
                        <br/> <br/>
                        <h3>Getting access to the Back Office</h3>
                            
                            <p>To access the Back Office you must first edit its configuration</p>
                            <p>Add some credentials by editing the BackOffice/Config file in the class __construct method:</p>
                            <pre>    <span class="tip">$this-&gt;backOfficeCredentials['yourUserName'] = 'yourPassWord';</span></pre>
                            <br/>
                            <p>Once this is done you should be able to sign in to the Back Office.</p>            
                            <a href="http://www.silexlabs.org/amfphp/documentation/using-the-back-office/">'Using the Back Office' Documentation</a>
                            <br/><br/>
                            <h3>What can you do with the Amfphp Back Office?</h3>

                            With the Amfphp Back Office you can 
                            <ul>
                                <li>Test your services</li>
                                <li>Generate client projects that consume your services</li>
                                <li>Profile your services for performance</li>
                            </ul>
                            <br/>
                            <h3>Some links to get you going</h3>
                            <ul>
                                <li>New to Amfphp? Read <a href="http://www.silexlabs.org/amfphp/documentation/getting-started/">Getting Started</a></li>
                                <li>Upgrading from 1.9? Read <a href="http://www.silexlabs.org/amfphp/documentation/upgrading-from-amfphp-1-9/">Upgrading from 1.9</a></li>
                                <li>Upgrading from 2.0.X and 2.1.x? Read <a href="http://www.silexlabs.org/amfphp/documentation/upgrading-from-2-0-x-and-2-1-x-to-2-2/">Upgrading from 2.0.X and 2.1.x</a></li>
                                <li>Need some help? Read <a href="http://www.silexlabs.org/amfphp/documentation/using-the-forums/">Using the forums</a>  </li>
                            </ul>
                            <br/>
                        </div>
                        
                        <div id="news"><h3>AmfPHP News</h3></div>
                    </div>
                </div>
            </div>
                
            <?php require_once(dirname(__FILE__) . '/Footer.inc.php'); ?>
        <script>
            $(function () {	    
                
                if(showNewComerExplanation){
                    $("#newComerExplanation").hide();
                }
                
                amfphpUpdates.init("#news", null, null, "#latestVersionInfo");
                amfphpUpdates.loadAndInitUi();
                
                //customize header
                $("#tabName").text("Sign In");
                $(".signOutLink").hide();
                $(".newsLink").hide();
                
            });

        </script>
