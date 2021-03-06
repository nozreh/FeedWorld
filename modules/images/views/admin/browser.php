<a class="feedworldcms_close" href="#"><img title="Close" src="<?php echo $this->config->item('staticPath'); ?>/images/btn_close.png"/></a>
<a href="<?php echo site_url('/admin/images'); ?>" class="feedworldcms_button feedworldcms_confirm" target="_top">Manage Images</a>
<div style="clear:both;"></div>

<div id="feedworldcms_scroll">

<?php if (@$folders): ?>

	<?php foreach ($folders as $folder): ?>
		<?php if ($folder['images']): ?>	
			<ul>
				<li class="feedworldcms_title"><a href="#" class="feedworldcms_togglefolder"><strong><?php echo $folder['folderName']; ?></strong></a></li>
			</ul>
		
			<ul>
				<?php foreach ($folder['images'] as $image):
					$imageData = $this->uploads->load_image($image['imageRef']);
					$imagePath = $imageData['src'];
					$imageData = $this->uploads->load_image($image['imageRef'], true);				
					$imageThumbPath = $imageData['src'];
				?>
					<li class="fixed">
						<div class="feedworldcms_thumb">
							<a href="#" class="feedworldcms_insertimage" title="<?php echo $image['imageRef']; ?>"><?php echo ($thumb = display_image($imageThumbPath, $image['imageName'], 50)) ? $thumb : display_image($imagePath, $image['imageName'], 50); ?></a>
						</div>
						<div class="feedworldcms_description">
							<a href="#" class="feedworldcms_insertimage" title="<?php echo $image['imageRef']; ?>"><?php echo $image['imageRef']; ?></a>
						</div>	
					</li>
				<?php endforeach; ?>
					
			</ul>
		<?php endif; ?>
	<?php endforeach; ?>

	<ul>
		<li class="feedworldcms_title"><a href="#" class="feedworldcms_togglefolder"><strong>Other Images</strong></a></li>
	</ul>

<?php endif; ?>

<?php if ($images): ?>

	<ul>
		<?php foreach ($images as $image):
			$imageData = $this->uploads->load_image($image['imageRef']);
			$imagePath = $imageData['src'];
			$imageData = $this->uploads->load_image($image['imageRef'], true);				
			$imageThumbPath = $imageData['src'];
		?>
			<li class="fixed">
				<div class="feedworldcms_thumb">
					<a href="#" class="feedworldcms_insertimage" title="<?php echo $image['imageRef']; ?>"><?php echo ($thumb = display_image($imageThumbPath, $image['imageName'], 50)) ? $thumb : display_image($imagePath, $image['imageName'], 50); ?></a>
				</div>
				<div class="feedworldcms_description">
					<a href="#" class="feedworldcms_insertimage" title="<?php echo $image['imageRef']; ?>"><?php echo $image['imageRef']; ?></a>
				</div>	
			</li>
		<?php endforeach; ?>
			
	</ul>
	
<?php else: ?>

	<p class="clear">You haven't uploaded any images yet.</p>

<?php endif; ?>

</div>