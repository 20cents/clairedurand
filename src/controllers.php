<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

function getImgConf($name) {
    $imgConf = array(
        'alcina-01' => array(
            'thumb' => array(
                'className' => 'grid-item--width2'
            ),
        ),
        'carmen-01' => array(
            'thumb' => array(
                'className' => 'grid-item--width2'
            ),
        ),
        'sac-gris-parme' => array(
            'thumb' => array(
                'className' => 'grid-item--width2'
            ),
        ),
        'house-01' => array(
            'thumb' => array(
                'className' => 'grid-item--width2'
            ),
        ),
    );
    if (isset($imgConf[$name])) {
        $imgConf[$name]['name'] = $name;

        return array_merge(array(
            'name' => $name,
            'zoom' => $name,
        ), $imgConf[$name]);
    }
    return array(
        'name' => $name,
        'zoom' => $name,
    );
}

$app->get('/', function () use ($app) {
    $images = array(
        'chauve-souris-01',
        'carmen-01',
        'foulard-eau-deco',
        'saroual',
        'sac-gris-parme',
        'sac-noir-turquoise',
        'laine-modulable-orange',
        'chauve-souris-02',
        //'laine-modulable-dos',
        //'laine-modulable-rayure-01',
        'foulard-rayure-fleur',
        //'laine-modulable-rayure-02',
        'onet-01',
        'onet-02',
        'jupe-courte-01',
        'cosi-01',
        'cosi-02',
        'house-03',
        'jupe-courte-02',
        'mitaine',
        'costume-homme',
        'tunique-01',
        'robe-mariee',
        'house-01',
        'house-02',
        'tunique-02',
        'sac-noir-marron',
        'foulard-noir-arabesque',
        'alcina-01',
    );
    foreach ($images as &$image) {
        $image = getImgConf($image);
    }
    return $app['twig']->render('index.html.twig', array(
        'images' => $images
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
