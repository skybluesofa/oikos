<?php
$entry->image = rand(0, 1);
?>
<div class="mt-1 border rounded-sm md:rounded-md shadow-lg bg-white flex-col-reverse lg:flex-row flex items-stretch text-xs sm:text-base">
    <div class="p-5 text-gray-700 flex-initial flex flex-row lg:flex-col items-stretch">
        <div class="w-12 lg:w-32">
            <img class="border border-indigo-100 shadow-lg round w-32 object-center" src="http://lilithaengineering.co.za/wp-content/uploads/2017/08/person-placeholder.jpg">
        </div>
        <div class="text-center w-32">{{ $entry->user }}</div>
    </div>
    <div class="text-gray-700 flex-auto bg-gray-100 @if (!$entry->image) rounded-t-sm md:rounded-t-md lg:rounded-r-md @endif">
        <div class="p-5 pb-2">
            @foreach (explode("\n", $entry->content) as $paragraph)
                <p class="pb-3">{{ $paragraph }}</p>
            @endforeach
        </div>
    </div>
    @if ($entry->image)
        <div class="flex-auto w-full">
            <?php
            $width = rand(3, 4) * 100;
            $height = rand(3, 4) * 100;
            ?>
            <img src="https://picsum.photos/{{ $width }}/{{ $height }}" class="rounded-t-sm md:rounded-t-md lg:rounded-t-none lg:rounded-r-md object-cover w-full lg:h-full">
        </div>
    @endif
</div>
