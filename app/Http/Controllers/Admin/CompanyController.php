<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class CompanyController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        


			$this->filter = \DataFilter::source(new \App\Company);
	



			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('name', 'Company Name');
			$this->addStylesToGrid();

        
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        	
	
			$this->edit = \DataEdit::source(new \App\Company());
			
			

			$this->edit->label('Edit Company');

			$this->edit->add('name','Name','text');

			$this->edit->add('phone','Phone','text');

			$this->edit->add('website','Website','text');

			$this->edit->add('email','Email','text');

			$this->edit->add('about', 'About', 'redactor');

			$this->edit->add('logo', 'Logo', 'image')->move('uploads/images/')->preview(80,80);

			$this->edit->add('user_id','User','select')->insertValue(1)->options(\App\User::pluck("email", "id")->all());
/*
			

			$this->edit->add('education', 'Education', 'text');

			$this->edit->add('nationality', 'Nationality', 'text');

			$this->edit->add('workPermit', 'Workpermit', 'text');

			$this->edit->add('user_id','User','select')->insertValue(1)->options(\App\User::pluck("email", "id")->all());

			$this->edit->add('category', 'Categories', 'checkboxgroup')->options(\App\Category::pluck("name", "id")->all());

			$this->edit->add('city', 'City', 'checkboxgroup')->options(\App\City::pluck("name", "id")->all());



			

*/
        
       
        return $this->returnEditView();
    }    
}
