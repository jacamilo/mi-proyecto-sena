<?php

namespace Drupal\sgdp_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;

/**
 * @file
 * Render a node inside a block.
 */

/**
 * Provides a 'ClienteBlock' block.
 *
 * @Block(
 *   id = "homecp_block",
 *   admin_label = @Translation("HomeCP Block"),
 *   category = @Translation("SGDP")
 * )
 */
class HomeCP extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_user = \Drupal::currentUser();
    $rol = NULL;
    if ($current_user->isAuthenticated()) {
      $uid = $current_user->id();
      $load = User::load($uid);
      $rol = $load->field_tipo_de_usuario->value ?? '';
    }

    $build['#cache']['max-age'] = 0;
    $build['#theme'] = 'homecpblock';
    $build['#rol_user'] = $rol;
    return $build;
  }

}
