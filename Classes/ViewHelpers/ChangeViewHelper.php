<?php
namespace MomoWebdevelopment\MomoPreciousmetal\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

class ChangeViewHelper extends AbstractTagBasedViewHelper
{
    protected $tagName = 'span';

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('change', 'string', 'Pm change', false);
    }

   public function render(): string
   {
       $change = $this->arguments['change'];
       if (strpos($change, '-') === false) {
           $this->tag->addAttribute('class', 'green');
           $change = '+' . $change;
       } else {
           $this->tag->addAttribute('class', 'red');
       }
       $this->tag->setContent($change);

       return $this->tag->render();
   }
}
