<?php

namespace ProjectManager\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjectManager\Transformers\ProjectNoteTransformer;

class ProjectNotePresenter extends FractalPresenter
{
    
    public function getTransformer()
    {
        return new ProjectNoteTransformer();
    }
}
