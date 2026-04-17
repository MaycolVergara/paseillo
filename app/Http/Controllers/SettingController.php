<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Muestra el formulario de configuración.
     */
    public function index()
    {
        $settings = SettingModel::first();
        return view('setting', compact('settings'));
    }

    /**
     * Actualiza la configuración de la empresa.
     */
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_subtitle' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $settings = SettingModel::first();
        if (!$settings) {
            $settings = new SettingModel();
        }

        $settings->company_name = $request->company_name;
        $settings->company_subtitle = $request->company_subtitle;

        if ($request->hasFile('company_logo')) {
            $disk = config('filesystems.default') === 's3' ? 's3' : 'public';

            // Eliminar logo anterior si no es el default
            if ($settings->company_logo && !str_contains($settings->company_logo, 'logo_principal.png')) {
                Storage::disk($disk)->delete($settings->company_logo);
            }

            // Guardar nuevo logo
            $path = $request->file('company_logo')->store('brand', $disk);
            $settings->company_logo = $path;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Configuración actualizada correctamente');
    }
}
