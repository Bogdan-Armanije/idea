@props(['label' => false,'name','type' =>'text'])

<div class="space-y-2">
    @if($label)
        <label for="{{$name}}" class="label">{{$label}}</label>
    @endif

    @if($type === 'textarea')
        <textarea id="{{$name}}" name="{{$name}}" class="textarea" {{$attributes}} > {{old($name)}} </textarea>
    @else
        <input type="{{$type}}" id="{{$name}}" name="{{$name}}" class="input" value="{{old($name)}}" {{$attributes}}>
    @endif

<x-form.error name="{{$name}}"></x-form.error>
</div>

