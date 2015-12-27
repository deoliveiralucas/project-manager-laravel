<?php

namespace ProjectManager\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjectManager\Transformers\ProjectMemberTransformer;

class ProjectMemberPresenter extends FractalPresenter
{
    
    public function getTransformer()
    {
        return new ProjectMemberTransformer();
    }
}
