<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title; ?></title>

	<?php include('resource.php'); ?>
</head>
<body>
	<?php include('head.php'); ?>
	
    <div id="page_wrap">
        <div id="site_menu">
            <p class="center"></p>
            <center>Explore the Peercoin blockchain by looking for a Block Number (Index), Block Hash, or Transaction ID.</center>
            <div class="menu_item">
                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                    <label for="block_height" class="menu_desc">Enter a Block Number</label><br>
                    <input class="form-control" type="text" name="block_height" id="block_height">
                    <input class="btn btn-success" type="submit" name="submit" value="Jump To Block">
                </form>
            </div>

            <div class="menu_item">
                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                    <label for="block_hash" class="menu_desc">Enter a Block Hash</label><br>
                    <input class="form-control" type="text" name="block_hash" id="block_hash">
                    <input class="btn btn-success" type="submit" name="submit" value="Jump To Block">
                </form>
            </div>

            <div class="menu_item">
                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                    <label for="transaction" class="menu_desc">Enter a Transaction ID</label><br>
                    <input class="form-control" type="text" name="transaction" id="transaction">
                    <input class="btn btn-success" type="submit" name="submit" value="Jump To TX">
                </form>
            </div>
            <div class="menu_item">
                <p class="menu_desc"><center>Find out more on Peercoin (PPC)</center></p>
                <a href="http://peercoin.net" target="_blank"><center>Visit Peercoin.net Official Peercoin Website</center></a>         </div>
                <a href="http://www.peercointalk.org" target="_blank"><center>Official Peercoin Forum</center></a>  
            </div>
        </div>
    
    </div>
    
    <div id="stats_wrap">
        <div class="coin-overview">
            <dl class="last">
                <dt>Connections:</dt>
                <dd><?php echo $network_info["connections"]; ?></dd>
            </dl>
        </div>
    </div>
    
	<?php include('foot.php'); ?>
</body>
</html>