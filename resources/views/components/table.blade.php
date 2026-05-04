@props([
    'headers' => [],
    'striped' => true,
    'class'   => '',
])

<div class="overflow-x-auto rounded-xl border border-gray-100">
    <table class="w-full text-sm data-table {{ $class }}">
        @if(count($headers) > 0)
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                @foreach($headers as $header)
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        @endif
        <tbody class="divide-y divide-gray-50 bg-white">
            {{ $slot }}
        </tbody>
    </table>
</div>
