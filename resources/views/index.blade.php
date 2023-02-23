<p>
    {{ $greeting }} {{ $name or '' }}. Welcome Back~
</p>


<ul>
    @foreach($items as $item)
        <li>{{ $item }}</li>
    @endforeach
</ul>


@if($itemCount = count($items))
    <p>There are {{ $itemCount }} items !</p>
@else
    <p>There is no item !</p>
@endif


<!--변수에 값이 있고 ArrayAccess를 할 수 있으면-->
<?php //$items = []; ?>
@forelse($items as $item)
    <p>The item is {{ $item }}</p>
@empty
    <p>There is no item !</p>
@endforelse