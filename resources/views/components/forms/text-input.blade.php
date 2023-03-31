@props([
    'type' => 'text',
    'value' => '',
    'isError' => false,
])

<input
    type="{{$type}}" value="{{$value}}"
    {{ $attributes->class([
        '_is-error' => $isError,
        'w-full h-14 px-4 rounded-lg border border-[#85552d] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#85552d] outline-none transition text-xxs md:text-xs font-semibold'])}}>
