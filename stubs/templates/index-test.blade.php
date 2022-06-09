@php echo "<?php";
@endphp

namespace Tests\Unit\{{$modelBaseName}};

@php $datatableComponent = ucfirst(Str::plural($modelBaseName)).'Table'; @endphp


use App\Http\Livewire\{{ucfirst(Str::plural($modelBaseName))}}\Datatable\{{$datatableComponent}};
use Tests\TestCase;
use App\Models\{{$modelBaseName}};
use App\Http\Livewire\{{ucfirst(Str::plural($modelBaseName))}}\Index;
use Livewire\Livewire;


class IndexTest extends TestCase
{

    public function test_we_can_find_datatable_on_index()
    {
        Livewire::test(Index::class)
          ->assertSeeLivewire({{$datatableComponent}}::class);
    }
}


