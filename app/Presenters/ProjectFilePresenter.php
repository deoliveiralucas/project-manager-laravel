<?php

namespace ProjectManager\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjectManager\Transformers\ProjectFileTransformer;

class ProjectFilePresenter extends FractalPresenter
{
    
    public function getTransformer()
    {
        return new ProjectFileTransformer();
    }
}
