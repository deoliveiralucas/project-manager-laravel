<?php

namespace ProjectManager\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjectManager\Transformers\ProjectTaskTransformer;

class ProjectTaskPresenter extends FractalPresenter
{
    
    public function getTransformer() 
    {
        return new ProjectTaskTransformer();
    }
    
}
