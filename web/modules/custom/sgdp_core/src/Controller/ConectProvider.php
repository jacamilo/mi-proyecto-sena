<?php

namespace Drupal\sgdp_core\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class ConectProvider.
 */
class ConectProvider extends ControllerBase {

  /**
   * Conecta un proveedor con el usuario actual.
   */
  public function conectProvider($id) {
    $load_user_provider = User::load($id);
    $current_user_id = \Drupal::currentUser()->id();
    $load_user_client = User::load($current_user_id);

    if ($load_user_provider && $load_user_client) {
      // Obtener valores existentes del proveedor y agregar el nuevo cliente si no existe.
      $clientes = $load_user_provider->get('field_clientes_asignados')->getValue();
      $clientes_ids = array_column($clientes, 'target_id');

      if (!in_array($current_user_id, $clientes_ids)) {
        $clientes[] = ['target_id' => $current_user_id];
        $load_user_provider->set('field_clientes_asignados', $clientes);
        $load_user_provider->save();
      }

      // Obtener valores existentes del cliente y agregar el nuevo proveedor si no existe.
      $proveedores = $load_user_client->get('field_proveedores_asignados')->getValue();
      $proveedores_ids = array_column($proveedores, 'target_id');

      if (!in_array($id, $proveedores_ids)) {
        $proveedores[] = ['target_id' => $id];
        $load_user_client->set('field_proveedores_asignados', $proveedores);
        $load_user_client->save();
      }

      \Drupal::messenger()->addMessage('Proveedor conectado exitosamente.');

      return new RedirectResponse('/consulta-proveedores');
    }
    else {
      return new Response("Usuario con ID $id no encontrado.", 404);
    }
  }

  /**
   * Desconecta un proveedor del usuario actual.
   */
  public function disconectProvider($id) {
    $load_user_provider = User::load($id);
    $current_user_id = \Drupal::currentUser()->id();
    $load_user_client = User::load($current_user_id);

    if ($load_user_provider && $load_user_client) {
      // Remover el cliente del campo field_clientes_asignados del proveedor.
      $clientes = $load_user_provider->get('field_clientes_asignados')->getValue();
      $clientes = array_filter($clientes, function ($item) use ($current_user_id) {
        return $item['target_id'] != $current_user_id;
      });
      $load_user_provider->set('field_clientes_asignados', array_values($clientes));
      $load_user_provider->save();

      // Remover el proveedor del campo field_proveedores_asignados del cliente.
      $proveedores = $load_user_client->get('field_proveedores_asignados')->getValue();
      $proveedores = array_filter($proveedores, function ($item) use ($id) {
        return $item['target_id'] != $id;
      });
      $load_user_client->set('field_proveedores_asignados', array_values($proveedores));
      $load_user_client->save();

      \Drupal::messenger()->addMessage('Proveedor desconectado exitosamente.');

      return new RedirectResponse('/consulta-proveedores');
    }
    else {
      return new Response("Usuario con ID $id no encontrado.", 404);
    }
  }

}
