<?php

namespace Drupal\sgdp_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @file
 * Render a node inside a block.
 */

/**
 * Provides a 'HeaderBlock' block.
 *
 * @Block(
 *   id = "header_block",
 *   admin_label = @Translation("Header Block"),
 *   category = @Translation("SGDP")
 * )
 */
class HeaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
      '#title' => "Header Block",
      '#theme' => 'headerblock',
      '#cache' => [
        'max-age' => 0,
        'contexts' => [],
        'tags' => [],
      ],
    ];
  }

}
