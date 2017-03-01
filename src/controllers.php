<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

 $images = array(
    'corset-01' => array(
        'caption' => 'Corset époque 1820',
    ),
    'jeans-01' => array(
        'caption' => 'Lorem',
    ),
    'veste-tailleur-01' => array(
        'caption' => 'Lorem',
    ),
    'sac-noir-turquoise' => array(
        'caption' => 'Lorem',
    ),
    'chauve-souris-01' => array(
        'caption' => 'Lorem',
    ),
    'housse-02' => array(
        'caption' => 'Lorem',
    ),
    'carmen-01' => array(
        'caption' => 'Lorem',
        'thumb' => array(
            'className' => 'grid-item--width2'
        ),
    ),
    'foulard-eau-deco' => array(
        'caption' => 'Lorem',
    ),
    'sac-gris-parme' => array(
        'caption' => 'Lorem',
        'thumb' => array(
          'className' => 'grid-item--width2'
        ),
    ),
    'saroual' => array(
        'caption' => 'Lorem',
    ),
    'robe-tieanddye-01' => array(
        'caption' => 'Lorem',
    ),
    'foulard-eau-ethnique' => array(
        'caption' => 'Lorem',
    ),
    'onet-01' => array(
        'caption' => 'Lorem',
    ),
    'onet-02' => array(
        'caption' => 'Lorem',
    ),
    'jupe-courte-01' => array(
        'caption' => 'Lorem',
    ),
    'cosi-01' => array(
        'caption' => 'Lorem',
    ),
    'cosi-02' => array(
        'caption' => 'Lorem',
    ),
    'housse-03' => array(
        'caption' => 'Lorem',
    ),
    'jupe-courte-02' => array(
        'caption' => 'Lorem',
    ),
    'mitaine' => array(
        'caption' => 'Lorem',
    ),
    'laine-modulable-orange' => array(
        'caption' => 'Lorem',
    ),
    'tunique-01' => array(
        'caption' => 'Lorem',
    ),
    'robe-mariee' => array(
        'caption' => 'Lorem',
    ),
    'housse-01' => array(
        'caption' => 'Lorem',
        'thumb' => array(
          'className' => 'grid-item--width2'
        ),
    ),
    'tunique-02' => array(
        'caption' => 'Lorem',
    ),
    'sac-noir-marron' => array(
        'caption' => 'Lorem',
    ),
    'foulard-rayure-fleur' => array(
        'caption' => 'Lorem',
    ),
    'alcina-01' => array(
        'caption' => 'Lorem',
        'thumb' => array(
            'className' => 'grid-item--width2'
        ),
    ),
);

$app->get('/', function () use ($app, $images) {
    $imageNames = array(
        'corset-01',
        'jeans-01',
        'veste-tailleur-01',
        'sac-noir-turquoise',
        'chauve-souris-01',
        'housse-02',
        'carmen-01',
        'foulard-eau-deco',
        'sac-gris-parme',
        'saroual',
        'robe-tieanddye-01',
        //'chauve-souris-02',
        //'laine-modulable-dos',
        //'laine-modulable-rayure-01',
        'foulard-eau-ethnique',
        //'laine-modulable-rayure-02',
        'onet-01',
        'onet-02',
        'jupe-courte-01',
        'cosi-01',
        'cosi-02',
        'housse-03',
        'jupe-courte-02',
        'mitaine',
        'laine-modulable-orange',
        'tunique-01',
        'robe-mariee',
        'housse-01',
        'tunique-02',
        'sac-noir-marron',
        'foulard-rayure-fleur',
        'alcina-01',
    );
    $wallImages = array();
    foreach ($imageNames as $imageName) {
        //$image = $app['getImgConf']($image);
        $wallImages[] = array_merge(array(
            'name' => $imageName,
            'zoom' => $imageName,
        ), $images[$imageName]);
    }
    return $app['twig']->render('index.html.twig', array(
        'images' => $wallImages,
    ));
})
->bind('homepage')
;

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});