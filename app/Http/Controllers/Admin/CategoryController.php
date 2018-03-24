<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class CategoryController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        

        $catGrid = \App\Category::with("childrenRecursive")->whereNull("parent_id")->get();


        
                 
        return view('vendor.panelViews.allCategories')->with('catGrid', $catGrid);
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        
	
			$this->edit = \DataEdit::source(new \App\Category());

			$this->edit->label('Edit Category');

			$this->edit->add('name', 'Name', 'text');

			$this->edit->add('parent_id','Parent','select')->insertValue(1)->option('', '---')->options(\App\Category::pluck("name", "id")->all());

        
       
        return $this->returnEditView();
    }    
}
