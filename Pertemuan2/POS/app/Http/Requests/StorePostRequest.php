<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

use function PHPUnit\Framework\returnSelf;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'kodeKategori' => 'required',
                'namaKategori' => 'required',
        ];
    }

    public function store(StorePostRequest $request): RedirectResponse{
        
        // The incoming request is valid 

        //Retrive the validated input data 
        $validated = $request->validate();

        //Retrive a portion of the validated input data 
        $validated = $request->safe()->only(['kodeKategori', 'namaKategori']);
        $validated = $request->safe()->except(['kodeKategori', 'namaKategori']);

        // store the post

        return redirect('/kategori');

    }
}
