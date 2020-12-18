<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class WebBaseController extends Controller
{
    public function responseSuccess($message, $data = null)
    {

        return redirect()->back()
            ->with('message', $message);
    }

    public function responseFail($error, $data = null)
    {
        return redirect()->back()
            ->with('error', $error);
    }

    public function warning()
    {
        request()
            ->session()
            ->flash('warning', 'Ошибка!');

    }

    public function added()
    {
        request()
            ->session()
            ->flash('warning', 'Добавлено!');
    }

    public function inModeration()
    {
        request()
            ->session()
            ->flash('warning', "Отправлено на мoдерацию администратору сайта");
    }

    public function deleted()
    {
        request()
            ->session()
            ->flash('warning', 'Удалено!');
    }

    public function successOperation()
    {
        request()
            ->session()
            ->flash('success', 'Операция успешна!');
    }

    public function edited()
    {
        request()
            ->session()
            ->flash('success', 'Обновлено!');
    }

    public function notFound()
    {
        request()
            ->session()
            ->flash('warning', 'Не найдено!');
    }


    public function error()
    {
        request()
            ->session()
            ->flash('error', 'Ошибка!');
    }

    public function makeToast($type, $message)
    {
        request()
            ->session()
            ->flash($type, $message);
    }
}
