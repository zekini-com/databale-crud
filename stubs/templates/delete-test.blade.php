@php echo "<?php";
@endphp


namespace Tests\Unit\{{$modelBaseName}};

use App\Http\Livewire\{{ucfirst(Str::plural($modelBaseName))}}\Delete;
use Tests\TestCase;
use App\Models\{{$modelBaseName}};
use Livewire\Livewire;


class DeleteTest extends TestCase
{

    public function test_we_can_delete_a_record()
    {
        $model = {{ucfirst($modelBaseName)}}::factory()->create();

        Livewire::test(Delete::class, ['modelId'=> $model->id])
        ->call('delete');

       // record is deleted
       $this->assertFalse({{ucfirst($modelBaseName)}}::where('id', $model->id)->exists());
    }
}

