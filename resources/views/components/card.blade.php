{{-- classes passed as props to /views/componetsnt/X.blade from views/listing.blade--}}
<div {{$attributes->merge(['class'=>'bg-gray-50 border border-gray-200 rounded p-6'])}}>
  {{$slot}}
</div>
