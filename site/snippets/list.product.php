<?php if(count($products) or $products->count()) { ?>
	<ul class="listing uk-container uk-padding-remove">
	  <?php foreach($products as $product): ?>
		<li class="uk-margin-right uk-margin-bottom">
			<a href="<?php echo $product->url() ?>">
				<?php 
					if ($product->hasImages()) {
						$image = $product->images()->sortBy('sort', 'asc')->first();
					} else {
						$image = $site->images()->find($site->placeholder());
					}
					$thumb = thumb($image,array('height'=>150));
				?>
				<img src="<?php echo $thumb->dataUri() ?>" title="<?php echo $product->title() ?>">

				<div style="max-width: <?php echo $thumb->width() ?>px;" class="uk-margin-small-top uk-grid uk-grid-collapse uk-grid-width-1-2">
					<div>
						<h3 class="uk-margin-remove"><?php echo $product->title()->html() ?></h3>
						<?php if ($product->text() != '') { ?>
							<p class="uk-margin-remove"><?php echo $product->text()->excerpt(80) ?></p>
						<?php } ?>
					</div>

					<div class="uk-text-right">
			    		<?php
			    			$variants = $product->variants()->yaml();
			    			foreach ($variants as $key => $variant) $pricelist[] = $variant['price'];
			    			$priceFormatted = formatPrice(min($pricelist));
			    			if (count($variants) > 1) $priceFormatted = 'From '.$priceFormatted;
						?>
						<span class="uk-button uk-button-primary uk-margin-left"><?php echo $priceFormatted ?></span>
					</div>
				</div>
			</a>
			<a class="fullscreen uk-button uk-padding-remove" href="<?php echo $product->url() ?>/slide">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><path id="fullscreen-icon" d="M157.943,426.942L192.94,462H50V319.062l35.058,34.997l57.253-57.254l72.884,72.886L157.943,426.942z M319.062,50l34.997,35.058l-56.08,56.079l72.885,72.885l56.08-56.08L462,192.938V50H319.062z M85.058,157.943L50,192.94V50h142.938 L157.94,85.058l57.254,57.253l-72.886,72.884L85.058,157.943z M462,319.062l-35.058,34.997l-56.079-56.08l-72.885,72.885 l56.08,56.08L319.062,462H462V319.062z"/></svg>
			</a>
		</li>
	  <?php endforeach ?>
	</ul>
<?php } ?>