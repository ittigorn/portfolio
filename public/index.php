<?php 
	require_once("../_includes/run_first_addon.php");

	// Takes care of scroll to
	$scroll 		= FALSE;
	$scroll_target 	= '';

	if (isset($_GET["scroll"])) {
		if ($_GET["scroll"] === 'about') {
			$scroll 		= TRUE;
			$scroll_target	= 'about';
		}
	}

?>
<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">

	<!-- FACEBOOK -->
		<meta property="fb:app_id" content="1926874874191572" />
		<meta property="og:url" content="http://www.ittigorn.space/" />
		<meta property="og:title" content="Ittigorn Tradussadee" />
		<meta property="og:description" content="Ittigorn Tradussadee's Portfolio" />
		<meta property="og:image" content="http://www.ittigorn.space/_images/facebook_cover4.jpg" />
		<meta property="og:image:type" content="image/jpeg" />
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />
	<!-- FACEBOOK -->

	<?php require_once(SITE_ROOT."_includes/global_header_addon.php"); ?>
	<title><?php lang('อิทธิกร ตราดุษฎี',TRUE) ?></title>

</head>
<body lang="<?php echo $page->language; ?>">
<?php require_once(SITE_ROOT."_includes/_scripts/facebook_script.php"); ?>
<?php require_once(SITE_ROOT."_includes/navigation_bar.php"); ?>

