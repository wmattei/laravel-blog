<?php

namespace WAuth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use WAuth\Domain\Category\Category;


class NewCategory extends Mailable implements ShouldQueue
{

    use Queueable, SerializesModels;

    public $category;

    /**
     * Create a new message instance.
     *
     * @param Category $category
     */
    public function __construct($category)
    {

        $this->category = $category;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //        view()->addNamespace('wview', base_path('/packages/w-auth/views'));
        $view = $this->markdown('mail.new_category_email');
        //        dd($view->);
        return $view;
    }
}
