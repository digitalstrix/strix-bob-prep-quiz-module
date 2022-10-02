<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\OptionSelected;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\QuestionCategory;
use App\Models\QuestionInPackage;
use App\Models\QuestionSubject;
use App\Models\QuestionOption;
use App\Models\QuestionPackage;
use App\Models\Test;

class QuestionController extends Controller
{
    function getcategory(Request $request){
        $rules =array(
            "user_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User Type is not Define"], 401);
            }
            $data = QuestionCategory::get();
            if($data)
            return response(["status" => true, "data" =>$data], 201);
            }
    }
    function getsubject(Request $request){
        $rules =array(
            "user_id" => "required",
            "category_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User Type is not Define"], 401);
            }
            if(!QuestionCategory::where('id',$request->category_id)->first()){
                return response(["status" => "error", "message" =>"Category Not Exist"], 401);
            }
            $data = QuestionSubject::where('category_id',$request->category_id)->get();
            if($data)
            return response(["status" => true, "data" =>$data], 201);
             }
    }
    function addcategory(Request $request){
        $rules =array(
            "user_id" => "required",
            "name" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User Type is not Define"], 401);
            }
            
            $data = new QuestionCategory();
            $data->category_name = $request->name;
            $data->save();
            if($data->save())
            return response(["status" => true, "message" =>"Category Sucessfully Created"], 201);
             }
    }
    function addsubject(Request $request){
        $rules =array(
            "user_id" => "required",
            "name" => "required",
            "category_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->where('role','admin')->first()){
                return response(["status" => "error", "message" =>"User Type is not admin"], 401);
            }
            if(!QuestionCategory::where('id',$request->category_id)->first()){
                return response(["status" => "error", "message" =>"Category Not Exist"], 401);
            }
            $data = new QuestionSubject();
            $data->subject_name = $request->name;
            $data->category_id= $request->category_id;
            $data->save();
            if($data->save())
            return response(["status" => true, "message" =>"SubCategory Sucessfully Created"], 201);
             }
    }
    function addquestion(Request $request){
        $rules =array(
            "user_id" => "required",
            "question" => "required",
            "category_id" => "required",
            "level" => "required",
            "subject_id" => "required",
            "option1" => "required",
            "option2" => "required",
            "option3" => "required",
            "option4" => "required",
            "is_correct" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->where('role','admin')->first()){
                return response(["status" => "error", "message" =>"User Type is not admin"], 401);
            }
            if(!QuestionCategory::where('id',$request->category_id)->first()){
                return response(["status" => "error", "message" =>"Category Not Exist"], 401);
            }
            if(!QuestionSubject::where('id',$request->subject_id)->first()){
                return response(["status" => "error", "message" =>"Subject Not Exist"], 401);
            }
            $data = new Question();
            $data->question = $request->question;
            $data->category_id = $request->category_id;
            $data->subject_id = $request->subject_id;
            $data->description = $request->description;
            $data->level = $request->level;
            $data->save();
            $q_id = $data->id;
            if($request->is_correct==1){
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option1;
                $data1->is_correct = '1';
                $data1->save();
            }else{
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option1;
                $data1->save();
            }
            if($request->is_correct==2){
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option2;
                $data1->is_correct = '1';
                $data1->save();
            }else{
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option2;
                $data1->save();
            }
            if($request->is_correct==3){
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option3;
                $data1->is_correct = '1';
                $data1->save();
            }else{
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option3;
                $data1->save();
            }
            if($request->is_correct==4){
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option4;
                $data1->is_correct = '1';
                $data1->save();
            }else{
                $data1 = new QuestionOption();
                $data1->question_id = $q_id;
                $data1->option = $request->option4;
                $data1->save();
            }
            if($data->save())
            return response(["status" => true, "message" =>"Question Sucessfully Created"], 201);
             }
    }
    function addpackage(Request $request){
        $rules =array(
            "user_id" => "required",
            "package_name" => "required"
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->where('role','admin')->first()){
                return response(["status" => "error", "message" =>"User Type is not admin"], 401);
            }
            $data = new QuestionPackage();
            $data->package_name = $request->package_name;
            $data->save();
            if($data->save())
            return response(["status" => true, "message" =>"Package Sucessfully Created"], 201);
             }
    }
    function addinpackage(Request $request){
        $rules =array(
            "user_id" => "required",
            "package_id" => "required",
            "question_id" => "required"
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->where('role','admin')->first()){
                return response(["status" => "error", "message" =>"User Type is not admin"], 401);
            }
            if(QuestionInPackage::where('package_id',$request->package_id)->where('question_id',$request->question_id)->first()){
                return response(["status" => "error", "message" =>"Question Already Added"], 401);
            }
            if(!QuestionPackage::where('id',$request->package_id)->first()){
                return response(["status" => "error", "message" =>"Not a Valid Package"], 401);
            }
            if(!Question::where('id',$request->question_id)->first()){
                return response(["status" => "error", "message" =>"Not a Valid Question"], 401);
            }
            $data = new QuestionInPackage();
            $data->package_id = $request->package_id;
            $data->question_id = $request->question_id;
            $data->save();
            if($data->save())
            return response(["status" => true, "message" =>"Question added in Package Sucessfully Created"], 201);
             }
    }
    function getpackage(Request $request){
        $rules =array(
            "user_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User Type is not Define"], 401);
            }
            $data = QuestionPackage::all();
            if($data)
            return response(["status" => true, "data" =>$data], 201);
             }
    }
    function starttest(Request $request){
        $rules =array(
            "user_id" => "required",
            "mode" => "required|in:1,2",
            "package_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User  is not Define"], 401);
            }
            $data = new Test();
            $data->mode = $request->mode;
            $data->user_id = $request->user_id;
            $data->package_id = $request->package_id;
            $data->save();
            if($data)
            return response(["status" => true, "data" =>$data,"test_id"=>$data->id], 201);
             }
    }
    function questionbypackage(Request $request){
        $rules =array(
            "user_id" => "required",
            "package_id" => "required"
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User is not Define"], 401);
            }
            if(!QuestionPackage::where('id',$request->package_id)->first()){
                return response(["status" => "error", "message" =>"Package is not Define"], 401);
            }
            $data = QuestionInPackage::where('package_id',$request->package_id)->get();
            // $data = [];
            $temp2 = array();
            foreach($data as $key){
                $question = Question::where('id',$key->question_id)->first();
                if(!Question::where('id',$question->id)->first()){
                    return response(["status" => "error", "message" =>"Question is not Define"], 401);
                }
                $temp = QuestionOption::where('question_id',$key->question_id)->get();
                $temp4 = array();
                foreach ($temp as $temp3){
                    $temp5 = array([
                        "option_id" => $temp3->id,
                        "option" => $temp3->option
                    ]);
                    $temp4[] = $temp5;
                }
                $data1 = ([
                    "question_id" => $question->id,
                    "question" => $question->question,
                    // "description" => $question->description,
                    "level" => $question->level,
                    "options"=>$temp4
                ]);
                $temp2[] = $data1;
            }
            // print_r($temp);
            return response(["status" => true, "data" =>$temp2,], 201);
             }
    }
    function addresponse(Request $request){
        $rules =array(
            "user_id" => "required",
            "test_id" => "required",
            "question_id" => "required",
            "option_id" => "",
            "seconds" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User  is not Define"], 401);
            }
            if(!Test::where('id',$request->test_id)->where('user_id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"Test not Define For User"], 401);
            }
            if (OptionSelected::where('test_id', $request->test_id)->where('question_id', $request->question_id)->first()){
                return response(["status" => "error", "message" =>"Answer Already Given"], 401);
            }
            else{
                $data = new OptionSelected();
                $data->test_id = $request->test_id;
                $data->question_id = $request->question_id;
                // Insert in Test Table for New Entry 
                $test = Test::where('id',$request->test_id)->first();
                $test->total_attempt = $test->total_attempt+1;
                $test->minutes = $test->minutes+($request->seconds)/60;
                if(isset($request->option_id)){
                if(QuestionOption::where('id',$request->option_id)->where('is_correct','1')->first()){
                $test->total_correct = $test->total_correct+1;
                }else{
                $test->total_incorrect = $test->total_incorrect+1;
                }
                }else{
                    $test->total_left = $test->total_left+1;
                }
                $test->save();
            }
            $data->option_id = $request->option_id;
            if(QuestionOption::where('id',$request->option_id)->where('is_correct','1')->first()){
                $data->is_correct = 1;
            }else{
                $data->is_correct = 0;
            }
            $data->save();           
            return response(["status" => true, "message" =>"Response Added Sucessfully", 201]);
             }
    }
    function gettest(Request $request){
        $rules =array(
            "user_id" => "",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(isset($request->user_id)){
                $test = Test::where('user_id',$request->user_id)->get(); 
            }
            else{
                $test = Test::all();
            }
            return response(["status" => true, "data" =>$test], 201);
             }
    }
    function testdetail(Request $request){
        $rules =array(
            "test_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            $test = OptionSelected::where('test_id',$request->test_id)->get();
            foreach($test as $key){
                $question = Question::where('id',$key->question_id)->first();
                if(!Question::where('id',$question->id)->first()){
                    return response(["status" => "error", "message" =>"Question is not Define"], 401);
                }
                $temp = QuestionOption::where('question_id',$key->question_id)->get();
                $temp4 = array();
                foreach ($temp as $temp3){
                    $temp5 = array([
                        "option_id" => $temp3->id,
                        "option" => $temp3->option
                    ]);
                    $temp4[] = $temp5;
                }
                $data1 = ([
                    "question_id" => $question->id,
                    "question" => $question->question,
                    "description" => $question->description,
                    "level" => $question->level,
                    "selected_option_id" => $key->option_id,
                    "is_correct" => $key->is_correct,
                    "options"=>$temp4
                ]);
                $temp2[] = $data1;
            }
            return response(["status" => true, "data" =>$temp2], 201);
             }
    }
    function getstats(Request $request){
        $rules =array(
            "user_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->where('role','admin')->first()){
                return response(["status" => "error", "message" =>"User Type is not Admin"], 401);
            }
            $question = Question::count();
            $test = Test::count();
            $package = QuestionPackage::count();
            $category = QuestionCategory::count();
            $subject = QuestionSubject::count();
            return response(["status" => true, "total_question" =>$question
            ,"total_test" => ($test),"total_packages"=>($package),"total_category"=>($category),"total_subject"=>($subject)
        ], 201);
             }
    }
    function getallquestion(Request $request){
        $rules =array(
            "user_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->where('role','admin')->first()){
                return response(["status" => "error", "message" =>"User Type is not Admin"], 401);
            }
            $question = Question::paginate(5);
            $temp = array();
            foreach ($question as $key){
                $option = QuestionOption::where('question_id',$key->id)->get();
                // $temp1 = array();
                $temp1 = array();
                foreach($option as $value){
                $temp1[] = array([
                    "option_id"=>$value->id,
                    "option" =>$value->option,
                    "is_correct"=> $value->is_correct
                ]);
                }
                $temp[] = array('question'=> $key,"option"=>$temp1);
            }
            return response(["status" => true, "question" =>$temp], 201);
             }
    }
    function getquestiondetail(Request $request){
        $rules =array(
            "user_id" => "required",
            "question_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->first()){
                return response(["status" => "error", "message" =>"User Type is not Admin"], 401);
            }
            $question = Question::where('id',$request->question_id)->first();
            $temp = array();
                $option = QuestionOption::where('question_id',$question->id)->get();
                // $temp1 = array();
                $temp1 = array();
                foreach($option as $value){
                $temp1[] = array([
                    "option_id"=>$value->id,
                    "option" =>$value->option,
                    "is_correct"=> $value->is_correct
                ]);
                }
                $temp[] = array('question'=> $question,"option"=>$temp1);
            
            return response(["status" => true, "question" =>$temp], 201);
             }
    }
    function getonlyquestion(Request $request){
        $rules =array(
            "user_id" => "required",
         );
         $validator= Validator::make($request->all(),$rules);
         if($validator->fails()){
             return $validator->errors();
         }
         else{
            if(!User::where('id',$request->user_id)->where('role','admin')->first()){
                return response(["status" => "error", "message" =>"User Type is not Admin"], 401);
            }
            $question = Question::all();
            $temp = array();
            foreach ($question as $key){ 
                $temp[] = array('question'=> $key->question ,"question_id"=>$key->id);
            }
            return response(["status" => true, "question" =>$temp], 201);
             }
    }
    
}