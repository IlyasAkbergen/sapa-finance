<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerFormRequest;
use App\Models\Partner;
use App\Services\PartnerServiceContract;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PartnerController extends Controller
{
    private $partnerService;

    public function __construct(PartnerServiceContract $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    public function index(Request $request)
    {
        $data = Partner::where('name', 'like', "%$request->search_key%")
            ->paginate(10);

        return Inertia::render('Partner/Crud/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return Inertia::render('Partner/Crud/Add');
    }

    public function store(PartnerFormRequest $request)
    {
        $data = $request->except('password');

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = Hash::make($request->input('password'));
        }

        if ($request->has('email_verified_at')
            && data_get($request, 'email_verified_at') === true) {
            $data['email_verified_at'] = Carbon::now();
        }

        $partner = $this->partnerService->create($data);

        if (!empty($partner)) {
            if (!config('app.debug')) {
                event(new Registered($partner));
            }
            return redirect()
                ->route('partners-crud.edit', $partner->id);
        } else {
            return $this->responseFail('failed saving partner');
        }
    }

    public function edit($id)
    {
        $partner = $this->partnerService->find($id);

        if (!empty($partner)) {
            return Inertia::render('Partner/Crud/Edit', [
                'partner' => $partner
            ]);
        } else {
            return redirect()->route('partners-crud.index');
        }
    }

    public function update(PartnerFormRequest $request)
    {
        $data = $request->except('password');

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = Hash::make($request->input('password'));
        }

        if ($request->has('email_verified_at')
            && data_get($request, 'email_verified_at') === true ) {
            $data['email_verified_at'] = Carbon::now();
        }

        $partner = $this->partnerService->update(
            $request->input('id'),
            $data
        );

        if (!empty($partner)) {
            return redirect()
                ->route('partners-crud.index');
        } else {
            return $this->responseFail('failed saving partner');
        }
    }

    public function show($id)
    {
        $partner = $this->partnerService->find($id);

        if (!empty($partner)) {
            return Inertia::render('Partner/Profile', [
                'partner' => $partner
            ]);
        } else {
            return redirect()->route('partners-crud.index');
        }
    }

    public function destroy($id)
    {
        $partner = $this->partnerService->find($id);

        $partner->update([
            'iin' => '_del_' . Carbon::now() . $partner->iin,
            'bin' => '_del_' . Carbon::now() . $partner->bin,
            'email' => '_del_' . Carbon::now() . $partner->email,
            'phone' => '_del_' . Carbon::now() . $partner->phone,
        ]);

        $deleted = $partner->delete($id);

        if ($deleted) {
            return redirect()->route('partners-crud.index');
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }
}
