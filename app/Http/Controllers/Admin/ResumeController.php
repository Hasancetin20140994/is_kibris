<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class ResumeController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        


			$this->filter = \DataFilter::source(new \App\Resume);
			$this->filter->add('category.id','Category','select')->options(\App\Category::pluck("name", "id")->all());

			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('user_id', 'UserId');
			$this->grid->add('education', 'Education', 'text');
			$this->grid->add('nationality', 'Nationality', 'text');
			$this->addStylesToGrid();

        
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        	
	
			$this->edit = \DataEdit::source(new \App\Resume());
			
			$user = $this->edit->model->user();

			$this->edit->label('Edit Resume');

			$this->edit->add('body', 'Body', 'redactor');

			$this->edit->add('education', 'Education', 'text');

			$this->edit->add('nationality', 'Nationality', 'text');

			$this->edit->add('workPermit', 'Workpermit', 'text');

			$this->edit->add('user_id','User','select')->insertValue(1)->options(\App\User::pluck("email", "id")->all());

			$this->edit->add('category', 'Categories', 'checkboxgroup')->options(\App\Category::pluck("name", "id")->all());

			$this->edit->add('city', 'City', 'checkboxgroup')->options(\App\City::pluck("name", "id")->all());
			
			$this->edit->add('education_id', 'Education', 'select')->options(\App\Education::pluck("name", "id")->all());


        return $this->returnEditView();
    }    
}
