<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Library\Avatar;

use RuntimeException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * This class represent the create and update process of entity avatar. 
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
abstract class Avatar
{
    private $uploadDir = null;

    private $uploadUrlBase = null;

    function __construct(RequestStack $requestStack)
    {
        if (!is_a($this, 'AppBundle\Library\Avatar\AvatarInterface')) {
            throw new RuntimeException(sprintf(
                "This class must implement the interface %s",
                "AppBundle\Library\Avatar\AvatarInterface"
            ));
        }
        $request = $requestStack->getCurrentRequest();
        $this->setUploadDir($request)->setUploadUrlBase($request)->createFolderName($request);
    }

    public function setAvatar(&$entity, $currentAvatar = null)
    {
        $file = $entity->getImage();
        if (is_a($file, 'Symfony\Component\HttpFoundation\File\File')) {
            $filename = $this->getFilename($file);
            $entity->setImage($file->move($this->uploadDir, $filename));
            if ($currentAvatar) {
                @unlink($currentAvatar);
            }
        } elseif($currentAvatar) {
            $entity->setImage(new File($currentAvatar));
        }
    }

    private function setUploadDir($request)
    {
        $this->uploadDir = sprintf(
            "%s/uploads/images/%s",
            $request->server->get('DOCUMENT_ROOT'),
            $this->getFolderName()
        );
        return $this;
    }

    private function setUploadUrlBase($request)
    {
        $this->uploadUrlBase = sprintf(
            "/uploads/images/%s/",
            $this->getFolderName()
        );
        return $this;
    }

    private function getFilename($file)
    {
        return sprintf("%s.%s", md5(uniqid()), $file->guessExtension());
    }

    private function createFolderName($request)
    {
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0775, true);
        }
        return $this;
    }
}
