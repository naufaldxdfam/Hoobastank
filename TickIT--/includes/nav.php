<?php
	
//Sudah Login
if($statusLogin == 1)
{
?>
<div class="navbar-fixed">
    <nav class="white" role="navigation">
    	<div class="nav-wrapper container">
        	<a id="logo-container" href="index.php" class="brand-logo"><img alt="logo" src="logo-24i.png" class="center" width="40px" height="40px"></a>
        	<ul class="right hide-on-med-and-down">
        		<li><a href="schedule.php">Penerbangan</a></li>
          		<li><a href="#"><?php echo $firstname_session ?></a></li>
          		<li><a href="logout.php">Keluar</a></li>
        	</ul>


        	<ul id="nav-mobile" class="side-nav">
        		<li><a href="schedule.php">Penerbangan</a></li>
          		<li><a href="#"><?php echo $firstname_session ?></a></li>
          		<li><a href="logout.php">Keluar</a></li>
        	</ul>
        	<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      	</div>
    </nav>
</div>
<?php
}
//belum login
else
{
?>
<div class="navbar-fixed">
    <nav class="white" role="navigation">
    	<div class="nav-wrapper container">
        	<a id="logo-container" href="index.php" class="brand-logo"><img alt="logo" src="logo-24i.png" class="center" width="40px" height="40px"></a>
        	<ul class="right hide-on-med-and-down">
        		<li><a href="schedule.php">Penerbangan</a></li>
          		<li><a href="login.php">Masuk</a></li>
          		<li><a href="register.php">Daftar</a></li>
        	</ul>


        	<ul id="nav-mobile" class="side-nav">
        		<li><a href="schedule.php">Penerbangan</a></li>
          		<li><a href="login.php">Masuk</a></li>
          		<li><a href="register.php">Daftar</a></li>
        	</ul>
        	<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      	</div>
    </nav>
</div>
<?php
}
?>