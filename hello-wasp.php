<?php
/**
 * *****************************************************************************
 * hello-wasp.php
 * *****************************************************************************
 *
 * Plugin Name:     Hello W.A.S.P. (We ain't sure pal!)
 * Plugin URI:      https://wordpress.org/plugins/hello-wasp/
 * Description:     Hello Blackie is just a Fork of Hello Dolly - with random quotes from the American band W.A.S.P. to tribute the incredible voice of Blackie Lawless.
 * Author:          Markus Pezold <markus.pezold@black-forever.de>
 * Version:         0.1.1
 * Min WP Version:  3.0
 * Author URI:      http://black-forever.de
 * License:         GPLv2 or later
 *
 * @package	hello-wasp
 *
 * *****************************************************************************
 */

/**
 * *****************************************************************************
 * 0. FILE ACCESS
 * *****************************************************************************
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * *****************************************************************************
 * I. WASP Songs - bf_hello_wasp_get_quotes()
 * *****************************************************************************
 * Blackie Lawless Quotes on the Admin Screens
 */
function bf_hello_wasp_get_quotes() {

	/** W.A.S.P. Lyrics - Blackie Lawless on the Microphone, one per line
	Lyrics from: http://www.darklyrics.com */

	$bf_song_quotes = "We ain't sure pal! (Blackie Laweless, 2001)
	I wanna be somebody, Be somebody soon. (I Wanna Be Somebody, 1984)
	You're nobody's slave, nobody's chains are holdin' you. (I Wanna Be Somebody, 1984)
	You don't want no nine to five. (I Wanna Be Somebody, 1984)
	Up high where the whole world's watching me. (I Wanna Be Somebody, 1984)
	I'm gonna be somebody, I'm gonna be somebody. (I Wanna Be Somebody, 1984)
	Magic runs through my fingers, One touch - you'll see! (L.O.V.E. Machine, 1984)
	L.O.V.E. All I need’s my love machine. (L.O.V.E. Machine, 1984)
	I'm a hundred degrees, with wild fantasies. (The Flame, 1984)
	Touch, touch in the flame's desire. Feeling the pain's denial. (Sleeping (In The Fire), 1984)
	I gaze as the flame and fire burn. And cry out the name of which I yearn.  (Sleeping (In The Fire), 1984)
	You're sleeping in the fire. (Sleeping (In The Fire), 1984)
	On Your knees, You shall be on your knees. (On Your Knees, 1984)
	I ride, I ride the winds that bring the rain (Wild Child, 1985)
	A creature of love and I can't be tamed (Wild Child, 1985)
	I'm a wild child, come and love me I want you (Wild Child, 1985)
	I want a fistful, fistful of diamonds (Fistful Of Diamonds, 1985)
	I live for the glory and fame (Fistful Of Diamonds, 1985)
	I want a fistful, fistful of diamonds (Fistful Of Diamonds, 1985)
	The millions are calling my name (Fistful Of Diamonds, 1985)
	I'm blind in Texas, the lone star is hot tonight (Blind in Texas, 1985)
	I'm blind in Texas, the cowboys have taken my eyes (Blind in Texas, 1985)
	Hey dude, let's party (Blind in Texas, 1985)
	Raisin hell in Austin just after sundown (Blind in Texas, 1985)
	A thousand times I had this dream, the flag was high I heard a scream (The Last Command, 1985)
	Ravens have bore me wings to fly. (Raven Heart, 2001)
	One crimson kiss is bleeding. My raven heart. (Raven Heart, 2001)
	Charisma - do you know my name. I'm the God that you pray. (Charisma, 2001)
	I know you hate to Love me, love me. (Hate To Love Me, 2001)
	My black bone torso's Bleeding me. (Black Bone Torso, 2002)";

	// Here we split it into lines.
	$bf_hello_wasp_quotes = explode( "\n", $bf_song_quotes );

	// And then randomly choose a line.
	return wptexturize( $bf_hello_wasp_quotes[ mt_rand( 0, count( $bf_hello_wasp_quotes ) - 1 ) ] );

}

/**
 * *****************************************************************************
 * bf_display_wasp_quotes()
 * ******************************************************************************
 * This just echoes the chosen line, we'll position it later
 */
function bf_display_wasp_quotes() {

	$chosen = bf_hello_wasp_get_quotes();
	echo '<p class="wasp-quotes" class="lyrics">' . esc_html( $chosen ) . '</p>';

}

// Now we set that function up to execute when the admin_notices action is called.
// Let the magic voice sing.
add_action( 'admin_notices', 'bf_display_wasp_quotes' );

/**
 * *****************************************************************************
 * II. CSS enhancement for the Admin Head (Positioning of the paragraph)
 * *****************************************************************************
 * bf_hello_wasp_css()
 * *****************************************************************************
 */
function bf_hello_wasp_css() {

	// Paying attention to positioning for right-to-left languages.
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	.wasp-quotes {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
	}
	.focus-off .wasp-quotes {
		display: block;
	}
	.focus-on .wasp-quotes {
		display: none;
	}
	</style>
	";
}

add_action( 'admin_head', 'bf_hello_wasp_css' );

?>
