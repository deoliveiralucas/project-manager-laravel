<?php

namespace ProjectManager\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjectManager\Transformers\ProjectTransformer;

class ProjectPresenter extends FractalPresenter
{
    
    public function getTransformer() 
    {
        return new ProjectTransformer();
    }
    
}
