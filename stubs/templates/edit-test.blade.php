@php echo "<?php";
@endphp

namespace Tests\Unit\{{$modelBaseName}};

@php $datatableComponent = ucfirst(Str::plural($modelBaseName)).'Table'; @endphp


use Tests\TestCase;
use App\Models\{{$modelBaseName}};
use App\Http\Livewire\{{ucfirst(Str::plural($modelBaseName))}}\Edit;
use Livewire\Livewire;


class EditTest extends TestCase
{

    public function test_we_can_update_a_record()
    {
        $model = {{ucfirst($modelBaseName)}}::factory()->create();

        $this->faker = \Faker\Factory::create();

        @if($columnFakerMappings->first()['name'] == 'email')
            $randomData = $this->faker->safeEmail();
        @else
            $randomData = 'tester';
        @endif

        Livewire::test(Edit::class, ['id'=> $model->id])
        @foreach($columnFakerMappings as $index=>$col)
            @if($index == 0)
                ->set('state.{{$col['name']}}', $randomData)
            @else
                ->set('state.{{$col['name']}}', {!!$col['faker']!!})
            @endif
        @endforeach
        @foreach($pivots as $pivot)
            @php
            $pivotModelFactory = '\App\Models\\'.ucfirst(Str::singular($pivot['table']));
            @endphp
            ->set('state.{{$pivot["table"]}}', {{ $pivotModelFactory }}::factory()->create()->id)
        @endforeach

        ->call('update');

       // record is deleted
       $this->assertTrue({{ucfirst($modelBaseName)}}::where('{{$columnFakerMappings->first()['name']}}', $randomData)->exists());
    }

    public function test_we_can_update_fails_by_validation_record()
    {
        $model = {{ucfirst($modelBaseName)}}::factory()->create();

        $this->faker = \Faker\Factory::create();

        Livewire::test(Edit::class, ['id'=> $model->id])
        @foreach($columnFakerMappings as $index=>$col)
            @if($index == 0)
                ->set('state.{{$col['name']}}', '')
            @else
                ->set('state.{{$col['name']}}', {!!$col['faker']!!})
            @endif
        @endforeach
        @foreach($pivots as $pivot)
            @php
            $pivotModelFactory = '\App\Models\\'.ucfirst(Str::singular($pivot['table']));
            @endphp
            ->set('state.{{$pivot["table"]}}', {{ $pivotModelFactory }}::factory()->create()->id)
        @endforeach
        ->call('update')
        ->assertHasErrors(['state.{{$columnFakerMappings->first()['name']}}'=> 'required']);

    }
}



