<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class WebBaseController extends Controller
{
    public function responseSuccess($message, $data = null)
    {

        return redirect()->back()
            ->with(['message' => $message]);
    }

    public function responseFail($error, $data = null)
    {
        return redirect()
            ->back()
            ->withErrors([$error]);
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

    public function edited($message = null)
    {
        request()
            ->session()
            ->flash('success', !!$message ? $message : 'Обновлено!');
    }

    public function notFound()
    {
        request()
            ->session()
            ->flash('warning', 'Не найдено!');
    }

    public function error($error_message = 'Ошибка.')
    {
        request()
            ->session()
            ->flash('error', $error_message);
    }

    public function makeToast($type, $message)
    {
        request()
            ->session()
            ->flash($type, $message);
    }
}
