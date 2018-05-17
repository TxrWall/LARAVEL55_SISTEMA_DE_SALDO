<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateProfileFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        return view('sites.profile.profile');
    }

    public function profileUpdate(UpdateProfileFormRequest $request)
    {
        $data = $request->all();

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $update = Auth()->user()->update($data);

        if ($update) {
          return redirect()
              ->route('profile')
              ->with('success', 'Sucesso ao atualizar!');
        }

        return redirect()
            ->back()
            ->with('error', 'Falha ao atualizar o perfil.');
    }
}
