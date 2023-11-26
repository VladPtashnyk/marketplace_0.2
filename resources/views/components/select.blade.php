<div>
<label for="{{ $type }}" class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.' . $type) }}</label>
<select name="{{ $idEntity }}" id="{{ $type }}"
        class="block mt-1 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
    @foreach ($entities as $entity)
        <option value="{{ $entity[$idEntity] }}"
            @if (!empty($filters[$idEntity]) && $filters[$idEntity] == $entity[$idEntity])
                selected
            @elseif ($entity[$idEntity] == 0)
                selected
            @endif
        >{{ ucfirst($entity['name']) }} {{ $entity['surname'] ?? '' }}</option>
    @endforeach
</select>
</div>
