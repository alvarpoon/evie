<?php
/*
Plugin Name: SearchWP WPML Integration
Plugin URI: https://searchwp.com/
Description: Integrate SearchWP with WPML
Version: 1.0
Author: Jonathan Christopher
Author URI: https://searchwp.com/

Copyright 2013-2014 Jonathan Christopher

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, see <http://www.gnu.org/licenses/>.
*/

// exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

class SearchWP_WPML {

	function __construct() {
		add_action( 'after_plugin_row_' . plugin_basename( __FILE__ ), array( $this, 'plugin_row' ), 11 );

		add_filter( 'searchwp_query_join', array( $this, 'join_wpml' ), 10, 2 );
		add_filter( 'searchwp_query_conditions', array( $this, 'force_current_language' ) );
	}

	function join_wpml( $sql, $postType ) {
		global $wpdb, $sitepress;

		if( !empty( $sitepress ) && method_exists( $sitepress, 'get_current_language' ) && method_exists( $sitepress, 'get_default_language' ) ) {
			$prefix = $wpdb->prefix;

			$sql .= " LEFT JOIN {$prefix}icl_translations t ON {$prefix}posts.ID = t.element_id ";
			$sql .= " AND t.element_type LIKE 'post_{$postType}' LEFT JOIN {$prefix}icl_languages l ON t.language_code=l.code AND l.active=1 ";
		}

		return $sql;
	}

	function force_current_language( $sql ) {
		global $sitepress;

		if( !empty( $sitepress ) && method_exists( $sitepress, 'get_current_language' ) && method_exists( $sitepress, 'get_default_language' ) ) {
			$currentLanguage = $sitepress->get_current_language();
			$defaultLanguage = $sitepress->get_default_language();

			if( $currentLanguage == $defaultLanguage ) {
				$sql .= " AND (t.language_code='" . $currentLanguage . "' OR t.language_code IS NULL) ";
			} else {
				$sql .= " AND (t.language_code='" . $currentLanguage . "') ";
			}
		}

		return $sql;
	}

	function plugin_row() {
		if( ! class_exists( 'SearchWP' ) ) { ?>
			<tr class="plugin-update-tr searchwp">
				<td colspan="3" class="plugin-update">
					<div class="update-message">
						<?php _e( 'SearchWP must be active to use this Extension' ); ?>
					</div>
				</td>
			</tr>
		<?php }
		else {
			$searchwp = SearchWP::instance();
			if( version_compare( $searchwp->version, '1.1', '<' ) ) { ?>
				<tr class="plugin-update-tr searchwp">
					<td colspan="3" class="plugin-update">
						<div class="update-message">
							<?php _e( 'SearchWP WPML Integration requires SearchWP 1.1 or greater', $searchwp->textDomain ); ?>
						</div>
					</td>
				</tr>
			<?php }
		}
	}

}

new SearchWP_WPML();
