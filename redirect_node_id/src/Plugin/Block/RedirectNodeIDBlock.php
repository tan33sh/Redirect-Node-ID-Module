<?php

namespace Drupal\redirect_node_id\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a node id redirect.
 *
 * @Block(
 *   id = "redirect_node_id",
 *   admin_label = @Translation("Redirect Node ID block"),
 * )
 */
class RedirectNodeIDBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Return the form @ Form/RedirectNodeIDBlockForm.php.
    return \Drupal::formBuilder()->getForm('Drupal\redirect_node_id\Form\RedirectNodeIDBlockForm');
  }
  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'redirect node id');
  }
/**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('redirect_node_id_block_settings', $form_state->getValue('redirect_node_id_settings'));
  }

}
