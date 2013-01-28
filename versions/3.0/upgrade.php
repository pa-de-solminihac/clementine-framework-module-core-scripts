<?php
/**
 * Script non interactif : mise à jour des fichiers de app/local pour passer de core 2.10 à core 3.0
 */

// appliquer les chercher remplacer dans tous les fichiers php des dossiers model,helper,ctrl,view (des modules locaux uniquement)
$app_local_path = realpath(__INSTALLER_ROOT__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'local');
$dossiers = array(
    $app_local_path . DIRECTORY_SEPARATOR . '*' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR,
    $app_local_path . DIRECTORY_SEPARATOR . '*' . DIRECTORY_SEPARATOR . 'helper' . DIRECTORY_SEPARATOR,
    $app_local_path . DIRECTORY_SEPARATOR . '*' . DIRECTORY_SEPARATOR . 'ctrl' . DIRECTORY_SEPARATOR,
    $app_local_path . DIRECTORY_SEPARATOR . '*' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR
);

// liste des chercher remplacer à appliquer
$remplacements = array(
    // changement de $request : le tableau est remplace par un opjet
    '/\$request\[\'GET\'\]/'      => '$request->GET',
    '/\$request\[\'POST\'\]/'     => '$request->POST',
    '/\$request\[\'COOKIE\'\]/'   => '$request->COOKIE',
    '/\$request\[\'REQUEST\'\]/'  => '$request->REQUEST',
    '/\$request\[\'AJAX\'\]/'     => '$request->AJAX',
    '/\$request\[\'METHOD\'\]/'   => '$request->METHOD',
    '/\$request\[\'EQUIV\'\]/'    => '$request->EQUIV',
    '/\$request\[\'LANG\'\]/'     => '$request->LANG',
    '/\$request\[\'ARGS\'\]/'     => '$request->ARGS',
    '/\$request\[\'FULLURL\'\]/'  => '$request->FULLURL',
    '/\$request\[\'NOCACHE\'\]/'  => '$request->NOCACHE',
    '/\$request\[\'CTRL\'\]/'     => '$request->CTRL',
    '/\$request\[\'ACT\'\]/'      => '$request->ACT',
    // changement de nom de hook
    '/ before_first_getRequest *\( *\)/'   => ' before_request($request)',
    '/:before_first_getRequest *\( *\)/'   => ':before_request($request)',
    '/before_first_getRequest/'   => 'before_request',
    // déplacement des fonctions map_url et canonical_url
    '/\$this->map_url *\(/'       => '$request->map_url(',
    '/\$this->canonical_url *\(/' => '$request->canonical_url('
);

$array_replaces = array('replace');
foreach ($dossiers as $dossier) {
    $array_replaces['replace'][$dossier] = $remplacements;
}

return $array_replaces;
?>
