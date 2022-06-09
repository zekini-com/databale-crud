@php
$openBlade = '{{';
$closeBlade = '}}';
@endphp
@foreach($vissibleColumns as $col)
@php
$textLabel = str_replace('_',' ',ucfirst($col['name']));
$wireModel = $col['name'];
@endphp
@if(in_array($col['name'], $belongsTo))
<div class="mb-6">

    <label for="{{$col['name']}}" class="block text-gray-700 text-sm font-bold mb-2">{{ $textLabel }}</label>
    <div class="col-xl-8">
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="state.{{$wireModel}}" id="{{ $col['name'] }}" name="{{ $col['name'] }}">
            {{'@'}}foreach(\App\Models\{{ucfirst(str_replace('_id','',$col['name']))}}::all() as $item)
            <option wire:key="{!! $openBlade !!} $item->id {!! $closeBlade !!}" value="{!! $openBlade !!} $item->id {!! $closeBlade !!}"> {!! $openBlade !!} $item->{{$recordTitleMap[Str::plural(str_replace('_id', '', $col['name']))]}} {!! $closeBlade !!}</option>
            {{'@'}}endforeach
        </select>
        {{'@'}}error('state.{{$col['name']}}') <span> {!! $openBlade !!} $message {!! $closeBlade !!} </span> {{'@'}}enderror
    </div>
</div>
@elseif($col['type'] == 'boolean')
<div class="mb-6">
    <label for="{{$col['name']}}" class="block text-gray-700 text-sm font-bold mb-2">{{ $textLabel }}</label>
    <div class="col-xl-8">
        <input class="form-check-input col-md-9" wire:model="state.{{$wireModel}}" id="{{ $col['name'] }}" type="checkbox" name="{{ $col['name'] }}">
        {{'@'}}error('state.{{$col['name']}}') <span> {!! $openBlade !!} $message {!! $closeBlade !!} </span> {{'@'}}enderror
    </div>
</div>
@elseif($col['type'] == 'text')
<div class="mb-6">
    <label for="{{ $col['name'] }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $textLabel }}</label>
    <div class="col-md-9 col-xl-8">
        <div>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="state.{{$wireModel}}" id="{{ $col['name'] }}" name="{{ $col['name'] }}"></textarea>
            {{'@'}}error('state.{{$col['name']}}') <span> {!! $openBlade !!} $message {!! $closeBlade !!} </span> {{'@'}}enderror
        </div>
    </div>
</div>
@elseif($col['type'] == 'datetime')
<div class="mb-6">
    <label for="{{$col['name']}}" class="block text-gray-700 text-sm font-bold mb-2">{{ $textLabel }}</label>
    <div class="col-xl-8 col-md-9">
        <input id="{{ $col['name'] }}" type="datetime-local" wire:model="state.{{$wireModel}}" name="{{ $col['name'] }}">
        {{'@'}}error('state.{{$col['name']}}') <span> {!! $openBlade !!} $message {!! $closeBlade !!} </span> {{'@'}}enderror
    </div>
</div>
@else

@if($col['name'] == 'image' || $col['name'] == 'file')
<div class="mb-6">
    <label for="{{$col['name']}}" class="block text-gray-700 text-sm font-bold mb-2">{{ $textLabel }}</label>
    <div class="col-xl-8">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="{{ $col['name'] }}" wire:model="state.{{$wireModel}}" type="file" name="{{ $col['name'] }}" multiple>
        {{'@'}}error('state.{{$col['name']}}') <span> {!! $openBlade !!} $message {!! $closeBlade !!} </span> {{'@'}}enderror
    </div>
</div>
@else
<div class="mb-6">
    <label for="{{$col['name']}}" class="block text-gray-700 text-sm font-bold mb-2">{{ $textLabel }}</label>
    <div class="col-xl-8">
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="{{ $col['name'] }}" wire:model="state.{{$wireModel}}" type="text" name="{{ $col['name'] }}">
        {{'@'}}error('state.{{$col['name']}}') <span> {!! $openBlade !!} $message {!! $closeBlade !!} </span> {{'@'}}enderror
    </div>
</div>
@endif
@endif
@endforeach


@foreach($pivots as $pivot)
@php
$textLabel = str_replace('_',' ',ucfirst($pivot['table']));
$wireModel = $pivot['table'];
@endphp
<div class="mb-6">

    <label for="{{$pivot['table']}}" class="col-form-label text-md-right col-md-3">{{ $textLabel }}</label>
    <div class="col-xl-8">
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="state.{{$wireModel}}" id="{{ $pivot['table'] }}" name="{{ $pivot['table'] }}" multiple>
            {{'@'}}foreach(\App\Models\{{Str::singular(ucfirst(str_replace('_id','',$pivot['table'])))}}::all() as $item)
            <option wire:key="{!! $openBlade !!} $item->id {!! $closeBlade !!}" value="{!! $openBlade !!} $item->id {!! $closeBlade !!}"> {!! $openBlade !!} $item->{{$recordTitleMap[Str::plural(str_replace('_id', '', $pivot['table']))]}} {!! $closeBlade !!}</option>
            {{'@'}}endforeach
        </select>
        {{'@'}}error('state.{{$pivot['table']}}') <span> {!! $openBlade !!} $message {!! $closeBlade !!} </span> {{'@'}}enderror
    </div>
</div>
@endforeach
