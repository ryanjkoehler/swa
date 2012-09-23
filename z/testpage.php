<?php $this->viewVars['pageTitle'] = $chart['Chart']['title']; ?>
<?php if(isset($chart['Chart']['meta_description'])): ?>
	<?php $this->viewVars['metadescription'] = $chart['Chart']['meta_description']; ?>
<?php endif; ?>
<?php if(isset($chart['Chart']['meta_keywords'])): ?>
	<?php $this->viewVars['metakeywords'] = $chart['Chart']['meta_keywords']; ?>
<?php endif; ?>

<div id="main">
	<h2 class="sp-header">Chart Detail</h2>
	<div class="detail data-detail">
		<h1><?php echo $chart['Chart']['title'];?></h1>
		<div class="chart">
			<?php if(isset($chart['Chart']['subtitle'])): ?>
				<h2><?php echo $chart['Chart']['subtitle'];?></h2>
			<?php endif; ?>
			<?php if(isset($chart['Chart']['image_file_path'])): ?>
				<?php echo $html->link($html->image(Configure::read('imageMed') . $chart['Chart']['image_file_path'], array('alt' =>  $chart['Chart']['title'].' chart')),  Configure::read('imageOrig') . $chart['Chart']['download_image_file_path'], array('escape' => false));?>
			<?php endif; ?>
		</div>
		<?php if(isset($chart['Chart']['body'])): ?>
			<?php echo $chart['Chart']['body'];?>
		<?php endif; ?>
		<div class="source">
			<?php if(isset($chart['Chart']['source'])): ?>
				<?php echo $chart['Chart']['source'];?>
			<?php endif; ?>
		</div>
		
		<?php if(isset($chart['Subject']['0'])): ?>
		<div class="meta">
			<h4>Subject</h4>
			<ul>
			<?php $tags = array(); ?>
			<?php foreach($chart['Subject'] as $tagChart):?>
				<?php 
					$tagLink = $html->link($tagChart['title'], array('controller'=>'charts', 'action'=>'subject', $tagChart['id']));
					array_push($tags, '<li>' . $tagLink . '</li>' );
				?>
			<?php 
				endforeach; 
				echo implode(", ", $tags);
			?>
			</ul>
		</div>
		<?php endif; ?>
		
		
		<?php if(isset($chart['Demographic']['0'])): ?>
		<div class="meta">
			<h4>Demographic</h4>
			<ul>
			<?php $tags = array(); ?>
			<?php foreach($chart['Demographic'] as $tagChart):?>
				<?php 
					$tagLink = $html->link($tagChart['title'], array('controller'=>'charts', 'action'=>'demographic', $tagChart['id']));
					array_push($tags, '<li>' . $tagLink . '</li>' );
				?>
			<?php 
				endforeach; 
				echo implode(", ", $tags);
			?>
			</ul>
		</div>
		<?php endif; ?>
		
		<!-- <?php if(isset($chart['Feature']['0'])): ?>
		<div class="meta">

			<h4>Feature tags</h4>
			<ul>
			<?php $tags = array(); ?>
			<?php foreach($chart['Feature'] as $tagChart):?>
				<?php 
					$tagLink = $html->link($tagChart['title'], array('controller'=>'charts', 'action'=>'feature', $tagChart['id']));
					array_push($tags, '<li>' . $tagLink . '</li>' );
				?>
			<?php 
				endforeach; 
				echo implode(", ", $tags);
			?>
			</ul>
		</div>
		<?php endif; ?> -->
		
		<?php if(isset($chart['Feature']['0'])): ?>
		<div class="meta">

			<ul>
				
				This chart is part of the
				<strong>
			<?php $tags = array(); ?>
			<?php foreach($chart['Feature'] as $tagChart):?>
				<?php 
					$tagLink = $html->link($tagChart['title'], array('controller'=>'charts', 'action'=>'feature', $tagChart['id']));
					array_push($tags, '<li>' . $tagLink . '</li>' );
				?>
			<?php 
				endforeach; 
				echo implode(", ", $tags);
			?>
			</strong>
			feature.
			
		</div>
		<?php endif; ?>
		
		
		
	</div>
	<div class="utilities">
		<div class="print-feature">
		</div>
		<div class="download-share">
			<span class="downloads">Download:
				<ul> 
					<!--<?php if(isset($chart['Chart']['download_pdf_file_path'])): ?>
						<li><?php echo $html->link('PDF', Configure::read('downloadFiles') . $chart['Chart']['download_pdf_file_path'], array('class' => 'pdf'));?></li>
					<?php endif; ?>-->
					<?php if(isset($chart['Chart']['download_file_file_path'])): ?>
						<li><?php echo $html->link('Excel', Configure::read('downloadFiles') . $chart['Chart']['download_file_file_path'], array('class' => 'excel'));?></li>
					<?php endif; ?>
					<?php if(isset($chart['Chart']['download_image_file_path'])): ?>
						<li><?php echo $html->link('Hi-Res', Configure::read('imageOrig') . $chart['Chart']['download_image_file_path'], array('class' => 'hires'));?></li>
					<?php endif; ?>
				</ul>
			</span>
			<span class="embed-feature"></span>
			<span class="share-chart">Share: <a class="addthis_button" href="http://www.addthis.com/bookmark.php"><img src="http://s7.addthis.com/static/btn/sm-plus.gif" width="16" height="16" alt="Share" /></a></span>
		</div>
	</div>
</div>
<div id="aside">

	<?php echo $this->element('explore'); ?>
	
	<?php echo $this->element('promo'); ?>
	
	<?php echo $this->element('features'); ?>
	
</div>
<div id="embed-code">
	<div class="boxy-content">
		<p>Use the code below to embed this chart:</p>
		<textarea rows="5" cols="30" id="embed-code-text" name="embed-code-text"><script type="text/javascript">document.write('<?php echo $html->link($html->image(substr(Router::url('/', true),0,-1) . Configure::read('imageMed') . $chart['Chart']['image_file_path'], array('alt' =>  $chart['Chart']['title'].' chart')), Router::url('', true), array('escape' => false));?>');</script></textarea>
	</div>
</div>