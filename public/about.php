<?php 
	require_once("../_includes/run_first_addon.php"); 

	$latest_filemtime = $server->get_latest_filemtime(SITE_ROOT.'public/','php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once(SITE_ROOT."_includes/global_header_addon.php"); ?>
	<title><?php lang('เกี่ยวกับเว็บไซต์นี้',TRUE); ?></title>
</head>
<body lang="<?php echo $page->language; ?>">
<?php require_once(SITE_ROOT."_includes/navigation_bar.php"); ?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-11 col-centered">
				<h1><?php lang('เกี่ยวกับเว็บไซต์นี้',TRUE); ?></h1>
			</div>
		</div>
	</div>
	<div class="container-fluid fixed_max_width">
		<div class="row">
			<div class="col-11 col-sm-11 col-md-10 col-lg-9 col-xl-8 col-centered">
				<div class="row">
					<div class="col-12 col-md-8">
						<h2><?php lang('เวอร์ชั่น'); ?></h2>
						<ul>
							<li>2.0</li>
						</ul>
						<h2><?php lang('อัพเดทล่าสุด'); ?></h2>
						<ul>
							<li><?php echo date("l F jS, Y",$latest_filemtime); ?></li>
						</ul>
						<h2><?php lang('ผู้สร้าง'); ?></h2>
						<ul>
							<li><?php lang('อิทธิกร ตราดุษฎี',TRUE); ?></li>
						</ul>
						<h2><?php lang('ฟีเจอร์'); ?></h2>
						<ul class="feature">
							<li><?php lang('เนื้อหาสองภาษา (ไทย-อังกฤษ)'); ?></li>
							<li>Responsive Design <?php lang('ตอบสนองกับทุกขนาดจอภาพ'); ?></li>
							<li><?php lang('พับเก็บเนื้อหาอัตโนมัติเมื่อเปิดในจอภาพขนาดเล็ก เพื่อย่นความยาวของเพจ'); ?></li>
							<li><?php lang('ปลอดภัยจากสแปมอีเมลล์โดยการใช้แบบฟอร์มติดต่อแทนการลงอีเมลล์แอดเดรสโดยตรง'); ?></li>
							<li><?php lang('ปลอดภัยจากบ็อทด้วย reCaptcha v.2 จาก Google เมื่อจะส่งอีเมลล์'); ?></li>
							<li><?php lang('&quot;อัพเดทล่าสุด&quot; เปลี่ยนเองอัตโนมัติโดยอ้างอิงจาก Last Modified Time ของไฟล์ที่ใหม่ที่สุด'); ?></li>
							<li><?php lang('แถบด้านล่างปรับตำแหน่งเองอัตโนมัติหากความสูงของเพจน้อยกว่าความสูงของหน้าจอ'); ?></li>
							<li>Object-oriented PHP <?php lang('ทำให้ง่ายต่อการแก้ไข และดูแล'); ?></li>
						</ul>
					</div>
					<div class="col-12 col-md-4">
						<h2><?php lang('เทคโนโลยีที่ใช้'); ?></h2>
						<ul>
							<li>Object-oriented PHP</li>
							<li>MySQL</li>
							<li>CSS3</li>
							<li>SASS</li>
							<li>jQuery</li>
							<li>Bootstrap 4</li>
							<li>Font Awesome</li>
							<li>PHPMailer</li>
							<li>Facebook SDK</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- END WRAPPER HERE -->
<?php require_once(SITE_ROOT."_includes/bottom_bar.php"); ?>
<?php require_once(SITE_ROOT."_includes/global_script.php"); ?>
</body>
</html>