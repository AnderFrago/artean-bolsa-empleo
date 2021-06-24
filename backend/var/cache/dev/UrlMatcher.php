<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/offers' => [
            [['_route' => 'offer_insert', '_controller' => 'App\\Controller\\OffersController::insertOffer'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'offers', '_controller' => 'App\\Controller\\OffersController::index'], null, ['GET' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/offers/([^/]++)(*:58)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        58 => [
            [['_route' => 'offer_by_id', '_controller' => 'App\\Controller\\OffersController::offerById'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
