<?php

namespace MyOrleansBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;

class CollaborateurUploadListener
{

    private $uploader;
    private $oldMedia;

    public function __construct(FileUploader $uploader, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Media) {
            return;
        }
        if ($entity->getCollaborateur()) {
            $this->uploadFile($entity);

            if ($this->oldMedia) {
                $entity->setLien($this->oldMedia);
            }
        }
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Media) {
            return;
        }
        if ($entity->getCollaborateur()) {
            if (is_file($entity->getLien())) {
                unlink($entity->getLien());
            }
        }
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Media) {
            return;
        }


        if ($entity->getCollaborateur()) {
            $file = $entity->getLien();

            // only upload new files
            if ($file instanceof UploadedFile) {
                $fileName = $this->uploader->upload($file);
                $entity->setLien($fileName);
            }

        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Media) {
            return;
        }
        $masterRequest = $this->requestStack->getMasterRequest()->get('_route');
        if ($masterRequest == 'admin_collaborateur_edit') {

            if ($entity->getCollaborateur()) {

                $this->oldMedia = $entity->getLien();

                if ($fileName = $entity->getLien() && !$this->oldMedia) {
                    $entity->setLien(new File($this->uploader->getTargetDir() . '/' . $fileName));
                }

            }
        }

    }

}