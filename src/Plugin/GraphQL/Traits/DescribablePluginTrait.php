<?php

namespace Drupal\graphql\Plugin\GraphQL\Traits;

trait DescribablePluginTrait {

  /**
   * @param $definition
   *
   * @return string
   */
  protected function buildDescription($definition) {
    if (isset($definition['description']) &&  !empty($definition['description'])) {
      if (is_callable([$definition['description'], 'render'])){
        return $definition['description']->getUntranslatedString();
        //return $definition['description']->render();
      }
    }

    return '';
  }

}
