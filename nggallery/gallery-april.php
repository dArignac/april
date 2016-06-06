<?php if( !defined( 'ABSPATH' ) ) die ( 'No direct access allowed' ); ?>
<?php if( !empty( $gallery ) ): ?>
	<div id="carousel-april-<?php echo $gallery->name ?>" class="carousel slide carousel-april" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<?php for( $i = 0; $i < count( $images ); $i++ ): ?>
				<div class="carousel-item<?php if ( $i == 0 ): ?> active<?php endif; ?>">
					<img src="<?php echo $images[$i]->url; ?>" class="center-block" alt="<?php echo $images[$i]->description; ?>" />
					<?php if( $images[$i]->description && strlen( trim( $images[$i]->description ) ) > 0 ): ?>
						<div class="carousel-caption">
							<p><?php echo $images[$i]->description; ?></p>
						</div>
					<?php endif; ?>
				</div>
			<?php endfor; ?>
		</div>

		<a class="left carousel-control" href="#carousel-april-<?php echo $gallery->name ?>" role="button" data-slide="prev">
			<span class="icon-prev" aria-hidden="true"></span>
			<span class="sr-only"><?php _e( 'Previous', 'april' ); ?></span>
		</a>

		<a class="right carousel-control" href="#carousel-april-<?php echo $gallery->name ?>" role="button" data-slide="next">
			<span class="icon-next" aria-hidden="true"></span>
			<span class="sr-only"><?php _e( 'Next', 'april' ); ?></span>
		</a>
	</div>
<?php endif; ?>