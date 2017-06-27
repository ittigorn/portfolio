<!-- DISPLAY ALERTS HERE IF ANY -->
<?php 
	echo $page->generate_alert(); 
?>

	<nav class="navbar navbar-toggleable-md navbar-light bg-faded" id="main_nav">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa fa-bars"></i>
		</button>
		<a class="navbar-brand" href="index.php"><img src="_images/logo.png"></a>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item<?php echo ($page->name === 'index') ? ' active' : ''; ?>">
					<a class="nav-link" href="index.php"><?php lang('สรุปคุณสมบัติ',TRUE); ?></a>
				</li>
				<!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle<?php echo (($page->name === 'computer') || ($page->name === 'photography') || ($page->name === 'english')) ? ' active' : ''; ?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php lang('ความเชี่ยวชาญ',TRUE); ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item<?php echo ($page->name === 'computer') ? ' active' : ''; ?>" href="computer.php"><?php lang('วิทยาศาสตร์คอมพิวเตอร์',TRUE); ?></a>
						<a class="dropdown-item<?php echo ($page->name === 'photography') ? ' active' : ''; ?>" href="photography.php"><?php lang('การถ่ายภาพ',TRUE); ?></a>
						<a class="dropdown-item<?php echo ($page->name === 'english') ? ' active' : ''; ?>" href="english.php"><?php lang('ภาษาอังกฤษ',TRUE); ?></a>
					</div>
				</li> -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php lang('โค้ดตัวอย่าง',TRUE); ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item<?php echo ($page->name === 'computer') ? ' active' : ''; ?>" target="_blank" href="https://github.com/ittigorn/nayada_v2">Nayada Thai Cuisine v.2 (2015)</a>
					</div>
				</li>
				<!-- <li class="nav-item<?php echo ($page->name === 'achievements') ? ' active' : ''; ?>">
					<a class="nav-link" href="achievements.php"><?php lang('รางวัล',TRUE); ?></a>
				</li> -->
				<li class="nav-item<?php echo ($page->name === 'contact') ? ' active' : ''; ?>">
					<a class="nav-link" href="contact.php"><?php lang('ติดต่อ',TRUE); ?></a>
				</li>
			</ul>

			<div class="dropdown-divider hidden-lg-up"></div>

			
			<form class="form-inline mr-0 ml-auto hidden-md-down" action="lang.php" method="post">
				<button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="switch_language" title="<?php lang('Change Language',TRUE); ?>" value="<?php echo htmlentities(basename($_SERVER['REQUEST_URI']), ENT_COMPAT, 'UTF-8'); ?>"><i class="fa fa-globe"></i> <?php lang('EN',TRUE) ?></button>
			</form>

			<!-- HIDDEN WHEN MEDUIM -->
			<form class="form-inline mr-0 ml-auto hidden-lg-up" action="lang.php" method="post">
				<button class="btn btn-outline-primary my-2 my-sm-0 language_button_small" type="submit" name="switch_language" title="<?php lang('Change Language',TRUE); ?>" value="<?php echo htmlentities(basename($_SERVER['REQUEST_URI']), ENT_COMPAT, 'UTF-8'); ?>"><?php lang('Change Language',TRUE) ?></button>
			</form>

		</div>
	</nav>



	<section id="floating_social_link">
		<a class="line_button" href="http://line.me/ti/p/~<?php echo $server->line; ?>" target="_blank">
			<img src="_images/line_sq.jpg" title="<?php lang('ไลน์ของผม',TRUE) ?>">
			<div class="description_container">
				<p>Line</p>
			</div>
		</a>
		<a class="linkedin_button" href="<?php echo $server->linkedin; ?>" target="_blank">
			<img src="_images/linkedin_sq.jpg" title="<?php lang('LinkedIn ของผม',TRUE) ?>">
			<div class="description_container">
				<p>LinkedIn</p>
			</div>
		</a>
		<a class="viewbug_button" href="<?php echo $server->viewbug; ?>" target="_blank">
			<img src="_images/viewbug_sq.jpg" title="<?php lang('Viewbug แกลเลอรี่ของผม',TRUE) ?>">
			<div class="description_container">
				<p>Viewbug</p>
			</div>
		</a>
		<a class="email_button" href="contact.php" target="_self">
			<img src="_images/gmail_sq.jpg" title="<?php lang('ติดต่อผม',TRUE) ?>">
			<div class="description_container">
				<p><?php lang('ติดต่อ',TRUE) ?></p>
			</div>
		</a>
	</section>


<!-- DEBUG SCRIPT OUTPUT -->
<div id="script_output"></div>