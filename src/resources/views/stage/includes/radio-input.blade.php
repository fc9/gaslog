<label>
    <input type="radio"
        name="{{$name}}"
        value="{{$value}}"
        {{$checkedValue === $value ? 'checked': ''}}>
    <span></span>
    <p>{{$label}}</p>
</label>
