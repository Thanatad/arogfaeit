<option value="" selected disabled>Select Day</option>
@foreach($daylists as $item)
<option value="{{$item->name}}">{{$item->name}}</option>
@endforeach
