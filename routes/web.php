<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/formtest', function(){
    $emails = session()->get('emails', []);

    return view('formtest',[
        'emails' => $emails,
    ]);
});

Route::post('/formtest', function(){

    $validated = request()->validate([
        'email' => 'required|email'
    ]);

    $emails = session()->get('emails', []);

    if (count($emails) >= 5) {
        return redirect('/formtest')->with('error', 'Maximum of 5 emails only.');
    }

    if (in_array($validated['email'], $emails)) {
        return redirect('/formtest')->with('error', 'Email already exists.');
    }

    $emails[] = $validated['email'];
    session(['emails' => $emails]);

    return redirect('/formtest')->with('success', 'Email added successfully!');
});

Route::post('/formtest/delete/{index}', function ($index) {
    $emails = session()->get('emails', []);

    if (isset($emails[$index])) {
        unset($emails[$index]);
        $emails = array_values($emails); // reindex
        session(['emails' => $emails]);
    }

    return redirect('/formtest')->with('success', 'Email deleted.');
});

Route::get('/delete-emails', function () {
    session()->forget('emails');
    return redirect('/formtest')->with('success', 'All emails deleted.');
});