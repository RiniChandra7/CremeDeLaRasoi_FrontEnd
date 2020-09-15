<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$db="cremedelarasoi";
	/*Create connection*/
	$conn = mysqli_connect($servername, $username, $password,$db);
?>
<?php
                            if ($_SESSION['UserName'] == "Guest") {
                                echo '<ul class="dropdown-menu">
                                        <li data-toggle="modal" data-target="#reg"><a>Register</a></li>
                                        <li data-toggle="modal" data-target="#signin"><a>Sign In</a></li>
                                    </ul>';
                            } else {
                                echo '
                                    <ul class="dropdown-menu">
                                        <li><a href="#">My Account</a></li>
                                        <li  onclick="getContributor();"><a href="#">Contribute</a></li>
                                        <li onclick="getFavorites();"><a href="#">Favorites</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li onclick="logout();"><form onsubmit="logout();"><button type="submit">Log Out</button></form></li>
                                    </ul>
                                ';
                            }
                        ?>