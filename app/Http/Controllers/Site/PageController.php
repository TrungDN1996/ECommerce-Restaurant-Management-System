<?php

namespace Lava\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Lava\Http\Controllers\Controller;
use Lava\Mail\ContactMessage;
use Lava\Http\Requests\Site\ContactForm;
use Session;
use Mail;

class PageController extends Controller
{
    /**
     * [Access to about page]
     * @return Illuminate\Http\Response
     */
    public function getHomepage()
    {
        return view('site.page.homepage');
    }

    /**
     * [Access to about page]
     * @return Illuminate\Http\Response
     */
    public function getAboutpage()
    {
    	return view('site.page.about');
    }

    /**
     * [Access to contact page]
     * @return Illuminate\Http|Response
     */
    public function getContactpage()
    {
    	return view('site.page.contact');
    }

    /**
     * [Send message from contact page]
     * @param  ContactForm Request $request 
     * @return Illuminate\Http\Response
     */
    public function sendMessage(ContactForm $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'mailMessage' => $request->get('message')
        ];
        
    	Mail::send('site.form.mail', $data, function($message) use ($data){
    		$message->from($data['email']);
    		$message->to('LavaProject@gmail.com');
    		$message->subject('Message from contact page');
    	});

        Session::flash('Success', 'You sent message successfully!');
    	return view('site.page.contact');
    }

    /**
     * [Routes connect to Site\PageControllers]
     * @return 
     */
    public static function routes()
    {
        return Route::group([
            'prefix' => '/',
            'namespace' => 'Site',
        ], function(){
            Route::name('page')->group(function(){
                Route::get('about', 'PageController@getAboutpage')->name('.about');
                Route::get('contact', 'PageController@getContactpage')->name('.contact');
                Route::post('contact', 'PageController@sendMessage')->name('.contactMessage');
            });
        });
    }
}
