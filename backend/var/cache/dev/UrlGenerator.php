<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format'], ['variable', '/', '\\d+', 'code'], ['text', '/_error']], [], []],
    'offer_insert' => [[], ['_controller' => 'App\\Controller\\OffersController::insertOffer'], [], [['text', '/offers']], [], []],
    'offer_by_id' => [['id'], ['_controller' => 'App\\Controller\\OffersController::offerById'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/offers']], [], []],
    'offers' => [[], ['_controller' => 'App\\Controller\\OffersController::index'], [], [['text', '/offers']], [], []],
];