<div id="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-centered">
				<h1 class="sr-only">Welcome to Ittigorn Tradussadee's Portfolio Website</h1>
				<div class="container-fluid">
					<section class="row" id="intro">
						<div class="col-11 col-md-10 col-centered fixed_max_width">
							<div class="row">
								<div class="col-12 col-lg-5 col-xl-5 left_group">
									<img src="_images/_index/profile_pic.jpg" class="img-fluid" id="profile_pic" />
									<h3 class="slogan"><!-- <a href="computer.php"> --><?php lang("คอมพิวเตอร์"); ?><!-- </a> --> <span>•</span> <!-- <a href="photography.php"> --><?php lang("ถ่ายภาพ"); ?><!-- </a> --> <span>•</span> <!-- <a href="english.php"> --><?php lang("ภาษาอังกฤษ"); ?><!-- </a> --></h3>
									<div class="social">

										<!-- FACEBOOK -->
										<div class="facebook">
											<div class="fb-share-button" data-href="http://www.ittigorn.space/portfolio2/public/index.php" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.ittigorn.space%2Fportfolio2%2Fpublic%2Findex.php&amp;src=sdkpreparse">Share</a></div>
										</div>
										
									</div>
								</div>
								<div class="col-12 col-lg-7 col-xl-7">
									<h2 class="name"><?php lang('อิทธิกร ตราดุษฎี',TRUE) ?></h2>
									<div class="intro_container">
										<?php if ($page->language === 'th') { ?>
											<p>
												สวัสดีครับ ยินดีต้อนรับสู่เว็บพอร์ตโฟลิโอของผม ก่อนอื่นผมอยากจะขออภัยกับดีไซน์ที่ไม่ค่อยปราณีตนักของเว็บนี้เพราะมันยังอยู่ในระหว่างการพัฒนา แต่อย่างไรก็ตามผมดีใจที่คุณสละเวลาเข้ามาดู เนื้อหาในเว็บนี้เกี่ยวกับประสบการณ์การทำงานของผมอย่างละเอียด
											</p>
											<p>
												ผมเป็นผู้พัฒนาเว็บจบปริญญาโทในสาขาระบบข้อมูลคอมพิวเตอร์จากแคลิฟอร์เนีย ตั้งแต่เด็กๆ ผมชอบด้านกราฟฟิก ตัดต่อ และการเขียนโปรแกรมโดยทั่วไปมาตลอด ครั้งแรกที่ทำให้ผมรู้ว่าผมชอบทำอะไรเกี่ยวกับเว็บก็คือตอนมัธยมปลายที่ผมเริ่มใช้ Adobe Dreamweaver สร้างเว็บเล่นๆ สำหรับเพื่อนๆ ในห้องเรียนขึ้นและฝากไว้บน Thai.net ในสมัยนั้นด้วยพื้นที่ฟรี 10 เมกกะไบต์ หลังจากจบมัธยม ผมได้เรียนต่อปริญญาตรีสาขาวิทยุโทรทัศน์และภาพยนตร์แต่ก็ยังคงได้ทำงานและฝึกฝนในทางเทคโนโลยีคอมพิวเตอร์มาตลอด ผมใช้เวลาในยามว่างฝึกเขียนโปรแกรมและพบว่าศาสตร์ที่เรียนเกี่ยวกับมัลติมีเดียต่างๆ นั้นเข้ากันได้ดีกับการสร้างสื่อออนไลน์ เราสามารถสร้างอะไรก็ได้โดยเฉพาะถ้าผสม PHP เข้าไปอีกนิดเพื่อให้ระบบให้มีความตอบสนองมากขึ้น นี่คือเหตุผลหลักที่ทำให้ผมตัดสินใจเรียนต่อปริญญาโทในสาขาคอมพิวเตอร์
											</p>
											<p>
												ผมได้มีโอกาสทำงานทั้งงานฟรีแลนซ์และฟูลไทม์ให้กับบริษัทในสหรัฐอเมริกา นอกจากด้านงานคอมพิวเตอร์แล้วผมก็ได้ทำงานด้านถ่ายภาพอาหารและถ่ายภาพสินค้าอีกมากเช่นกัน โดยเฉพาะตอนที่ผมทำงานอยู่ในบริษัท Roberto Martinez, Inc. ในเมือง San Clemente รัฐแคลิฟอร์เนีย ที่ผมต้องถ่ายภาพเครื่องประดับ, ซ้อนภาพด้วยเทคนิค Focus Stacking และดูแลช่องทางการขายของออนไลน์หลากหลายช่องทางให้กับบริษัท
											</p>
											<p>
												ถ้าหากคุณมีข้อสงสัยหรือติชม ติดต่อผ่านเพจ <a title="ติดต่อผมทางอีเมลล์" href="contact.php">"ติดต่อ"</a> ของผมได้เลยโดยทันที ไม่ต้องลังเลนะครับ
											</p>
										<?php } /* end if */ if ($page->language === 'en') { ?>
											<p>
												Welcome to my online portfolio. First of all, I&#39;d like to apologize for this site&#39;s crude design. It&#39;s still under development and some features are still under construction. Nevertheless, I&#39;m glad you&#39;re here. This site contains my professional info and past experience in detail.
											</p>
											<p>
												I&#39;m a full-stack web developer with a Master of Science in Computer Information Systems degree from California. I&#39;ve always been passionate about graphics, editing programs and programming in general. My first impression was when I used Adobe Dreamweaver to create my first website for my class and hosted it on thai.net when I was in high school. I then went for Broadcasting &amp; Film major for my Bachelor&#39;s degree but always kept a close look at upcoming technology. After tinkering with some programming in my free time, I found that my background in multimedia industry is a good mix when it comes to designing and developing online content; Add a touch of back-end systems using PHP, anything is possible. This was the main reason why I went for another branch for my Master&#39;s.
											</p>
											<p>
												I&#39;ve had a lot of fun working both as a freelancer and as a full-time employee in U.S. companies. In addition to the IT side of work, I&#39;ve also done a fair share of customer service, food and product photography especially when I was working with Roberto Martinez, Inc. in San Clemente, California where taking, retouching jewelry photos and managing eCommerce channels were a part of my job description. That added to my experience significantly.
											</p>
											<p>
												Please feel free to browse around and do not hesitate to contact me through my <a title="Contact Me via email" href="contact.php">Contact Me</a> page if you have any query.
											</p>
										<?php } // end if ?>
										<div class="continue_reading">
											<h3><?php lang('อ่านต่อ'); ?> <i class="fa fa-chevron-down"></i></h3>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</section>

					<section class="row" id="summary">
						<div class="col-12">
							<div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-7 col-centered inner_div">
								<h2 class="section_title"><i class="fa fa-star"></i><?php lang('สรุปคุณสมบัติ'); ?></h2>
								<ul>
									<li><?php lang('ปริญญาโทวิทยาศาสตรมหาบัณฑิตสาขาระบบข้อมูลคอมพิวเตอร์ (MSCIS)'); ?></li>
									<li><?php lang('ปริญญาตรีนิเทศศาสตร์บัณฑิตสาขาวิทยุโทรทัศน์และภาพยนตร์'); ?></li>
									<li><?php lang('เชี่ยวชาญภาษาอังกฤษด้วยคะแนน TOEIC 955 คะแนน (15 มิถุนายน 2560)'); ?></li>
									<li><?php lang('ประสบการณ์ 6 ปีครึ่งที่เรียนและทำงานในสหรัฐอเมริกา'); ?></li>
									<li><?php lang('สามารถสลับการทำงานได้คล่องระหว่างการดีไซน์และพัฒนาเว็บไซต์'); ?></li>
									<li><?php lang('ทักษะเชิงลึกในการทำงานกับ Object-oriented PHP, MySQL, JavaScript และ jQuery'); ?></li>
									<li><?php lang('คุ้นเคยกับการพัฒนาซอฟท์แวร์แบบ Progressive enhancement และสภาพแวดล้อมการทำงานแบบ Agile Development'); ?></li>
									<li><?php lang('คุ้นเคยกับการใช้ Git ในการควบคุมเวอร์ชั่น'); ?></li>
									<li><?php lang('มีประสบการณ์ในการสร้าง Custom CMS, จัดการช่องทางการค้า eCommerce, การบริการลูกค้าและการจัดการลูกค้าสัมพันธ์'); ?></li>
									<li><?php lang('มีประสบการณ์ในการดีไซน์เว็บเพจที่ตอบสนองต่อขนาดของหน้าจอ (Responsive web design) โดยใช้ CSS &#47; CSS3 media query และเครื่องมืออื่นๆ เช่น jQuery, CSS Preprocessor (SASS, LESS)'); ?></li>
									<li><?php lang('ประสบการณ์การเขียนฟังก์ชั่นด้วย jQuery, สร้าง Ajax call ที่ตอบสนองต่อผู้ใช้เพื่อดึงเนื้อหาบางส่วนของเพจ, เข้ารหัสและถอดรหัส JSON, อัพเดทตัวแปรของ Session และ ดึงข้อมูลจากฐานข้อมูล'); ?></li>
									<li><?php lang('สามารถสร้างและดัดแปลงเพจได้อย่างที่ลูกค้าต้องการรวมถึงใช้ Framework เช่น Bootstrap หรือเขียนโค้ดเองเพื่อความง่ายต่อการควบคุม'); ?></li>
									<li><?php lang('เปิดรับและฝึกหัดการใช้งาน API ใหม่ๆ อยู่เสมอ เช่น Google Maps API เป็นต้น'); ?></li>
									<li><?php lang('มีประสบการณ์ในการนำ PayPal API และ Payment Gateway (Authorize.net API) เข้ามาใช้กับเว็บเพจและฐานข้อมูล'); ?></li>
									<li><?php lang('มีประสบการณ์ในการสร้าง Email Campaign ใน MailChimp รวมไปถึงการสร้างและส่ง dynamic HTML email เพื่อตอบสนองให้กับผู้รับแต่ละคนแตกต่างกันไปโดยใช้ PHPMailer'); ?></li>
									<li><?php lang('สามารถเขียนโค้ดด้วยมือโดยใช้ HTML, XML, CSS, SASS, PHP, Javascript และ jQuery'); ?></li>
									<li><?php lang('ประสบการณ์การปรับแต่ง, อัพเดท และจัดการ Magento Store'); ?></li>
									<li><?php lang('ประสบการณ์การสร้าง Template สำหรับสร้างสินค้าใหม่ทีละหลายชิ้นผ่านทาง eCommerce หลายๆ ช่องทางเช่น Amazon.com, Overstock.com และ SellerCloud'); ?></li>
									<li><?php lang('คุ้นเคยกับระบบปฏิบัติการที่ใช้ในการพัฒนาเว็บไซต์เช่น Windows และ Linux หลายเวอร์ชั่นเช่น Ubuntu, Raspbian'); ?></li>
									<li><?php lang('ความสามารถในการทำงานเป็นทีมหรือทำงานคนเดียวจนกง่าจะจบโปรเจ็คได้'); ?></li>
									<li><?php lang('ประสบการณ์การทำงานถ่ายภาพ, จัดแสง และแต่งภาพ'); ?></li>
								</ul>
								<div class="continue_reading">
									<h3><?php lang('อ่านต่อ'); ?> <i class="fa fa-chevron-down"></i></h3>
								</div>
							</div>
						</div>
					</section>

					<section class="row" id="info">
						<div class="col-11 col-md-10 col-centered fixed_max_width">
							<div class="container-fluid">
								<div class="row">
									<div class="col-12">
										<h2 class="section_title core"><i class="fa fa-thumb-tack"></i><?php lang('ความสามารถหลัก'); ?></h2>
									</div>
								</div>
								<div class="row core">
									<div class="col-10 col-sm-6 col-lg-4">
										<p>Full-Stack Development</p>
										<p>JavaScript &amp; jQuery</p>
										<p>Bootstrap 3 / 4</p>
										<p>eCommerce</p>
										<p>Responsive Design</p>
										<p>Adobe Creative Suite</p>
									</div>
									<div class="col-10 col-sm-6 col-lg-4">
										<p>Object-oriented PHP</p>
										<p>Ajax &amp; JSON</p>
										<p>Email Design &amp; Marketing</p>
										<p>Customized CMS</p>
										<p>Professional Photography &amp; Lighting</p>
										<p>Professional Photo / Video Editing</p>
									</div>
									<div class="col-10 col-sm-6 col-lg-4">
										<p>MySQL Database</p>
										<p>SASS &amp; LESS</p>
										<p>Payment Gateway Integration</p>
										<p>Graphic Design</p>
										<p>Magento Stores</p>
									</div>
									<div class="continue_reading">
										<h3><?php lang('อ่านต่อ'); ?> <i class="fa fa-chevron-down"></i></h3>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<h2 class="section_title development"><i class="fa fa-level-up"></i><?php lang('การพัฒนาอาชีพ'); ?></h2>
									</div>
									<div class="col-12 col-xl-9 col-centered">
										<ul>
											<li>Project Management Seminar (California University of Management and Sciences - 2015)</li>
											<li>Network Planning and Administration (California University of Management and Sciences - 2014)</li>
											<li>Data Modeling and Database Administration (California University of Management and Sciences - 2014)</li>
										</ul>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<h2 class="section_title development"><i class="fa fa-mortar-board"></i><?php lang('การศึกษา'); ?></h2>
									</div>
									<div class="col-12 col-md-11 col-lg-9 col-xl-7 col-centered">
										<a href="http://www.calums.edu" target="_blank">
											<p>
												California University of Management and Sciences, Anaheim, California, USA
												<br />
												Master of Science in Computer Information Systems, June 2015
											</p>
										</a>
										<a href="http://www.bu.ac.th" target="_blank">
											<p>
												<?php lang('มหาวิทยาลัยกรุงเทพ, กรุงเทพมหานครฯ, ประเทศไทย'); ?>
												<br />
												<?php lang('นิเทศศาสตร์บัณฑิต สาขาวิชาวิทยุโทรทัศน์และภาพยนตร์, ตุลาคม พ.ศ. 2552'); ?>
											</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					</section>

					<section class="row" id="job">
						<div class="col-12">
							<div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-7 col-centered inner_div">
								<div class="container-fluid">
									<div class="row">
										<div class="col-12">
											<h2 class="section_title"><i class="fa fa-briefcase"></i><?php lang('ประวัติการทำงาน'); ?></h2>
										</div>
									</div>
									<div class="row">
										<div class="col-12 job_container">
											<h3 class="year"><span>2017</span></h3>
											<div class="job">
												<h4>Full Stack Developer</h4>
												<p><?php lang('บริษัท เมตา 888 จำกัด'); ?></p>
												<p><?php lang('เมษายน',TRUE); ?> - <?php lang('มิถุนายน',TRUE); ?></p>
												<p><?php lang('พระนครศรีอยุธยา, ประเทศไทย'); ?></p>
												<p><i class="fa fa-external-link"></i> <a href="http://www.yoibrand.com/" target="_blank">www.YoiBrand.com</a></p>
											</div>
											<div class="job">
												<h4>Document Translator</h4>
												<p><?php lang('หจก. พชรภัณฑ์ เทรดดิ้ง'); ?></p>
												<p><?php lang('กุมภาพันธ์',TRUE); ?></p>
												<p><?php lang('กรุงเทพมหานครฯ, ประเทศไทย'); ?></p>
											</div>
											<h3 class="year"><span>2016</span></h3>
											<div class="job">
												<h4>Professional Photographer</h4>
												<p>Thai Laos Food &amp; Market</p>
												<p><?php lang('กรกฎาคม',TRUE); ?> - <?php lang('กันยายน',TRUE); ?> (2 sessions)</p>
												<p>Anaheim, California, USA</p>
											</div>
											<div class="job">
												<h4>Webmaster</h4>
												<p>Roberto Martinez, Inc.</p>
												<p><?php lang('พฤษภาคม',TRUE); ?> - <?php lang('สิงหาคม',TRUE); ?></p>
												<p>San Clemente, California, USA</p>
												<p><i class="fa fa-external-link"></i> <a href="http://www.sterlingessentials.com/" target="_blank">www.SterlingEssentials.com</a></p>
												<p><i class="fa fa-external-link"></i> <a href="http://www.robertomartinez.com/" target="_blank">www.RobertoMartinez.com</a></p>
												<p><i class="fa fa-external-link"></i> <a href="http://wholesale.robertomartinez.com/" target="_blank">Wholesale.RobertoMartinez.com</a></p>
											</div>
											<div class="job">
												<h4>Full Stack Developer</h4>
												<p>Arawan Thai Cuisine</p>
												<p><?php lang('มกราคม',TRUE); ?> - <?php lang('กุมภาพันธ์',TRUE); ?></p>
												<p>Long Beach, California, USA</p>
												<p><i class="fa fa-external-link"></i> <a href="http://www.arawanthailb.com/" target="_blank">www.ArawanThaiLB.com</a></p>
											</div>
											<h3 class="year"><span>2009</span></h3>
											<div class="job">
												<h4>Part-time Administration Staff</h4>
												<p><?php lang('สถานสอนภาษา เอ.ยู.เอ. (ท่าพระ)'); ?></p>
												<p><?php lang('มิถุนายน',TRUE); ?> - <?php lang('กรกฎาคม',TRUE); ?></p>
												<p><?php lang('กรุงเทพมหานครฯ, ประเทศไทย'); ?></p>
											</div>
										</div>
									</div>
								</div>
								<div class="continue_reading">
									<h3><?php lang('อ่านต่อ'); ?> <i class="fa fa-chevron-down"></i></h3>
								</div>
							</div>
						</div>
					</section>

					<section class="row" id="technical">
						<div class="col-12">
							<div class="col-12 col-sm-10 col-md-10 col-lg-9 col-xl-7 col-centered inner_div">
								<div class="container-fluid">
									<div class="row">
										<div class="col-12">
											<h2 class="section_title"><i class="fa fa-cogs"></i><?php lang('ความชำนาญด้านเทคนิค'); ?></h2>
										</div>
									</div>
									<div class="row">
										<div class="col-12 col-md-6">
											<h3><?php lang('การพัฒนาด้านคอมพิวเตอร์ และทักษะการจัดการ'); ?></h3>
											<ul>
												<li>Web Developing</li>
												<li>Responsive Web Design</li>
												<li>Database Design</li>
												<li>Custom CMS designing / developing</li>
												<li>PHP5, PHP7 (Object-oriented &amp; Procedural)</li>
												<li>MySQL</li>
												<li>SQL</li>
												<li>XHTML / HTML5</li>
												<li>XML</li>
												<li>JavaScript / ECMA Script</li>
												<li>jQuery</li>
												<li>AJAX</li>
												<li>JSON</li>
												<li>Bootstrap 3 / 4</li>
												<li>SASS</li>
												<li>CSS / CSS3</li>
												<li>Magento</li>
												<li>Linux (Ubuntu / Raspbian)</li>
												<li>Apache Server</li>
												<li>SSL</li>
												<li>Python</li>
												<li>Java</li>
												<li>Git / GitHub</li>
												<li>WAMP</li>
												<li>LAMP</li>
												<li>Node.js</li>
												<li>Android SDK</li>
											</ul>
										</div>
										<div class="col-10 col-md-6">
											<h3 class="hidden-sm-down" style="opacity: 0;"><?php lang('การพัฒนาด้านคอมพิวเตอร์ และทักษะการจัดการ'); ?></h3>
											<ul class="second_technical_list">
												<li>Android Studio</li>
												<li>PayPal Integration</li>
												<li>Payment Gateway Integration (Authorize.net)</li>
												<li>C, C++</li>
												<li>Adobe Photoshop</li>
												<li>Adobe Photoshop Lightroom</li>
												<li>Adobe Illustrator</li>
												<li>Adobe Premiere Pro</li>
												<li>Adobe After Effects</li>
												<li>Adobe Dreamweaver</li>
												<li>Helicon Focus</li>
												<li>Agile Development</li>
												<li>Project Management</li>
												<li>Microsoft Office
													<ul>
														<li>Word</li>
														<li>Excel</li>
														<li>PowerPoint</li>
														<li>Publisher</li>
													</ul>
												</li>
											</ul>
											<h3><br /><?php lang('ทักษะด้านมัลติมีเดียและกราฟฟิก'); ?></h3>
											<ul>
												<li><?php lang('กราฟฟิกดีไซน์'); ?></li>
												<li><?php lang('แต่งภาพ / ตัดต่อวีดีโอ'); ?></li>
												<li><?php lang('การกระจายสื่อมัลติมีเดีย'); ?></li>
												<li><?php lang('จัดแสงสตูดิโอ / จัดแสงกลางแจ้ง'); ?></li>
												<li><?php lang('ถ่ายภาพอาหาร, อีเว็นท์, สินค้า และงานแต่งงาน '); ?></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="continue_reading">
									<h3><?php lang('อ่านต่อ'); ?> <i class="fa fa-chevron-down"></i></h3>
								</div>
							</div>
						</div>
					</section>

					<section class="row" id="project">
						<div class="col-12">
							<div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-7 col-centered inner_div">
								<div class="container-fluid">
									<div class="row">
										<div class="col-12">
											<h2 class="section_title development"><i class="fa fa-tasks"></i><?php lang('โปรเจ็ค / เว็บไซต์ในประสบการณ์'); ?></h2>
										</div>
										<div class="col-12 col-md-11 col-centered">
											<ul>
												<li>
													<a href="http://www.yoibrand.com" target="_blank">
														<p><?php lang('เว็บไซต์ผลิตภัณฑ์โยอิ ( Yoi )'); ?></p>
														<p class="description">( <?php lang('โปรเจ็คล่าสุดของผม'); ?> )</p>
														<p class="url">www.YoiBrand.com</p>
													</a>
												</li>
												<li>
													<a href="http://www.arawanthailb.com" target="_blank">
														<p><?php lang('ร้านอาหารเอราวัณ ( Arawan Thai Cuisine )'); ?></p>
														<p class="description">( <?php lang('เวอร์ชั่นที่นำไปใช้จริง'); ?> )</p>
														<p class="url">www.ArawanThaiLB.com</p>
													</a>
												</li>
												<li>
													<a href="http://www.ittigorn.space/arawan_old_design/public" target="_blank">
														<p><?php lang('ร้านอาหารเอราวัณ ( Arawan Thai Cuisine )'); ?></p>
														<p class="description">( <?php lang('รีดีไซน์เวอร์ชั่นแรก – สำหรับอ้างอิงเท่านั้น'); ?>' )</p>
														<p class="url">www.ittigorn.space/arawan_old_design</p>
													</a>
												</li>
												<li>
													<p><?php lang('เว็บไซต์ของบริษัท Roberto Martinez, Inc.'); ?></p>
													<p class="description">( <?php lang('เว็บไซต์ที่เกี่ยวข้องกับงานที่ผมเป็นคนดูแลตอนที่ทำงานกับบริษัท Roberto Martinez, Inc.'); ?> )</p>
													<a href="http://www.robertomartinez.com/" target="_blank">
														<p class="url">www.RobertoMartinez.com</p>
													</a>
													<a href="https://sterlingessentials.com/" target="_blank">
														<p class="url">www.SterlingEssentials.com</p>
													</a>
													<a href="http://wholesale.robertomartinez.com/" target="_blank">
														<p class="url">Wholesale.RobertoMartinez.com</p>
													</a>
												</li>
												<li>
													<a href="http://www.ittigorn.space/rm_tools/" target="_blank">
														<p><?php lang('Admin Toolbox สำหรับ Roberto Martinez, Inc.'); ?></p>
														<p class="description">( <?php lang('เวอร์ชั่นจำลองของ Admin Toolbox ที่ผมสร้างเพื่อช่วยทำงานต่างๆ ให้บริษัทโดยอัตโนมัติ URL และ password ถูกเปลี่ยนเพื่อรักษาความลับของบริษัท'); ?> )</p>
														<p class="url">www.ittigorn.space/rm_tools</p>
														<p class="url">** <?php lang('กรุณาติดต่อผมผ่านทางหน้า &quot;ติดต่อ&quot; เพื่อรับ Login และ Password สำหรับเข้าระบบครับ'); ?></p>
													</a>
												</li>
												<li>
													<a href="http://ittigorn.space/nayada_v2_preview/" target="_blank">
														<p><?php lang('เว็บไซต์ร้าน Nayada Thai Cuisine เวอร์ชั่น 2'); ?></p>
														<p class="description">( <?php lang('โปรเจ็คของผมก่อนจะถูกสั่งหยุดเนื่องจากเจ้าของร้านสองคนตกลงกันไม่ได้'); ?> )</p>
														
														<p class="url">www.ittigorn.space/nayada_v2_preview</p>
														<p class="description">* <?php lang('เนื่องจากโปรเจ็คนี้ยังไม่เสร็จ ฟังก์ชั่นบางอย่างอาจใช้ไม่ได้หรือถูกปิดโดยตั้งใจ'); ?></p>
														<p class="url">** <?php lang('กรุณาติดต่อผมผ่านทางเพจ &quot;ติดต่อ&quot; เพื่อรับ Login และ Password สำหรับเข้าระบบครับ'); ?></p>
													</a>
												</li>
												<li>
													<a href="http://www.ittigorn.space/resistor/" target="_blank">
														<p><?php lang('ตัวอ่านค่าความต้านทาน Resistor'); ?></p>
														<p class="description">( <?php lang('โปรเจ็คเสริมที่ผมสร้างขึ้นมาในช่วงเวลาว่างเพื่อช่วยอ่านค่าความต้านทานของ Resistor'); ?> )</p>
														<p class="url">www.ittigorn.space/resistor</p>
													</a>
												</li>	
											</ul>
										</div>
									</div>
								</div>
								<div class="continue_reading">
									<h3><?php lang('อ่านต่อ'); ?> <i class="fa fa-chevron-down"></i></h3>
								</div>
							</div>
						</div>
					</section>

					<section class="row" id="sample">
						<div class="col-11 col-md-10 col-centered fixed_max_width">
							<div class="container-fluid">
								<div class="row">
									<div class="col-12">
										<h2 class="section_title"><i class="fa fa-link"></i><?php lang('โค้ดตัวอย่าง'); ?></h2>
									</div>
									<div class="col-12 col-xl-9 col-centered sample">
										<ul>
											<li>
												<a href="https://github.com/ittigorn/portfolio" target="_blank">
													<p><?php lang('เว็บไซต์พอร์ตโฟลิโอของผม'); ?></p>
													<p class="description">( Object Oriented PHP, Bootstrap 4, SASS )</p>
													<p class="url">github.com/ittigorn/portfolio</p>
												</a>
											</li>
											<li>
												<a href="https://github.com/ittigorn/nayada_v2" target="_blank">
													<p><?php lang('เว็บไซต์ร้าน Nayada Thai Cuisine เวอร์ชั่น 2'); ?></p>
													<p class="description">( Object Oriented PHP, Bootstrap 3, SASS )</p>
													<p class="url">github.com/ittigorn/nayada_v2</p>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</section>

					<section class="row" id="misc">
						<div class="col-11 col-md-10 col-centered fixed_max_width">
							<div class="container-fluid">
								<div class="row">
									<div class="col-12">
										<h2 class="section_title"><i class="fa fa-link"></i><?php lang('แหล่งอ้างอิงอื่นๆ'); ?></h2>
									</div>
									<div class="col-12 col-xl-9 col-centered misc">
										<ul>
											<li>
												<a href="https://www.viewbug.com/member/Petch" target="_blank">
													<p><?php lang('แกลเลอรี่ส่วนตัวของผมบน'); ?> Viewbug.com</p>
													<p class="description">( แกลเลอรี่ส่วนตัวที่รวบรวมภาพต่างๆ ของผมตั้งแต่อดีตถึงปัจจุบัน )</p>
													<p class="url">www.viewbug.com/member/Petch</p>
												</a>
											</li>
											<li>
												<p><?php lang('คุณสุรเชษฐ์ แสนรุ่งเมือง'); ?></p>
												<p class="description">( <?php lang('ผู้ว่าจ้างทำเว็บไซต์ YoiBrand.com และเจ้าของบริษัท'); ?> Meta 888 Co., Ltd. )</p>
												<p class="url"><i class="fa fa-envelope"></i> info@yoibrand.com</p>
												<p class="url"><i class="fa fa-phone"></i> (+66) 95 - 401 - 8179</p>
											</li>
											<li>
												<p>Professor William Wimberly</p>
												<p class="description">( <?php lang('อาจารย์ที่ดีที่สุดคนหนึ่งที่ผมได้รับเกียรติเป็นลูกศิษย์ในหลายๆ คลาสขณะที่เรียนอยู่ที่ CalUMS'); ?> )</p>
												<p class="url"><i class="fa fa-envelope"></i> wrwimberly@earthlink.net</p>
												<p class="url"><i class="fa fa-linkedin"></i> <a href="http://www.linkedin.com/in/wrwimberly" target="_blank">www.linkedin.com/in/wrwimberly</a></p>
											</li>
											<li>
												<p>Aris O Lavranos</p>
												<p class="description">( <?php lang('ผู้จัดการฝ่ายบุคคลบริษัท'); ?> Roberto Martinez, Inc. )</p>
												<p class="url"><i class="fa fa-envelope"></i> aris@rminc.ws</p>
											</li>
											<li>
												<p>Areerak Angkulsit</p>
												<p class="description">( <?php lang('เจ้าของร้านเอราวัณ &quot;Arawan Thai Cuisine&quot;'); ?> )</p>
												<p class="url"><i class="fa fa-phone"></i> (+1) 562 - 426 - 1788</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</section>

				</div>
			</div>
		</div>
	</div>
</div> <!-- END WRAPPER HERE -->
<?php require_once(SITE_ROOT."_includes/bottom_bar.php"); ?>
<?php require_once(SITE_ROOT."_includes/global_script.php"); ?>
<script type="text/javascript">

	$(document).ready(function() {

		function collapse_contents() {

		} // end function

		function expand_sibling_div(clicked_element) {
			var parent = $(clicked_element).parent('div');
		 	$(parent).removeAttr('style');
		 	$(clicked_element).hide();
		} // end function

		var win = {
		 	width : $(window).innerWidth(),
		 	height : $(window).innerHeight()
		}

		if (win.width < 768) {
			$('div.continue_reading').each(function(index, el) {
				var parent = $(this).parent('div');
				$(this).show();
			 	$(parent).css({
			 		height: '300px'
			 	});
			});
		 	
		} // end if

		// Events
		$('div.continue_reading').click(function(event) {
		 	expand_sibling_div($(this));
		});

	});

</script>
</body>
</html>