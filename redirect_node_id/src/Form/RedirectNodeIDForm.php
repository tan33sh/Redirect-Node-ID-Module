<?php

namespace Drupal\redirect_node_id\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class RedirectNodeIDForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'redirect_node_id_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('redirect_node_id.settings');
 // Page title field.
    $form['page_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('redirect node id page title:'),
      '#default_value' => $config->get('redirect_node_id.page_title'),
      '#description' => $this->t('Give your redirect node id page a title.'),
    );
    // Source text field.
    $form['source_text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Source text for redirect node id:'),
      '#default_value' => $config->get('redirect_node_id.source_text'),
      '#description' => $this->t('Redirects to Node ID'),
    );

    return $form;
  }
 /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('redirect_node_id.settings');
    $config->set('redirect_node_id.source_text', $form_state->getValue('source_text'));
    $config->set('redirect_node_id.page_title', $form_state->getValue('page_title'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'redirect_node_id.settings',
    ];
  }

}
