<?php
namespace App\Services;

use App\Repository\EditeurRepository;

class Slugger
{
    private $editeurRepository;

    public function __construct(EditeurRepository $editeurRepository)
    {
        $this->editeurRepository = $editeurRepository;
    }

    /**
     * @param $editeur
     * @return string
     */
    public function slugify($editeur): string
    {
        $name = $editeur->getName();
        $slug = str_replace(' ', '-', $name);
        $transliterator = \Transliterator::createFromRules(':: NFD; :: [:Nonspacing Mark:] Remove; :: Lower(); :: NFC;', \Transliterator::FORWARD);
        $slug = $transliterator->transliterate($slug);
        $slug = preg_replace('/[^a-z0-9\-]/i', '', $slug);
        
        $lastEditeur = $this->editeurRepository->findDuplicateSlug($editeur->getId(), $slug);

        if ($lastEditeur) {
            $lastSlug = $lastEditeur->getSlug();
            $lastChar = mb_substr($lastSlug, -1);
            if (is_numeric($lastChar)) {
                $lastChar++;
                $slug .= '-' . $lastChar;
            } else {
                $slug .= '-1';
            }
        }

        return $slug;
    }
}
