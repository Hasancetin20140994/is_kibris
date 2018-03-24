<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class UserController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        


			$this->filter = \DataFilter::source(new \App\User);
			$this->filter->add('category.id','Category','select')->options(\App\Category::pluck("name", "id")->all());
			$this->filter->add('name', 'Name', 'text');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('name', 'Name');
			$this->addStylesToGrid();

        
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        	
	
			$this->edit = \DataEdit::source(new \App\User());

			$this->edit->label('Edit Jobs');

			$this->edit->add('name', 'Name', 'text');

			$this->edit->add('phoneNumber', 'Phone', 'text');

			$this->edit->add('email', 'Email', 'text');

			$this->edit->add('type', 'User Type', 'select')->options(['candidate' => "İş Arayan", 'employer' => "İş Veren"]);



		

			


        
       
        return $this->returnEditView();
    }    
}
