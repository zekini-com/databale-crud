

/* Auto-generated admin routes */
Route::group(['prefix'=>'{{Str::plural($resource)}}'], function() {
    Route::get('/', App\Http\Livewire\{{$livewireFolderName}}\Index::class)->name('{{Str::plural($resource)}}');

});
