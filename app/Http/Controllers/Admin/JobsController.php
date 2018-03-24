<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class JobsController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        


			$this->filter = \DataFilter::source(new \App\Jobs);
			$this->filter->add('category.id','Category','select')->option('','- Select Category -')->options(\App\Category::pluck("name", "id")->all());
			$this->filter->add('city.id','City','select')->options(\App\City::pluck("name", "id")->all());
			$this->filter->add('name', 'Name', 'text');
			$this->filter->submit('Arama');
			$this->filter->reset('Sıfırla');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('name', 'Name');
			$this->grid->add('email', 'Email');
			$this->grid->add('phone', 'Phone');
			$this->addStylesToGrid();

        
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        	
	
			$this->edit = \DataEdit::source(new \App\Jobs());
//dd($this);
			$this->edit->label('Edit Jobs');

			$this->edit->add('name', 'Name', 'text');

			$this->edit->add('body', 'Body', 'redactor');

			$this->edit->add('phone', 'Phone', 'text');

			$this->edit->add('email', 'Email', 'text');


			$this->edit->add('user_id','User','select')->insertValue(1)->options(\App\User::pluck("email", "id")->all());

			$this->edit->add('company_id','Company Id','select')->insertValue(1)->options(\App\Company::pluck("Name", "id")->all());

			$this->edit->add('category', 'Categories', 'checkboxgroup')->options(\App\Category::pluck("name", "id")->all());

			$this->edit->add('city', 'Cities', 'checkboxgroup')->options(\App\City::pluck("name", "id")->all());

			$this->edit->add('type', 'Types', 'checkboxgroup')->options(\App\Type::pluck("name", "id")->all());

			$this->edit->add('education_id', 'Education', 'select')->option("","---")->options(\App\Education::pluck("name", "id")->all());
			
			$this->edit->add('startDate', 'Başlangıç Tarihi', 'text');
			

        return $this->returnEditView();
    }    
}
