<div id="main">
	<h2 class="sp-header">Error</h2>
	<div class="detail">
		<h1>Sitemap</h1>
		<p>http://www.stateofworkingamerica.org</p>
		<ul id="nav-404" class="clearfix">
			<li><?php echo $html->link('About the State of Working America', array('controller'=>'pages', 'action'=>'about')); ?></li>
			<li id ="features-nav">
				Features
				<ul>
				<?php foreach($features as $key => $feature):?>
					<li><?php echo $html->link($feature, array('controller'=>'features', 'action'=>'view', $key)); ?></li>
				<?php endforeach; ?>
				</ul>
			</li>
			<li id ="subjects-nav">
				Subjects
				<ul>
				<?php foreach($subjects as $key => $subject):?>
					<li><?php echo $html->link($subject, array('controller'=>'charts', 'action'=>'subject', $key)); ?></li>
				<?php endforeach; ?>
				</ul>
			</li>
			<li id ="demographics-nav">
				Demographics
				<ul>
				<?php foreach($demographics as $key => $demographic):?>
					<li><?php echo $html->link($demographic, array('controller'=>'charts', 'action'=>'demographic', $key)); ?></li>
				<?php endforeach; ?>
				</ul>
			</li>
		</ul>
		
	</div>
</div>
<div id="aside">
	
	<?php echo $this->element('promo'); ?>
	
	<?php echo $this->element('explore'); ?>
	
</div>