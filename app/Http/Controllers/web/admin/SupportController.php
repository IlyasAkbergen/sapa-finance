<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\web\WebBaseController;
use App\Models\Support;
use Inertia\Inertia;

class SupportController extends WebBaseController
{

    public function index()
    {
        $items = Support::with(['user'])->orderBy('id', 'DESC')->get();
        return Inertia::render('Support/List', [
            'items' => $items
        ]);
    }

    public function destroy($id)
    {
        $support = Support::find($id);
        if ($support) {
            $support->delete();
            return redirect()->route('supports.index');
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }
}
