<button
    {{ $attributes->merge(['type' => 'submit','class' => 'px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900']) }}>{{ $slot }}</button>
