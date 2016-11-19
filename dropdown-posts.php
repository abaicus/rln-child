<?php

class RLN_Posts_Pages_Dropdown extends WP_Customize_Control {

	public function render_content() {

		$the_posts = array( '-' => __( 'Select post', 'rln-child' ) );

		// Loop the posts.
		$options  = array();
		$postargs = wp_parse_args( $options, array(
			'numberposts' => '-1',
			'post_type'   => array(
				'post',
				'page',
			),
		) );

		$posts = get_posts( $postargs );

		foreach ( $posts as $post ) {
			$the_posts[ $post->ID ] = $post->post_title;
		}

		if ( empty( $the_posts ) )
			return;
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<select <?php $this->link(); ?>>
				<?php
				foreach ( $the_posts as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
				?>
			</select>
		</label>
		<?php
	}

}