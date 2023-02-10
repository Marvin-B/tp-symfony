<?php
// app/AppKernel.php (your kernel class may be defined in a different class/path)

use Symfony\Component\HttpKernel\Kernel;

//class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new Vich\UploaderBundle\VichUploaderBundle(),
            // ...
        ];
    }
}