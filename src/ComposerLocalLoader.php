<?php
/**
 * Composer Local Loader, adds local paths to the composer autoloader to
 * allow the use of composer.json dependencies from local repos rather than
 * using the ones found in the vendor directory
 *
 * @author Jay Francis <jay.francis@jdiuk.com>
 */

class ComposerLocalLoader
{

  /**
   * @param \Composer\Autoload\ClassLoader $loader
   * @param bool                           $takePriority
   * @param null                           $basePath
   *
   * @return \Composer\Autoload\ClassLoader
   */
  function get(
    Composer\Autoload\ClassLoader $loader,
    $takePriority = true,
    $basePath = null
  )
  {
    // The default base path assumes /base/group/repo/src
    if(!$basePath)
    {
      $basePath = dirname(dirname(dirname(__DIR__)));
    }

    foreach($loader->getPrefixes() as $namespace => $paths)
    {
      $path = trim($namespace, '\\');
      $path = str_replace('\\', '/', $path);

      // Add original case
      $loader->add(
        $namespace,
        sprintf('%s/%s/src', $basePath, $path),
        $takePriority
      );

      // Add lowercase
      if(strtolower($path) !== $path)
      {
        $loader->add(
          $namespace,
          sprintf('%s/%s/src', $basePath, strtolower($path)),
          $takePriority
        );
      }
    }

    return $loader;
  }
}
