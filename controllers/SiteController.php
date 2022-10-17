<?php
namespace cont;
use mdls\ContactForm;
use oo\Application;
use oo\Controller;
use oo\Request;
use oo\Response;
class SiteController extends Controller{


    public function home(){
        $params=[
            'name'=>"TheCOdeholic"
        ];
        return $this->render('home',$params);
        // return Application::$app->router->renderView('home',$params);
    }
    public function contacts(Request $request,Response $response){
        $contact=new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success','Thank you for contacting us');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contacts',['model'=>$contact]);
    }



}