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
        'nbZoom' => 4,
    ),
    'jeans-01' => array(
        'caption' => 'Fabrication de jeans sur commande',
        'nbZoom' => 2,
    ),
    'veste-tailleur-01' => array(
        'caption' => 'Veste de costume homme - technique tailleur',
        'nbZoom' => 3,
    ),
    'sac-noir-turquoise' => array(
        'caption' => 'Sac à main et pochette - petite série',
    ),
    'chauve-souris-01' => array(
        'caption' => 'Vêtement modulable - petite série',
        'nbZoom' => 3,
    ),
    'housse-02' => array(
        'caption' => 'Pochette d\'ordinateur - petite série',
        'nbZoom' => 2,
    ),
    'carmen-01' => array(
        'caption' => 'Modéliste pour Le Petit Atelier/Les Chorégies d\'Orange 2015<br />Robe chasuble et costume militaire<br/>Réalisation des prototypes, gradation et industrialisation pour la fabrication de 70 pièces en atelier de confection<br /><small>Opéra Carmen - Mise en scène et costumes Louis Désiré</small>',//? petit atelier
        'thumb' => array(
            'className' => 'grid-item--width2'
        ),
    ),
    'foulard-01' => array(
        'caption' => 'Foulard - petite série',
        'nbZoom' => 4,
    ),
    'sac-gris-parme' => array(
        'caption' => 'Sac à main et pochette - petite série',
        'thumb' => array(
          'className' => 'grid-item--width2'
        ),
    ),
    'saroual' => array(
        'caption' => 'Vêtement modulable - petite série',
        'nbZoom' => 3,
    ),
    'robe-tieanddye-01' => array(
        'caption' => 'Robe sur mesure - création et réalisation',
        'nbZoom' => 3,
    ),
    'foulard-02' => array(
        'caption' => 'Foulard - petite série',
        'nbZoom' => 4,
    ),
    'onet-01' => array(
        'caption' => 'Lauréate du concours lancé par la société ONET pour la création d\'une nouvelle gamme de vêtements de travail',
    ),
    'onet-02' => array(
        'caption' => 'Lauréate du concours lancé par la société ONET pour la création d\'une nouvelle gamme de vêtements de travail',
    ),
    'jupe-courte-01' => array(
        'caption' => 'Vêtement modulable - petite série',
        'nbZoom' => 2,
    ),
    'cosi-01' => array(
        'caption' => 'Couturière pour le Festival d\'Aix 2016<br /><small>Opéra Così fan tutte - Mise en scène Christophe Honoré - Costumes Thibault Vancraenenbroeck</small>',
    ),
    'cosi-02' => array(
        'caption' => 'Couturière pour le Festival d\'Aix 2016<br /><small>Opéra Così fan tutte - Mise en scène Christophe Honoré - Costumes Thibault Vancraenenbroeck</small>',
    ),
    'housse-03' => array(
        'caption' => 'Pochette d\'ordinateur - petite série',
        'nbZoom' => 2,
    ),
    'mitaine' => array(
        'caption' => 'Mitaines réversibles - petite série',
    ),
    'laine-modulable' => array(
        'caption' => '"Petite laine modulable"',
        'nbZoom' => 6,
    ),
    'tunique-01' => array(
        'caption' => 'Vêtement modulable - petite série',
        'nbZoom' => 3,
    ),
    'robe-mariee-01' => array(
        'caption' => 'Robe de mariée sur mesure - création et réalisation',
        'nbZoom' => 2,
    ),
    'housse-01' => array(
        'caption' => 'Pochette d\'ordinateur - petite série',
        'thumb' => array(
          'className' => 'grid-item--width2'
        ),
        'nbZoom' => 3,
    ),
    'sac-noir-marron' => array(
        'caption' => 'Sac à main et pochette - petite série',
    ),
    'foulard-03' => array(
        'caption' => 'Foulard - petite série',
        'nbZoom' => 4,
    ),
    'alcina-01' => array(
        'caption' => 'Couturière pour le Festival d\'Aix 2015<br /><small>Opéra Alcina - Mise en scène Katie Mitchell - Costumes Laura Hopkins</small>',
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
        'alcina-01',
        'foulard-01',
        'sac-gris-parme',
        'saroual',
        'robe-tieanddye-01',
        //'chauve-souris-02',
        //'laine-modulable-dos',
        //'laine-modulable-rayure-01',
        'foulard-02',
        //'laine-modulable-rayure-02',
        'onet-01',
        'onet-02',
        'jupe-courte-01',
        'cosi-01',
        'cosi-02',
        'housse-03',
        'mitaine',
        'laine-modulable',
        'tunique-01',
        'robe-mariee-01',
        'housse-01',
        'sac-noir-marron',
        'foulard-03',
        'carmen-01',
    );
    $wallImages = array();
    foreach ($imageNames as $imageName) {
        //$image = $app['getImgConf']($image);
        $wallImages[] = array_merge(array(
            'name' => $imageName,
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