

/* Auto-generated admin routes */
Route::group(['prefix'=>'{{Str::plural($resource)}}'], function() {
    Route::get('/', App\Http\Livewire\{{$livewireFolderName}}\Index::class)->name('{{Str::plural($resource)}}');
    Route::get('/{id}', App\Http\Livewire\{{$livewireFolderName}}\Show::class)->name('{{Str::plural($resource)}}.show');
    Route::get('/{id}/edit', App\Http\Livewire\{{$livewireFolderName}}\Edit::class)->name('{{Str::plural($resource)}}.edit');
});
