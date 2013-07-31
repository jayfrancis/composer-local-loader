Composer Local Loader
=====================

Override composers standard autoloading to use a local repo but fail-over
to the vendor directory.

To use simply add the following to your composer.json file:
  //todo

Then modify the bootstrap process in your application as follows:

    /** @var \Composer\Autoload\ClassLoader $composerLoader */
    $composerLoader = require dirname(__DIR__) . '/vendor/autoload.php';

    /**
     * Wrap this in a conditional for certain environments, i.e. development
     */
    $composerLoader = ComposerLocalLoader::addLocalPaths($composerLoader);
