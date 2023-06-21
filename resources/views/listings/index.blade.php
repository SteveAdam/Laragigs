<x-layout>


@section ('content')
@include('partials\_hero')
@include('partials._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

{{-- @php
// Directives can be used in blade components
// To use directives --> @'name of directive'
@endphp --}}


@if(count($lists) ==0)
     <p>Empty</p>
@else
    @foreach ($lists as $listing)
    <x-listing-card :listing="$listing"/>
     @endforeach
@endif


{{-- Instead of @if-else --}}
@unless(count($lists)==0)
<p>{{count($lists)}} listings found</p>
@else
<p>No listings mahn</p>
@endunless

</div>

<div class="mt-6 p-4">
    {{$lists->links()}}
</div> 

</x-layout>


